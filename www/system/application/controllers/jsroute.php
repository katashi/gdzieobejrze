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
        $this->load->model('gdzieobejrze/partner_model');
        $this->load->model('gdzieobejrze/partner_comment_model');
        $this->load->model('gdzieobejrze/partner_product_model');
    }

    // display
    function display() {
        if(isset($_POST['method'])){
            $method = $_POST['method'];
            $params = json_decode($_POST['data']);
            call_user_func_array(array($this, $method) , array($params));
        }else{
            echo 'NO WAY!';
        }
    }

    function displayProduct($data){
        $template = 'popup/product';
        $id_product = $data->id_product;
        $product = $this->product_model->load($id_product);
        $products_shop = $this->partner_product_model->load_shops($id_product);
        $this->ci->smarty->assign('product', $product);
        $this->ci->smarty->assign('product_shops', $products_shop);
        $this->smarty_display($template);
    }

    function displayShop($data){
        $template = 'popup/shop';
        $id_shop = $data->id_shop;
        $shop = $this->partner_model->load($id_shop);
        $shop_comments = $this->partner_comment_model->load_all($shop['id'],'id_partner');
        $this->ci->smarty->assign('shop', $shop);
        $this->ci->smarty->assign('shop_comments', $shop_comments);
        $this->smarty_display($template);
    }
    function displayNoResults(){
        $template = 'popup/no_search_results';
        $this->smarty_display($template);
    }

    function displayShopsList(){
        $template = 'popup/shops_list';
        $shops = $this->partner_model->load_all();
        $this->ci->smarty->assign('shops', $shops);
        $this->smarty_display($template);
    }

    function formDisplayMeeting($data){
        $template = 'popup/form_meeting_shop';
        $id_shop = $data->id_shop;
        $this->ci->smarty->assign('id_shop', $id_shop);
        $this->smarty_display($template);
    }
    function formDisplayComment($data){
        $template = 'popup/form_comment_shop';
        $id_shop = $data->id_shop;
        $this->ci->smarty->assign('id_shop', $id_shop);
        $this->smarty_display($template);
    }
    function formDisplayQuestion($data){
        $template = 'popup/form_question_shop';
        $id_shop = $data->id_shop;
        $this->ci->smarty->assign('id_shop', $id_shop);
        $this->smarty_display($template);
    }

    function sendMeetingEmail(){
        $data = json_decode($_POST['data']);
        $data->from = $data->email;
        $this->sendEmail($data);
        $message = 'Wiadomość została wysłana.';
        echo '{"success":"true","message":'.json_encode($message).'}';
    }

    function CommentShop(){
        $data = json_decode($_POST['data']);
        //wysyłanie komentarzy o sklepiel
        echo '{"success":"true"}';
    }

    function sendQuestionEmail(){
        $data = json_decode($_POST['data']);
        $data->from = $data->email;
        $this->sendEmail($data);
        $message = 'Wiadomość została wysłana.';
        echo '{"success":"true","message":'.json_encode($message).'}';
    }


    public function sendEmail($data,$template='default') {
        // lets define data
        $this->ci->smarty->assign('path_template', SITE_URL . '/templates/email/' . CONFIGURATION);
        $this->ci->smarty->assign('path_media', SITE_URL . '/templates/email/' . CONFIGURATION);
        $this->ci->smarty->assign('path_site', SITE_URL);
        if(!isset($data->to)){
            $data->to = 'robert.osiadacz@tworzeniestron.pl';
        }

        foreach($data as $key => $val){
            //add to smarty all data
            $this->ci->smarty->assign($key, $val);
        }
        $message = $this->ci->smarty->fetch('../../../../templates/email/' . CONFIGURATION . '/'.$template.'.html');
        //
        $config['protocol'] = 'sendmail';
        $config['mailtype'] = 'html';
        $config['charset'] = 'utf-8';
        //
        $this->ci->email->initialize($config);
        $this->ci->email->subject('Email GO info');
        $this->ci->email->from($data->from);
        $this->ci->email->to($data->to);
        $this->ci->email->message($message);
        $this->ci->email->send();
    }

}