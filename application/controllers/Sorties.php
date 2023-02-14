<?php

/**
 * Created by PhpStorm.
 * User: Congo Agile
 * Date: 21/10/2020
 * Time: 20:44
 */
class Sorties extends CI_Controller
{

	function index()
	{
		$data['title'] = "Sorties enregistrées";
		$data['sorties'] = $this->sortie_model->fetch();


		$this->load->view('dashboards/header');
		$this->load->view('sorties/index', $data);
		$this->load->view('dashboards/footer');
	}

	function sortie($id)
	{
		$data = array(
			'categories' => $this->categorie_model->fetch(),
			'article' => $this->article_model->get_article_id($id),
			'title' => 'Enregistrer la sortie de l\'article',
			'sales_points' => $this->categorie_model->getShops()
		);

		$this->load->view('dashboards/header');
		$this->load->view('sorties/sortie', $data);
		$this->load->view('dashboards/footer');
	}

	function save()
	{

		$session_data = $this->session->userdata('logged_in');
		$userID = $session_data['id'];;

		$quantite_initiale = $this->input->post('qte_initial');
		$quantite_sortie = $this->input->post('qte_sortie');

		$sales_point = $this->input->post('sales_point');

		/*
         Quantité Sortie
        */
		$key_sortie_qte = rand(78452, 8569211);

		if ($quantite_sortie > $quantite_initiale) {
			$this->session->set_flashdata('error', "Impossible d'enregistrer, La quantité à sortir doit être inférieure ou égale à la quantité en stock!");
			redirect('sorties/sortie/' . $this->input->post('id_article'));
		} else {
			$quantite_actuel = $this->input->post('qte_initial') - $this->input->post('qte_sortie');

			$data_sortie = array(
				'id_article' => $this->input->post('id_article'),
				'qte_sortie' => $this->input->post('qte_sortie'),
				'date_sortie' => $this->input->post('date_sortie'),
				'motif_sortie' => 'Réapprovisionnement',
				'key_sortie' => $key_sortie_qte,
				'sales_pointId' => $sales_point,
				'userId' => $userID
			);

			$data_article = array(
				'qte_actuelle' => $quantite_actuel
			);

			$data_qte_sortie = array(
				'key_sortie' => $key_sortie_qte,
				'qte_restante' => $quantite_actuel
			);

			$this->sortie_model->save($data_sortie, $data_article, $data_qte_sortie);

			/*
			 * Reapportionment Sales points
			 */
			$productId = $this->input->post('id_article');

			$stock = $this->db->get_where('salespoint_stocks', array('productId' => $productId, 'salespointId' => $sales_point))->row();

			if (!empty($stock)) {
				$qtyDisposed = $stock->disponibleQty;
				$newQty = $qtyDisposed + $quantite_sortie;

				$updateData = array(
					'disponibleQty' => $newQty,
					'userId' => $userID,
					'updatedAt' => date('Y-m-d')
				);

				$this->db->update('salespoint_stocks', $updateData, array('productId' => $productId, 'salespointId' => $sales_point));

			} else {
				$newQty = $quantite_sortie;
				$createData = array(
					'salespointId' => $sales_point,
					'productId' => $productId,
					'disponibleQty' => $newQty,
					'userId' => $userID
				);

				$this->db->insert('salespoint_stocks', $createData);
			}
			//Set Message
			$this->session->set_flashdata('success', 'La sortie de l\'article a été bien enregistrée !');
			redirect('sorties');
		}
	}

	/*
	 * Printables Output reports (documents)
	 */

	public function printByOutput($outPutId = null)
	{
		$outPut = $this->sortie_model->getForPrint($outPutId);

		if (!empty($outPut)) {
			$data = array(
				'output' => $outPut,
				'title' => "Bon de sortie"
			);
			$this->load->view('sorties/bon', $data);
		} else {
			show_error('Le bon de sortie n\'a pas été retrouvé !');
		}
	}

	/*
	 * Bon by sales points
	 */
	public function salesPoints()
	{
		$data = array(
			'title' => "Stock par point de ventes",
			'sales_points' => $this->db->get_where('lq_salespoints', array('is_deleted' => 'N'))->result()
		);

		$this->load->view('dashboards/header');
		$this->load->view('sorties/sales_points', $data);
		$this->load->view('dashboards/footer');

	}

