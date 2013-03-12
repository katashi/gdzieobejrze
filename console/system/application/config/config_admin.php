<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| UI - Available system
| -------------------------------------------------------------------------
*/
$config['system'] = array(
    0 => array('iconCls'=>'group_gear', 'id'=>'administrator', 'text'=>'Administratorzy', 'type'=>'tab', 'url'=>APP_URL.'/_core:administrator/display'),
    //1 => array('iconCls'=>'group_gear', 'id'=>'users', 'text'=>'Partnerzy', 'type'=>'tab', 'url'=>APP_URL.'/_core:partner/display'),
    1 => array('-'),
    2 => array('iconCls'=>'door_out', 'text'=>'Wyloguj', 'type'=>'href', 'url'=>APP_URL.'/_core:administrator/logout')
);
$config['zarzadzaj'] = array(
    0 => array('iconCls'=>'group_gear', 'id'=>'shops', 'text'=>'Sklepy', 'type'=>'tab', 'url'=>APP_URL.'/gdzieobejrze:partner/display'),
    1 => array('iconCls'=>'group_gear', 'id'=>'product_categorys', 'text'=>'Kategorie', 'type'=>'tab', 'url'=>APP_URL.'/gdzieobejrze:product_dict_category/display'),
    2 => array('iconCls'=>'group_gear', 'id'=>'product_vendors', 'text'=>'Producenci', 'type'=>'tab', 'url'=>APP_URL.'/gdzieobejrze:product_dict_vendor/display'),
    3 => array('iconCls'=>'group_gear', 'id'=>'products', 'text'=>'Produkty', 'type'=>'tab', 'url'=>APP_URL.'/gdzieobejrze:product/display'),
    4 => array('-')
);

/* End of file config.php */
/* Location: ./system/application/config/config.php */