<?php
    class Shopping_cart_model extends CI_Model{
        public function __construct()
        {
            $this->load->database();
        }

        function fetch_all(){

            $query=$this->db->get("lq_articles");
            return $query->result();
        }
    }