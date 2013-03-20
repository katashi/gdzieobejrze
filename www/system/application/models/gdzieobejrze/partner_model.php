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


}