<?php
require_once( dirname(__FILE__) . '/../../../../wp-load.php' ); // WP environment
ob_start();

if( function_exists('fw_get_db_settings_option') ) {
  $theme_option = fw_get_db_settings_option();
  $enableSandbox = $theme_option['theme_paypal_switch']['on']['paypal_mode'];
  $paypal_business_email = $theme_option['theme_paypal_switch']['on']['paypal_business_email'];
  $paypal_success_page_url = $theme_option['theme_paypal_switch']['on']['paypal_success_page_url'];
  $paypal_cancel_page_url = $theme_option['theme_paypal_switch']['on']['paypal_cancel_page_url'];
  $currency_code = $theme_option['currency'];
}

$paypalConfig = [
    'email' => $paypal_business_email,
    'return_url' => $paypal_success_page_url ? $paypal_success_page_url : site_url(),
	'cancel_url' => $paypal_cancel_page_url ? $paypal_cancel_page_url : site_url(),
	'notify_url' => site_url().'/wp-content/plugins/miraculouscore/paypal/music_orders.php',
];
if($enableSandbox == "testing"){
    $paypalUrl = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
}
else{
  $paypalUrl = 'https://www.paypal.com/cgi-bin/webscr';  
}

$item_id = $_POST['item_number'];
$itemName = get_the_title($item_id);
$author_id = get_post_field ('post_author', $item_id);

$item_type = get_post_type($item_id);
if($item_type == 'ms-albums'){
	$itemAmount = get_post_meta( $item_id, 'fw_option:album_full_prices', true );
	$item_type = 'Album';
} else {
	$itemAmount = get_post_meta( $item_id, 'fw_option:single_music_prices', true );
	$item_type = 'Track';
}
// Check if paypal request or response
if (!isset($_POST["txn_id"]) && !isset($_POST["txn_type"])) {
    // Grab the post data so that we can set up the query string for PayPal.
    // Ideally we'd use a whitelist here to check nothing is being injected into
    // our post data.
    $data = [];
    foreach ($_POST as $key => $value) {
        $data[$key] = stripslashes($value);
    }

    // Set the PayPal account.
    $data['business'] = $paypalConfig['email'];

    // Set the PayPal return addresses.
    $data['return'] = stripslashes($paypalConfig['return_url']);
    $data['cancel_return'] = stripslashes($paypalConfig['cancel_url']);
    $data['notify_url'] = stripslashes($paypalConfig['notify_url']);

    // Set the details about the product being purchased, including the amount
    // and currency so that these aren't overridden by the form data.
    $data['item_name'] = $itemName;
    $data['amount'] = $itemAmount;
    $data['currency_code'] = $currency_code;
    $data['item_number'] = $item_id;
    
    $custom_arr = array('user_id' => $_POST['user_id'],'payment_status' => 'success');
	$data['custom'] = json_encode($custom_arr);

     //Add any custom fields for the query string.
    //$data['custom'] = USERID;

    // Build the query string from the data.
    $queryString = http_build_query($data);

    // Redirect to paypal IPN
    header('location:' . $paypalUrl . '?' . $queryString);
    exit();

} else {
    $custom_res = stripslashes($_POST['custom']);
	$custom_res1 = json_decode( $custom_res );
	$data = [
		'plan_name' => $_POST['item_name'],
		'plan_number' => $_POST['item_number'],
		'user_id' => $custom_res1->user_id,
		'plan_validity' => $custom_res1->plan_validity,
		'monthly_download' => $custom_res1->ms_download,
		'monthly_upload' => $custom_res1->ms_upload,
		'payment_status' => $_POST['payment_status'],
		'payment_amount' => $_POST['mc_gross'],
		'payment_currency' => $_POST['mc_currency'],
		'txn_id' => $_POST['txn_id'],
		'receiver_email' => $_POST['receiver_email'],
		'payer_email' => $_POST['payer_email'],
	];
	$plan_validity = '12';
    global $wpdb;
	$tbl_pay = $wpdb->prefix. 'ms_orders';
	if (is_array($data)) {
		$wpdb->insert(
    		$tbl_pay,
    		array(
                'user_id' => $data['user_id'], 
                'author_id' => $author_id,
                'itemid' => $data['plan_number'], 
                'txnid' => $data['txn_id'], 
                'payment_amount' => $data['payment_amount'],
                'payment_amount_admin' => $data['payment_amount'],
                'payment_amount_author' => $data['payment_amount'],
                'payment_status' => $data['payment_status'],
                'monthly_download_limite' => 100,
                'createdtime' => date('Y-m-d H:i:s'),
                'expiretime' => date("Y-m-d H:i:s", strtotime("+$plan_validity months")),
                'extra_data' => json_encode($data),
    		   ), 
    		array(
    			'%d', 
    			'%d', 
    			'%d',
    			'%s',
    			'%s',
    			'%s',
    			'%s',
    			'%s',
    			'%d', 
    			'%s',
    			'%s',
                '%s'
    		)  
		);
		
		if($wpdb->insert_id){
		    $item_id = $data['plan_number'];
		    $user_id = $data['user_id'];
	        update_option('miraculous_paypal_testing', $item_id);
    	    $post_type = get_post_type( $item_id );
    		    if($post_type == 'ms-music'){
    		        $songs = array();
    		        $songs[] = $item_id;
    		        $counte = 1;
                	$dowenloadsong = get_post_meta($item_id,'song_dowenload_counter',true);
                	if($dowenloadsong){
                	    $counte +=$dowenloadsong;
                	}
                	$items = get_user_meta($user_id, 'premium_downloaded_songs_by_user_'.$user_id, true);
                	if($items){
                	    $new_arr = array_merge($items, $songs);
                	    update_user_meta($user_id, 'premium_downloaded_songs_by_user_'.$user_id, $new_arr);
                	    update_post_meta($item_id,'song_dowenload_counter',$counte);
                	} else {
                	    update_user_meta($user_id, 'premium_downloaded_songs_by_user_'.$user_id, $songs);
                	}
    		    } else {
    		        $songs = array();
    		        $songs[] = $item_id;
    		        $albums = get_user_meta($user_id, 'premium_downloaded_album_by_user_'.$user_id, true);
    				if($albums){
                	    $new_arry = array_merge($albums, $songs);
                	    update_user_meta($user_id, 'premium_downloaded_album_by_user_'.$user_id, $new_arry);
                	} else {
                	    update_user_meta($user_id, 'premium_downloaded_album_by_user_'.$user_id, $songs);
                	}
    		    }
    	?>
            <script>
            jQuery(document).ready(function($){
               "use strict";
                toastr.success('Thank you for making a purchase');
                window.location.replace('<?php echo esc_url($stripe_success_page_url); ?>');
            }); 
            </script> <?php
            //exit();
    	}
	}
	return false;
}
ob_end_clean();