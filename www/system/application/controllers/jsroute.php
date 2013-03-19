<?php
/*
 *  Klasa strzona dla wywołań json
 */
class JsRoute extends Main {

    function JsRoute($_ci) {
        parent::Controller();
        $this->ci = $_ci;
        //
        $this->load->model('main_model');
        $this->load->model('gdzieobejrze/product_model');
    }

    // display
    function display() {
        if(isset($_POST['method'])){
            $method = $_POST['method'];
            $params = json_decode($_POST['data']);
            call_user_func_array(array($this, $method) , $params );
        }else{
            echo 'NO WAY!';
        }
    }

    function displayProduct($data){
        $template = 'popup/product';
        echo $this->smarty_display($template);
    }

}