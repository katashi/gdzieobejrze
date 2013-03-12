<?php
if (!defined('BASEPATH')) die;

class Administrator extends Hub {

	function Administrator($_ci='') {
		parent::Controller();
		$this->ci = $_ci;
        //
        $this->_dir = '_core';
        $this->_name = 'administrator';
        $this->_id = $this->_dir.'_'.$this->_name.'_'.rand(0,999);
        $this->_path = $this->_dir.'/'.$this->_name;
        $this->_response = 'json';
        //
        $this->load->model('main_model');
        $this->_model = $this->load->model($this->_path.'_model');
        //
//        echo'<pre>';
//        print_R($this->_model);
//        echo'</pre>';
        $this->ci->smarty->assign('_dir', $this->_dir);
        $this->ci->smarty->assign('_id', $this->_id);
        $this->ci->smarty->assign('_name', $this->_name);
        $this->ci->smarty->assign('field', json_encode($this->_model->load_field()));
	}

    function load_all_object() {
        return $this->_model->load_all();
    }

	// session
	function session_create($record) {
		$this->ci->session->set_userdata('administrator_authorised', true);
        $this->ci->session->set_userdata('administrator_type', $record['type']);
        $this->ci->session->set_userdata('administrator_id_partner', $record['id_partner']);
        $this->ci->session->set_userdata('administrator_user', $record['user']);
        $this->ci->session->set_userdata('administrator_email', $record['email']);
	}
	function session_destroy() {
		$this->ci->session->unset_userdata('administrator_authorised');
        $this->ci->session->unset_userdata('administrator_id_partner');
        $this->ci->session->unset_userdata('administrator_type');
        $this->ci->session->unset_userdata('administrator_user');
        $this->ci->session->unset_userdata('administrator_email');
	}
	function session_verify() {
		$administrator_authorised = $this->ci->session->userdata('administrator_authorised');
		if ($administrator_authorised) { 
			return true;
		} else {
			return false;
		}
	}

	// authorisation
	function authorise() {
		$record = $this->administrator_model->authorise(); 
		if ($record) {
			$this->session_create($record);
			return '{"success": true}';
		} else {
			return '{"success": false}';
		}
	}

	// logout
	function logout() {
		$this->session_destroy();
		header("Location: ". SITE_URL .'/console');
	}
	
}