<?php
if (!defined('BASEPATH')) die;

class Partner_Product extends Hub {
	
	function Partner_Product($_ci='') {
        parent::Controller();
        $this->ci = $_ci;
        //
        $this->_dir = 'gdzieobejrze';
        $this->_name = 'partner_product';
        $this->_id = $this->_dir.'_'.$this->_name.'_'.rand(0,999);
        $this->_path = $this->_dir.'/'.$this->_name;
        $this->_response = 'json';
        //
        $this->load->model('main_model');
        $this->load->model('gdzieobejrze/product_model');
        $this->_model = $this->load->model($this->_path.'_model');
        //
        $this->ci->smarty->assign('_dir', $this->_dir);
        $this->ci->smarty->assign('_id', $this->_id);
        $this->ci->smarty->assign('_name', $this->_name);
        $this->ci->smarty->assign('field', json_encode($this->_model->load_field()));
	}

    function add_partner_product(){
        $success =false;
        $data = array();
        $base_product = $this->product_model->load($_POST['id_product']);
        $id_partner = $this->ci->session->userdata['administrator_id_partner'];
        //sprawdzamy czy partner
        $check = $this->partner_product_model->check_product_exist($_POST['id_product'],$id_partner);
        if(empty($check)){
            $_POST = array_merge($_POST,$base_product);
            unset($_POST['id']);
            $_POST['id_partner'] = $id_partner;
            $this->partner_product_model->add();
            $success = true;
            $data['message'] = 'product_added';
        }else{
            $success = false;
            $data['message'] = 'product_exist';
        }
        echo json_encode(array('success'=>$success,'data'=>$data));
        //echo '{"success": 1, "data":'.json_encode($data).'}';
    }



}