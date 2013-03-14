<?php
class Hub extends Main {

    // display
    function display($id=null) {
        //for information in view
        if(isset($this->ci->session->userdata['administrator_id_partner']) && $this->ci->session->userdata['administrator_id_partner']!= 0){
            $this->ci->smarty->assign('administrator_id_partner',$this->ci->session->userdata['administrator_id_partner']);
        }
        $this->ci->smarty->assign('id', $id);
        $this->ci->smarty->display($this->_path.'.html');
    }
    function display_add($id=null) {
        $this->ci->smarty->assign('id', $id);
        $this->ci->smarty->display($this->_path.'_add.html');
    }
    function display_edit($id) {
        $this->ci->smarty->assign('id', $id);
        $this->ci->smarty->display($this->_path.'_edit.html');
    }

    // load
    function load_field() {
        $field = $this->_model->load_field();
        echo '{"field":'.json_encode($field).'}';
    }
    function load_total($id=null, $where = null) {
        $total = $this->_model->load_total($id,$where);
        echo '{"total":'.json_encode($total).'}';
    }
    function load_all($id=null, $where = null) {
        $total = $this->_model->load_total($id,$where);
        $data = $this->_model->load_all($id,$where);
        echo '{"total":'.json_encode($total).', "data":'.json_encode($data).'}';
    }
    function load($id=null) {
        if (!isset($id)) die;
        $data = $this->_model->load($id);
        echo '{"success": 1, "data":'.json_encode($data).'}';
    }

    // crud
    function add($id=null) {
        $success = $this->_model->add($id);
        echo '{"success":'.$success.'}';
    }
    function edit($id=null) {
        if (!isset($id)) die;
        $success = $this->_model->edit($id);
        echo '{"success":'.$success.'}';
    }
    function delete($id=null) {
        if (!isset($id)) die;
        $success = $this->_model->delete($id);
        echo 'grid';
        //echo '{"success":'.$success.'}';
    }

}