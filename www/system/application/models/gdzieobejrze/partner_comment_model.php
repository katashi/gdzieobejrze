<?php

class Partner_Comment_Model extends Main_Model {

    function Partner_Comment_Model() {
        $this->_name = 'partner_comment';
        // Call the Model constructor
        parent::Model();
        //
        if (isset($this->ci)) {
            $this->db = $this->ci->db;
        }
        //
    }


}