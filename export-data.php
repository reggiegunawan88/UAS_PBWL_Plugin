<?php

/*
Plugin Name: Export CSV/XLS Plugin
Description: Plugin untuk melakukan export database kedalam bentuk file CSV/XLS.
Version: 1.0.0
Author: Group G (Reggie Maurice Gunawan, Frengki Ang)
Author URI: http://grupg-pbwlanjut.com/
*/

//to prevent data leaks, so it cant be accessed directly
if(!defined('ABSPATH'))
{
    exit; 
}

//check if woocommerce plugin is active
if(!in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_options('active_plugins'))))
{
    exit;
}

add_action('admin_menu', 'add_export_menu');

function add_export_menu()
{
    $hook_menu = add_submenu_page('woocommerce', 'Export Order', 'Export Order', 'view_woocommerce_reports', 'export-order', 'export_menu_output');
}

function export_menu_output()
{
    if(!current_user_can('view_woocommerce_reports'))
    {
        return;
    }
    ?>
    <div class="wrap">
        <h2>Export File to CSV or XLS</h2>
        Silahkan gunakan fitur export file ke dalam bentuk CSV atau XLS
        <form action="<?php menu_page_url('export-order') ?>" method="post">
            <button type="submit" class="button">Export now</button>
        </form>

        
    </div>

    <?php
        add_action('load-',$hook_menu,'export_order_submit');
        function export_order_submit()
        {

        }
    ?>
}

