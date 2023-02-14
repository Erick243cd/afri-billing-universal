<?php

class Article_model extends CI_Model
{

	public function __construct()
	{
		$this->load->database();
	}

	public function get_articles()
	{
		$this->db->order_by('id_article', 'DESC');
		$this->db->join('lq_categories', 'lq_articles.id_categorie=lq_categories.id_categorie');
		$this->db->join('lq_unities', 'lq_articles.unityId=lq_unities.unityId');
		$query = $this->db->get_where("lq_articles", array('lq_articles.deleted' => 'not'));
		return $query->result();
	}

	public function getProductsBySalesPoint($salesPoint)
	{
		$this->db->order_by('id_article', 'DESC');
		$this->db->join('lq_articles', 'lq_articles.id_article=salespoint_stocks.productId');
		$this->db->join('lq_categories', 'lq_articles.id_categorie=lq_categories.id_categorie');
		$this->db->join('lq_unities', 'lq_articles.unityId=lq_unities.unityId');

		return $this->db->get_where("salespoint_stocks", array('salespoint_stocks.salespointId' => $salesPoint))->result();
	}


	public function get_article_id($id)
	{
		$this->db->join('lq_categories', 'lq_articles.id_categorie=lq_categories.id_categorie');
		$this->db->join('lq_unities', 'lq_articles.unityId=lq_unities.unityId');
		$query = $this->db->get_where('lq_articles', array('id_article' => $id));
		return $query->row_array();
	}

	public function create_article($file)
	{
		$data = array(
			'designation' => $this->input->post('designation'),
			'prix_achat' => $this->input->post('prix_achat'),
			'prix_unitaire' => $this->input->post('prix_unitaire'),
			'devise' => $this->input->post('devise'),
			'qte_initial' => $this->input->post('qte_initial'),
			'qte_actuelle' => $this->input->post('qte_initial'),
			'id_categorie' => $this->input->post('id_categorie'),
			'unityId' => $this->input->post('unity'),
			'deleted' => 'not',
			'image_article' => $file
		);
		return $this->db->insert('lq_articles', $data);
	}

	public function delete_article($id)
	{
		/*$image_file_name=$this->db->select('product_image')->get_where('Articles', array('product_id'=>$id))->row()->product_image;
		$cwd=getcwd();//Save the current working directory
		$image_file_path=$cwd."\\assets\\img\\articles\\";
		chdir($image_file_path);
		unlink($image_file_name);
		chdir($cwd);//Restore the preview working directory
		$this->db->where('product_id',$id);
		$this->db->delete('Articles');*/
		$data = array(
			'deleted' => 'yes',
		);
		$this->db->where('id_article', $id);
		return $this->db->update('lq_articles', $data);
	}

	public function update_article($data)
	{
		$this->db->where('id_article', $this->input->post('id_article'));
		return $this->db->update('lq_articles', $data);
	}

	function fetch_reappro()
	{
		$this->db->order_by('id_reappro', 'DESC');
		$this->db->join('lq_articles', 'lq_articles.id_article=lq_reappro.id_article');
		$this->db->join('lq_unities', 'lq_articles.unityId=lq_unities.unityId');
		$this->db->join('lq_quantites_entree', 'lq_quantites_entree.key_entree=lq_reappro.key_entree');
		$query = $this->db->get("lq_reappro");
		return $query->result();
	}

	function save_reappro($data_reappro, $data_article, $data_quantite_entree)
	{
		$this->db->insert('lq_reappro', $data_reappro);

		$this->db->insert('lq_quantites_entree', $data_quantite_entree); //Maintient de la quantité actuel par entree

		$this->db->where('id_article', $this->input->post('id_article'));
		$this->db->update('lq_articles', $data_article);

		return true;
	}


	public function getQuantity($productId)
	{
		return $this->db->get_where('lq_articles', ['id_article' => $productId])->row();
	}

	public function updateProductQuantity($productId, $data)
	{
		$this->db->where('id_article', $productId);
		return $this->db->update('lq_articles', $data);
	}

	public function getUnities()
	{
		return $this->db->get('lq_unities')->result();
	}

	public function getInput($key)
	{
		$this->db->join('lq_articles', 'lq_articles.id_article=lq_reappro.id_article');
		return $this->db->get_where('lq_reappro', array('id_reappro' => $key))->row();
	}
}
