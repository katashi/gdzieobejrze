<?php

class Product_Dict_Category_Model extends Main_Model {

    function Product_Dict_Category_Model() {
        // Call the Model constructor
        parent::Model();
        //
        if (isset($this->ci)) {
            $this->db = $this->ci->db;
        }
        //
        $this->table_name = 'pc_product_dict_category';
    }
}