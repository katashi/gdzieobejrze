<?php

class Partner_Model extends Main_Model {

    function Partner_Model() {
        $this->_name = 'partner';
        // Call the Model constructor
        parent::Model();
        //
        if (isset($this->ci)) {
            $this->db = $this->ci->db;
        }
        //
    }

    function load_in($array) {
        $this->db->where_in('id',$array);
        $query = $this->db->get($this->_name);
        $record = $query->result_array();
        return $record;
    }

}