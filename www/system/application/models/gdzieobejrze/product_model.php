<?php

class Product_Model extends Main_Model {

    function Product_Model() {
        $this->_name = 'product';
        // Call the Model constructor
        parent::Model();
        //
        if (isset($this->ci)) {
            $this->db = $this->ci->db;
        }
        //

    }

    function load_total() {
        $this->db->from($this->_name);
        return $this->db->count_all_results();
    }
    function load_all() {
        $query = $this->db->get($this->_name);
        $record = $query->result_array();
        return $record;
    }

    function load_product_shops($id_product){
        $this->db->select('id_partner');
        $this->db->where('id_product',$id_product);
        $query = $this->db->get('partner_product');
        $record = $query->result_array();
        return $record;
    }

    /*
     * Search from query
     */
    function search_query() {
        $this->db->select('partner.id as id_partner, partner.gm_position ,product.id as id_product, product.title');
        $this->db->join('partner_product', $this->_name.'.id = partner_product.id_product','left');
        $this->db->join('partner', 'partner_product.id_partner = partner.id','left');
        if(isset($_POST['query']) && !empty($_POST['query'])){
            $this->db->like($this->_name.'.title', $_POST['query']);
            $this->db->or_like($this->_name.'.text1', $_POST['query']);
            $this->db->or_like($this->_name.'.text2', $_POST['query']);
        }
        $query = $this->db->get($this->_name);
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
        $this->db->join('partner_product', $this->_name.'.id = partner_product.id_product','left');
        $this->db->join('partner', 'partner_product.id_partner = partner.id','left');
        if(isset($_POST['query']) && !empty($_POST['query'])){
            $this->db->like($this->_name.'.title', $_POST['query']);
            $this->db->or_like($this->_name.'.text1', $_POST['query']);
            $this->db->or_like($this->_name.'.text2', $_POST['query']);
        }
        $query = $this->db->get($this->_name);
        $record = $query->result_array();
        return $record;
    }

}