	public function printBySalesPoint($salesPointId = null)
	{
		$data = array(
			'sales_point' => $this->db->get_where('lq_salespoints', array('salespoint_id' => $salesPointId))->row(),
			'outputs' => $this->sortie_model->getOutPutBySalesPoint($salesPointId),
			'title' => 'Rapport de réapprovisionnement'
		);

		if (!empty($data['sales_point'])) {
			$this->load->view('sorties/bons', $data);
		} else {
			show_error('Le point de vente n\'a pas été retrouvé !');
		}

	}

	public function edit($outPutId)
	{
		if (!isLoggedIn()) redirect('pages/connexion');

		if (userSessData()->role_utilisateur === 'admin') {

			$outPut = $this->sortie_model->getOutput($outPutId);
			if (!empty($outPutId)) {
				$data = array(
					'title' => 'Modifier les informations pour la sortie',
					'output' => $outPut,
					'salespoints' => $this->db->get_where('lq_salespoints', array('is_deleted' => 'N'))->result()
				);
				$this->load->view('dashboards/header');
				$this->load->view('sorties/edit', $data);
				$this->load->view('dashboards/footer');

			} else {
				show_error("<b>Erreur</b>Aucune information n'a été trouvée pour cette sortie");
			}

		} else {
			show_error("<b>Erreur</b> Vous n'avez pas l'autorisation d'effectuer cette opération !");
		}
	}

	public function update($outPutId)
	{

		$productId = $this->input->post('product_id');
		$outputQty = $this->input->post('output_qty');
		$currentQty = $this->input->post('current_qty');

		$sales_pointId = $this->input->post('sales_point_id');
		$ancient_salesPointId = $this->input->post('ancient_sales_point_id');

		$currentProductQty = $this->db->get_where('lq_articles', array('id_article' => $productId))->row();
		$tmpQty = $currentProductQty->qte_actuelle + $outputQty;

		$qty = $tmpQty - $currentQty;

		if ($qty < 0) {
			//Set Message
			$this->session->set_flashdata('error', "Impossible d'enregistrer la modification, 
			La quantité saisie doit être supérieure ou égale à la quantité en stock");
			redirect('sorties/edit/' . $outPutId);
		} else {

			//Update sortie quantity
			$outputData = array(
				'qte_sortie' => $currentQty,
				'sales_pointId' => $sales_pointId
			);

			$this->sortie_model->updateOutput($outPutId, $outputData);

			//Update product quantity lq_articles
			$productData = array(
				'id_article' => $productId,
				'qte_actuelle' => $qty
			);
			$this->sortie_model->upateProductQty($productId, $productData);

			//Update sales point qty
			$salesPointData = array(
				'salespointId' => $sales_pointId,
				'disponibleQty' => $currentQty
			);
			$this->sortie_model->updateSalesPointStock($ancient_salesPointId, $productId, $salesPointData);


			//Table lq_quantites_sortie update
			$key = $this->db->select('key_sortie')->from('lq_sorties')->where('id_sortie', $outPutId)->get()->row();

			$this->db->update('lq_quantites_sortie', array('qte_restante' => $qty), array('key_sortie' => $key->key_sortie));


			$this->session->set_flashdata('success', "La mise à jour a été effectué avec succès !");
			redirect('sorties');
		}
	}

	public function stockBySalesPoint($salesPointId)
	{
		if (!isLoggedIn()) redirect('pages/connexion');

		if (userSessData()->role_utilisateur === 'admin') {

			$data = array(
				'sales_point' => $this->db->get_where('lq_salespoints', array('salespoint_id' => $salesPointId))->row(),
				'stockdata' => $this->db->join('lq_articles', 'lq_articles.id_article=salespoint_stocks.productId')
					->join('lq_unities', 'lq_articles.unityId=lq_unities.unityId')
					->get_where('salespoint_stocks', array('salespoint_stocks.salespointId' => $salesPointId))->result(),
				'title' => 'Rapport de stock',
			);
			$this->load->view('sorties/stock_report', $data);
		} else {
			$this->session->set_flashdata('error', "Vous n'avez pas l'autorisation d'accéder à ces informations !");
			redirect('sorties/salesPoints');
		}
	}
}
