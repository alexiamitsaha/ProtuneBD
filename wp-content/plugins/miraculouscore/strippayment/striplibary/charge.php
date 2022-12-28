<?php 
require_once( dirname(__FILE__) . '/../../../../wp-load.php' ); // WP environment
require_once( dirname(__FILE__) . '/striplibary/init.php' ); // I placed the directory with Stripe PHP library in the theme folder
 
/* we specified this parameter as a hidden field */
$item_id = $_POST['item_id'];
 
/* run print_r( $_POST ) to view all available parameters */
 
/* if your plugin price looks like 9.59, then you need to *100 it */
$price = get_post_meta( $item_id, 'fw_option:plan_price', true ) * 100;
 
$secret = 'sk_test_51HL3wLEDbRYzntObdGU4nWd5hnm4rR1fk1UfJf9kKc1N9GeVAq6Yybc5LP1yvNp4aXLWqmQiM76vAr9csksDJ9Il00VyIVqIF6';  // you can get it in Stripe Account Settings -> API Keys

\Stripe\Stripe::setApiKey( $secret );
 
try {
	if ( !isset($_POST['stripeToken']) )
		throw new Exception('The Stripe Token is not correct');
 
	/* make a charge */
	\Stripe\Charge::create( array( 'amount' => $price, 'currency' => 'usd', 'source' => $_POST['stripeToken'], 'description' => 'Plugin (ID ' . $item_id . ') download for ' . $_POST['stripeEmail'] ) );
 
	/* if successful - send a plugin by email */
	$plugin_path = 'YOUR_PLUGIN_ZIP_FILE_PATH'; // you can store this information in custom fields for example
	$headers = 'From: Misha Rudrastyh <no-reply@rudrastyh.com>' . "\r\n";
	wp_mail( $_POST['stripeEmail'], 'Thanks for buying my plugin', 'The plugin is attached to this email.', $headers, $attachments );
 
} catch (Exception $e) {
	/*
	 * if something goes wrong
	 */ 
	echo $e->getMessage();
}