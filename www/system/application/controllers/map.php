<?php
class Map extends Main {

    function Map($_ci) {
        parent::Controller();
        $this->ci = $_ci;
        //
        $this->load->model('main_model');
        $this->load->model('gdzieobejrze/product_model');
        //
        $this->load_recommended_products();
    }

    // display
    function display($template = null, $title_call = null) {
       // $this->search_post_process();

        $this->ci->smarty->assign('POST', json_encode($_POST));
        $this->assign_template_titlecall($template, $title_call);
        $this->smarty_display($template);
    }

    function display_redirect($template = null, $title_call = null, $variable = null) {
        $result = unserialize($variable);
        $this->assign_template_titlecall($template, $title_call);
        $this->display('map');
    }

    function load_recommended_products(){
        $_REQUEST['start'] = 0;
        $_REQUEST['limit'] = 6;
        $products = $this->product_model->load_all();
        $this->ci->smarty->assign('recommended_products', $products);
    }

    /*
     * Proces Wyszukiwania
     *
     * get: $_POST;
     * return: all products from query
     */
//    function search_post_process() {
//        $results = $this->product_model->search_query();
////        echo'<pre style="display: none">';
////        print_R($results);
////        echo'</pre>';
//    }
//
//    function search_post_results(){
//
//        $results = $this->product_model->search_query_results();
////        echo'<pre>';
////        print_R($results);
////        echo'</pre>';
//        //tutaj poprawny rezultat bedziemy dodawac do smartow
//
//    }

}