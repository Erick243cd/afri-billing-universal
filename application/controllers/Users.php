<?php

class Users extends CI_Controller
{
	public function index()
	{
		$data['title'] = 'Utilisateurs';
		$data['users'] = $this->user_model->get_users();

		$this->load->view('dashboards/header');
		$this->load->view('users/index', $data);
		$this->load->view('dashboards/footer');
	}

	public function create()
	{
		$data = array(
			'title' => 'Nouvel utilisateur',
			'salespoints' => $this->db->get('lq_salespoints')->result()
		);

		//Validation de formulaire
		$this->form_validation->set_rules('username', 'Nom utilisateur', 'required|is_unique[lq_users.user_name]');
		$this->form_validation->set_rules('role_user', 'Rôle utilisateur', 'required');
		$this->form_validation->set_rules('sales_point', 'Point de vente', 'required');

		if ($this->form_validation->run() === FALSE) {
			$this->load->view('dashboards/header');
			$this->load->view('users/create', $data);
			$this->load->view('dashboards/footer');
		} else {
			$this->user_model->create_user();

			//Set_messages
			$this->session->set_flashdata('success', 'Utilisateur crée avec succès !');
			redirect('users/index');
		}
	}

	public function edit($id)
	{
		$data = array(
			'user' => $this->user_model->get_user_id($id)
		);

		if (empty($data['user'])) {
			show_404();
		}
		$data['title'] = 'Editer les informations de l\'utilisateur';

		$this->load->view('dashboards/header');
		$this->load->view('users/edit', $data);
		$this->load->view('dashboards/footer');
	}

	public function edit_compte($id)
	{
		$data = array(
			'user' => $this->user_model->get_user_id($id),
			'salespoints' => $this->db->get('lq_salespoints')->result()
		);

		if (empty($data['user'])) {
			show_404();
		}
		$data['title'] = 'Editer les informations de base';

		$this->load->view('dashboards/header');
		$this->load->view('users/edit_compte', $data);
		$this->load->view('dashboards/footer');
	}

	public function update_compte()
	{
		$this->user_model->update_user_compte();
		//Set Message
		$this->session->set_flashdata('success', 'L\'utilisateur a été modifié avec succès !');
		redirect('users/index');
	}

	public function update()
	{
		//Upload Image
		$config['upload_path'] = './assets/img/users';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size'] = '4848';
		$config['max_width'] = '3500';
		$config['max_heigth'] = '3500';

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload()) {
			$errors = array('error' => $this->upload->display_errors());
			$id = $this->input->post('id');
			$data['user'] = $this->user_model->get_user_id($id);
			$user_image = $data['user']['user_image'];
		} else {
			$data = array('upload_data' => $this->upload->data());
			$user_image = $_FILES['userfile']['name'];
		}
		$this->user_model->update_user($user_image);
		//Set Message
		$this->session->set_flashdata('user_updated', 'Vos informations ont été modifiées !');
		redirect('users/view_membre');
	}

	public function view_membre()
	{
		$data['title'] = 'Mon compte';

		$data['user'] = $this->user_model->get_user_by_sessions();

		$this->load->view('dashboards/header');
		$this->load->view('users/vue_membre', $data);
		$this->load->view('dashboards/footer');
	}
}
