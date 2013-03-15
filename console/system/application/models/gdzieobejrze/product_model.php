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
        $_POST['date_created'] = date("Y-m-d H:i:s");
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
    function edit($id , $where = 'id') {
        $id_tree = $_POST['id_category'];
        $record = array('id_tree'=>$id_tree);
        $this->db->where('id_element', $id);
        $this->db->update('product_relations', $record);
        //exception for partners
        $fields = $this->load_field();
        if(in_array('id_partner',$fields)){
            if(isset($this->ci->session->userdata['administrator_id_partner']) != 0){
                $this->db->where('id_partner',$this->ci->session->userdata['administrator_id_partner']);
            }
        }
        $fields = $this->load_field();
        if(in_array('date_last_modified',$fields)){
            $_POST['date_last_modified'] = date("Y-m-d H:i:s");
        }
        // end exception
        $this->db->where($where, $id);
        $this->db->update($this->_name, $_POST);
        return 1;
    }
    function delete($id) {
        //exception for partners
        $fields = $this->load_field();
        if(in_array('id_partner',$fields)){
            if(isset($this->ci->session->userdata['administrator_id_partner']) != 0){
                $this->db->where('id_partner',$this->ci->session->userdata['administrator_id_partner']);
            }
        }
        // end exception
        $this->db->where('id', $id);
        $query = $this->db->delete($this->_name);
        //relation
        $this->db->where('id_element', $id);
        $query = $this->db->delete('product_relations');

        return 1;
    }
}