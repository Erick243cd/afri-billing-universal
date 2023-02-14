<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

	public function index()
	{
		if (date('Y-m-d') >= '2023-05-20') {
			$this->session->set_flashdata('delay_expirate', "L'application nécessite des nouvelles mises à jour !");
			redirect('pages/connexion');
		} else {
			$this->form_validation->set_rules('username', 'User Name', 'required');
			$this->form_validation->set_rules('password', 'Password', 'trim|required|callback_authentification');
			if ($this->form_validation->run() === FALSE) {

				$this->session->set_flashdata('connexion_failed', 'Nom d\'utilisateur ou mot de passe incorrect !');
				redirect(base_url('pages/connexion'));
			} else {
				redirect(base_url('pages/dashboards'));
			}
		}
	}

	function authentification($password)
	{

		$username = $this->input->post('username');

		$result = $this->login_model->login($username, $password);

		if ($result) {
			$sess_array = array();
			foreach ($result as $row) {
				$sess_array = $arrayName = array(
					'id' => $row->id,
					'user_name' => $row->user_name,
					'role_utilisateur' => $row->role_utilisateur,
					'user_image' => $row->user_image,
					'statut' => $row->statut,
					'sales_point_id' => $row->sales_point_id
				);
				$this->session->set_userdata('logged_in', $sess_array);
			}
			return true;
		} else {
			$this->session->set_flashdata('connexion_failed', 'Nom d\'utilisateur ou Mot de passe incorrect !');
			redirect(base_url('pages/connexion'));
		}
	}
}
