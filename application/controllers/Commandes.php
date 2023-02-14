<?php

use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\Printer;

class Commandes extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('sales_point_model');
	}

	public function index()
	{
		$sess_data = $this->session->userdata('logged_in');
		$salesPointId = $sess_data['sales_point_id'];
		$userRole = $sess_data['role_utilisateur'];

		$data = array(
			'title' => 'Factures enregistrées',
			'factures' => $this->commande_model->get_commandes($salesPointId, $userRole),
			'userRole' => $userRole
		);


		$this->load->view('dashboards/header');
		$this->load->view('factures/index', $data);
		$this->load->view('dashboards/footer');
	}

	public function canceledCommands()
	{
		$sess_data = $this->session->userdata('logged_in');
		$salesPointId = $sess_data['sales_point_id'];
		$userRole = $sess_data['role_utilisateur'];
		$data['title'] = 'Factures annulées';

		$data['factures'] = $this->commande_model->getCanceledCommands($salesPointId, $userRole);

		$this->load->view('dashboards/header');
		$this->load->view('factures/canceled', $data);
		$this->load->view('dashboards/footer');
	}

	public function create()
	{
		$this->load->library("cart");

		$client_token = substr(str_shuffle(str_repeat('123456789', mt_rand(5, 20))), 0, 5);
		$fact_token = substr(str_shuffle(str_repeat('987654321', mt_rand(5, 20))), 0, 5);
		$usb_amount = htmlentities($this->input->post('usd_amount'));
		$cdf_amount = htmlentities($this->input->post('cdf_amount'));
		$client_name = htmlentities($this->input->post('client_name'));
		//$is_cash = $this->input->post('is_cash');
		$is_tva = $this->input->post('is_tva');

		$sess_data = $this->session->userdata('logged_in');
		$salesPointId = $sess_data['sales_point_id'];
		$userId = $sess_data['id'];
		//var_dump($this->cart->contents()); die();
		if (!empty($this->cart->contents())) {
			foreach ($this->cart->contents() as $items) {
				$data = array(
					'id_article' => $items["id"],
					'prix_achat' => $items["buy_price"],
					'prix_unitaire' => $items["unit_price"],
					'prix_vente' => $items["price"],
					'qte_achetee' => $items["qty"],
					'remise' => $items["remise"],
					'usd_amount' => $usb_amount,
					'cdf_amount' => $cdf_amount,
					'product_tva' => isset($is_tva) ? $items['subtotal'] * 0.16 : $items['tva'],
					'subtotal' => $items["subtotal"],
					'totalWithRemise' => $items["totalWithRemise"],
					'fact_token' => $fact_token,
					'client_token' => $client_token,
					'client_name' => $client_name,
					'date_facture' => date('Y-m-d'),
					'is_cash' => 1,//isset($is_cash) ? $is_cash : 0,
					'userId' => $userId,
					'salespointId' => $salesPointId,
					'currency' => $this->db->get('lq_currencies')->row()->currencyValue
				);

				//Mise jour de la quantité
				$product = $this->sales_point_model->getQuantity($items['id'], $salesPointId);

				if ($items['qty'] > $product->qte_actuelle) {
					$this->session->set_flashdata('error', "<b>Erreur</b>, 
														La quantité en stock de l'article <b>{$product->designation}</b>
														 est inférieure à celle qui est saisie,
													 Veuillez réapprovisionner puis compléter l'article sur la facture !");
					redirect(base_url('shopping_cart/index'));

				} else {
					$reste = $product->disponibleQty - $items['qty'];
					$DataQty = array(
						'disponibleQty' => $reste
					);
					$this->sales_point_model->updateProductQuantity($items['id'], $salesPointId, $DataQty);
				}
				$this->commande_model->create_commande($data); //Create command
			}

//			$data['solde'] = $this->commande_model->getSolde($salesPointId);
//
//			if (!empty($data['solde'])) {
//				$general_solde = $data['solde']['montant_entree'];
//				$usd_solde = $data['solde']['usd_amount'];
//				$cdf_solde = $data['solde']['cdf_amount'];
//
//				$data_solde = array(
//					'usd_amount' => $usd_solde + $usb_amount,
//					'cdf_amount' => $cdf_solde + $cdf_amount,
//					'montant_entree' => $general_solde + $usb_amount
//				);
//				$this->commande_model->update_solde($salesPointId, $data_solde);
//			} else {
//				//Solde add data
//
//			}
			//Create Solde
			$data_solde = array(
				//'montant_entree' => $usb_amount,
				'usd_amount' => $usb_amount,
				'cdf_amount' => $cdf_amount,
				'salesPointId' => $salesPointId,
				'fact_token' => $fact_token,
				'client_token' => $client_token,
			);
			$this->commande_model->insert_solde($data_solde);

			redirect('commandes/factureDetail/' . $fact_token . '/' . $client_token);
		} else {
			$this->session->set_flashdata('error', '<b>Erreur</b>, La facture ne contient aucune élément, Veuillez ajouter des articles à la facture.!');
			redirect(base_url('shopping_cart/index'));
		}
	}

	public function delete($id)
	{
		$this->commande_model->delete_commande($id);
		//Set Message
		$this->session->set_flashdata('commande_deleted', 'La commande a été supprimée !');
		redirect('commandes/index');
	}

	function factureDetail($fact_token, $client_token)
	{
		$sess_data = $this->session->userdata('logged_in');

		$salesPointId = $this->db->get_where('lq_factures', array('fact_token' => $fact_token, 'client_token' => $client_token))->first_row()->salespointId;
		$userRole = $sess_data['role_utilisateur'];

		$data = array(
			'factures' => $this->commande_model->factureDetails($fact_token, $client_token, $salesPointId, $userRole),
			'facture' => $this->commande_model->factureDetail($fact_token, $salesPointId, $userRole)
		);

		$this->load->library("cart");
		$this->cart->destroy();
		$this->session->set_flashdata('succsess', 'Facture enregitrée!');

		$this->load->view('factures/fact_more', $data);

	}

	function soldes()
	{
		$request = $this->input->post('date_facture');

		$usd_amount = 0;
		$cdf_amount = 0;
		$remise_amount = 0;
		$subtotal = 0;

		$sess_data = $this->session->userdata('logged_in');
		$salesPointId = $sess_data['sales_point_id'];
		$userRole = $sess_data['role_utilisateur'];

		$soldes = $this->commande_model->getSoldeStory($request, $userRole, $salesPointId);

		if (!empty($soldes)) {
			foreach ($soldes as $solde) {
				$usd_amount += $solde->usd_amount;
				$cdf_amount += $solde->cdf_amount;
				$remise_amount += $solde->remise;
				$subtotal += $solde->subtotal;
			}
		}
		$data = (object)array(
			'usd_amount' => $usd_amount,
			'cdf_amount' => $cdf_amount,
			'remise' => $remise_amount,
			'subtotal' => $subtotal,
		);

		$this->load->view('dashboards/header');
		$this->load->view('soldes/index', $data);
		$this->load->view('dashboards/footer');
	}

	function facturesByarticle()
	{
		$sess_data = $this->session->userdata('logged_in');
		$salesPointId = $sess_data['sales_point_id'];
		$userRole = $sess_data['role_utilisateur'];

		$request = $this->input->post('date_facture') ?? date('Y-m-d');

		$data['factures'] = $this->commande_model->facturesByarticle($request, $userRole, $salesPointId);


		$this->load->view('dashboards/header');
		$this->load->view('factures/list', $data);
		$this->load->view('dashboards/footer');
	}

	function retrieve()
	{
		$data = array('current' => $this->commande_model->getSolde());

		$this->load->view('dashboards/header');
		$this->load->view('soldes/retrieve', $data);
		$this->load->view('dashboards/footer');
	}

	function saveRetrieve()
	{

		$data['current'] = $this->commande_model->getSolde();

		$current_amount = $data['current']['montant_entree'];

		$amount_to_retrieve = $this->input->post('amount_retrieve');

		$data_solde = ['montant_entree' => $current_amount - $amount_to_retrieve];

		$this->commande_model->update_solde($data_solde);

		$data = array(
			'preview_amount' => $current_amount,
			'retrieve_amount' => $amount_to_retrieve,
			'current_amount' => $current_amount - $amount_to_retrieve,
			'retrieve_date' => $this->input->post('date_retrait'),
			'motif' => $this->input->post('motif_retrait')
		);

		$this->commande_model->saveRetrieve($data);

		$this->session->set_flashdata('success', 'Le retrait a été enregistré !');
		redirect(base_url('commandes/soldes'));
	}

	function retrieveList()
	{
		$data['retrieves'] = $this->commande_model->getRetrieve();

		$this->load->view('dashboards/header');
		$this->load->view('soldes/retrievelist', $data);
		$this->load->view('dashboards/footer');
	}


	public function cancelFacture($factureToken, $clientToken)
	{
		$sess_data = $this->session->userdata('logged_in');
		$userRole = $sess_data['role_utilisateur'];

		$salesPointId = $this->db->get_where('lq_factures', array('fact_token' => $factureToken, 'client_token' => $clientToken))->first_row()->salespointId;

		if ($userRole == 'admin') {

			$factures = $this->commande_model->factureDetails($factureToken, $clientToken, $salesPointId, $userRole);

			if (!empty($factures)) {
				foreach ($factures as $item) {
					$product = $this->sales_point_model->getQuantity($item->id_article, $salesPointId);
					$newQuantity = $product->disponibleQty + $item->qte_achetee;
					$data = array(
						'disponibleQty' => $newQuantity
					);
					//Restore Quantity
					$this->sales_point_model->updateProductQuantity($item->id_article, $salesPointId, $data);
				}
				//Update soldes and cancel it
				$this->db->update('lq_soldes', array('is_canceled' => 'y'), array('salesPointId' => $salesPointId, 'fact_token'=>$factureToken, 'client_token'=>$clientToken));

				//Command updated
				$commandData = array(
					'is_canceled' => "1"
				);
				$this->commande_model->cancelCommand($factureToken, $clientToken, $commandData);

				$this->session->set_flashdata('success', 'La facture a été annulée avec succès !');
				redirect(base_url('commandes/index'));

			} else {
				$this->session->set_flashdata('error', 'La facture n\'a pas été retrouvée !');
				redirect(base_url('commandes/index'));
			}
		} else {
			show_error('La facture ne peut être annulée que par l\'Administrateur');
		}
	}

	public function paymentReceipt($fact_token, $client_token)
	{
		$sess_data = $this->session->userdata('logged_in');
		$salesPointId = $this->db->get_where('lq_factures', array('fact_token' => $fact_token, 'client_token' => $client_token))->first_row()->salespointId;
		$userRole = $sess_data['role_utilisateur'];

		$data = array(
			'factures' => $this->commande_model->factureDetails($fact_token, $client_token, $salesPointId, $userRole),
			'facture' => (object)$this->commande_model->factureDetail($fact_token, $salesPointId, $userRole)
		);

		if (!empty($data['facture']) && !empty($data['factures'])) {

			//$connector = new \Mike42\Escpos\PrintConnectors\NetworkPrintConnector('10.252.44.191', 9100);

			$connector = new WindowsPrintConnector("smb://Afrinewsoft/KazicCompanyPrinter");

			$printer = new  Printer($connector);

			try {
				/* Start the printer */

				/* Name of organisation */

				$printer->selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
				$printer->setJustification(Printer::JUSTIFY_CENTER);
				$printer->setEmphasis(true);
				$printer->text("KAZIC COMPANY SARL\n");
				$printer->text("RCCM: KHI/015-B-69 .\n");
				$printer->text("ID.NAT: 6-83- N60270B .\n");
				$printer->text("N° IMPOT : A1510169W .\n");
				$printer->feed();

				/* Title of receipt */
				$printer->setJustification(Printer::JUSTIFY_CENTER);
				$printer->setEmphasis(false);
				$printer->text("Facture N°: {$data['facture']->fact_token} \n");
				$printer->text("Client  : {$data['facture']->client_name} \n");
				$printer->text("Date  : {$data['facture']->date_facture} \n");
				$printer->setEmphasis(false);
				$printer->feed(2);

				/*
				 * CURRENCY
				 */
				$printer->setEmphasis(true);
				$printer->setJustification(Printer::JUSTIFY_RIGHT);
				$printer->text("CDF\n");

				/* Items */
				$printer->setEmphasis(false);
				$printer->setJustification(Printer::JUSTIFY_LEFT);
				$printer->text("ARTICLE  ");
				$printer->text("QTE  ");
				$printer->setJustification(Printer::JUSTIFY_CENTER);
				$printer->text("PU  ");
				$printer->setJustification(Printer::JUSTIFY_RIGHT);
				$printer->text("PT\n");
				$printer->text("_______________________\n");

				$total = 0;
				foreach ($data['factures'] as $item) {
					$printer->setJustification(Printer::JUSTIFY_LEFT);
					$printer->text("{$item->designation}  ");
					$printer->text("{$item->qte_achetee}  ");

					$printer->setJustification(Printer::JUSTIFY_CENTER);
					$printer->text("{$item->prix_unitaire}  ");

					$printer->setJustification(Printer::JUSTIFY_RIGHT);
					$printer->text("{$item->subtotal}\n");
					$printer->text("_______________________\n");

					$total += $item->subtotal;
				}

				/* Tax and total */

				$tva = number_format($total * 0.16, 2, ',', '');
				$phtva = number_format($total - $tva);
				$totalNet = number_format($total - $data['facture']->remise, 2, ',', '');
				$formatedTotal = number_format($total, 2, ',', '');
				$formatedReduction = number_format($data['facture']->remise, 2, ',', '');

				$printer->selectPrintMode(\Mike42\Escpos\Printer::MODE_DOUBLE_WIDTH);
				$printer->setJustification(\Mike42\Escpos\Printer::JUSTIFY_RIGHT);
				$printer->setEmphasis(true);
				$printer->text("TOTAL : {$formatedTotal} \n");

				$printer->setEmphasis(false);
				$printer->text("REDUCTION : {$formatedReduction} \n");
				$printer->text("PRIX HORS TVA : {$phtva} \n");
				$printer->text("TVA (16%) : {$tva} \n");

				$printer->setEmphasis(true);
				$printer->text("NET A PAYER : CDF  {$totalNet}");


				/* Footer */
				$printer->feed(2);
				$printer->setJustification(\Mike42\Escpos\Printer::JUSTIFY_CENTER);
				$printer->text("NB: Les marchandises vendues ne sont ni reprises ni échangées.\n");

				/* Cut the receipt and open the cash drawer */
				$printer->cut();
				$printer->pulse();
				$printer->close();

				$this->session->set_flashdata('success', 'L\'impression a été lancée...');
				redirect(base_url('commandes/factureDetail/' . $fact_token . '/' . $client_token));


			} catch (\Exception $e) {
				$data = [
					'errors' => "Impossible d'imprimer à cette imprimante -> : " . $e->getMessage() . "\n",
					'paymentID' => $fact_token
				];
				show_error($data);
			}

		} else {
			show_error('Aucune informarmation trouvée pour la facture lancée');
		}
	}


}
