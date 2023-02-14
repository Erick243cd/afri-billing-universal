<?php

class Inventaire extends CI_Controller
{

	function index()
	{

		$data = array(
			'products' => $this->inventaire_model->productData(),
			'inputs' => $this->inventaire_model->sortieData(),
			'outputs' => $this->inventaire_model->entreeData(),
		);
		var_dump($data);
		die();


		$this->load->view('dashboards/header');
		$this->load->view('inventaire/index', $data);
		$this->load->view('dashboards/footer');
	}
}
