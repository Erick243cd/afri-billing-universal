<?php

class Sales_points extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('sales_point_model');
	}

	public function index()
	{
		$data = array(
			'title' => 'Points de vente',
			'sales_points' => $this->db->get_where('lq_salespoints', array('is_deleted' => 'N'))->result(),
		);
		$this->load->view('dashboards/header');
		$this->load->view('sales-points/index', $data);
		$this->load->view('dashboards/footer');
	}

	public function create()
	{
		$data = array(
			'title' => 'Nouveau point de vente',
		);
		//Validation de formulaire
		$this->form_validation->set_rules('name', 'Nom du point de vente', 'required|is_unique[lq_salespoints.salespoint_name]');
		$this->form_validation->set_rules('address', 'Adresse du point de vente', 'required');

		if ($this->form_validation->run() === FALSE) {

			$this->load->view('dashboards/header');
			$this->load->view('sales-points/create', $data);
			$this->load->view('dashboards/footer');

		} else {
			$sess_data = $this->session->userdata('logged_in');
			$userID = $sess_data['id'];
			$data = array(
				'salespoint_name' => htmlspecialchars($this->input->post('name')),
				'salespoint_adress' => htmlspecialchars($this->input->post('address')),
				'user_id' => $userID
			);
			
			$this->sales_point_model->create($data);
			//Set_messages
			$this->session->set_flashdata('success', 'Point de vente crée avec succès !');
			redirect('sales_points/index');
		}
	}

	public function update($salesPointId)
	{

		$data['sales_point'] = $this->db->get_where('lq_salespoints', array('salespoint_id' => $salesPointId))->row();
		$data['title'] = 'Editer le point de vente';

		if (empty($data['sales_point'])) {

			show_error('Le point de vente choisi n\'a pas été retrouvé');

		} else {
			$this->form_validation->set_rules('name', 'Nom du point de vente', 'required');
			$this->form_validation->set_rules('address', 'Adresse du point de vente', 'required');

			if ($this->form_validation->run() === FALSE) {

				$this->load->view('dashboards/header');
				$this->load->view('sales-points/edit', $data);
				$this->load->view('dashboards/footer');

			} else {

				$newdata = array(
					'salespoint_name' => htmlspecialchars($this->input->post('name')),
					'salespoint_adress' => htmlspecialchars($this->input->post('address')),
				);

				$this->sales_point_model->update($salesPointId, $newdata);
				//Set_messages
				$this->session->set_flashdata('success', 'Point de vente mis à jour avec succès !');
				redirect('sales_points/index');
			}
		}
	}

	function delete($salesPointId)
	{
		$data = array(
			'is_deleted' => 'Y',
		);

		$this->sales_point_model->update($salesPointId, $data);
		$this->session->set_flashdata('success', 'Point de vente supprimé avec succès !');
		redirect('sales_points/index');
	}
}
