<?php

/**
 * Created by PhpStorm.
 * User: Congo Agile
 * Date: 21/10/2020
 * Time: 19:38
 */
class Categorie_model extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
	}

	function fetch()
	{
		$this->db->order_by('id_categorie', 'ASC');
		$query = $this->db->get_where('lq_categories', array('deleted' => 'not'));
		return $query->result();
	}

	function getShops()
	{
		$this->db->order_by('salespoint_id', 'DESC');
		return $this->db->get('lq_salespoints')->result();
	}

	public function getCategory($categoryId)
	{
		return $this->db->get_where('lq_categories', array('id_categorie' => $categoryId))->row();
	}

	public function create($data)
	{
		return $this->db->insert('lq_categories', $data);
	}

	public function update($categoryId, $data)
	{
		$this->db->where('id_categorie', $categoryId);
		return $this->db->update('lq_categories', $data);
	}

	public function delete($categoryId)
	{
		$this->db->where('id_categorie', $categoryId);
		$data = array('deleted' => 'yes');
		return $this->db->update('lq_categories', $data);
	}
}
