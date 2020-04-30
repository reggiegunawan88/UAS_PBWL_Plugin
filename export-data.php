<?php

/*
Plugin Name: Export CSV/XLS Plugin
Description: Plugin untuk melakukan export database kedalam bentuk file CSV/XLS.
Version: 1.0.0
Author: Group G (Reggie Maurice Gunawan, Frengki Ang)
Author URI: http://grupg-pbwlanjut.com/
*/



function add_export_menu()
{
    add_submenu_page('woocommerce', 'Export Order', 'Export Order', 'manage_options', 'export_order', '');
}

add_action('admin_menu', 'add_export_menu');

function export_menu_output(){
    echo '<div><h2>Export File to CSV or XLS</h2>Silahkan gunakan fitur export file ke dalam bentuk CSV atau XLS</div>';
}

?>