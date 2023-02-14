<?php

class Articles extends CI_Controller
{
	public function index($offset = 0)
	{
		$data['title'] = 'Articles';

		$data['articles'] = $this->article_model->get_articles();

		$this->load->view('dashboards/header');
		$this->load->view('articles/index', $data);
		$this->load->view('dashboards/footer');
	}

	public function create()
	{
		$data = array(
			'title' => 'Nouvel article',
			'categories' => $this->categorie_model->fetch(),
			'unities' => $this->article_model->getUnities()
		);

		//Validation de formulaire
		$this->form_validation->set_rules('designation', 'Nom de l\'article', 'required');
		$this->form_validation->set_rules('prix_unitaire', 'Prix unitaire', 'required|numeric');
		$this->form_validation->set_rules('qte_initial', 'Quantité initiale', 'required|numeric');
		$this->form_validation->set_rules('unity', 'Unité', 'required');

		if ($this->form_validation->run() === FALSE) {
			$this->load->view('dashboards/header');
			$this->load->view('articles/create', $data);
			$this->load->view('dashboards/footer');
		} else {
			if (isset($_FILES["articlefile"]["name"])) {

				$config['upload_path'] = './assets/img/articles';
				$config['allowed_types'] = 'jpg|jpeg|png|webp';
				$config['encrypt_name'] = TRUE;
				$this->load->library('upload', $config);

				if (!$this->upload->do_upload('articlefile')) {
					$error = array('error' => $this->upload->display_errors());
					//print_r($error) ;
				} else {
					$data = (object)$this->upload->data();
				}
			}
			$this->article_model->create_article($data->file_name ?? 'product_image.png');
			//Set_messages
			$this->session->set_flashdata('article_created', 'L\'article a bien été créé avec succès!');
			redirect('articles');
		}
	}

	public function edit($id)
	{
		$data = array(
			'title' => 'Editer l\'article',
			'categories' => $this->categorie_model->fetch(),
			'unities' => $this->article_model->getUnities(),
			'article' => $this->article_model->get_article_id($id)
		);

		$this->load->view('dashboards/header');
		$this->load->view('articles/edit', $data);
		$this->load->view('dashboards/footer');
	}

	public function update()
	{
		$data = array(
			'designation' => htmlspecialchars($this->input->post('designation')),
			'prix_unitaire' => $this->input->post('prix_unitaire'),
			'prix_achat' => $this->input->post('prix_achat'),
			'devise' => $this->input->post('devise'),
			'qte_actuelle' => $this->input->post('qte_initial'),
			'id_categorie' => $this->input->post('id_categorie'),
			'unityId' => $this->input->post('unity'),
		);

		$this->article_model->update_article($data);
		//Set Message
		$this->session->set_flashdata('article_updated', 'Le produit a été modifié !');
		redirect('articles');
	}

	public function delete($id)
	{
		$this->article_model->delete_article($id);
		//Set Message
		$this->session->set_flashdata('article_deleted', 'L\'article a été supprimé avec succès !');
		redirect('articles');
	}

	function entree($id)
	{
		$data = array(
			'categories' => $this->categorie_model->fetch(),
			'article' => $this->article_model->get_article_id($id),
			'title' => 'Réapprovisionner l\'article'
		);

		$this->load->view('dashboards/header');
		$this->load->view('entrees/entree', $data);
		$this->load->view('dashboards/footer');
	}

	function reapprovisionner()
	{
		/*
         Quantité Sortie
            */
		$session_data = $this->session->userdata('logged_in');
		$userID = $session_data['id'];;

		$key_entree_qte = rand(78452, 8569211);

		$quantite_actuel = $this->input->post('qte_actuelle') + $this->input->post('qte_reappro');

		$data_entree = array(
			'id_article' => $this->input->post('id_article'),
			'qte_reappro' => $this->input->post('qte_reappro'),
			'date_reappro' => $this->input->post('date_reappro'),
			'nom_fournisseur' => $this->input->post('nom_fournisseur'),
			'key_entree' => $key_entree_qte,
			'userId' => $userID
		);

		$data_article = array(
			'qte_actuelle' => $quantite_actuel
		);

		$data_qte_entree = array(
			'key_entree' => $key_entree_qte,
			'qte_restante' => $quantite_actuel
		);
		$this->article_model->save_reappro($data_entree, $data_article, $data_qte_entree);
		//Set Message
		$this->session->set_flashdata('reapro_save', 'Le réapprovisionnement de l\'article a été bien enregistré !');
		redirect('articles/entreelist');
	}

	function entreelist()
	{
		$data['title'] = "Reapprovisionnements";
		$data['sorties'] = $this->article_model->fetch_reappro();

		$this->load->view('dashboards/header');
		$this->load->view('entrees/index', $data);
		$this->load->view('dashboards/footer');
	}

	function inventaire()
	{

		$mois = null; //Initialize month and motif value
		$motif = null;

		if ($this->input->post('month') !== NULL) {
			$mois = $this->input->post('month');
			$title = $mois . ' - ' . date('Y');

			$motif = $this->input->post('motif');
		}

		$data = array(
			'title' => $title ?? "",
			'products' => $this->inventaire_model->productData(),
			'outputs' => $this->inventaire_model->outputData($mois, $motif),
			'inputs' => $this->inventaire_model->inputData($mois),
			'motifs' => $this->inventaire_model->getMotifs()
		);

		$this->load->view('dashboards/header');
		$this->load->view('inventaire/index', $data);
		$this->load->view('dashboards/footer');
	}

	public function editInput($inputId)
	{
		$input = $this->article_model->getInput($inputId);
		$data = array(
			'input' => $input,
			'key_entree' => $input->key_entree,
			'title' => 'Editer le réapprovisionnement'
		);

		$this->load->view('dashboards/header');
		$this->load->view('entrees/edit', $data);
		$this->load->view('dashboards/footer');
	}

	public function updateInput($inputId)
	{
		$productCurrentQty = $this->input->post('current_qty');
		$productId = $this->input->post('product_id');
		$reapproQty = $this->input->post('qte_reappro');
		$newQty = $this->input->post('new_qty');
		$key_entree = $this->input->post('key_entree');

		//Les donnees de la table lq_quantites_entree
		$quantites_entree = $this->db->get_where('lq_quantites_entree', array('key_entree' => $key_entree))->row();

		//Update reappro
		$inputData = array(
			'qte_reappro' => $newQty,
			'nom_fournisseur' => $this->input->post('fournisseur')
		);
		$this->db->update('lq_reappro', $inputData, array('id_reappro' => $inputId));

		//Update lq_quantites_entree
		$qte_entree_data = array(
			'qte_restante' => $quantites_entree->qte_restante - $reapproQty + $newQty,
		);
		$this->db->update('lq_quantites_entree', $qte_entree_data, array('key_entree' => $key_entree));

		//Update Article stock lq_articles
		$productQty = array(
			'qte_actuelle' => $productCurrentQty - $reapproQty + $newQty,
		);

		$this->db->update('lq_articles', $productQty, array('id_article' => $productId));

		//Set Message
		$this->session->set_flashdata('reapro_save', 'La modification a été bien effectuée !');
		redirect('articles/entreelist');
	}
}
