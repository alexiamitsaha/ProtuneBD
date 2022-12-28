<?php
require_once( dirname(__FILE__) . '/../../../../wp-load.php' ); // WP environment
//wp_head();
	    $current_user = wp_get_current_user();
	    $user_ID = $current_user->ID;
	    $email = $current_user->user_email;
		$order_id = $_POST['razorpay_payment_id'];
		$plan_id = $_POST['plan_id'];
		$plan_validity = get_post_meta($plan_id, 'fw_option:plan_validity', true);
        $total_downloads = get_post_meta($plan_id, 'fw_option:plan_monthly_download', true);
        $total_uploads = get_post_meta($plan_id, 'fw_option:plan_monthly_uploads', true);
        $price = get_post_meta( $plan_id, 'fw_option:plan_monthly_price', true );
        $title = get_the_title( $plan_id );
        
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
		 
		if(isset($order_id)){
			global $wpdb; 
			$tbl_pay = $wpdb->prefix. 'ms_payments';
			$wpdb->insert(
			$tbl_pay, 
			array(
			    'user_id' => $user_ID, 
			    'txnid' => $order_id, 
			    'payment_amount' => $price,
			    'payment_status' => 'Success',
			    'itemid' => $plan_id, 
			    'monthly_download' => $total_downloads, 
			    'monthly_upload' => $total_uploads, 
			    'createdtime' => date('Y-m-d H:i:s'),
				'expiretime' => date("Y-m-d H:i:s", strtotime("+$plan_validity months")),
			    'remains_download' => $total_downloads,
				'remains_upload' => $total_uploads,
			    'extra_data' => json_encode($_POST),
			    'payment_getway' => 'Razorpay Payment',
                ) 
			);
			if($wpdb->insert_id){
			    $web_url ='Thankyou Purchasing plan'. $title ;
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
			}else{ 
				$data = array('status' => 'false', 'msg' => 'Failed', 'url' => $razorpay_cancel_page_url);
			} 
		}
    
	echo json_encode($data);
die();
?>



