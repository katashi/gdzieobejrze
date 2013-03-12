<?php
if (!defined('BASEPATH')) die;

class Product extends Hub {
	
	function Product($_ci='') {
        parent::Controller();
        $this->ci = $_ci;
        //
        $this->_dir = 'gdzieobejrze';
        $this->_name = 'product';
        $this->_id = $this->_dir.'_'.$this->_name.'_'.rand(0,999);
        $this->_path = $this->_dir.'/'.$this->_name;
        $this->_response = 'json';
        //
        $this->load->model('main_model');
        $this->_model = $this->load->model($this->_path.'_model');
        //
        $this->ci->smarty->assign('_dir', $this->_dir);
        $this->ci->smarty->assign('_id', $this->_id);
        $this->ci->smarty->assign('_name', $this->_name);
        $this->ci->smarty->assign('field', json_encode($this->_model->load_field()));
	}

}