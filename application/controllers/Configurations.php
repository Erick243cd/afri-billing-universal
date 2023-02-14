<?php

class Configurations extends CI_Controller
{
	public function currency()
	{
		if (!isLoggedIn()) redirect('pages/connexion');

		if (userSessData()->role_utilisateur === 'admin') {

			$data = array(
				'currency' => $this->db->get('lq_currencies')->row(),
				'title' => "Taux"
			);

			$this->load->view('dashboards/header');
			$this->load->view('configurations/currency', $data);
			$this->load->view('dashboards/footer');

		} else {
			show_error("<b>Error</b>  Vous n'avez pas l'autorisation d'effectuer cette opération");
		}
	}

	public function updateCurrency()
	{
		$data = array(
			'currencyValue' => $this->input->post('currency')
		);

		$this->db->update('lq_currencies', $data);
		redirect('configurations/currency');
	}
}
