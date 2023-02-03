<?php

include '../../../wp-load.php';



$usercomment = $_GET['usercomment'];

$username = $_GET['username'];

$userphone = $_GET['userphone'];

$userproduct = $_GET['userproduct'];

$useremail = $_GET['useremail'];



$plugin_url = plugin_dir_url( __FILE__ );

$jsonurl = $plugin_url . 'json/db.json';

$jsonfile = file_get_contents($jsonurl);

$json = json_decode($jsonfile, true);

$from = $json['inquire']['from'];

$fromname = "Cebelio";

$emailto = $json['inquire']['to'];

$replyto = $json['inquire']['replyto'];

$replymessagebox = $json['inquire']['replymessagebox'];

$replymessage = $json['inquire']['replymessage'];



if(!$from){

    $from = get_bloginfo('admin_email');

}

if(!$emailto){

    $emailto = get_bloginfo('admin_email');

}

if(!$replyto){

    $replyto = get_bloginfo('admin_email');

}

if($replymessagebox == "true"){

    if(!$replymessage){

        $replymessage = "Thank you for your inquiry regarding our product. One of our team will be in contact with you shortly.";

    }

}



$message= '

<p>Name: '.$username.'</p>

<p>Phone: '.$userphone.'</p>

<p>Email: '.$useremail.'</p><br>

<p>Product: '.$userproduct.'</p><br>

<p>'.$usercomment.'</p>

';



$to = $emailto;

$subject = 'Enquire Form';

$headers = array('Content-Type: text/html; charset=UTF-8','from: '.$fromname.' <'.$from.'>','Reply-To: '.$username.' <'.$useremail.'>');

wp_mail( $to, $subject, $message, $headers );



if($replymessagebox == "true"){

    $to = $useremail;

    $subject = 'Enquire Form';

    $headers = array('Content-Type: text/html; charset=UTF-8','from: '.$fromname.' <'.$from.'>','Reply-To: <'.$replyto.'>');

    wp_mail( $to, $subject, $replymessage, $headers );

}



?>