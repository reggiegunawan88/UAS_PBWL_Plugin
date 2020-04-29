<?php
 wp_enqueue_script('jquery');


/*
Plugin Name: Export CSV/XLS Plugin
Description: Ini adalah plugin untuk mengeksport file dalam beberapa csv atau xls.
Version: 1.0.0
Author: Group k (Billy Setiadi, Laras Octa, Richard Morris Yonggi)
Author URI: http://pbwl2020.com/groupk
Licence: groupK
Text Domain: groupK-plugin
*/

function export_file_menu(){
 // add_menu_page('Forms', 'Form Items', 'manage_options', 'export_file_menu', 'export_file_menu_main');
 add_submenu_page('woocommerce', 'Export File', 'Export File', 'manage_options', 'export-file', 'export_file_menu_main');
}

add_action('admin_menu', 'export_file_menu');

function export_file_menu_main(){
        global $wpdb;
 $posts_dataProduk = $wpdb->get_results("
  SELECT 
   wp_postmeta.post_id,
   wp_posts.post_modified, 
   wp_postmeta.meta_value AS 'data1',
   wp_woocommerce_order_itemmeta.meta_key AS 'data2',
   wp_woocommerce_order_itemmeta.meta_value AS 'nama'

  FROM 
   wp_woocommerce_order_itemmeta 
   JOIN
   wp_woocommerce_order_items  ON wp_woocommerce_order_items.order_item_id = wp_woocommerce_order_itemmeta.order_item_id
   JOIN 
   wp_posts ON wp_woocommerce_order_items.order_id = wp_posts.ID 
   JOIN 
   wp_postmeta ON wp_postmeta.post_id = wp_posts.ID 
  WHERE
   post_status = 'wc-completed'
   AND 
   wp_postmeta.meta_key = '_billing_address_index' 
   AND
   wp_woocommerce_order_itemmeta.meta_key like '%Nama%'
  ");
?>


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
 echo '<div class="wrap"><h2>Export File to CSV or XLS</h2>Silahkan Gunakan fitur export file ke dalam bentuk csv atau xls</div>';
 echo "<table id='listData'>";
 echo   "<tr>";
 echo   "<th>Nama Depan Guru</th>";
 echo   "<th>Nama Belakang Guru</th>";
        echo   "<th>Nama Murid 1</th>";
        echo   "<th>Nama Murid 2</th>";
        echo   "<th>Alamat</th>";
        echo   " <th>E-mail</th>";
        echo   "<th>No. Telp</th>";
 echo   "</tr>";

 $status = TRUE;
 $namaSiswa = "";

 foreach($posts_dataProduk as $x){
  if($status === TRUE){
   $namaSiswa = $x->nama;
   $status = FALSE;
  }else{
   $data = explode(' ', $x->data1);
   $alamat = "";

   for($i = 2; $i < count($data)-2; $i++){
    $alamat .=$data[$i]. " ";
           //print($alamat);
                        }
                         
   echo "<tr>";
   echo "<td>".$data[0]."</td>";
   echo "<td>".$data[1]."</td>";
   echo "<td>".$namaSiswa."</td>";
   echo "<td>".$data->nama."</td>";
   echo "<td>".$alamat."</td>";
   echo "<td>".$data[count($data)-2]."</td>";
   echo "<td>".$data[count($data)-1]."</td>";
   echo "</tr>";
   $status = TRUE;
  }
 }

 echo "  
   </table>
  ";
?>

<script type="text/javascript">
 $(document).ready(function(){
  $('#listData').DataTable({
   dom: 'Bfrtip', 
   buttons: [
    'excel'
   ]
  })
 })
</script>

<?php

}