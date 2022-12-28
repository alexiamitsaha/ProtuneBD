<?php
require_once( dirname(__FILE__) . '/../../../../wp-load.php' ); // WP environment
//wp_head();
	    $current_user = wp_get_current_user();
	    $user_ID = $current_user->ID;
	    $email = $current_user->user_email;
		$order_id = $_POST['razorpay_payment_id'];
		$plan_id = $_POST['plan_id'];
		$author_id = get_post_field( 'post_author', $plan_id);
		$price = get_post_meta( $plan_id, 'fw_option:album_full_prices', true );
        
        $miraculous_theme_data = '';
        if (function_exists('fw_get_db_settings_option')):  
            $miraculous_theme_data = fw_get_db_settings_option();     
        endif;
        
        $razorpay_success_page_url = '';
        if(!empty($miraculous_theme_data['theme_razorpay_switch']['on']['razorpay_success_page_url'])):
            $razorpay_success_page_url = $miraculous_theme_data['theme_razorpay_switch']['on']['razorpay_success_page_url'];
        endif;
        
        $razorpay_cancel_page_url = '';
        if(!empty($miraculous_theme_data['theme_razorpay_switch']['on']['razorpay_cancel_page_url'])):
            $razorpay_cancel_page_url = $miraculous_theme_data['theme_razorpay_switch']['on']['razorpay_cancel_page_url'];
        endif;
        $amount_admin = 0;
        $download_limite = 100;
        $plan_validity = 12;
		 
		if(isset($order_id)){
			global $wpdb; 
			$tbl_pay = $wpdb->prefix. 'ms_orders';
			$wpdb->insert(
			$tbl_pay, 
			array(
			    'user_id' => $user_ID, 
                'author_id' => $author_id,
                'itemid' => $plan_id,
                'txnid' => $order_id,
                'payment_amount' => $price,
                'payment_amount_admin' => $amount_admin,
                'payment_amount_author' => $price,
                'payment_status' => 'Successfull',
                'monthly_download_limite' => $download_limite,
                'createdtime' => date('Y-m-d H:i:s'),
                'expiretime' => date("Y-m-d H:i:s", strtotime("+$plan_validity months")),
               'extra_data' => json_encode($_POST),
                ) 
			);
			if($wpdb->insert_id){
			    $post_type = get_post_type( $plan_id );
    		    if($post_type == 'ms-music'){
    		        $songs = array();
    		        $songs[] = $plan_id;
    		        $counte = 1;
                	$dowenloadsong = get_post_meta($plan_id,'song_dowenload_counter',true);
                	if($dowenloadsong){
                	    $counte +=$dowenloadsong;
                	}
                	$items = get_user_meta($user_ID, 'premium_downloaded_songs_by_user_'.$user_ID, true);
                	if($items){
                	    $new_arr = array_merge($items, $songs);
                	    update_user_meta($user_ID, 'premium_downloaded_songs_by_user_'.$user_ID, $new_arr);
                	    update_post_meta($plan_id,'song_dowenload_counter',$counte);
                	} else {
                	    update_user_meta($user_ID, 'premium_downloaded_songs_by_user_'.$user_ID, $songs);
                	}
    		    } else {
    		        $songs = array();
    		        $songs[] = $plan_id;
    		        $albums = get_user_meta($user_ID, 'premium_downloaded_album_by_user_'.$user_ID, true);
    				if($albums){
                	    $new_arry = array_merge($albums, $songs);
                	    update_user_meta($user_ID, 'premium_downloaded_album_by_user_'.$user_ID, $new_arry);
                	} else {
                	    update_user_meta($user_ID, 'premium_downloaded_album_by_user_'.$user_ID, $songs);
                	}
    		    }
			    
			    $web_url ='Thankyou Purchasing';
				$header = '';
                $emailmessage = 'Order Successfully Placed';  
                $customer_email = $email;
                $admin_email = get_option('admin_email');
                $headers = array('Content-Type: text/html; charset=UTF-8',$header); 
                $multiple_emails = array(
                    $admin_email, 
                    $customer_email,
                );
                wp_mail($multiple_emails, $emailmessage, $web_url, $headers);
                
				$data = array('status' => 'true', 'msg' => 'Sucess', 'url' => $razorpay_success_page_url);
			} else{ 
				$data = array('status' => 'false', 'msg' => 'Failed', 'url' => $razorpay_cancel_page_url);
			} 
		}
    
	echo json_encode($data);
die();
?>



