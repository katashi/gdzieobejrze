<?php
class Shop extends Main {

    function Shop ($_ci) {
        parent::Controller();
        $this->ci = $_ci;
        //
        $this->load->model('main_model');
        $this->load->model('gdzieobejrze/product_model');

    }

    // display
    function display($template = null, $title_call = null) {

        $this->assign_template_titlecall($template, $title_call);
        $this->smarty_display($template);
    }

    function display_redirect($template = null, $title_call = null, $variable = null) {
        $result = unserialize($variable);
        $this->assign_template_titlecall($template, $title_call);
        $this->display('map');
    }

}