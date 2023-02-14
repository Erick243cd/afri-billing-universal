<?php

class Sales_point_model extends CI_Model
{
	public function create($data)
	{
		return $this->db->insert('lq_salespoints', $data);
	}

	public function update($salesPointId, $data)
	{
		$this->db->where('salespoint_id', $salesPointId);
		return $this->db->update('lq_salespoints', $data);
	}

	public function getQuantity($productId, $salesPoint)
	{
		$this->db->join('lq_articles', 'lq_articles.id_article=salespoint_stocks.productId');

		return $this->db->get_where('salespoint_stocks', array('productId' => $productId, 'salespointId' => $salesPoint))->row();
	}

	public function updateProductQuantity($productId, $salesPoint, $data)
	{
		$this->db->where(array('productId'=>$productId, 'salespointId' => $salesPoint));
		return $this->db->update('salespoint_stocks', $data);
	}
}
