<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| UI - Available system
| -------------------------------------------------------------------------
*/
$config['system'] = array(
    0 => array('iconCls'=>'door_out', 'text'=>'Wyloguj', 'type'=>'href', 'url'=>APP_URL.'/_core:administrator/logout')
);
$config['zarzadzaj'] = array(
    0 => array('iconCls'=>'group_gear', 'id'=>'shops', 'text'=>'Twoj Sklep', 'type'=>'tab', 'url'=>APP_URL.'/gdzieobejrze:partner/display_edit_shop/'),
    //1 => array('iconCls'=>'group_gear', 'id'=>'categories', 'text'=>'Kategorie', 'type'=>'tab', 'url'=>APP_URL.'/_core:user/display'),
    1 => array('iconCls'=>'group_gear', 'id'=>'products', 'text'=>'Twoje Produkty', 'type'=>'tab', 'url'=>APP_URL.'/gdzieobejrze:partner_product/display'),
    2 => array('-')
);
/* End of file config.php */
/* Location: ./system/application/config/config.php */