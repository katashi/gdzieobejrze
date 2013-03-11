<?php
if (!defined('BASEPATH')) die;

class Image extends Hub {

    var $file;

    function Image($_ci='') {
        parent::Controller();
        $this->ci = $_ci;
        //
        $this->_dir = '_media';
        $this->_name = 'image';
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

    // display
    function display($id) {
        $this->ci->smarty->assign('id', $id);
        $this->ci->smarty->display($this->_path.'.html');
    }

    // load
    function load_all($id) {
        $total = $this->_model->load_total($id);
        $data = $this->_model->load_all($id);
        echo '{"total":'.json_encode($total).', "data":'.json_encode($data).'}';
    }

    // crud
    function add($id) {
        $success = $this->_model->add($id);
        echo $success;
    }
    function delete($id) {
        $success = $this->_model->delete($id);
        echo 'grid';
    }

}