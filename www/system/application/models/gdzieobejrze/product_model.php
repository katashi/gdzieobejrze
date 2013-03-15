<?php

class Product_Model extends Main_Model {

    function Product_Model() {
        // Call the Model constructor
        parent::Model();
        //
        if (isset($this->ci)) {
            $this->db = $this->ci->db;
        }
        //
        $this->table_name = 'product';
    }

    /*
     * Search from query
     */
    function search_query() {
        $this->db->select('partner.id as id_partner, partner.gm_position ,product.id as id_product, product.title');
        $this->db->join('partner_product', $this->table_name.'.id = partner_product.id_product','left');
        $this->db->join('partner', 'partner_product.id_partner = partner.id','left');
        if(isset($_POST['query']) && !empty($_POST['query'])){
            $this->db->like($this->table_name.'.title', $_POST['query']);
            $this->db->or_like($this->table_name.'.text1', $_POST['query']);
            $this->db->or_like($this->table_name.'.text2', $_POST['query']);
        }
        $query = $this->db->get($this->table_name);
        $record = $query->result_array();
        return $record;
    }

    /*
     * Search main results
     */
    function search_query_results() {
        $this->db->select('partner.id as id_partner,
                           partner.gm_position ,
                           product.id as main_product_id,
                           partner_product.id as parter_product_id,
                           product.title as title,
                           product.text1 as text1,
                           product.text2 as text2,
                           product.text3 as text3,
                           partner_product.price1 as price,
                           ');
        $this->db->join('partner_product', $this->table_name.'.id = partner_product.id_product','left');
        $this->db->join('partner', 'partner_product.id_partner = partner.id','left');
        if(isset($_POST['query']) && !empty($_POST['query'])){
            $this->db->like($this->table_name.'.title', $_POST['query']);
            $this->db->or_like($this->table_name.'.text1', $_POST['query']);
            $this->db->or_like($this->table_name.'.text2', $_POST['query']);
        }
        $query = $this->db->get($this->table_name);
        $record = $query->result_array();
        return $record;
    }

}