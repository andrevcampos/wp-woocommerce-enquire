<?php



$status = $_GET['status'];

$from = $_GET['from'];

$replyto = $_GET['replyto'];

$to = $_GET['to'];

$color = $_GET['color'];

$replymessage = $_GET['replymessage'];

$messagebox = $_GET['replymessagebox'];

$buttonproducts = $_GET['buttonproducts'];

$buttonproductssingle = $_GET['buttonproductssingle'];



include '../../../wp-load.php';

$plugin_url = plugin_dir_url( __FILE__ );

$jsonurl = $plugin_url . 'json/db.json';

$jsonfile = file_get_contents($jsonurl);

$json = json_decode($jsonfile, true);



$json['inquire']['status'] = $status;

$json['inquire']['from'] = $from;

$json['inquire']['replyto'] = $replyto;

$json['inquire']['to'] = $to;

$json['inquire']['color'] = $color;

$json['inquire']['replymessage'] = $replymessage;

$json['inquire']['replymessagebox'] = $messagebox;

$json['inquire']['buttonproducts'] = $buttonproducts;

$json['inquire']['buttonproductssingle'] = $buttonproductssingle;

$json_object = json_encode($json, true);

$file = WP_PLUGIN_DIR . '/bm_woocommerce_enquire/json/db.json';

file_put_contents($file, $json_object);



?>