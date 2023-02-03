<?php

/*

Plugin Name: BM_Woocommerce_Inquires

Description: Woocommerce Product Inquires

Version: 1.0

Author: Andre Campos

*/ 



// Add Announcement button to wordpress admin menu.

add_action('admin_menu', 'my_menu_pages_query');

function my_menu_pages_query(){

    add_menu_page('Product Enquire', 'Product Enquire', 'manage_options', 'my-menu-enquire', 'my_menu_enquire', null, 6 );

}





// What is showing on Annoucement menu on wordpress admin menu.

function my_menu_enquire() {



    $plugin_url = plugin_dir_url( __FILE__ );

    wp_enqueue_style( 'css', $plugin_url . 'css/admin.css' );

	wp_enqueue_script( 'js', $plugin_url . 'js/js.js' );

	

	$jsonurledit = $plugin_url . 'bm-inquire-json.php';

	

    $jsonurl = $plugin_url . 'json/db.json';

    $jsonfile = file_get_contents($jsonurl);

    $json = json_decode($jsonfile, true);

    $status = $json['inquire']['status'];

    $from = $json['inquire']['from'];

    $replyto = $json['inquire']['replyto'];

    $to = $json['inquire']['to'];

    $replymessage = $json['inquire']['replymessage'];

    $replymessagebox = $json['inquire']['replymessagebox'];

    $buttonproducts = $json['inquire']['buttonproducts'];

    $buttonproductssingle = $json['inquire']['buttonproductssingle'];

    $color2 = $json['inquire']['color'];
    $color = "#".$color2;

    $admin_email = get_bloginfo('admin_email');


    if($status == "true"){

        $statusdisplay = "block";

    }else{

        $statusdisplay = "none";   

    }

	echo '<div class="wrap">';

        echo '<h2>Product Inquire</h2>';

	echo '</div><br>';

	

	echo '<label class="switch">';

        if($status == "true"){

            echo '<input id="status" onclick="myFunction()" type="checkbox" checked>';

        }else{

            echo '<input id="status" onclick="myFunction()" type="checkbox">';

        }

        echo '<span class="slider round"></span>';

    echo '</label><br><br>';

    

    echo "<div id='announcementplugininformation' class='wrap' style='display:$statusdisplay'>";

    

        echo '<div class="wrap">';

            echo '<h3>Button</h3>';

    	echo '</div>';

        

        if($buttonproducts == "true"){

            echo '<input type="checkbox" id="buttonproducts" name="buttonproducts" checked>';

        }else{

            echo '<input type="checkbox" id="buttonproducts" name="buttonproducts">';

        }

        echo '<label for="buttonproducts">Show on Products - Archive</label><br><br>';

        

        if($buttonproductssingle == "true"){

            echo '<input type="checkbox" id="buttonproductssingle" name="buttonproductssingle" checked>';

        }else{

            echo '<input type="checkbox" id="buttonproductssingle" name="buttonproductssingle">';

        }

        echo '<label for="buttonproductssingle">Show on Products - Single Page</label><br><br>';


        echo '<div class="wrap">';

            echo '<h3>Color</h3>';

    	echo '</div>';


        echo "<input type='color' id='apicolor' name='apicolor' value='$color'><br><br>";

    

        echo '<div class="wrap">';

            echo '<h3>Email Settings</h3>';

    	echo '</div>';

    	

        echo '<label for="fname">Send Enquires to this email</label><br>';

        echo "<input type='text' id='apito' name='apito' placeholder='$admin_email' value='$to'><br><br>";

    	

        echo '<label for="fname">From</label><br>';

        echo "<input type='text' id='apifrom' name='apifrom' placeholder='$admin_email' value='$from'><br><br>";

        echo '<label for="fname">Reply-to</label><br>';

        echo "<input type='text' id='apireplyto' name='apireplyto' placeholder='$admin_email' value='$replyto'><br><br>";

        

        

        

        echo '<div class="wrap">';

            echo '<h3>Options</h3>';

    	echo '</div>';

    

        if($replymessagebox == "true"){

            echo '<input type="checkbox" id="replymessage" name="replymessage" value="Send Message" checked>';

        }else{

            echo '<input type="checkbox" id="replymessage" name="replymessage" value="Send Message">';

        }

        

        echo '<label for="replymessage">Send an automatic reply message to customers</label><br><br>';

        echo "<textarea id='replymessagetext' name='replymessagetext' placeholder='We received your inquiry, and one of our team will get back to you as soon as possible.'>$replymessage</textarea><br><br>";

        

    echo '</div><br>';

    

    echo '<div class="wrap">';

        echo "<button id='announcementbutton' onclick='buttonsave(\"$jsonurledit\")' style='width:80px;height:35px;'>Save</button></a>";

    echo '</div>';



}











// // Extra button on product list - Before

// add_action( 'woocommerce_after_shop_loop_item', 'new_add_to_cart_button' );

// function new_add_to_cart_button() {

//     echo '<button type="submit" class="button alt">Change me please</button>';

// }

// Extra button on product list - After

