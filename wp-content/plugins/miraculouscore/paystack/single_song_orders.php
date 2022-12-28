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
        $item_id = $tranx->data->metadata->plan_id;
        //print_r($item_id);
        $current_user = wp_get_current_user();
        $item_type = get_post_type($item_id);
        if($item_type == 'ms-albums'){
            $price = get_post_meta($item_id, 'fw_option:album_full_prices', true);
            $item_type = 'Album';
        } else {
            $price = get_post_meta($item_id, 'fw_option:single_music_prices', true);
            $item_type = 'Track';
        }
        global $wpdb; 
        $tbl_pay = $wpdb->prefix. 'ms_orders';
		$current_user = wp_get_current_user();
		$download_limite = 100;
        $tranx_amount = $price;
        $amount_admin = $price;
        $amount_author = $price;
		$tranx_id = $tranx->data->id;
		$tranx_status = $tranx->data->status;
        $plan_validity = '12';
        $post_type = 
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
               'extra_data' => json_encode($tranx->data),
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