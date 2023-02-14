<?php

class Commande_model extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
	}

	public function create_commande($data)
	{

		return $this->db->insert('lq_factures', $data);
	}

	public function insert_solde($data)
	{
		return $this->db->insert('lq_soldes', $data);
	}

	function update_solde($salesPoint, $data)
	{
		$this->db->where('salesPointId', $salesPoint);
		return $this->db->update('lq_soldes', $data);
	}

	function getSolde($salesPoint)
	{
		$this->db->limit(1);
		return $this->db->get_where('lq_soldes', array('salesPointId' => $salesPoint))->row_array();
	}


	public function get_commandes($salesPoint, $userRole)
	{
		if ($userRole != 'admin') {
			$wheres = array('is_canceled' => "0", 'salespointId' => $salesPoint);
		} else {
			$wheres = array('is_canceled' => "0");
		}
		$this->db->group_by('fact_token');
		$this->db->join('lq_salespoints', 'lq_salespoints.salespoint_id=lq_factures.salespointId');
		$this->db->order_by('date_facture', 'DESC');
		return $this->db->get_where("lq_factures", $wheres)->result();
	}

	public function getCanceledCommands($salesPoint, $userRole)
	{
		if ($userRole != 'admin') {
			$wheres = array('is_canceled' => "1", 'salespointId' => $salesPoint);
		} else {
			$wheres = array('is_canceled' => "1");
		}
		$this->db->group_by('fact_token');
		$this->db->join('lq_salespoints', 'lq_salespoints.salespoint_id=lq_factures.salespointId');
		$this->db->order_by('id_facture', 'DESC');
		return $this->db->get_where("lq_factures", $wheres)->result();
	}

	public function delete_commande($id)
	{

		$this->db->where('id', $id);
		return $this->db->delete('commandes');

	}

	function factureDetails($fact_token, $clientToken, $salesPoint, $userRole)
	{
		if ($userRole != 'admin') {
			$wheres = array('fact_token' => $fact_token, 'client_token' => $clientToken, 'salespointId' => $salesPoint);
		} else {
			$wheres = array('fact_token' => $fact_token, 'client_token' => $clientToken);
		}

		$wheres = array('fact_token' => $fact_token);

		$this->db->join('lq_articles', 'lq_articles.id_article=lq_factures.id_article');
		$this->db->join('lq_unities', 'lq_unities.unityId=lq_articles.unityId');
		return $this->db->get_where("lq_factures", $wheres)->result();

	}

	function factureDetail($fact_token, $salesPoint, $userRole)
	{
		if ($userRole != 'admin') {
			$wheres = array('fact_token' => $fact_token, 'salespointId' => $salesPoint);
		} else {
			$wheres = array('fact_token' => $fact_token);
		}

		$this->db->limit(1);
		return $this->db->get_where("lq_factures", $wheres)->row_array();
	}

	function facturesByarticle($request, $userRole, $salesPoint)
	{
		if (isset($request) && $request != "") {
			if ($userRole == 'admin') {
				$wheres = array('date_facture' => $request, 'is_canceled' => "0");
			} else {
				$wheres = array('date_facture' => $request, 'is_canceled' => "0", 'salespointId' => $salesPoint);
			}

		} else {
			if ($userRole == 'admin') {
				$wheres = array('date_facture' => date('Y-m-d'), 'is_canceled' => "0");
			} else {
				$wheres = array('date_facture' => date('Y-m-d'), 'is_canceled' => "0", 'salespointId' => $salesPoint);
			}
		}


		$this->db->select('*');

		$this->db->select_sum('qte_achetee');
		$this->db->select_sum('totalWithRemise');
		$this->db->select_sum('remise');

		$this->db->group_by('lq_factures.id_article,salespointId');
		$this->db->join('lq_articles', 'lq_articles.id_article=lq_factures.id_article');
		$this->db->join('lq_salespoints', 'lq_salespoints.salespoint_id=lq_factures.salespointId');
		return $this->db->get_where("lq_factures", $wheres)->result();
	}

	function getSoldeStory($request, $userRole, $salesPoint)
	{
		if (isset($request)) {
			if ($userRole == 'admin') {
				$wheres = array('date_facture' => $request, 'is_canceled' => '0');
			} else {
				$wheres = array('date_facture' => $request, 'is_canceled' => '0', 'salespointId' => $salesPoint);
			}
		} else {
			if ($userRole == 'admin') {
				$wheres = array('date_facture' => date('Y-m-d'), 'is_canceled' => '0');
			} else {
				$wheres = array('date_facture' => date('Y-m-d'), 'is_canceled' => '0', 'salespointId' => $salesPoint);
			}
		}
		$this->db->select('is_canceled, fact_token, remise, usd_amount, cdf_amount, subtotal');
		$this->db->group_by('fact_token');
		return $this->db->get_where('lq_factures', $wheres)->result();
	}


	//Retrieve
	function saveRetrieve($data)
	{
		return $this->db->insert('lq_retrieves', $data);
	}

	function getRetrieve()
	{
		$this->db->order_by('id_retrieve', 'DESC');
		return $this->db->get('lq_retrieves')->result();
	}

	function cancelCommand($factToken,$clientToken, $data)
	{
		$this->db->where(array('fact_token'=>$factToken, 'client_token'=>$clientToken));
		return $this->db->update('lq_factures', $data);
	}


}
