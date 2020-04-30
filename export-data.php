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

function export_menu_output(){
echo '<div class="wrap center"><h2>Export File to CSV/XLS</h2>';
echo '<h3>Silahkan pilih fitur dibawah ini untuk melakukan export data ke dalam bentuk CSV/XLS</h3></div>';
 
echo '<table id="example" class="display" style="width:100%">';
echo
 '<thead>
     <tr>
     <th>Name</th>
     <th>Position</th>
     <th>Office</th>
     <th>Age</th>
     <th>Start date</th>
     <th>Salary</th>
     </tr>
 </thead>';
 echo 
 '<tbody>
 <tr>
             <td>Tiger Nixon</td>
             <td>System Architect</td>
             <td>Edinburgh</td>
             <td>61</td>
             <td>2011/04/25</td>
             <td>$320,800</td>
         </tr>
         <tr>
             <td>Garrett Winters</td>
             <td>Accountant</td>
             <td>Tokyo</td>
             <td>63</td>
             <td>2011/07/25</td>
             <td>$170,750</td>
         </tr>
 </tbody>';
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





