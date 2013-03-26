<?php

class Partner_Model extends Main_Model {

    function Partner_Model() {
        $this->table_name = 'pc_partner';
        // Call the Model constructor
        parent::Model();
        //
        if (isset($this->ci)) {
            $this->db = $this->ci->db;
        }
        //

    }
}