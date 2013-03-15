<?php

class Partner_Product_Model extends Main_Model {

    function Partner_Product_Model() {
        // Call the Model constructor
        parent::Model();
        //
        if (isset($this->ci)) {
            $this->db = $this->ci->db;
        }
        //
        $this->table_name = 'partner_product';
    }

    // load
    function load_field() {
        $fields = $this->db->list_fields($this->_name);
        $add_fields = array('category_title', 'vendor_title');
        $fields = array_merge($fields, $add_fields);
        return $fields;
    }

    function load_total($id = null, $where = 'id') {
        //exception for partners
        $fields = $this->load_field();
        if (in_array('id_partner', $fields)) {
            if (isset($this->ci->session->userdata['administrator_id_partner']) != 0) {
                $this->db->where('id_partner', $this->ci->session->userdata['administrator_id_partner']);
            }
        }
        if (isset($id) && !empty($id)) {
            ($where == null ? $where = 'id' : '');
            $this->db->where($where, $id);
        }
        // end exception
        $this->db->select($this->table_name . '.*,
                            product_tree.title as category_title,
                            product_dict_vendor.title as vendor_title,
                            product.title as title,
                            product.text1 as text1');
        $this->db->join('product', $this->table_name . '.id_product = product.id', 'left');
        $this->db->join('product_tree', $this->table_name . '.id_category = product_tree.id', 'left');
        $this->db->join('product_dict_vendor', 'product.id_vendor = product_dict_vendor.id', 'left');
        $this->db->from($this->_name);
        return $this->db->count_all_results();
    }

    function load_all($id = null, $where = 'id') {
        //exception for partners
        $fields = $this->load_field();
        if (in_array('id_partner', $fields)) {
            if (isset($this->ci->session->userdata['administrator_id_partner']) != 0) {
                $this->db->where('id_partner', $this->ci->session->userdata['administrator_id_partner']);
            }
        }
        if (isset($id) && !empty($id)) {
            ($where == null ? $where = 'id' : '');
            $this->db->where($where, $id);
        }
        // end exception
        $this->db->select($this->table_name . '.*,
                            product_tree.title as category_title,
                            product_dict_vendor.title as vendor_title,
                            product.title as title,
                            product.text1 as text1');
        $this->db->join('product', $this->table_name . '.id_product = product.id', 'left');
        $this->db->join('product_tree', $this->table_name . '.id_category = product_tree.id', 'left');
        $this->db->join('product_dict_vendor', 'product.id_vendor = product_dict_vendor.id', 'left');
        $query = $this->db->get($this->_name);
        $record = $query->result_array();
        return $record;
    }

    function load($id, $where = 'id') {
        // end exception
        $this->db->select($this->table_name . '.*,
                            product_tree.title as category_title,
                            product_dict_vendor.title as vendor_title,
                            product.title as title,
                            product.text1 as text,
                            product.image1 as image1,
                            product.image2 as image2,
                            product.image3 as image3,
                            product.image4 as image4,
                            product.image5 as image5,'
        );
        $this->db->join('product', $this->table_name . '.id_product = product.id', 'left');
        $this->db->join('product_tree', $this->table_name . '.id_category = product_tree.id', 'left');
        $this->db->join('product_dict_vendor', 'product.id_vendor = product_dict_vendor.id', 'left');
        //exception for partners
        $fields = $this->load_field();
        if (in_array('id_partner', $fields)) {
            if (isset($this->ci->session->userdata['administrator_id_partner']) != 0) {
                $this->db->where('id_partner', $this->ci->session->userdata['administrator_id_partner']);
            }
        }
        // end exception
        $this->db->where('partner_product.'.$where, $id);
        $query = $this->db->get($this->_name);
        $record = $query->row_array();
        return $record;
    }

    // crud
    function add() {
        $fields = $this->load_field();
        if (in_array('date_added', $fields)) {
            $_POST['date_added'] = date("Y-m-d H:i:s");
        }
        if (in_array('date_created', $fields)) {
            $_POST['date_created'] = date("Y-m-d H:i:s");
        }
        $this->db->insert($this->_name, $_POST);
        return 1;
    }

    function edit($id, $where = 'id') {
        //exception for partners
        $fields = $this->load_field();
        if (in_array('id_partner', $fields)) {
            if (isset($this->ci->session->userdata['administrator_id_partner']) != 0) {
                $this->db->where('id_partner', $this->ci->session->userdata['administrator_id_partner']);
            }
        }
        $fields = $this->load_field();
        if (in_array('date_last_modified', $fields)) {
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
        if (in_array('id_partner', $fields)) {
            if (isset($this->ci->session->userdata['administrator_id_partner']) != 0) {
                $this->db->where('id_partner', $this->ci->session->userdata['administrator_id_partner']);
            }
        }
        // end exception
        $this->db->where('id', $id);
        $query = $this->db->delete($this->_name);
        return 1;
    }

    // db query modifier
    function limit_check() {
        if (isset($_REQUEST['start']) && isset($_REQUEST['limit'])) {
            $this->start = $_REQUEST['start'];
            $this->limit = $_REQUEST['limit'];
            $this->db->limit($this->limit, $this->start);
        }
    }

    function active_set($id, $state) {
        $this->db->where('id', $id);
        $this->db->set('active', $state);
        $this->db->update($this->_name);
        return '{"success": true}';
    }
}