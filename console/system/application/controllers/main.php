<?php
class Main extends Controller {
	
	var $controllers;

	function Main() {
		parent::Controller();
		//
		$this->db->query("SET NAMES 'utf8'");
		$this->smarty->assign('base_url', $this->config->site_url().'/');	
		$this->phpVersion = substr(phpversion(),0,1);
		$this->controllers = array();
		//
		ini_set('display_errors', true);
		ini_set('log_errors', true);
		ini_set('error_log', dirname(__FILE__) . '/../../../../error_console.txt');
		//
        $this->include_controller('hub');
		$this->include_controller('_core/administrator');
        // TEST WARTOSCI Z SESJI
        if(isset($this->session->userdata['administrator_id_partner']) && $this->session->userdata['administrator_id_partner']!= 0){
            $this->config->load('config_partner');
        }else{
            $this->config->load('config_admin');
        }
	}

	// preliminary launch
	function index() {
        // administrator base init plus template setup due to auth process
        $this->administrator = new Administrator($this);
        $this->administrator_authorised = $this->administrator->session_verify();
        $this->template = ($this->administrator_authorised) ? 'main' : 'login';
        // prepare js injection
        $js0 = $this->js_prepare_file('javascript/configuration.js');
        $this->smarty->assign('js0', $js0);
        $js1 = $this->js_prepare_directory('javascript/component');
        $this->smarty->assign('js1', $js1);
        $js2 = $this->js_prepare_directory('javascript/module');
        $this->smarty->assign('js2', $js2);
        $js3 = $this->js_prepare_directory('javascript/inc');
        $this->smarty->assign('js3', $js3);
        // display
        $this->smarty->display($this->template.'.html');
	}
	function index_check() {
        $this->administrator = new Administrator($this);
		echo $this->administrator->authorise();
	}

	// run
	function run() {
		// we need to segment uri to gain some control
		$this->uri = array_slice($this->uri->segment_array(), 2);		
		if (isset($this->uri[0])) { $command_sequence = $this->uri[0]; } else { $command_sequence = ''; }
        // ok, because we need to put controllers in different directories to get general control
        // we put : between DIR:MODULE(controller)
        if (stristr($command_sequence, ':')) {
            $tmp = explode(':', $command_sequence);
            $command_module_directory = $tmp[0];
            $command_module = $tmp[1];
        } else {
            $command_module_directory = '';
            $command_module = $command_sequence;
        }
        // lets go to methods/arguments
		if (isset($this->uri[1])) {	$command_method = $this->uri[1]; } else { $command_method = ''; }
		if (isset($this->uri[2])) { $command_arguments = explode(",", $this->uri[2]); } else { $command_arguments = array(); }
		// now we will create new class instance including desired controller ( which will include required model )
		if ($command_module) { $$command_module = $this->run_factory($command_module_directory, $command_module); }
		if ($command_method) { call_user_func_array(array($$command_module, $command_method), $command_arguments); }
	}
	function run_factory($directory='', $module='') {
        if ($directory != '') { $directory .= '/'; }
		$this->include_controller($directory.$module);
		$classname = new $module($this);
        return $classname;
	}

	// welcome screen
	function welcome() {
        $this->smarty->display('welcome.html');
	}

	// include controller
	function include_controller($controller) {
		$this->included = false;
		foreach ($this->controllers as $value) {
			if ($controller == $value) { $this->included = true; }
		}
		if (!$this->included) {
			array_push($this->controllers, $controller);
			include($controller.'.php');
		}
	}

	// converting php arrays to json
	function php2js($a=false) {
		if (is_null($a)) return 'null';
		if ($a === false) return 'false';
		if ($a === true) return 'true';
		if (is_scalar($a)) {
			if (is_float($a)) {
				// Always use "." for floats.
				$a = str_replace(",", ".", strval($a));
			}
			// All scalars are converted to strings to avoid indeterminism.
			// PHP's "1" and 1 are equal for all PHP operators, but
			// JS's "1" and 1 are not. So if we pass "1" or 1 from the PHP backend,
			// we should get the same result in the JS frontend (string).
			// Character replacements for JSON.
			static $jsonReplaces = array(array("\\", "/", "\n", "\t", "\r", "\b", "\f", '"'),
			array('\\\\', '\\/', '\\n', '\\t', '\\r', '\\b', '\\f', '\"'));
			return '"' . str_replace($jsonReplaces[0], $jsonReplaces[1], $a) . '"';
		}
		$isList = true;
		for ($i = 0, reset($a); $i < count($a); $i++, next($a)) {
			if (key($a) !== $i) {
				$isList = false;
				break;
			}
		}
		$result = array();
		if ($isList) {
			foreach ($a as $v) $result[] = $this->php2js($v);
			return '[' . join(',', $result) . ']';
		} else {
			foreach ($a as $k => $v) $result[] = $this->php2js($k).':'.$this->php2js($v);
			return '{' . join(',', $result) . '}';
		}
	}

    // js injection
    function js_prepare_var($var_name, $var_value) {
        $include = "var ".$var_name." = '".$var_value."';\n";
        return $include;
    }
    function js_prepare_file($file) {
        $include = "<script type=\"text/javascript\" src=\"".$file."\"></script>\n";
        return $include;
    }
    function js_prepare_directory($path) {
        $files = scandir($path);
        $files = array_slice($files, 2);
        $include = '';
        foreach($files as $file) {
            $include .= "<script type=\"text/javascript\" src=\"".$path."/".$file."\"></script>\n";
        }
        return $include;
    }
/*
    //
    // active set
    //
    /*function active_set($id=null, $state=false) {
        if (!isset($id)) { die; }
        $result = $this->main_model->active_set($id, $state);
        echo 'grid';
    }

    //
    // suspend set
    //
    function suspend_set($id=null, $state=false) {
        if (!isset($id)) { die; }
        $result = $this->main_model->suspend_set($id, $state);
        echo 'grid';
    }*/
	
}