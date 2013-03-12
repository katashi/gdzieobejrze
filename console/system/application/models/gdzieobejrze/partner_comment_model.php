<?php

class Partner_Comment_Model extends Main_Model {

    function Partner_Comment_Model() {
        // Call the Model constructor
        parent::Model();
        //
        if (isset($this->ci)) {
            $this->db = $this->ci->db;
        }
        //
        $this->table_name = 'pc_partner_comment';
    }
}