function wc_shop_enquire_button() {

    

    $plugin_url = plugin_dir_url( __FILE__ );

    $jsonurl = $plugin_url . 'json/db.json';

    $jsonfile = file_get_contents($jsonurl);

    $json = json_decode($jsonfile, true);

    $status = $json['inquire']['status'];

    $singlestatus = $json['inquire']['buttonproducts'];

    $color2 = $json['inquire']['color'];
    $color = "#".$color2;




    global $product;

    $productname = $product->get_name();

    

    if( !$product->is_purchasable() && $status=="true" && $singlestatus == "true") {

        echo '<button style="margin-left:10px;background-color:'.$color.'" type="submit" onclick="openinquirebox(\''.$productname.'\')" class="button alt">Enquire</button>';

    }

}

add_action( 'woocommerce_after_shop_loop_item', 'wc_shop_enquire_button', 20 );





add_action( 'woocommerce_simple_add_to_cart', 'wc_simple_enquire_add_to_cart' );

function wc_simple_enquire_add_to_cart(){

    

    $plugin_url = plugin_dir_url( __FILE__ );

    $jsonurl = $plugin_url . 'json/db.json';

    $jsonfile = file_get_contents($jsonurl);

    $json = json_decode($jsonfile, true);

    $status = $json['inquire']['status'];

    $singlestatus = $json['inquire']['buttonproductssingle'];

    $color2 = $json['inquire']['color'];
    $color = "#".$color2;



    global $product;

    $productname = $product->get_name();

    

    if( !$product->is_purchasable() && $status=="true" && $singlestatus == "true") {

        echo sprintf( '<button type="submit" style="width:200px;background-color:'.$color.'" onclick="openinquirebox(\''.$productname.'\')" class="button alt">Enquire</button>', wc_get_cart_url(), __( 'View Cart', 'woocommerce' ) );

    }

    

}







function mbmyqueryform() {

    

$plugin_url = plugin_dir_url( __FILE__ );

wp_enqueue_style( 'css', $plugin_url . 'css/css.css' );

wp_enqueue_script( 'js', $plugin_url . 'js/js.js' );



$jsonurl = $plugin_url . 'json/db.json';

$jsonfile = file_get_contents($jsonurl);

$json = json_decode($jsonfile, true);

$color2 = $json['inquire']['color'];
$color = "#".$color2;



$jsonurl = $plugin_url . 'json/db.json';

$backgroundimageurl =  $plugin_url . 'img/inquires_small.jpg';

$emailurl = $plugin_url . 'bm-inquire-email.php';

$loadingimageurl =  $plugin_url . 'img/loading.gif';



echo'<div id="loginScreen" class="overlay" style="display:none;">';

    echo'<div class="overlay-content" style="border-color:'.$color.'">';

        echo'<div onclick="closeinquirebox()" class="closebtn" style="color:'.$color.';border-color:'.$color.'">X</div>';

        echo'

        

            <div class="overlay-top-content" style="border-bottom-color:'.$color.'">

                <div class="overlay-top-content-left"><img src="'.$backgroundimageurl.'" alt="Inquires" width="250" height="150"></div>

                <div class="overlay-top-content-right">

                    <div style="width:100%;position: relative;display: inline-block;">

                        <h4>Enquire Form</h4>

                        <p style="font-size:16px">Please fill out the form below, and one of our team will get back to you.</p>

                    </div>

                </div>

            </div>

        

        ';

        

        echo'<h5 id="inquireproductid" style="text-align: left;">Product</h5>';

        //echo'<form id="bmmyqueryform" method="post">';
        echo '<div id="divformenquirediv">';

            echo'<input id="emailname" type="text" placeholder="Your Name"/><br/>';

            echo'<input id="emailemail" type="email" placeholder="Your Email"/><br/>';

            echo'<input id="emailphone" type="text" placeholder="Your Phone"/><br/>';

            echo'<textarea id="emailcomment" name="comment" placeholder="Message"></textarea><br/>';

            echo'<button id="butaosend" onclick="bminquiresendemail(\''.$emailurl.'\',\''.$loadingimageurl.'\')" style="margin-top: 20px;background-color:'.$color.';border-color:'.$color.'" class="formbutton"> Submit </button>';

        echo '</div>';
        echo '<div id="divformenquiremessagediv" style="color:#0B4513;font-size:18px;"></div>';
        //echo'</form>';

    echo'</div>';

echo'</div>';



}

add_action('wp_body_open', 'mbmyqueryform');



add_shortcode('bm_enquire_buttom_shortcode', 'bm_enquire_buttom_shortcode'); 
function bm_enquire_buttom_shortcode() {
    ob_start();
    $plugin_url = plugin_dir_url( __FILE__ );

    wp_enqueue_style( 'css', $plugin_url . 'css/css.css' );
    wp_enqueue_script( 'js', $plugin_url . 'js/js.js' );

    global $product;

    $parent_title = get_the_title( $post->post_parent );


    $jsonurl = $plugin_url . 'json/db.json';

    $backgroundimageurl =  $plugin_url . 'img/inquires_small.jpg';

    $emailurl = $plugin_url . 'bm-inquire-email.php';

    $loadingimageurl =  $plugin_url . 'img/loading.gif';

    echo '<div><button type="submit" class="formbutton" onclick="openinquirebox(\''.$parent_title.'\')" class="button alt">Enquire Now</button></div>';
    return ob_get_clean();
}


?>