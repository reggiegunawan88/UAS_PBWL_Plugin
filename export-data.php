<?php

/*
Plugin Name: Export CSV/XLS Plugin
Description: Plugin untuk melakukan export database kedalam bentuk file CSV/XLS.
Version: 1.0.0
Author: Group G (Reggie Maurice Gunawan, Frengki Ang)
Author URI: http://grupg-pbwlanjut.com/
*/

add_action('admin_menu', 'add_export_menu');

function add_export_menu()
{
    add_menu_page('Export Order', 'Export Order', 'manage_options', 'export-order', 'export_menu_output', 'dashicons-media-spreadsheet');
}

function export_menu_output(){
    echo '<div><h2>Export File to CSV or XLS</h2>Silahkan gunakan fitur export file ke dalam bentuk CSV atau XLS</div>';
}

?>