<?php
class Map extends Main {

    function Map($_ci) {
        parent::Controller();
        $this->ci = $_ci;
        //
        $this->load->model('main_model');
        $this->load->model('gdzieobejrze/product_model');
    }

    // display
    function display($template = null, $title_call = null) {
        $this->search_post_process();
        $this->assign_template_titlecall($template, $title_call);
        $this->smarty_display($template);
    }

    function display_redirect($template = null, $title_call = null, $variable = null) {
        $result = unserialize($variable);
        $this->assign_template_titlecall($template, $title_call);
        $this->display('map');
    }

    /*
     * Proces Wyszukiwania
     *
     * get: $_POST;
     * return: all products from query
     */
    function search_post_process() {
        if (isset($_POST['query']) && $_POST['query'] = 'Samsung LCD 43 HD') {
            $_POST['query'] = '';
        }
        if (isset($_POST['localization']) && $_POST['localization'] = 'Bez lokalizacji') {
            $_POST['localization'] = '';
        }
        if (isset($_POST['km_distance']) && $_POST['km_distance'] = 'Zasięg w km') {
            $_POST['km_distance'] = '';
        }
        $results = $this->product_model->search_query();
        echo'<pre style="display: none">';
        print_R($results);
        echo'</pre>';
    }

    function search_post_results(){

        $results = $this->product_model->search_query_results();
        echo'<pre>';
        print_R($results);
        echo'</pre>';
        //tutaj poprawny rezultat bedziemy dodawac do smartow

    }

}