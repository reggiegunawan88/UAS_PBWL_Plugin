<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css">

<?php
/*
Plugin Name: Export CSV/XLS Plugin
Description: Plugin sederhana untuk melakukan export data ke dalam bentuk file CSV/XLS.
Version: 1.0.0
Author: Group G (Reggie Maurice Gunawan, Frengki Ang)
Author URI: http://grupg-pbwlanjut.com/
*/

//to prevent data leaks, so it cant be accessed directly
if (!defined('ABSPATH')) {
    exit;
}

//check if woocommerce plugin is active
if (!in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {
    exit;
}

add_action('admin_menu', 'add_export_menu');

function add_export_menu()
{
    $hook_export_order = add_submenu_page('woocommerce', 'Export Order', 'Export Order', 'view_woocommerce_reports', 'export-order', 'export_menu_output');
}

function export_menu_output()
{
    if(!current_user_can('view_woocommerce_reports'))
    {
        return;
    }
    echo '<div class="wrap center"><h2>Export File to CSV/XLS</h2>';
    echo '<h3>Silahkan pilih fitur dibawah ini untuk melakukan export data ke dalam bentuk CSV/XLS</h3></div>';
    WC()->session = new WC_Session_Handler();
    WC()->session->init();
    $orders = wc_get_orders([]);
    $meta_keys = [];
    foreach($orders as $order)
    {
        foreach($order->get_items() as $item)
        {
            foreach($item->get_meta_data() as $meta_data)
            {
                $meta_data_array = $meta_data->get_data();
                $meta_diambil = $meta_data_array['key'];
                if(strpos($meta_diambil,"Nama")!==false)
                {
                    $meta_keys[$meta_data->key] = TRUE;
                }
            }
        }
    }
    echo '<table id="example" class="display" style="width:100%">';
    echo
    '<thead>
        <tr>
        <td>ID Pemesanan</td>
        <td>Status Pemesanan</td>
        <td>Tanggal Pemesanan</td>
        <td>Catatan Pelanggan</td>
        <td>Metode Pembayaran</td>';
        foreach(WC()->checkout()->get_checkout_fields('billing') as $fieldset_key) 
        {
            echo '<th>'.$fieldset_key['label'].'</th>';
        }
        foreach($meta_keys as $meta_header => $meta_value)
        {
            echo '<th>'.$meta_header.'</th>';
        }
    echo
        '</tr>
        </thead>';
    echo 
    '<tbody>';
    foreach($orders as $order)
    {
        echo '<tr>';
        $items = $order->get_items();
        foreach($items as $item)
        {
            echo '<td>'; echo $order->get_id(); echo '</td>';
            echo '<td>'; echo $order->get_status(); echo '</td>';
            echo '<td>'; echo $order->get_date_created(); echo '</td>';
            echo '<td>'; echo $order->get_customer_note(); echo '</td>';
            echo '<td>'; echo $order->get_payment_method_title(); echo '</td>';
            echo '<td>'; echo $order->get_billing_first_name(); echo '</td>';
            echo '<td>'; echo $order->get_billing_last_name(); echo '</td>';
            echo '<td>'; echo $order->get_billing_company(); echo '</td>';
            echo '<td>'; echo $order->get_billing_address_1(); echo '</td>';
            echo '<td>'; echo $order->get_billing_address_2(); echo '</td>';
            echo '<td>'; echo $order->get_billing_city(); echo '</td>';
            echo '<td>'; echo $order->get_billing_state(); echo '</td>';
            echo '<td>'; echo $order->get_billing_postcode(); echo '</td>';
            echo '<td>'; echo $order->get_billing_email(); echo '</td>';
            echo '<td>'; echo $order->get_billing_phone(); echo '</td>';
            foreach($meta_keys as $meta_key => $meta_value)
            {
                echo '<td>'; echo $item->get_meta($meta_key); echo '</td>';
            }
        }
        echo '</tr>';
    }
    echo '</tbody>';
    echo '</table>';
}
?>
<script type="text/javascript">
$(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'excelHtml5',
            'csvHtml5',
        ]
    } );
} );
</script>





