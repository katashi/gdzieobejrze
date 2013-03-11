<?php
class Home extends Main {

	function Home($_ci) {
		parent::Controller();
        $this->ci = $_ci;
    }

    // display
    function display($template = null, $title_call = null) {
        $this->assign_template_titlecall($template, $title_call);
        $this->smarty_display($template);
    }
    function display_redirect($template = null, $title_call = null, $variable = null) {
        $result = unserialize($variable);
        $this->assign_template_titlecall($template, $title_call);
        $this->display('home');
    }

}