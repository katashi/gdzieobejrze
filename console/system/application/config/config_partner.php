<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| UI - Available system
| -------------------------------------------------------------------------
*/
$config['system'] = array(
    0 => array('iconCls'=>'group_gear', 'id'=>'administrator', 'text'=>'Administratorzy', 'type'=>'tab', 'url'=>APP_URL.'/_core:administrator/display'),
    1 => array('iconCls'=>'group_gear', 'id'=>'users', 'text'=>'Użytkownicy', 'type'=>'tab', 'url'=>APP_URL.'/_core:user/display'),
    2 => array('-'),
    3 => array('iconCls'=>'door_out', 'text'=>'Wyloguj', 'type'=>'href', 'url'=>APP_URL.'/_core:administrator/logout')
);
$config['tab1'] = array(
    0 => array('iconCls'=>'group_gear', 'id'=>'shops', 'text'=>'Sklepy', 'type'=>'tab', 'url'=>APP_URL.'/_core:administrator/display'),
    1 => array('iconCls'=>'group_gear', 'id'=>'categories', 'text'=>'Kategorie', 'type'=>'tab', 'url'=>APP_URL.'/_core:user/display'),
    2 => array('iconCls'=>'group_gear', 'id'=>'products', 'text'=>'Produkty', 'type'=>'tab', 'url'=>APP_URL.'/_core:user/display'),
    3 => array('-')
);

/* End of file config.php */
/* Location: ./system/application/config/config.php */