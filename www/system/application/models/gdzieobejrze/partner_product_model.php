<?php

class Partner_Product_Model extends Main_Model {

    function Partner_Product_Model() {
        $this->_name = 'partner_product';
        // Call the Model constructor
        parent::Model();
        //
        if (isset($this->ci)) {
            $this->db = $this->ci->db;
        }
        //
    }
    function load_shops($id_product){
        $this->db->select('partner.*,partner_product.price1 as price');
        $this->db->join('partner', $this->_name.'.id_partner = partner.id','left');
        $this->db->where('partner_product.id_product',$id_product);
        $query = $this->db->get($this->_name);
        $record = $query->result_array();
        return $record;
    }


}