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
        $this->table_name = 'pc_product';
    }

    function add() {
        $this->db->insert($this->_name, $_POST);
        $id_element = $this->db->insert_id();
        $id_tree = $_POST['id_category'];
        $record = array();
        $this->db->select_max('position');
        $this->db->where('id_tree', $id_tree);
        $query = $this->db->get('product_relations');
        $result = $query->row_array();
        $position = $result['position'] + 1;
        $record['id_tree'] = $id_tree;
        $record['id_element'] = $id_element;
        $record['position'] = $position;
        $this->db->insert('product_relations', $record);
        return 1;
    }

}