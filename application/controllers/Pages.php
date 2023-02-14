<?php
class Pages extends CI_Controller
{

	public function dashboards()
	{
		$this->load->view('dashboards/header');
		$this->load->view('dashboards/main');
		$this->load->view('dashboards/footer');
	}

	public function connexion()
	{
		$this->load->view('pages/connexion');
	}
	public function logout()
	{
		$this->session->unset_userdata('logged_in');
		$this->session->sess_destroy();
		redirect('pages/connexion', 'refresh');
	}
}
