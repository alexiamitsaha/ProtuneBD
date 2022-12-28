<?php
require '../../../../wp-load.php';

$plan_id = $_REQUEST['plan_id'];
$curl = curl_init();
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

$currency = '';
if(!empty($miraculous_theme_data['currency'])):
    $currency = $miraculous_theme_data['currency'];
endif;

$itemAmount = get_post_meta($_POST['plan_id'], 'fw_option:single_music_prices', true);
if(empty($itemAmount)){
    $itemAmount = get_post_meta($_POST['plan_id'], 'fw_option:album_full_prices', true);
    } 

$amount = $itemAmount * 100;
$email = $_POST['payer_email'];
$plan_id = $_POST['plan_id'];
    
// url to go to after payment
$callback_url = plugins_url('miraculouscore/paystack/single_song_orders.php');  

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.paystack.co/transaction/initialize",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => json_encode([
    'amount'=>$amount,
    'email'=>$email,
    'metadata'=> [ 'plan_id' => $plan_id ],
    'callback_url' => $callback_url
  ]),
  CURLOPT_HTTPHEADER => [
    "authorization: Bearer $secret_key", //replace this with your own test key
    "content-type: application/json",
    "cache-control: no-cache"
  ],
));

$response = curl_exec($curl);
$err = curl_error($curl);

if($err){
  // there was an error contacting the Paystack API
  die('Curl returned error: ' . $err);
}

$tranx = json_decode($response, true);

if(!$tranx['status']){
  // there was an error from the API
  print_r('API returned error: ' . $tranx['message']);
}

// comment out this line if you want to redirect the user to the payment page

// uncomment this line to allow the user redirect to the payment page
header('Location: ' . $tranx['data']['authorization_url']);