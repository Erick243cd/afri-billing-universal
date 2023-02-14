<?php

class Categories extends CI_Controller
{
	public function index()
	{
		$data = array(
			'title' => "Categories d'articles",
			'categories' => $this->categorie_model->fetch()
		);
		$this->load->view('dashboards/header');
		$this->load->view('categories/index', $data);
		$this->load->view('dashboards/footer');
	}

	public function create()
	{
		$data = array(
			'title' => "Catégorie d'article",
		);
		$this->form_validation->set_rules('categoryName', 'Nom de la catégorie', 'required|is_unique[lq_categories.nom_categorie]');

		if ($this->form_validation->run() === FALSE) {
			$this->load->view('dashboards/header');
			$this->load->view('categories/create', $data);
			$this->load->view('dashboards/footer');
		} else {

			$data = array(
				'nom_categorie' => htmlspecialchars($this->input->post('categoryName')),
				'deleted' => 'not'
			);
			$this->categorie_model->create($data);
			//Set_messages
			$this->session->set_flashdata('success', 'La catégorie  a bien été ajoutée avec succès!');
			redirect('categories');
		}
	}

	public function edit($categoryId)
	{
		$category = $this->categorie_model->getCategory($categoryId);
		if (!empty($category)) {
			$data= array('category' => $category, 'title'=>'Editer catégorie');

			$this->load->view('dashboards/header');
			$this->load->view('categories/edit', $data);
			$this->load->view('dashboards/footer');

		} else show_error('La catégorie choisie n\'est pas reconnue');
	}

	public function update($categoryId)
	{
		$data = array('nom_categorie' => htmlspecialchars($this->input->post('categoryName')));

		$this->categorie_model->update($categoryId, $data);

		$this->session->set_flashdata('success', 'La catégorie  a bien été modifiée avec succès!');
		redirect('categories');
	}

	public function delete($categoryId)
	{
		$category = $this->categorie_model->getCategory($categoryId);
		if (!empty($category)) {
			$this->categorie_model->delete($categoryId);
			$this->session->set_flashdata('success', 'La catégorie  a bien été supprimée avec succès!');
			redirect('categories');
		} else {
			show_error('Catégorie non retrouvée');
		}
	}
}
