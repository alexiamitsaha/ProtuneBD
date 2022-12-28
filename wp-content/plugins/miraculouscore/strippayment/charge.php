<?php 
require_once( dirname(__FILE__) . '/../../../../wp-load.php' ); // WP environment
wp_head();
require_once( dirname(__FILE__) . '/striplibary/init.php' ); // I placed the directory with Stripe PHP library in the theme folder

$miraculous_theme_data = '';
if (function_exists('fw_get_db_settings_option')):  
    $miraculous_theme_data = fw_get_db_settings_option();     
endif; 
$current_user = wp_get_current_user();
$user_email = $current_user->user_email;
$currency = '';
if(!empty($miraculous_theme_data['currency'])):
    $currency = $miraculous_theme_data['currency'];
endif;
$stripe_publishable_key = '';
if(!empty($miraculous_theme_data['theme_stripe_switch']['on']['stripe_publishable_key'])):
    $stripe_publishable_key = $miraculous_theme_data['theme_stripe_switch']['on']['stripe_publishable_key'];
endif;
 
$stripe_success_page_url = '';
if(!empty($miraculous_theme_data['theme_stripe_switch']['on']['stripe_success_page_url'])):
    $stripe_success_page_url = $miraculous_theme_data['theme_stripe_switch']['on']['stripe_success_page_url'];
endif;

$stripe_cancel_page_url = '';
if(!empty($miraculous_theme_data['theme_stripe_switch']['on']['stripe_cancel_page_url'])):
    $stripe_cancel_page_url = $miraculous_theme_data['theme_stripe_switch']['on']['stripe_cancel_page_url'];
endif;

// you can get it in Stripe Account Settings -> API Keys
$secret = '';
if(!empty($miraculous_theme_data['theme_stripe_switch']['on']['stripe_secret_key'])):
    $secret = $miraculous_theme_data['theme_stripe_switch']['on']['stripe_secret_key'];
endif;
$email = '';
if(!empty($miraculous_theme_data['theme_stripe_switch']['on']['stripe_email'])):
    $email = $miraculous_theme_data['theme_stripe_switch']['on']['stripe_email'];
endif;


if(isset($_POST['stripeToken'])){
	
	\Stripe\Stripe::setApiKey( $secret );

	/* we specified this parameter as a hidden field */
	$item_id = $_POST['item_id'];

    $item_type = '';
    if(isset($_POST['item_type'])){
	  $item_type = $_POST['item_type'];
    } 
    $item_name = get_the_title($item_id);

	$price = get_post_meta( $item_id, 'fw_option:plan_monthly_price', true ) * 100;

	try {

		if ( !isset($_POST['stripeToken']) )
			throw new Exception('The Stripe Token is not correct');
	
		/* make a charge */
        $token = $_POST['stripeToken'];
		$email = $user_email;
		$data = \Stripe\Charge::create( array( 'amount' => $price, 'currency' => $currency, 'source' => $token, 'description' => 'Plan Name:' . $item_name. ') User EMail: ' . $_POST['stripeEmail'] ) );
		global $wpdb;

		$tbl_pay = $wpdb->prefix. 'ms_payments';
		
		$current_user = wp_get_current_user();
		
        $plan_validity = get_post_meta($item_id, 'fw_option:plan_validity', true);

		$total_downloads = get_post_meta($item_id, 'fw_option:plan_monthly_download', true);
        $total_uploads = get_post_meta($item_id, 'fw_option:plan_monthly_uploads', true);
		  
		$sub_id = $data->id;
		$billing_ca = 'stripe';
		$collection_method = 'stripe';
	    $st_plan_id = $data->balance_transaction;
	    $amount = $data->amount/100;
		$pl_status = $data->status;
	    $customer = 'customer';
		$wpdb->insert( 
			$tbl_pay, 
			array(
			    'user_id' => $current_user->ID, 
			    'txnid' => $sub_id, 
			    'payment_amount' => $amount,
			    'payment_status' => $pl_status,
			    'itemid' => $item_id, 
			    'monthly_download' => $total_downloads, 
			    'monthly_upload' => $total_uploads, 
			    'createdtime' => date('Y-m-d H:i:s'),
				'expiretime' => date("Y-m-d H:i:s", strtotime("+$plan_validity months")),
			    'remains_download' => $total_downloads,
				'remains_upload' => $total_uploads,
			    'extra_data' => 'Stripe Payment Succesfull',
			    'payment_getway' => 'Stripe Payment',
                ), 
			array( 
				'%d',
				'%s',
				'%d',
				'%s',
				'%d',
				'%d',
				'%d',
				'%s',
				'%s',
				'%d',
				'%d',
				'%s',
				'%s',
				)  
			); 
    if($wpdb->insert_id){
		
        //add_graph_data($item_id,'tracks_song_purchase_count',1); 
		$web_url = get_the_permalink($item_id); 
        $header = '';
        if(!empty($miraculous_theme_data['planspayment_header'])):
            $header = $miraculous_theme_data['planspayment_header'];
        endif;
        $emailmessage = '';
        if(!empty($miraculous_theme_data['planpayment_emailmessage'])):
            $emailmessage = $miraculous_theme_data['planpayment_emailmessage'];
        endif;
        $customer_email = $_POST['stripeEmail'];
        $admin_email = get_option('admin_email');
        $headers = array('Content-Type: text/html; charset=UTF-8',$header);

        $multiple_emails = array(
            $admin_email, 
            $customer_email,
           );
        wp_mail($multiple_emails, $emailmessage, $web_url, $headers);
    ?>
	<script>
    jQuery(document).ready(function($){
       "use strict";
        toastr.success('Thank you for making a purchase');
        window.location.replace('<?php echo esc_url($stripe_success_page_url); ?>');
    });   
    </script>
	<?php
	}else{
    ?>
    <script>
    jQuery(document).ready(function($){
       "use strict";
       toastr.success('Error!');
       window.location.replace('<?php echo esc_url($stripe_cancel_page_url); ?>');
    });  
    </script>
    <?php
	}
	
} catch (Exception $e) {
	/*
	* if something goes wrong
	*/ 
	echo $e->getMessage();
} 

}else{
	esc_html_e('The Stripe Token is not correct','miraculous');
}
wp_footer();