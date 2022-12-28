<?php
require '../../../../wp-load.php';
wp_head();

$miraculous_theme_data = '';
if (function_exists('fw_get_db_settings_option')):  
    $miraculous_theme_data = fw_get_db_settings_option();     
endif; 

$secret_key = '';
if(!empty($miraculous_theme_data['theme_paystack_switch']['on']['paystack_secret_key'])):
    $secret_key = $miraculous_theme_data['theme_paystack_switch']['on']['paystack_secret_key'];
endif;

$paystack_success_page_url = '';
if(!empty($miraculous_theme_data['theme_paystack_switch']['on']['paystack_success_page_url'])):
    $paystack_success_page_url = $miraculous_theme_data['theme_paystack_switch']['on']['paystack_success_page_url'];
endif;

$paystack_cancel_page_url = '';
if(!empty($miraculous_theme_data['theme_paystack_switch']['on']['paystack_cancel_page_url'])):
    $paystack_cancel_page_url = $miraculous_theme_data['theme_paystack_switch']['on']['paystack_cancel_page_url'];
endif;

$curl = curl_init();
$reference = isset($_GET['reference']) ? $_GET['reference'] : '';
if(!$reference){
  die('No reference supplied');
}

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.paystack.co/transaction/verify/" . rawurlencode($reference),
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_HTTPHEADER => [
    "accept: application/json",
    "authorization: Bearer $secret_key",
    "cache-control: no-cache"
  ],
));

$response = curl_exec($curl);
$err = curl_error($curl);

if($err){
    // there was an error contacting the Paystack API
  die('Curl returned error: ' . $err);
}

$tranx = json_decode($response);
if(!$tranx->status){
  // there was an error from the API
  die('API returned error: ' . $tranx->message);
}

if('success' == $tranx->data->status){
  // transaction was successful...
  // please check other things like whether you already gave value for this ref
  // if the email matches the customer who owns the product etc
  // Give value
  $plan_id = $tranx->data->metadata->plan_id;
  $current_user = wp_get_current_user();
  $itemName = '';
  $plan_validity = get_post_meta($plan_id, 'fw_option:plan_validity', true);
  $monthly_download = get_post_meta($plan_id, 'fw_option:plan_monthly_download', true);
  $monthly_upload = get_post_meta($plan_id, 'fw_option:plan_monthly_uploads', true);
   
  global $wpdb;
  $tbl_pay = $wpdb->prefix. 'ms_payments';
  $wpdb->insert( 
			$tbl_pay, 
			array(
				'user_id' => $current_user->ID, 
				'txnid' => $tranx->data->id, 
				'payment_amount' => $tranx->data->amount/100,
				'payment_status' => $tranx->data->status,
				'itemid' => $plan_id,
				'monthly_download' => $monthly_download,
				'monthly_upload' => $monthly_upload,
				'createdtime' => date('Y-m-d H:i:s'),
				'expiretime' => date("Y-m-d H:i:s", strtotime("+$plan_validity months")),
				'remains_download' => $monthly_download,
				'remains_upload' => $monthly_upload,
				'extra_data' =>'Paystack Payment Succesfull',
				'payment_getway' =>'Paystack'
			), 
			array(
				'%d', 
				'%s', 
				'%s',
				'%s',
				'%d',
				'%d',
				'%d',
				'%s',
				'%s',
				'%d',
				'%d',
				'%s',
				'%s'
			) 
		);
	if($wpdb->insert_id){
	?>
	<script>
    jQuery(document).ready(function($){
       "use strict";
        toastr.success('Thank you for making a purchase');
       window.location.replace('<?php echo esc_url($paystack_success_page_url); ?>');
    });  
    </script>
	<?php
	}else{
	?>
	<script>
    jQuery(document).ready(function($){
       "use strict";
        toastr.success('Error!');
       window.location.replace('<?php echo esc_url($paystack_cancel_page_url); ?>');
    });  
    </script>
	<?php 
	}
}
wp_footer();