<?php 
require_once( dirname(__FILE__) . '/../../../../wp-load.php' ); // WP environment
wp_head();
require_once( dirname(__FILE__) . '/striplibary/init.php' ); // I placed the directory with Stripe PHP library in the theme folder

$miraculous_theme_data = '';
if (function_exists('fw_get_db_settings_option')):  
    $miraculous_theme_data = fw_get_db_settings_option();     
endif; 
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

$stripe_commission_point = '';
if(!empty($miraculous_theme_data['theme_stripe_switch']['on']['stripe_commission_point'])):
   $stripe_commission_point = $miraculous_theme_data['theme_stripe_switch']['on']['stripe_commission_point'];
endif;
if(isset($_POST['stripeToken'])){
	
	\Stripe\Stripe::setApiKey( $secret );     

	/* we specified this parameter as a hidden field */
    $item_id = $_POST['item_id'];
	
    $item_name = get_the_title($item_id);
    $author_id = get_post_field ('post_author', $item_id);
	
    if($author_id):
      $stripe_username = get_user_meta($author_id,'stripe_username', true);
      $stripe_useremail = get_user_meta($author_id,'stripe_useremail', true);
      $stripe_secretkey = get_user_meta($author_id, 'stripe_secretkey', true); 
      $stripe_accountid = get_user_meta($author_id, 'stripe_accountid', true);  
    endif; 
	/* if your plugin price looks like 9.59, then you need to *100 it */
	$item_type = get_post_type($item_id);
	if($item_type == 'ms-albums'){
	    $price = get_post_meta( $item_id, 'fw_option:album_full_prices', true ) * 100;
	    $item_type = 'Album';
	} else {
	    $price = get_post_meta( $item_id, 'fw_option:single_music_prices', true ) * 100;
	    $item_type = 'Track';
	}
    
	try {

		if ( !isset($_POST['stripeToken']) )
			throw new Exception('The Stripe Token is not correct');
	
		/* make a charge */
        $rdata = \Stripe\Charge::create( array( 'amount' => $price, 'currency' => $currency, 'source' => $_POST['stripeToken'], 'description' => $item_type.': ' . $item_name . ', User EMail: ' . $_POST['stripeEmail'] ) );
        
        if(!empty($stripe_secretkey) && !empty($stripe_accountid) ){

            \Stripe\Stripe::setApiKey($stripe_secretkey);
		
            $payment_intent = \Stripe\PaymentIntent::create([
                'payment_method_types' => ['card'],
                
                'payment_method' => $rdata->payment_method,
                'amount' => $price,
                'currency' => $currency,
            ], ['stripe_account' => $stripe_accountid]);
                
            $stripe = new \Stripe\StripeClient($stripe_secretkey);
                
            
            $stripe->paymentIntents->confirm(
                $payment_intent->id,
                ['payment_method' => 'pm_card_visa']
            );

        }

        global $wpdb; 
        $tbl_pay = $wpdb->prefix. 'ms_orders';
		$current_user = wp_get_current_user();
		$download_limite = 100;
        $tranx_amount = $price/100;
        $amount_admin = 0;
        if(!empty($totalcommission)){
        $amount_admin = $totalcommission/100;
        }
        $amount_author = $price/100;
		$tranx_id = $rdata->id;
		$tranx_status = $rdata->status;
        $plan_validity = '12';
        $author_id = get_post_field( 'post_author', $item_id);
        $user_id = $current_user->ID;
		$wpdb->insert( 
			$tbl_pay, 
		array(
                'user_id' => $user_id, 
                'author_id' => $author_id,
                'itemid' => $item_id,
                'txnid' => $tranx_id,
                'payment_amount' => $tranx_amount,
                'payment_amount_admin' => $amount_admin,
                'payment_amount_author' => $amount_author,
                'payment_status' => $tranx_status,
                'monthly_download_limite' => $download_limite,
                'createdtime' => date('Y-m-d H:i:s'),
                'expiretime' => date("Y-m-d H:i:s", strtotime("+$plan_validity months")),
               'extra_data' => json_encode($rdata),
                //'item_type'=> $item_type,
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
                '%s',
                '%s',
			  )  
		); 
	if($wpdb->insert_id){ 
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
	else{
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