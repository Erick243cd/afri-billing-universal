<?php

/**
 * Invetaire class
 */
class Inventaire_model extends CI_Model
{
	function productData()
	{
		return $this->db->get_where("lq_articles", array('lq_articles.deleted' => 'not'))->num_rows();
	}

	function inputData($mois = null)
	{
		$this->db->select('lq_articles.designation, lq_reappro.date_reappro');
		$this->db->join('lq_articles', 'lq_articles.id_article=lq_reappro.id_article');
		$this->db->select_sum('lq_reappro.qte_reappro');

		if (!empty($mois)) {
			$date = date('Y') . '-' . $mois;
			$this->db->like('lq_reappro.date_reappro', $date);
			$this->db->group_by('lq_reappro.id_article');

		} else {

			$this->db->group_by('lq_reappro.id_article, lq_reappro.date_reappro');

		}

		return $this->db->get("lq_reappro")->result();
	}

	function outputData($mois = null, $motif = null)
	{

		$date = date('Y') . '-' . $mois;

		$this->db->select('lq_articles.designation, lq_sorties.date_sortie, lq_sorties.motif_sortie, lq_salespoints.salespoint_name');
		$this->db->join('lq_articles', 'lq_articles.id_article=lq_sorties.id_article');
		$this->db->join('lq_salespoints', 'lq_salespoints.salespoint_id=lq_sorties.sales_pointId');

		$this->db->select_sum('lq_sorties.qte_sortie');

		if (!empty($mois) && !empty($motif)) {
			$this->db->where('lq_sorties.motif_sortie', $motif);
			$this->db->like('lq_sorties.date_sortie', $date);
			$this->db->group_by('lq_sorties.id_article');

		} elseif (!empty($mois) && $motif === null) {
			$this->db->like('lq_sorties.date_sortie', $date);
			$this->db->group_by('lq_sorties.id_article,lq_sorties.motif_sortie');
		} else {
			$this->db->group_by('lq_sorties.id_article, lq_sorties.motif_sortie');//$this->db->group_by('lq_sorties.id_article');

		}


		return $this->db->get("lq_sorties")->result();
	}

	function getMotifs()
	{
		$this->db->select('motif_sortie');
		$this->db->distinct('motif_sortie');
		return $this->db->get('lq_sorties')->result();

	}
}

