<?php

class Product_Dict_Category_Model extends Main_Model {

    function Product_Dict_Category_Model() {
        $this->_name = 'product_tree';
        // Call the Model constructor
        parent::Model();
        //
        if (isset($this->ci)) {
            $this->db = $this->ci->db;
        }
        //

    }
}
