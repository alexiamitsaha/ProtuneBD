<?php
/**
 * miraculous class of ajax function
 * File correction: 27-01-2021
 * @create: @an
 **/

  
class Miraculous_Ajax_Call{

  public function __construct() {

     /* */

	}
 
   public function init(){

		add_action( 'wp_ajax_miraculous_create_new_user_playlist', array( $this, 'miraculous_create_new_user_playlist' ), 10 );

		add_action( 'wp_ajax_nopriv_miraculous_create_new_user_playlist', array( $this, 'miraculous_create_new_user_playlist' ), 10 );

		add_action( 'wp_ajax_miraculous_user_login_form', array( $this, 'miraculous_user_login_form' ), 10 );

		add_action( 'wp_ajax_nopriv_miraculous_user_login_form', array( $this, 'miraculous_user_login_form' ), 10 );

		add_action( 'wp_ajax_miraculous_user_register_form', array( $this, 'miraculous_user_register_form' ), 10 );

		add_action( 'wp_ajax_nopriv_miraculous_user_register_form', array( $this, 'miraculous_user_register_form' ), 10 );

		add_action( 'wp_ajax_miraculous_user_update_form', array( $this, 'miraculous_user_update_form' ), 10 );

		add_action( 'wp_ajax_nopriv_miraculous_user_update_form', array( $this, 'miraculous_user_update_form' ), 10 );

		add_action( 'wp_ajax_miraculous_user_newsletter_form', array( $this, 'miraculous_user_newsletter_form' ), 10 );

		add_action( 'wp_ajax_nopriv_miraculous_user_newsletter_form', array( $this, 'miraculous_user_newsletter_form' ), 10 );

		add_action( 'wp_ajax_miraculous_add_in_favourites_songs_list', array( $this, 'miraculous_add_in_favourites_songs_list' ), 10 );

		add_action( 'wp_ajax_nopriv_miraculous_add_in_favourites_songs_list', array( $this, 'miraculous_add_in_favourites_songs_list' ), 10 );

		add_action( 'wp_ajax_miraculous_remove_from_favourites_songs_list', array( $this, 'miraculous_remove_from_favourites_songs_list' ), 10 );

		add_action( 'wp_ajax_nopriv_miraculous_remove_from_favourites_songs_list', array( $this, 'miraculous_remove_from_favourites_songs_list' ), 10 );

		add_action( 'wp_ajax_miraculous_add_in_favourites_albums_list', array( $this, 'miraculous_add_in_favourites_albums_list' ), 10 );

		add_action( 'wp_ajax_nopriv_miraculous_add_in_favourites_albums_list', array( $this, 'miraculous_add_in_favourites_albums_list' ), 10 );

		add_action( 'wp_ajax_miraculous_add_in_favourites_radios_list', array( $this, 'miraculous_add_in_favourites_radios_list' ), 10 );

		add_action( 'wp_ajax_nopriv_miraculous_add_in_favourites_radios_list', array( $this, 'miraculous_add_in_favourites_radios_list' ), 10 );
		
    	add_action( 'wp_ajax_miraculous_add_in_favourites_artists_list', array( $this, 'miraculous_add_in_favourites_artists_list' ), 10 );

		add_action( 'wp_ajax_nopriv_miraculous_add_in_favourites_artists_list', array( $this, 'miraculous_add_in_favourites_artists_list' ), 10 );
		
        add_action( 'wp_ajax_miraculous_add_music_in_user_playlist', array( $this, 'miraculous_add_music_in_user_playlist' ), 10 );

		add_action( 'wp_ajax_nopriv_miraculous_add_music_in_user_playlist', array( $this, 'miraculous_add_music_in_user_playlist' ), 10 );
		
		add_action( 'wp_ajax_miraculous_filter_music_language', array( $this, 'miraculous_filter_music_language' ), 10 );

		add_action( 'wp_ajax_nopriv_miraculous_filter_music_language', array( $this, 'miraculous_filter_music_language' ), 10 );		

		add_action( 'wp_ajax_miraculous_user_music_upload', array( $this, 'miraculous_user_music_upload' ), 10 );

		add_action( 'wp_ajax_nopriv_miraculous_user_music_upload', array( $this, 'miraculous_user_music_upload' ), 10 );		

		add_action( 'wp_ajax_miraculous_music_download', array( $this, 'miraculous_music_download' ), 10 );

		add_action( 'wp_ajax_nopriv_miraculous_music_download', array( $this, 'miraculous_music_download' ), 10 );

		add_action( 'wp_ajax_miraculous_remove_from_premium_songs_list', array( $this, 'miraculous_remove_from_premium_songs_list' ), 10 );

		add_action( 'wp_ajax_nopriv_miraculous_remove_from_premium_songs_list', array( $this, 'miraculous_remove_from_premium_songs_list' ), 10 );

		add_action( 'wp_ajax_miraculous_remove_from_free_songs_list', array( $this, 'miraculous_remove_from_free_songs_list' ), 10 );

		add_action( 'wp_ajax_nopriv_miraculous_remove_from_free_songs_list', array( $this, 'miraculous_remove_from_free_songs_list' ), 10 );

		add_action( 'wp_ajax_miraculous_remove_from_user_playlist_songs_list', array( $this, 'miraculous_remove_from_user_playlist_songs_list' ), 10 );

		add_action( 'wp_ajax_nopriv_miraculous_remove_from_user_playlist_songs_list', array( $this, 'miraculous_remove_from_user_playlist_songs_list' ), 10 );

		add_action( 'wp_ajax_miraculous_add_to_queue_action', array( $this, 'miraculous_add_to_queue_action' ), 10 );

		add_action( 'wp_ajax_nopriv_miraculous_add_to_queue_action', array( $this, 'miraculous_add_to_queue_action' ), 10 );
		
		add_action( 'wp_ajax_miraculous_play_all_music_action', array( $this, 'miraculous_play_all_music_action' ), 10 );

		add_action( 'wp_ajax_nopriv_miraculous_play_all_music_action', array( $this, 'miraculous_play_all_music_action' ), 10 );
		
		add_action( 'wp_ajax_miraculous_remove_user_playlist', array( $this, 'miraculous_remove_user_playlist' ), 10 );

		add_action( 'wp_ajax_nopriv_miraculous_remove_user_playlist', array( $this, 'miraculous_remove_user_playlist' ), 10 );
				
		add_action( 'wp_ajax_miraculous_play_user_playlist', array( $this, 'miraculous_play_user_playlist' ), 10 );

		add_action( 'wp_ajax_nopriv_miraculous_play_user_playlist', array( $this, 'miraculous_play_user_playlist' ), 10 );
		
		add_action( 'wp_ajax_miraculous_user_queue_data_action', array( $this, 'miraculous_user_queue_data_action' ), 10 );

		add_action( 'wp_ajax_nopriv_miraculous_user_queue_data_action', array( $this, 'miraculous_user_queue_data_action' ), 10 );
		
		add_action( 'wp_ajax_miraculous_user_load_queue_data_action', array( $this, 'miraculous_user_load_queue_data_action' ), 10 );

		add_action( 'wp_ajax_nopriv_miraculous_user_load_queue_data_action', array( $this, 'miraculous_user_load_queue_data_action' ), 10 );
		
		add_action( 'wp_ajax_miraculous_play_single_music_action', array( $this, 'miraculous_play_single_music_action' ), 10 );

		add_action( 'wp_ajax_nopriv_miraculous_play_single_music_action', array( $this, 'miraculous_play_single_music_action' ), 10 );
		
		add_action( 'wp_ajax_miraculous_remove_history_music_action', array( $this, 'miraculous_remove_history_music_action' ), 10 );

		add_action( 'wp_ajax_nopriv_miraculous_remove_history_music_action', array( $this, 'miraculous_remove_history_music_action' ), 10 );		
		
		add_action( 'wp_ajax_miraculous_freeplane_optionajax', array( $this, 'miraculous_freeplane_optionajax' ), 10 );

		add_action( 'wp_ajax_nopriv_miraculous_freeplane_optionajax', array( $this, 'miraculous_freeplane_optionajax' ), 10 );
			
		add_action( 'wp_ajax_miraculous_nofication_form', array( $this, 'miraculous_nofication_form' ), 10 );

		add_action( 'wp_ajax_nopriv_miraculous_nofication_form', array( $this, 'miraculous_nofication_form' ), 10 );
				
		add_action( 'wp_ajax_miraculous_follow', array( $this, 'miraculous_follow' ), 10 );

		add_action( 'wp_ajax_nopriv_miraculous_follow', array( $this, 'miraculous_follow' ), 10 );		
		
		add_action( 'wp_ajax_miraculous_payment', array( $this, 'miraculous_payment' ), 10 );

		add_action( 'wp_ajax_miraculous_payment', array( $this, 'miraculous_payment' ), 10 );
				
		add_action( 'wp_ajax_miraculous_user_payment_request', array( $this, 'miraculous_user_payment_request' ), 10 );

        add_action( 'wp_ajax_nopriv_miraculous_user_payment_request', array( $this, 'miraculous_user_payment_request' ), 10 );
               		
		add_action( 'wp_ajax_miraculous_pass_orderid_inmodel', array( $this, 'miraculous_pass_orderid_inmodel' ), 10 );

        add_action( 'wp_ajax_nopriv_miraculous_pass_orderid_inmodel', array( $this, 'miraculous_pass_orderid_inmodel' ), 10 );
                
        add_action( 'wp_ajax_miraculous_payout_btn', array( $this, 'miraculous_payout_btn' ), 10 );

        add_action( 'wp_ajax_nopriv_miraculous_payout_btn', array( $this, 'miraculous_payout_btn' ), 10 );
	}
	
	
	public function miraculous_payout_btn(){
	    if(!empty($_POST['data_id']) && !empty($_POST['data_attr'])){
	        $user_id = $_POST['data_id'];
	        $data_attr = $_POST['data_attr'];
            global $wpdb; 
			$tbl_pay = $wpdb->prefix. 'payement_request';
			$wpdb->insert(
			$tbl_pay, 
			array(
			    'payment_receiver_id' => $user_id, 
			    'us_payment_receiver' => 'Pending', 
			    'amount' => $data_attr,
			    'payment_type' => 'All Payment',
			    'extradata' => '', 
                ) 
			);
			if($wpdb->insert_id){
			    $data = array('status' => 'true', 'msg' => 'Your Request Under Process', 'price'=> $data_attr);
			} else {
			    $data = array('status' => 'false', 'msg' => 'Request failed please try again');
			}
	    }
	    echo json_encode($data);
	    die();
	}
	
	public function miraculous_pass_orderid_inmodel(){
		if(!empty($_POST['order_id'])){
			$order_id = $_POST['order_id'];
			$html ='';
			$html .='<div class="modal-dialog" role="document">
					<div class="modal-content">';
						$icon_doolor = get_template_directory_uri().'/assets/images/icon_doolor.png'; 
						$html .='<img src="'.esc_url($icon_doolor).'" class="payment_icon">
					  <div class="modal-header">
						<h5 class="modal-title" id="payment_method">'.esc_html__("Choose your payment method", "miraculous").'</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						  <span aria-hidden="true">X</span>
						</button>'; 
						$user_id = get_current_user_id();
						$paypal_icon = get_template_directory_uri().'/assets/images/paypal_icon.jpg';
						$Stripe_icon = get_template_directory_uri().'/assets/images/Stripe_icon.jpg';
						$Paytrac_icon = get_template_directory_uri().'/assets/images/Paytrac_icon.jpg';
						$miraculous_theme_data = '';
							if (function_exists('fw_get_db_settings_option')):  
								$miraculous_theme_data = fw_get_db_settings_option();     
							endif;
						
						  $theme_paypal_switch = '';
						 if(!empty($miraculous_theme_data['theme_paypal_switch']['Paypal_switch_value'])):
							 $theme_paypal_switch = $miraculous_theme_data['theme_paypal_switch']['Paypal_switch_value'];
						 endif;
						 $currency = '';
							if(!empty($miraculous_theme_data['currency'])):
								$currency = $miraculous_theme_data['currency'];
							endif;
						 $theme_stripe_switch = '';
						if(!empty($miraculous_theme_data['theme_stripe_switch']['stripe_switch_value'])):
							$theme_stripe_switch = $miraculous_theme_data['theme_stripe_switch']['stripe_switch_value'];
						endif;
						
							$stripe_publishable_key = '';
							if(!empty($miraculous_theme_data['theme_stripe_switch']['on']['stripe_publishable_key'])):
								$stripe_publishable_key = $miraculous_theme_data['theme_stripe_switch']['on']['stripe_publishable_key'];
							endif;
							
							$stripe_secret_key = '';
							if(!empty($miraculous_theme_data['theme_stripe_switch']['on']['stripe_secret_key'])):
								$stripe_secret_key = $miraculous_theme_data['theme_stripe_switch']['on']['stripe_secret_key'];
							endif;
							
							$stripe_email = '';
							if(!empty($miraculous_theme_data['theme_stripe_switch']['on']['stripe_email'])):
								$stripe_email = $miraculous_theme_data['theme_stripe_switch']['on']['stripe_email']; 
							endif;
							
							$stripe_logo_image = '';
							if(!empty($miraculous_theme_data['theme_stripe_switch']['on']['stripe_logo_image']['url'])):
								$stripe_logo_image = $miraculous_theme_data['theme_stripe_switch']['on']['stripe_logo_image']['url'];
							endif;
							
							$stripe_store_name = '';
							if(!empty($miraculous_theme_data['theme_stripe_switch']['on']['stripe_store_name'])):
								$stripe_store_name = $miraculous_theme_data['theme_stripe_switch']['on']['stripe_store_name'];
							endif;
							
							$stripe_store_description = '';
							if(!empty($miraculous_theme_data['theme_stripe_switch']['on']['stripe_store_description'])):
								$stripe_store_description = $miraculous_theme_data['theme_stripe_switch']['on']['stripe_store_description'];
							endif;
							
							$theme_paystack_switch = '';
							if(!empty($miraculous_theme_data['theme_paystack_switch']['paystack_switch_value'])):
								$theme_paystack_switch = $miraculous_theme_data['theme_paystack_switch']['paystack_switch_value'];
							endif;
							
							$stripe_submit_orders_url = plugins_url().'/miraculouscore/strippayment/music_orders.php';
	 
						if ($theme_stripe_switch == 'on') {
						$html .='<div class="ms_plan_btn_modal">';
							if(!empty($user_id)){
								$product_price = get_post_meta($order_id, 'fw_option:plan_price', true)*100;
							   $html .='<!-- Stripe Payment Option -->
								<form action="'.esc_url($stripe_submit_orders_url).'" method="post">
									<script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
									data-label="'.esc_attr__('Buy Music','miraculous').'"
									data-key="'. esc_attr($stripe_publishable_key).'"
									data-name="'. esc_attr($stripe_store_name).'"
									data-description="'. esc_attr($stripe_store_description).'"
									data-image="'. esc_attr($stripe_logo_image).'" 
									data-amount="'. esc_attr($product_price).'"
									data-currency='. esc_attr($currency).'
									data-email="'. esc_attr($stripe_email).'"
									data-locale="auto"></script>
									<?php /* you can pass parameters to php file in hidden fields, for example - plugin ID */ ?>
									<input type="hidden" name="item_id" value="'. esc_attr($order_id).'">
									<input type="hidden" name="data-post" id="data-post" value="">
								</form>';
							} 
						$html .='</div>';
						} 
						//paypal option
						$theme_paypal_switch = '';
						if(!empty($miraculous_theme_data['theme_paypal_switch']['Paypal_switch_value'])):
							$theme_paypal_switch = $miraculous_theme_data['theme_paypal_switch']['Paypal_switch_value'];
						endif;
						$current_user = wp_get_current_user();
						$submit_url = plugins_url().'/miraculouscore/paypal/music_orders.php';
						//Paypal Switch
						if ($theme_paypal_switch == 'on') {
						$html .='<div class="ms_plan_btn_modal">
							<form class="paypal" action="'. esc_url($submit_url).'" method="post">
								<input type="hidden" name="cmd" value="_xclick" />
								<input type="hidden" name="lc" value="UK" />
								<input type="hidden" name="first_name" value="'. esc_attr($current_user->user_nicename) .'" />
								<input type="hidden" name="last_name" value="'. esc_attr($current_user->display_name) .'" />
								<input type="hidden" name="payer_email" value="'. esc_attr($current_user->user_email) .'" />
								<input type="hidden" name="user_id" value="'. esc_attr($current_user->ID) .'" />
								<input type="hidden" name="item_number" value="'. esc_attr($order_id) .'" / >
								<input type="hidden" name="item_name" value="'. get_the_title($order_id) .'" / >
								<button type="submit" name="submit" class="ms_btn stripe-button-el" value="'. esc_attr__('Paypal', 'miraculous') .'">
										<img src="'. esc_url($paypal_icon) .'" alt="'. esc_attr__('Buy Now', 'miraculous') .'">
									</button>
							</form>
						</div>';
						}
						
						if ($theme_paystack_switch == 'on') {
							 $current_user = wp_get_current_user();
						$html .='<div class="ms_plan_btn_modal">';
							if(!empty($user_id)){ 
								
								$html .='<form action="'. plugins_url("miraculouscore/paystack/single_payment_initialize.php").'" method="post">
									<input type="hidden" name="payer_email" value="'. esc_attr($current_user->user_email).'" />
									<input type="hidden" name="plan_id" value="'. esc_attr($order_id).'" / >
									<input type="hidden" name="data-post" id="data-post" value="">
										<button type="submit" name="Paystack_submit" class="ms_btn ms-paystrack" value="'. esc_attr__("aystack", "miraculous").'">
										<img src="'. esc_url($Paytrac_icon).'" alt="'. esc_attr__('Buy Now', 'miraculous').'">
									</button>
								</form>';
							} 
						$html .='</div>';
						}
						$theme_razorpay_switch = '';
            		    if(!empty($miraculous_theme_data['theme_razorpay_switch']['razorpay_switch_value'])):
            			    $theme_razorpay_switch = $miraculous_theme_data['theme_razorpay_switch']['razorpay_switch_value'];
            			endif;
            			
            			$razorpay_key = '';
                        if(!empty($miraculous_theme_data['theme_razorpay_switch']['on']['razorpay_key'])):
                            $razorpay_key = $miraculous_theme_data['theme_razorpay_switch']['on']['razorpay_key'];
                        endif;
                        $razorpay_icon = get_template_directory_uri().'/assets/images/razorpay_icon.jpg';
                        if($theme_razorpay_switch == 'on'){
                            $html .='<div class="ms_plan_btn_modal">';
                                if(!empty($current_user) && $current_user->ID ){
                                    $post_type = get_post_type( $order_id );
                                    if($post_type =='ms-albums'){
                                        $product_price = get_post_meta($order_id, 'fw_option:album_full_prices', true)*100;
                                    } else {
                                        $product_price = get_post_meta($order_id, 'fw_option:single_music_prices', true)*100;
                                    }
                                    $razorpay_submit_url = plugins_url().'/miraculouscore/razorpay/single-ms-music-payment.php';
                                    $html .='<form action="" method="post" id="form_data_razorpay_single_song">
                                        <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
                                        <input type="hidden" name="payer_id" value="'. esc_attr($current_user->ID) .'" />
                                        <input type="hidden" name="payer_email" value="'. esc_attr($current_user->user_email).'" />
                                        <input type="hidden" name="plan_id" id="plan_id" value="'. $order_id.'" / >
                                        <input type="hidden" name="plan_price" id="plan_price" value="'. $product_price.'" / >
                                        <input type="hidden" name="razorpay" id="razorpay" value="'. $razorpay_key .'" / >
                                        <input type="hidden" name="razorpay_url" id="razorpay_url" value="'. $razorpay_submit_url .'" / >
                                        <input type="hidden" name="currency" id="currency" value="'. $currency.'" / >
                                        <button type="submit" name="Paystack_submit" class="ms_btn ms-razorpay" value="">
    						                <img src="'. esc_url($razorpay_icon).'">
    					                </button>
                                    </form>';
                                }
                            $html .='</div>';
                            
                        }
					  $html .='</div>
					</div>
				  </div>

				<style>
					button.stripe-button-el {
					background-image: url(<?php echo esc_url($Stripe_icon); ?>);
					width: 100%;
					max-width: 100%;
					height: 60px;
					margin: auto;
					display: flex;
					justify-content: center;
					align-items: center;
					padding-bottom: 10px;
					border-radius: 10px;
					background-repeat: no-repeat;
					background-size: 82%;
					background-position: center;
					background-color: white;
					margin: 15px auto;
				}
				.stripe-button-el:not(:disabled):active, .stripe-button-el.active {
					background-color: #005d9300!important;
					box-shadow: 0px 0 0 !important;
					background-image: url(<?php echo esc_url($Stripe_icon); ?>);
				}
					button.stripe-button-el span {
						display: none!important;
					}
					.close span {
					font-size: 14px!important;
				}
				div#bynow_single {
					top: 20%;
				}
					
				</style>';
				echo $html;
				die();
		}
	}
	
    public function miraculous_create_new_user_playlist(){

		$message = array();

		$userid = get_current_user_id();

		if (isset($_POST['playlistname']) && $userid) {

		    $p_name = str_replace(' ', '-', $_POST['playlistname']);

		    $key_prefix = "miraculous_playlist_".$userid."_".$p_name;
 
		    if( get_user_meta($userid, $key_prefix, true) ){

		        $message['status'] = esc_html__('error','miraculous');

		        $message['msg'] = esc_html__('Playlist alreay created with this name.','miraculous');

		    }else{

		        add_user_meta($userid, $key_prefix, '');

		        $message['status'] = esc_html__('success','miraculous');

		        $message['msg'] = esc_html__('Playlist created successfully.','miraculous');

		    }

		    echo json_encode($message);

		    die();

		}



		$message['status'] = esc_html__('error','miraculous');

		$message['msg'] = esc_html__('You need to login.','miraculous');

		echo json_encode($message);

		die();

	}
	public function miraculous_user_payment_request(){
        if(isset($_POST['userid'])){ 
            $userid = $_POST['userid'];
        }
        $complete = "complete";
        global $wpdb;

        $pmt_tbl = $wpdb->prefix . 'payement_request'; 

			$wpdb->update(

				$pmt_tbl, 

				array( 

					'us_payment_receiver' => $complete

					), 

				array( 'payment_receiver_id' => $userid ), 

				array(

					'%s'

				), 

				array( '%s' ) 

			);
			$data = array('status' => 'true', 'msg' => 'Data Uploaded Successfully.');

		echo json_encode($data);

		die();
    }
	public function miraculous_payment(){
	    $message = array();
	    if( isset($_POST['order_id'])) {
	        $order_id = $_POST['order_id'];
            $current_user = wp_get_current_user();
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
                
            $stripe_secret_key = '';
            if(!empty($miraculous_theme_data['theme_stripe_switch']['on']['stripe_secret_key'])):
                $stripe_secret_key = $miraculous_theme_data['theme_stripe_switch']['on']['stripe_secret_key'];
            endif;
                
            $stripe_logo_image = '';
            if(!empty($miraculous_theme_data['theme_stripe_switch']['on']['stripe_logo_image']['url'])):
                $stripe_logo_image = $miraculous_theme_data['theme_stripe_switch']['on']['stripe_logo_image']['url'];
            endif;
                
            $stripe_store_name = '';
            if(!empty($miraculous_theme_data['theme_stripe_switch']['on']['stripe_store_name'])):
                $stripe_store_name = $miraculous_theme_data['theme_stripe_switch']['on']['stripe_store_name'];
            endif;
                
            $stripe_store_description = '';
            if(!empty($miraculous_theme_data['theme_stripe_switch']['on']['stripe_store_description'])):
                $stripe_store_description = $miraculous_theme_data['theme_stripe_switch']['on']['stripe_store_description'];
            endif;
                
            $theme_paystack_switch = '';
            if(!empty($miraculous_theme_data['theme_paystack_switch']['paystack_switch_value'])):
                $theme_paystack_switch = $miraculous_theme_data['theme_paystack_switch']['paystack_switch_value'];
            endif;
            $Stripe_icon = get_template_directory_uri().'/assets/images/Stripe_icon.jpg';
            $Paytrac_icon = get_template_directory_uri().'/assets/images/Paytrac_icon.jpg';
            $razorpay_icon = get_template_directory_uri().'/assets/images/razorpay_icon.jpg';
            $paypal_icon = get_template_directory_uri().'/assets/images/paypal_icon.jpg';
            
			$theme_stripe_switch = '';
		    if(!empty($miraculous_theme_data['theme_stripe_switch']['stripe_switch_value'])):
			    $theme_stripe_switch = $miraculous_theme_data['theme_stripe_switch']['stripe_switch_value'];
			endif;
			//paypal option
			$theme_paypal_switch = '';
		    if(!empty($miraculous_theme_data['theme_paypal_switch']['Paypal_switch_value'])):
			    $theme_paypal_switch = $miraculous_theme_data['theme_paypal_switch']['Paypal_switch_value'];
			endif;
			$submit_url = plugins_url().'/miraculouscore/paypal/payments.php';
			
			// Stripe Payment
			if ($theme_stripe_switch == 'on') { ?>
				<div class="ms_plan_btn_modal">
                    <?php 
                    if(!empty($current_user) && $current_user->ID ){
                        $product_price = get_post_meta(get_the_id(), 'fw_option:plan_price', true)*100;
                        $stripe_submit_url = plugins_url().'/miraculouscore/strippayment/charge.php';
                        ?>
                    <form action="<?php echo esc_url($stripe_submit_url); ?>" method="post" id="form_data_strip">
                        <script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                        data-key="<?php echo esc_attr($stripe_publishable_key); ?>"
                        data-name="<?php echo esc_attr($stripe_store_name); ?>"
                        data-description="<?php echo esc_attr($stripe_store_description); ?>"
                        data-image="<?php echo esc_attr($stripe_logo_image); ?>" 
                        data-currency=<?php echo esc_attr($currency); ?>
                        data-email="<?php echo esc_attr($current_user->user_email); ?>"
                        data-locale="auto"></script>
                        <?php /* you can pass parameters to php file in hidden fields, for example - plugin ID */ ?>
                        <input type="hidden" name="item_id" id="item_id" value="<?php echo $order_id; ?>">
                    </form>
                        <?php } ?>
                    </div>
			<?php } 
			
			
			//Paypal Switch
			if ($theme_paypal_switch == 'on') { ?>
			<div class="ms_plan_btn_modal">
				<form class="paypal" action="<?php echo esc_url($submit_url); ?>" method="post">
					<input type="hidden" name="cmd" value="_xclick" />
					<input type="hidden" name="lc" value="UK" />
					<input type="hidden" name="first_name" value="<?php echo esc_attr($current_user->user_nicename); ?>" />
					<input type="hidden" name="last_name" value="<?php echo esc_attr($current_user->display_name); ?>" />
					<input type="hidden" name="payer_email" value="<?php echo esc_attr($current_user->user_email); ?>" />
					<input type="hidden" name="user_id" value="<?php echo esc_attr($current_user->ID); ?>" />
					<input type="hidden" name="item_number" value="<?php echo $order_id; ?>" / >
					<input type="hidden" name="item_name" value="<?php echo get_the_title($order_id); ?>" / >
					<button type="submit" name="submit" class="ms_btn stripe-button-el" value="<?php esc_attr_e('Paypal', 'miraculous'); ?>">
						    <img src="<?php echo esc_url($paypal_icon); ?>" alt="<?php esc_attr_e('Buy Now', 'miraculous'); ?>">
					    </button>
				</form>
			</div>	
			<?php 
			}
			
			// Paystack Payment
			if ($theme_paystack_switch == 'on') { ?>
			    <div class="ms_plan_btn_modal">
                    <?php if( !empty($current_user) && $current_user->ID ){ ?>
					<form action="<?php echo plugins_url('miraculouscore/paystack/initialize.php'); ?>" method="POST" id="form_data_paysrack">
					    <input type="hidden" name="payer_email" value="<?php echo esc_attr($current_user->user_email); ?>" />
						<input type="hidden" class="ms-plan" id="monthly" name="monthly" type="radio" value="monthly">
						<input type="hidden" name="plan_id" id="plan_id" value="<?php echo $order_id; ?>" / >
						<button type="submit" name="Paystack_submit" class="ms_btn ms-paystrack" value="<?php esc_attr_e('Paystack', 'miraculous'); ?>">
						    <img src="<?php echo esc_url($Paytrac_icon); ?>" alt="<?php esc_attr_e('Buy Now', 'miraculous'); ?>">
					    </button>
                    </form> 
                        <?php } ?>
                    </div>
				<?php 
			}
			
			$theme_razorpay_switch = '';
		    if(!empty($miraculous_theme_data['theme_razorpay_switch']['razorpay_switch_value'])):
			    $theme_razorpay_switch = $miraculous_theme_data['theme_razorpay_switch']['razorpay_switch_value'];
			endif;
			
			$razorpay_key = '';
            if(!empty($miraculous_theme_data['theme_razorpay_switch']['on']['razorpay_key'])):
                $razorpay_key = $miraculous_theme_data['theme_razorpay_switch']['on']['razorpay_key'];
            endif;
            
            if ($theme_razorpay_switch == 'on') { 
			    ?>
			    <div class="ms_plan_btn_modal">
               <?php if(!empty($current_user) && $current_user->ID ){
                    $product_price = get_post_meta($order_id, 'fw_option:plan_monthly_price', true)*100;
                    $razorpay_submit_url = plugins_url().'/miraculouscore/razorpay/payment-process.php';
                    ?>
                        <form action="" method="post" id="form_data_razorpay">
                            <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
                            <input type="hidden" name="payer_id" value="<?php echo esc_attr($current_user->ID); ?>" />
                            <input type="hidden" name="payer_email" value="<?php echo esc_attr($current_user->user_email); ?>" />
                            <input type="hidden" name="plan_id" id="plan_id" value="<?php echo $order_id; ?>" / >
                            <input type="hidden" name="plan_price" id="plan_price" value="<?php echo $product_price; ?>" / >
                            <input type="hidden" name="razorpay" id="razorpay" value="<?php echo $razorpay_key; ?>" / >
                            <input type="hidden" name="razorpay_url" id="razorpay_url" value="<?php echo $razorpay_submit_url; ?>" / >
                            <input type="hidden" name="currency" id="currency" value="<?php echo $currency; ?>" / >
                            <button type="submit" name="Paystack_submit" class="ms_btn ms-razorpay" value="<?php esc_attr_e('razorpay', 'miraculous'); ?>">
                                
						        <img src="<?php echo esc_url($razorpay_icon); ?>" alt="<?php esc_attr_e('Buy Now', 'miraculous'); ?>">
					    </button>
                        </form>
                    <?php 
               }
               ?>
               </div>
               <?php
            }	
	    }

		die();
	}
	
	public function miraculous_nofication_form(){
	    
	    if( isset($_POST['notify'])) {
	        $notfiy = $_POST['notify'];
                $user_id = get_current_user_id();
                $notify_up = get_user_meta($user_id, 'notification', true);
                if (!empty($notify_up)) {
                    $off = delete_user_meta($user_id, 'notification');
                    if($off !=''){
                        $message['status'] = esc_html__('success','miraculous');
		                $message['msg'] = esc_html__('Notification Disabled','miraculous');
		                $message['action'] = esc_html__('removed','miraculous');
                    
                    }else{
                        $message['status'] = esc_html__('error','miraculous');
		                $message['msg'] = esc_html__('Notification Off Something went wrong.','miraculous');
                    }
                } else {
                    $on = add_user_meta( $user_id, 'notification', $notfiy);
                    if($on){
                        $message['status'] = esc_html__('success','miraculous');
		                $message['msg'] = esc_html__('Notification Enabled','miraculous');
		                $message['action'] = esc_html__('added','miraculous');
                    }else{
                        $message['status'] = esc_html__('error','miraculous');
		                $message['msg'] = esc_html__('Notification On Something went wrong.','miraculous');
                    }
                }
	    	echo json_encode($message);
	    	die();
	    }  
	     $data = array('status' => 'false', 'msg' => 'Something went wrong. Please try again.');
	    
	echo json_encode($data);
	die();
	}
	
	public function miraculous_follow(){
	    if( isset($_POST['follow'])) {
	        $follow = $_POST['follow'];
    	        $userdata = get_userdata($follow);
                $display_name = $userdata->data->display_name;
                $user_id = get_current_user_id();
				$arrey = array();
				$arrey[] = $_POST['follow'];
                $follow_cont = get_user_meta($user_id, 'follow_id', true);
				if($follow_cont){
					if(in_array($follow, $follow_cont)){
						$key = array_search($follow, $follow_cont);
						unset($follow_cont[$key]);
						$new_arr = array_values($follow_cont);
						$oip = update_user_meta( $user_id, 'follow_id', $new_arr);
						if($oip){
							$message['status'] = esc_html__('success','miraculous');
							$message['msg'] = esc_html__('You Have Unfollowed ','miraculous').$display_name;
							$message['action'] = esc_html__('removed','miraculous');
						}
					}else{
						$new_arr = array_merge($follow_cont, $arrey);
						$op = update_user_meta($user_id, 'follow_id', $new_arr);
						if($op){
							$message['status'] = esc_html__('success','miraculous');
							$message['msg'] = esc_html__('You Have Followed ','miraculous').$display_name;
							$message['action'] = esc_html__('added','miraculous');
						}
					}
				} else{
					$ol = update_user_meta( $user_id, 'follow_id', $arrey);
					if($ol){
                        $message['status'] = esc_html__('success','miraculous');
		                $message['msg'] = esc_html__('You Have Followed ','miraculous').$display_name;
						$message['action'] = esc_html__('added','miraculous');
                    }
				}
				
				$follower_cont = get_user_meta($follow, 'follower', true);
				if($follower_cont){
					if(in_array($user_id, $follower_cont)){
						$key = array_search($user_id, $follower_cont);
						unset($follower_cont[$key]);
						$new_arr = array_values($follower_cont);
						$oip = update_user_meta( $follow, 'follower', $new_arr);
						if($oip){
							$message['status'] = esc_html__('success','miraculous');
							$message['msg'] = esc_html__('You Have Unfollowed ','miraculous').$display_name;
							$message['action'] = esc_html__('removed','miraculous');
						}
					}else{
					    $user[] = $user_id;
						$new_arr = array_merge($follower_cont, $user);
						$op = update_user_meta($follow, 'follower', $new_arr);
						if($op){
							$message['status'] = esc_html__('success','miraculous');
							$message['msg'] = esc_html__('You Have Followed ','miraculous').$display_name;
							$message['action'] = esc_html__('added','miraculous');
						}
					}
				} else{
				    $user[] = $user_id;
					$ol = update_user_meta( $follow, 'follower', $user);
					if($ol){
                        $message['status'] = esc_html__('success','miraculous');
		                $message['msg'] = esc_html__('You Have Followed ','miraculous').$display_name;
						$message['action'] = esc_html__('added','miraculous');
                    }
				}
				echo json_encode($message);
	    	die();
	        }  
	     $data = array('status' => 'false', 'msg' => 'Add ');
	    
	echo json_encode($data);
	die();
	}
	
	public function miraculous_remove_user_playlist(){
	    $message = array();

		$userid = get_current_user_id();

		if (isset($_POST['playlist']) && $userid) {

	    	$playlist_key = 'miraculous_playlist_'.$userid.'_'.$_POST['playlist']; 
            
            $del = delete_user_meta($userid, $playlist_key);
            if($del){
                $message['status'] = esc_html__('success','miraculous');
		        $message['msg'] = esc_html__('Removed Successfully','miraculous');
            }else{
                $message['status'] = esc_html__('error','miraculous');
		        $message['msg'] = esc_html__('Something went wrong.','miraculous');
            }
	    	echo json_encode($message);
	    	die();

		}

		$message['status'] = esc_html__('error','miraculous');
		$message['msg'] = esc_html__('Something went wrong.','miraculous');

		echo json_encode($message);

		die();
	}

public function miraculous_user_login_form(){
        
		if( isset($_POST['username']) && isset($_POST['password']) ) {

           extract($_POST);
           
           if($rem_check) {
                $rem = true;
            }else{
                $rem = false;
            }

            if( is_user_logged_in() ) {

				$data = array('status' => 'false', 'msg' => 'You are already logged in!');

			}else{

				$creds = array();

				$creds['user_login'] = $username;

				$creds['user_password'] = $password;

				$creds['remember'] = $rem;

				$user = wp_signon( $creds, true );
                if( is_user_logged_in() ) {

				$data = array('status' => 'false', 'msg' => 'You are already logged in!');

			}else{

				$creds = array();

				$creds['user_login'] = $username;

				$creds['user_password'] = $password;

				$creds['remember'] = $rem;

				$user = wp_signon( $creds, true );

				if ( is_wp_error($user) ) {

					$error = esc_html__('Incorrect login details.', 'miraculous');

					$data = array('status' => 'false', 'msg' => $error);
 
				}else{
                    if (function_exists('fw_get_db_settings_option')):  
                      $miraculous_loginbar_data = fw_get_db_settings_option();     
                    endif; 
                    
					$url = esc_url( get_page_link( $miraculous_loginbar_data['dashboard_redirect'] ) ); 

					$data = array('status' => 'true', 'msg' => 'Login Successfully', 'redirect_uri' => $url);

				}

			}

			}

            echo json_encode($data);

			die();
   
		}

		$data = array('status' => 'false', 'msg' => 'Something went wrong. Please try again.');

		echo json_encode($data);

		die();

}
/**
 * user_register_form
 */
public function miraculous_user_register_form() {
	
		$error = array();

		if( isset($_POST['username']) && isset($_POST['full_name']) && isset($_POST['useremail']) && isset($_POST['password']) && isset($_POST['confirmpass']) && isset($_POST['roleusers']) ) {
  
			extract($_POST);
            
            if( ! validate_username($username) ) {
		    	$error['erroruser'] = "* Username is not valid. Use only lowercase letter!";
		    }

		    if( username_exists($username) ) {
		    	$error['erroruser'] = "* Username is already exist!";
		    }

		    if( email_exists($useremail) ) {
		    	$error['erroremail'] = "* Email is already exist!"; 
		    }

		    if( empty($error) ) {
				$userdata = array(
					'user_login' => $username,
                    'user_pass' => $password,
                    'first_name' => $full_name,
					'user_email' => $useremail,
					'role' => $roleusers
				   );  
				   
                $user_id = wp_insert_user( $userdata );
		    	//On success
                if (!is_wp_error( $user_id )) {

					$data = array('status' => 'true', 'msg' => 'You are successfully registered. Please login');
                    $gender = $_POST['user_gender'];
					update_usermeta( $user_id, "user_gender", $gender);
					$age = $_POST['uagerGroup'];
					if(!empty($age)){
						update_usermeta( $user_id, "user_ageGroup", $age);
					}else{
						update_usermeta( $user_id, "user_ageGroup", 25);
					}
					echo json_encode($data);
 
		    	}else{

			        $data = array('status' => 'false', 'msg' => 'Something went wrong. Please try again.');
			        echo json_encode($data);
		    	}

		    }else{

				$error['status'] = 'false';
				echo json_encode($error);

		    }
			die();
		} 
die();
	}

	public function miraculous_user_update_form() {

		$error = array();

		if( isset($_POST['username']) && isset($_POST['useremail']) && isset($_POST['userid']) ) {

	    	extract($_POST);
	    	$current_user = wp_get_current_user();

		    if( $current_user->user_email != trim($useremail) ) {

		        if( email_exists($useremail) ) {

		            $error['status'] = 'false';

		            $error['msg'] = "Email is already exist!";

		        }

		    }

		    $full_name = explode(' ', $username);

		    $first_name = $full_name[0];

			unset($full_name[0]);
			
		    $last_name = implode(' ', $full_name);

            if( empty($error) ) {

               if( isset($password) && isset($confpassword) && $password != '' && $confpassword != '' ) {

		            $userdata = array(

		              'ID' => $userid,

		              'user_pass' => $password,

		              'first_name' => $first_name,

		              'last_name' => $last_name,

		              'user_email' => $useremail,

					  'display_name' => $username,
		            );

		        }else{

		            $userdata = array(

		              'ID' => $userid,

		              'first_name' => $first_name,

		              'last_name' => $last_name,

		              'user_email' => $useremail,

					  'display_name' => $username,
		            );

		        }

                $user_id = wp_update_user( $userdata );
			   //On success
			    
                if (!is_wp_error($user_id)) {

				  if(!empty($profile_img)){
				    update_user_meta($user_id, 'user_profile_img', $profile_img);
				  }
				  $page_url = home_url('/profile');
				  $data = array('status' => 'true', 
								'msg' => 'Profile Successfully update',
								'page_url' => $page_url
							   );
                  echo json_encode($data);
                }else{
				  $data = array('status' => 'false', 
				                'msg' => 'Something went wrong. Please try again.');
                  echo json_encode($data);
                }

		    }else{
             echo json_encode($error);
            }

           die();

		}

	}

	public function miraculous_user_newsletter_form() {
        
        $message = array();
        if(isset($_POST['ns_email'])){
            
            $fname = $_POST['ns_name'];
            $email = $_POST['ns_email'];
            
            if(!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL) === false){

				// MailChimp API credentials

				$apiKey = '';

				$listID = '';

	        	if( function_exists('fw_get_db_settings_option') ) {

		        	$apiKey = fw_get_db_settings_option( 'mailchimp_api_key' );

		        	$listID = fw_get_db_settings_option( 'mailchimp_list_id' );

	        	}

	         	// MailChimp API URL

				$memberID = md5(strtolower($email));

				$dataCenter = substr($apiKey,strpos($apiKey,'-')+1);

				$url = 'https://' . $dataCenter . '.api.mailchimp.com/3.0/lists/' . $listID . '/members/' . $memberID;

	           // member information

				$json = json_encode([

					'email_address' => $email,

					'status'        => 'subscribed',

					'merge_fields'  => [

						'FNAME'     => $fname

					]

				]);

	           // send a HTTP POST request with curl

				$ch = curl_init($url);

				curl_setopt($ch, CURLOPT_USERPWD, 'user:' . $apiKey);

				curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);

				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

				curl_setopt($ch, CURLOPT_TIMEOUT, 10);

				curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');

				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

				curl_setopt($ch, CURLOPT_POSTFIELDS, $json);

				$result = curl_exec($ch);

				$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

				curl_close($ch);

	           // store the status message based on response code

	        	if ($httpCode == 200) {

	            	$message['msg'] = esc_html__('You have successfully subscribed.','miraculous');

	            	$message['status'] = esc_html__('success','miraculous');

	        	} else {

	            	switch ($httpCode) {

	                  	case 214:

	                    	$msg = esc_html__('You are already subscribed.','miraculous');

	                    	$message['status'] = esc_html__('success','miraculous');

	                    	break;

	                  	default:

	                    	$msg = esc_html__('Some problem occurred, please try again.','miraculous');

	                    	$message['status'] = esc_html__('error','miraculous');

	                    	break;

	            	}

	              $message['msg'] = $msg;

	        	}

	    	}else{

	        	$message['msg'] = esc_html__('Please enter email address.','miraculous');

	        	$message['status'] = esc_html__('error','miraculous');

	    	}
          
          	echo json_encode($message);

	    	die();

		}

        $message['msg'] = esc_html__('Please enter email address.','miraculous');

		$message['status'] = esc_html__('error','miraculous');

		echo json_encode($message);
        
        die();

	}



	public function miraculous_add_in_favourites_songs_list() {

		$message = array();

		$userid = get_current_user_id();

		if (isset($_POST['songid']) && $userid) {

			$songs = array();

			$songs[] = $_POST['songid'];

			$music_id = get_user_meta($userid, 'favourites_songs_lists'.$userid, true);

		    if( $music_id ) {

		    	if( in_array($_POST['songid'], $music_id) ) {
                    $key = array_search($_POST['songid'], $music_id); 
	        		unset($music_id[$key]);
	        		$new_arr = array_values($music_id);
	        		update_user_meta($userid, 'favourites_songs_lists'.$userid, $new_arr);
	        		
			        $message['status'] = esc_html__('success','miraculous');
                    $message['action'] = esc_html__('removed','miraculous');
			        $message['msg'] = esc_html__('Removed successfully','miraculous');

		      	}else{
			        $new_arr = array_merge($music_id, $songs);
			        update_user_meta($userid, 'favourites_songs_lists'.$userid, $new_arr);

			        $message['status'] = esc_html__('success','miraculous');
                    $message['action'] = esc_html__('added','miraculous');
			        $message['msg'] = esc_html__('Added successfully','miraculous');
		      	}

		    }else{

				update_user_meta($userid, 'favourites_songs_lists'.$userid, $songs);
                $message['status'] = esc_html__('success','miraculous');
                $message['msg'] = esc_html__('Added successfully','miraculous');

		    }
        echo json_encode($message);
        die();

		}
        
        $message['status'] = esc_html__('error','miraculous');
        $message['msg'] = esc_html__('You need to login.','miraculous');
        echo json_encode($message);
        die();

	}

   public function miraculous_remove_from_favourites_songs_list(){

		$message = array();

		$userid = get_current_user_id();

		if (isset($_POST['songid']) && $userid) {

	    	$songs = array();
            $songs[] = $_POST['songid'];
            $music_id = get_user_meta($userid, 'favourites_songs_lists'.$userid, true);

          if( $music_id ) {

	      		if( in_array($_POST['songid'], $music_id) ) {

	        		$key = array_search($_POST['songid'], $music_id); 

                    unset($music_id[$key]);

	        		$new_arr = array_values($music_id);

	        		update_user_meta($userid, 'favourites_songs_lists'.$userid, $new_arr);

                    $message['status'] = 'success';
                    $message['msg'] = 'Removed successfully';

	      		}

	    	}

          echo json_encode($message);
          die();

		}

        $message['status'] = esc_html__('error','miraculous');
        $message['msg'] = esc_html__('You need to login.','miraculous');
        echo json_encode($message);
        die();

	}


	public function miraculous_add_in_favourites_albums_list(){

	    $message = array();

	    $userid = get_current_user_id();

	    if (isset($_POST['albumid']) && $userid) {

	        $albums = array();

	        $albums[] = $_POST['albumid'];

	        $album_id = get_user_meta($userid, 'favourites_albums_lists'.$userid, true);

	    	if( $album_id ) {

	        	if( in_array($_POST['albumid'], $album_id) ) {
	        	    $key = array_search($_POST['albumid'], $album_id); 

	        		unset($album_id[$key]);
	        		$new_arr = array_values($album_id);

	        		update_user_meta($userid, 'favourites_albums_lists'.$userid, $new_arr);

	          		$message['status'] = esc_html__('success','miraculous');
	          		$message['action'] = esc_html__('removed','miraculous');
	          		$message['msg'] = esc_html__('Removed successfully','miraculous');

	        	}else{

		          	$new_arr = array_merge($album_id, $albums);

		          	update_user_meta($userid, 'favourites_albums_lists'.$userid, $new_arr);

		          	$message['status'] = esc_html__('success','miraculous');
                    $message['action'] = esc_html__('added','miraculous');
		          	$message['msg'] = esc_html__('Added successfully','miraculous');

	        	}

	      	}else{

		        update_user_meta($userid, 'favourites_albums_lists'.$userid, $albums);

		        $message['status'] =esc_html__('success','miraculous');

		        $message['msg'] = esc_html__('Added successfully','miraculous');

	      	}



		    echo json_encode($message);

		    die();

	    }
        $message['status'] = esc_html__('error','miraculous');

	    $message['msg'] = esc_html__('You need to login.','miraculous');

	    echo json_encode($message);

	    die();

	}

	public function miraculous_add_in_favourites_radios_list(){
	    
		$message = array();

	    $userid = get_current_user_id();

	    if (isset($_POST['radioid']) && $userid) {

	        $radios = array();

	        $radios[] = $_POST['radioid'];

	        $radio_id = get_user_meta($userid, 'favourites_radios_lists'.$userid, true);

            if( $radio_id ) {

	        	if( in_array($_POST['radioid'], $radio_id) ) {

	          		$key = array_search($_POST['radioid'], $radio_id); 

	        		unset($radio_id[$key]);
	        		$new_arr = array_values($radio_id);

	        		update_user_meta($userid, 'favourites_radios_lists'.$userid, $new_arr);
                    $message['status'] = esc_html__('success','miraculous');
	          		$message['action'] = esc_html__('removed','miraculous');
	          		$message['msg'] = esc_html__('Removed successfully','miraculous');

	        	}else{

    	          	$new_arr = array_merge($radio_id, $radios);
                    update_user_meta($userid, 'favourites_radios_lists'.$userid, $new_arr);
                    $message['status'] = esc_html__('success','miraculous');
                    $message['msg'] = esc_html__('Added successfully','miraculous');
                }

            }else{

		    update_user_meta($userid, 'favourites_radios_lists'.$userid, $radios);
            $message['status'] = esc_html__('success','miraculous');
            $message['msg'] = esc_html__('Added successfully','miraculous');

	      	}

		    echo json_encode($message);
            die();

	    }

        $message['status'] = esc_html__('error','miraculous');
  	    $message['msg'] = esc_html__('You need to login.','miraculous');
        echo json_encode($message);
        die();
	}

	public function miraculous_add_in_favourites_artists_list(){

	    $message = array();

	    $userid = get_current_user_id();

	    if (isset($_POST['artistid']) && $userid) {

	        $artists = array();

            $artists[] = $_POST['artistid'];

	        $artist_id = get_user_meta($userid, 'favourites_artists_lists'.$userid, true);

      if( $artist_id ) {

	    if( in_array($_POST['artistid'], $artist_id) ) {

		    $key = array_search($_POST['artistid'], $artist_id); 
            unset($artist_id[$key]);
    		$new_arr = array_values($artist_id);
            update_user_meta($userid, 'favourites_artists_lists'.$userid, $new_arr);
            $message['status'] = esc_html__('success','miraculous');
      		$message['action'] = esc_html__('removed','miraculous');
      		$message['msg'] = esc_html__('Removed successfully','miraculous');

	     }else{

		 $new_arr = array_merge($artist_id, $artists);
         update_user_meta($userid, 'favourites_artists_lists'.$userid, $new_arr);
         $message['status'] = esc_html__('success','miraculous');
         $message['msg'] = esc_html__('Added successfully','miraculous');

	     }
        }else{
            update_user_meta($userid, 'favourites_artists_lists'.$userid, $artists);
            $message['status'] = esc_html__('success','miraculous');
            $message['msg'] = esc_html__('Added successfully','miraculous');
          }
          echo json_encode($message);
          die();
        }
        $message['status'] = esc_html__('error','miraculous');
        $message['msg'] = esc_html__('You need to login.','miraculous');
        echo json_encode($message);
        die();
    }

    public function miraculous_add_music_in_user_playlist(){

	    $message = array();

	    $userid = get_current_user_id();

	    if (isset($_POST['musicid']) && isset($_POST['key']) && $userid) {

	        $songs = array();

	        $key = $_POST['key'];

	        $songs[] = $_POST['musicid'];

	        $music_id = get_user_meta($userid, $key, true);



	        if( $music_id ) {

	          	if( in_array($_POST['musicid'], $music_id) ) {

		            $message['status'] = esc_html__('success','miraculous');

		            $message['msg'] =esc_html__('Already added','miraculous');

	          	}else{

		            $new_arr = array_merge($music_id, $songs);

		            update_user_meta($userid, $key, $new_arr);

		            $message['status'] = esc_html__('success','miraculous');

		            $message['msg'] = esc_html__('Added successfully','miraculous');

	          	}

	          

	        }else{

	          	update_user_meta($userid, $key, $songs);

	          	$message['status'] = esc_html__('success','miraculous');

	          	$message['msg'] = esc_html__('Added successfully','miraculous');

	        }



	        echo json_encode($message);

	        die();

	    }



	    $message['status'] = esc_html__('error','miraculous');

	    $message['msg'] = esc_html__('You need to login.','miraculous');

	    echo json_encode($message);

	    die();

	}



	public function miraculous_filter_music_language() {



	    if( isset($_POST['filter_lang']) ) {



	        if( is_user_logged_in() ){

	            $user_id = get_current_user_id();



	            if( $_POST['filter_lang'] != '' ){

	                $lang_data = explode(',', $_POST['filter_lang']);

	                update_option('language_filter_ids_'.$user_id, $lang_data);

	                echo site_url();

	            }else{

	                update_option('language_filter_ids_'.$user_id, $lang_data);

	                echo site_url();

	            }

	        }else{

	            if( $_POST['filter_lang'] != '' ) {

	                $cookie_name = "lang_filter";

	                $cookie_value = $_POST['filter_lang'];

	                setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day



	                echo site_url();

	            }else{

	                $cookie_name = "lang_filter";

	                $cookie_value = $_POST['filter_lang'];

	                setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day



	                echo site_url();

	            }

	        }



	    }



	    die();

	}


 
	public function miraculous_user_music_upload(){
        $miraculous_theme_data = '';
        if (function_exists('fw_get_db_settings_option')):  
          $miraculous_theme_data = fw_get_db_settings_option();     
        endif; 
        $track_page = '';
        if(!empty($miraculous_theme_data['user_blog_page'])):
         $track_page = get_the_permalink( $miraculous_theme_data['user_blog_page'] );
        endif;
        $data = array('status' => 'false', 'msg' => 'Something went Wrong.');
		if( isset($_POST['mp3_url']) ){
	    $up_track_desc = $_POST['up_track_desc']; 
		    extract($_POST);
		    $artist_arr = array();

		    $user_id = get_current_user_id();

		    $lang_arr = array( $language_id );
		    $genres_arr = array( $up_genres_id );

		    if($language_id){

		        $m_args = array(

		            'post_type' => 'ms-music',

		            'post_title' => $track_name,

		            'post_author' => $user_id,
		            
		            'post_content' => $up_track_desc,

		            'post_status' => 'Publish'

		      );

		    }else{

		      	$m_args = array(

					'post_type' => 'ms-music',

					'post_title' => $track_name,

					'post_author' => $user_id,
                    
		            'post_content' => $up_track_desc,
		            
					'post_status' => 'Publish'

		    	);

		    }

            $music_id =  wp_insert_post($m_args);

	    	if($music_id){

				$artist_arr[] = $_POST['artists_name'];
				
				$new_full_track = array('attachment_id' => $track_mp3_id, 'url' => $mp3_url);
				$ex_full_track = $mp3_url;
				update_post_meta($music_id, 'music_added_by', $user_id);
				
                if(!empty($track_mp3_id)){
				    update_post_meta($music_id, 'fw_option:mp3_full_songs', $new_full_track);
                }
                else{
                    update_post_meta($music_id, 'fw_option:music_extranal_url', $ex_track_mp3);    
                }
				update_post_meta($music_id, 'mp3_full_songs', $full_track);
				
				update_post_meta($music_id, 'fw_option:music_types', $track_types);

				update_post_meta($music_id, 'fw_option:single_music_prices', $track_price);
				
				update_post_meta($music_id, 'fw_option:music_artists', $artist_arr);

				update_post_meta($music_id, 'fw_option:music_release_date', $release_date);

	    		if($music_image){

	        		set_post_thumbnail( $music_id, $attachimage_id );
	        		wp_set_post_terms( $music_id, $lang_arr, 'language' );
	        		wp_set_post_terms( $music_id, $genres_arr, 'genre' );

	      		}

	      		global $wpdb;

	      		$pmt_tbl = $wpdb->prefix . 'ms_payments'; 

	      		$query = $wpdb->get_row( "SELECT * FROM `$pmt_tbl` WHERE user_id = $user_id AND expiretime > '$today'" );

	      		if($query->remains_upload > 0){

		          	$wpdb->update( 

		            	$pmt_tbl, 

			            array( 

			                'remains_upload' => $query->remains_upload-1

			               ), 

		            	array( 'ID' => $query->id ), 

			            array( 

			              '%d'

			            ), 

		            	array( '%d' ) 

		          	);

	      		}

	      		$data = array('status' => 'true', 'msg' => 'Uploaded Successfully.', 'track_page' => $track_page, 'data' => $ex_mp3_url);
	    	}else{

	      		$data = array('status' => 'false', 'msg' => 'Something went Wrong.');

	    	}

	    	echo json_encode($data);

	    	die();

		}

	  	echo json_encode($data);

	  	die();

	}

/*/**
 * Dowenload New Code mira
 */
public function miraculous_music_download(){
    $userid = get_current_user_id(); 
	$miraculous_theme_data = '';
	if (function_exists('fw_get_db_settings_option')){
	  $miraculous_theme_data = fw_get_db_settings_option();     
	}
	$counte = 1;
	$dowenloadsong = get_post_meta($_POST['musicid'],'song_dowenload_counter',true);
	if($dowenloadsong){
	    $counte +=$dowenloadsong;
	}
	$freedowenload = '';
	if(!empty($miraculous_theme_data['directedowenload_switch'])){
	    $freedowenload = $miraculous_theme_data['directedowenload_switch'];
	}
	if($freedowenload == 'on'){
	    $message = array();
		if($userid == 0){
			$message = array('status' => 'false', 'msg' => 'You need to login.', 'plan_page' => '');
			echo json_encode($message);
			die();
		}
		global $wpdb;
		if(isset($_POST['musicid'])):
		    $message = array();
		    global $wpdb;
		    if(isset($_POST['musicid'])):
		        $songs = array();
			    $songs[] = $_POST['musicid'];
			    $mpurl = get_post_meta($_POST['musicid'], 'fw_option:mp3_full_songs', true);
			    if(empty($mpurl)){
			        $miraculous_meta_data = '';
        			if (function_exists('fw_get_db_post_option')): 
        			    $miraculous_meta_data = fw_get_db_post_option($_POST['musicid']);   
        			endif;
        			if(!empty($miraculous_meta_data['music_extranal_url'])):
			            $mpurl = $miraculous_meta_data['music_extranal_url'];
			        endif;
			    } else {
			        $mpurl = $mpurl['url'];
			    }
			    if(!empty($mpurl)){
			        $title = get_the_title( $_POST['musicid'] );
			        $music_id = get_user_meta($userid, 'free_downloaded_songs_by_user_'.$userid, true);
			        if( $music_id ) {
        			    if( in_array($_POST['musicid'], $music_id) ) {
        			            array_search($_POST['musicid'], $music_id); 
        			            $message['msg'] = esc_html__('Already downloaded','miraculous');
        			            $message['status'] = esc_html__('success','miraculous');
                    			$message['mp3_uri'] = $mpurl;
                    			$message['mp3_name'] = $title;
        			    } else {
        			        $new_arry = array_merge($music_id, $songs);
        			        update_user_meta($userid, 'free_downloaded_songs_by_user_'.$userid, $new_arry);
        			        $message['msg'] = esc_html__('Song Downloaded','miraculous');
        			        $message['status'] = esc_html__('success','miraculous');
                    		$message['mp3_uri'] = $mpurl;
                    		$message['mp3_name'] = $title;
        			        update_post_meta($_POST['musicid'],'song_dowenload_counter',$counte);
        			    }
			        } else {
        			    update_user_meta($userid, 'free_downloaded_songs_by_user_'.$userid, $songs);
        			    $message['msg'] = esc_html__('Song Downloaded','miraculous');
        			    $message['status'] = esc_html__('success','miraculous');
                    	$message['mp3_uri'] = $mpurl;
                    	$message['mp3_name'] = $title;
                    	update_post_meta($_POST['musicid'],'song_dowenload_counter',$counte);
        			}
			    }
		    endif; 
        endif;
		echo json_encode($message);
		die();
	} else {
	    $message = array();
		global $wpdb;
		$userid = get_current_user_id();
		$miraculous_theme_data = '';
		if (function_exists('fw_get_db_settings_option')){
			$miraculous_theme_data = fw_get_db_settings_option();     
		} 
		$pricing_plan_page = '';
		if(!empty($miraculous_theme_data['user_pricing_plan_page'])){
			$pricing_plan_page = get_the_permalink( $miraculous_theme_data['user_pricing_plan_page'] );
		}
   
		if($userid == 0){
			$message = array('status' => 'false', 'msg' => 'You need to login.', 'plan_page' => '');
			echo json_encode($message);
			die();
		}
		if( isset($_POST['musicid']) && $userid ){
		    $songs = array();
		    $songs[] = $_POST['musicid'];
			$mpurl = get_post_meta($_POST['musicid'], 'fw_option:mp3_full_songs', true);
			
			if(empty($mpurl)){
				$mpurl = get_post_meta($_POST['musicid'], 'fw_option:music_extranal_url', true);
			} else {
			    $mpurl = $mpurl['url'];
			}
			
			$title = get_the_title( $_POST['musicid'] );
			$music_types = get_post_meta($_POST['musicid'], 'fw_option:music_types', true);
			if($music_types == 'free'){
	            if(!empty($mpurl)){
			        $title = get_the_title( $_POST['musicid'] );
			        $music_id = get_user_meta($userid, 'free_downloaded_songs_by_user_'.$userid, true);
			        if( $music_id ) {
        			    if( in_array($_POST['musicid'], $music_id) ) {
        			        $key = array_search($_POST['musicid'], $music_id); 
        			        $message['msg'] = esc_html__('Already downloaded','miraculous');
        			        $message['status'] = esc_html__('success','miraculous');
                            $message['mp3_uri'] = $mpurl;
                    		$message['mp3_name'] = $title;
        			    } else {
        			        $new_arry = array_merge($music_id, $songs);
        			        update_user_meta($userid, 'free_downloaded_songs_by_user_'.$userid, $new_arry);
            			    $message['msg'] = esc_html__('Song Downloaded','miraculous');
            			    $message['status'] = esc_html__('success','miraculous');
                        	$message['mp3_uri'] = $mpurl;
                        	$message['mp3_name'] = $title;
    			            update_post_meta($_POST['musicid'],'song_dowenload_counter',$counte);
        			    }
			        } else {
        			    update_user_meta($userid, 'free_downloaded_songs_by_user_'.$userid, $songs);
        			    $message['msg'] = esc_html__('Song Downloaded','miraculous');
        			    $message['status'] = esc_html__('success','miraculous');
                        $message['mp3_uri'] = $mpurl;
                    	$message['mp3_name'] = $title;
			            update_post_meta($_POST['musicid'],'song_dowenload_counter',$counte);
        			}
			    }
			    echo json_encode($message);
		        die();
			} else{
			    $albumid = $_POST['albumid'];
			    $pmt_tbl = $wpdb->prefix . 'ms_payments'; 
				$query = $wpdb->get_row( "SELECT * FROM `$pmt_tbl` WHERE user_id = $userid AND expiretime > '$today' AND remains_download > 0" );
				if(!empty($query)){
				    $key = 'premium_downloaded_songs_by_user_'.$userid;
					$music_id = get_user_meta($userid, $key, true);
					if( $music_id ) {
					    if( in_array($_POST['musicid'], $music_id) ) {
					        $message['msg'] = esc_html__('Already downloaded','miraculous');
        			        $message['status'] = esc_html__('success','miraculous');
                    		$message['mp3_uri'] = $mpurl;
                    		$message['mp3_name'] = $title;
					    } else {
					        $new_arry = array_merge($music_id, $songs);
        			        update_user_meta($userid, 'premium_downloaded_songs_by_user_'.$userid, $new_arry);
					        $message['msg'] = esc_html__('Song Downloaded','miraculous');
        			        $message['status'] = esc_html__('success','miraculous');
                            $message['mp3_uri'] = $mpurl;
                    	    $message['mp3_name'] = $title;
			                update_post_meta($_POST['musicid'],'song_dowenload_counter',$counte);
			                $wpdb->update( $pmt_tbl,
								array( 'remains_download' => $query->remains_download-1	), 
								array( 'ID' => $query->id ),
								array( '%d' ), 
								array( '%d' ) 
							);
					    }
					} else {
					    update_user_meta($userid, 'premium_downloaded_songs_by_user_'.$userid, $songs);
        			    $message['msg'] = esc_html__('Song Downloaded','miraculous');
        			    $message['status'] = esc_html__('success','miraculous');
                        $message['mp3_uri'] = $mpurl;
                    	$message['mp3_name'] = $title;
			            update_post_meta($_POST['musicid'],'song_dowenload_counter',$counte);
			            $wpdb->update( $pmt_tbl,
							array( 'remains_download' => $query->remains_download-1	), 
							array( 'ID' => $query->id ),
							array( '%d' ), 
							array( '%d' ) 
						);
			        }
			        echo json_encode($message);
		            die();
				} 
				elseif($albumid != 'null'){
				    $song_id = $_POST['musicid'];
				    $pmt_tbl = $wpdb->prefix . 'ms_orders'; 
				    $query = $wpdb->get_row( "SELECT * FROM `$pmt_tbl` WHERE user_id = $userid AND itemid = $albumid" );
				    $key = 'premium_downloaded_album_by_user_'.$userid;
					$music_id = get_user_meta($userid, $key, true);
				    if(!empty($query)){
				        if( $music_id ) {
					        if( in_array($_POST['musicid'], $music_id) ) {
    					        $message['msg'] = esc_html__('Already Downloaded','miraculous');
            			        $message['status'] = esc_html__('success','miraculous');
                        		$message['mp3_uri'] = $mpurl;
                        		$message['mp3_name'] = $title;
    					    } else {
    					        $new_arry = array_merge($music_id, $songs);
        			            update_user_meta($userid, 'premium_downloaded_album_by_user_'.$userid, $new_arry);
    					        $message['msg'] = esc_html__('Song Downloaded','miraculous');
            			        $message['status'] = esc_html__('success','miraculous');
                                $message['mp3_uri'] = $mpurl;
                        	    $message['mp3_name'] = $title;
    			                update_post_meta($_POST['musicid'],'song_dowenload_counter',$counte);
    					    } 
    					} else {
    					    update_user_meta($userid, 'premium_downloaded_songs_by_user_'.$userid, $songs);
            			    $message['msg'] = esc_html__('Song Downloaded','miraculous');
            			    $message['status'] = esc_html__('success','miraculous');
                            $message['mp3_uri'] = $mpurl;
                        	$message['mp3_name'] = $title;
    			            update_post_meta($_POST['musicid'],'song_dowenload_counter',$counte);
    			        }
    			        echo json_encode($message);
		                die();
				    }
				}
				else {
				    $song_id = $_POST['musicid'];
				    $pmt_tbl = $wpdb->prefix . 'ms_orders'; 
				    $query = $wpdb->get_row( "SELECT * FROM `$pmt_tbl` WHERE user_id = $userid AND itemid = $song_id" );
				    $key = 'premium_downloaded_songs_by_user_'.$userid;
					$music_id = get_user_meta($userid, $key, true);
				    if(!empty($query)){
				        if( $music_id ) {
					        if( in_array($_POST['musicid'], $music_id) ) {
    					        $message['msg'] = esc_html__('Already Downloaded','miraculous');
            			        $message['status'] = esc_html__('success','miraculous');
                        		$message['mp3_uri'] = $mpurl;
                        		$message['mp3_name'] = $title;
    					    } else {
    					        $new_arry = array_merge($music_id, $songs);
        			            update_user_meta($userid, 'premium_downloaded_album_by_user_'.$userid, $new_arry);
    					        $message['msg'] = esc_html__('Song Downloaded','miraculous');
            			        $message['status'] = esc_html__('success','miraculous');
                                $message['mp3_uri'] = $mpurl;
                        	    $message['mp3_name'] = $title;
    			                update_post_meta($_POST['musicid'],'song_dowenload_counter',$counte);
    					    } 
    					} else {
    					    update_user_meta($userid, 'premium_downloaded_songs_by_user_'.$userid, $songs);
            			    $message['msg'] = esc_html__('Song Downloaded','miraculous');
            			    $message['status'] = esc_html__('success','miraculous');
                            $message['mp3_uri'] = $mpurl;
                        	$message['mp3_name'] = $title;
    			            update_post_meta($_POST['musicid'],'song_dowenload_counter',$counte);
    			        }
    			        echo json_encode($message);
		                die();
				    }
				}
			    $message = array('status' => 'false', 'msg' => 'You need to login or need to purchase plan.', 'plan_page' => $pricing_plan_page);
            	echo json_encode($message);
            	die();
			}
		}
	}
	$message = array('status' => 'false', 'msg' => 'You need to login or need to purchase plan.', 'plan_page' => $pricing_plan_page);
    echo json_encode($message);
    die();
}

public function miraculous_remove_from_premium_songs_list(){

		$message = array();

		$userid = get_current_user_id();

		if (isset($_POST['songid']) && $userid) {

	    	$songs = array();

	    	$songs[] = $_POST['songid'];

	    	$music_id = get_user_meta($userid, 'premium_downloaded_songs_by_user_'.$userid, true);

	    	if( $music_id ) {

	      		if( in_array($_POST['songid'], $music_id) ) {

	        		$key = array_search($_POST['songid'], $music_id); 

                    unset($music_id[$key]);

	        		$new_arr = array_values($music_id);

	        		update_user_meta($userid, 'premium_downloaded_songs_by_user_'.$userid, $new_arr);

                    $message['status'] = esc_html__('success','miraculous');

	        		$message['msg'] = esc_html__('Removed successfully','miraculous');

	      		}

	    	}

           echo json_encode($message);
           die();

		}

        $message['status'] = esc_html__('error','miraculous');

		$message['msg'] = esc_html__('You need to login.','miraculous');

		echo json_encode($message);

		die();

	}

	public function miraculous_remove_from_free_songs_list(){

		$message = array();
        $userid = get_current_user_id();
        if (isset($_POST['songid']) && $userid) {

	    	$songs = array();
            $songs[] = $_POST['songid'];
            $music_id = get_user_meta($userid, 'free_downloaded_songs_by_user_'.$userid, true);

            if( $music_id ) {

	      		if( in_array($_POST['songid'], $music_id) ) {

	        		$key = array_search($_POST['songid'], $music_id); 

                    unset($music_id[$key]);

	        		$new_arr = array_values($music_id);

	        		update_user_meta($userid, 'free_downloaded_songs_by_user_'.$userid, $new_arr);



	        		$message['status'] = esc_html__('success','miraculous');

	        		$message['msg'] = esc_html__('Removed successfully','miraculous');

	      		}

	    	}

          echo json_encode($message);
          die();

		}

        $message['status'] = 'error';
        $message['msg'] = 'You need to login.';
        echo json_encode($message);
        die();

	}

	public function miraculous_remove_from_user_playlist_songs_list(){

		$message = array();

		$userid = get_current_user_id();

		if (isset($_POST['songid']) && isset($_POST['playlist']) && $userid) {

	    	$songs = array();
            $songs[] = $_POST['songid'];
	    	$playlist_key = 'miraculous_playlist_'.$userid.'_'.$_POST['playlist']; 

	    	$music_id = get_user_meta($userid, $playlist_key, true);



	    	if( $music_id ) {

	      		if( in_array($_POST['songid'], $music_id) ) {

	        		$key = array_search($_POST['songid'], $music_id); 



	        		unset($music_id[$key]);

	        		$new_arr = array_values($music_id);

	        		update_user_meta($userid, $playlist_key, $new_arr);



	        		$message['status'] = 'success';

	        		$message['msg'] = 'Removed successfully';

	      		}

	    	}



	    	echo json_encode($message);

	    	die();

		}



		$message['status'] = esc_html__('error','miraculous');

		$message['msg'] = esc_html__('You need to login','miraculous');

		echo json_encode($message);

		die();

	}

	public function miraculous_add_to_queue_action(){

		$return_arr = array('status' => 'false', 'msg' => 'Not have music');
		
		
		if( isset($_POST['musicid']) && isset($_POST['musictype']) ){
		    
			$attach_meta = array();
			$queue_arr = array();
			
			
            $album = esc_html__('album','miraculous');
			if($_POST['musictype'] == $album){
				$ms_album_post_meta_option = '';
				$artists_name = array();
				if( function_exists('fw_get_db_post_option') ):
					$ms_album_post_meta_option = fw_get_db_post_option($_POST['musicid']);
			    endif;
		        if($ms_album_post_meta_option['album_artists']):
		    		foreach ($ms_album_post_meta_option['album_artists'] as $artists_id):
		    			$artists_name[] = get_the_title($artists_id);
		    		endforeach; 
		    	endif;
			    if(!empty($ms_album_post_meta_option['album_songs'])){

			    	foreach ($ms_album_post_meta_option['album_songs'] as $music_id) {
			    		$mpurl = get_post_meta($music_id, 'fw_option:mp3_full_songs', true);
			    		$title = get_the_title( $music_id );
			    		if(function_exists( 'fw_get_db_post_option' )):	
			    		    
                        $miraclous_post_data = fw_get_db_post_option($music_id); 
                        endif;
        				if(!empty($mpurl['url'])):
        					$mp3url = $mpurl['url'];
        				else:
        				$mp3url = '';
        				if(!empty($miraclous_post_data['music_extranal_url'])):
        				  $mp3url = $miraclous_post_data['music_extranal_url'];
        				endif;
        				endif;
			    		$image_uri = get_the_post_thumbnail_url ( $music_id );
			    		$artists = implode(', ', $artists_name);
                        $share_uri = get_the_permalink($music_id);
			    		$queue_arr[] = array('status' => 'success', 'image' => $image_uri, 'song_name' => $title, 'artists' => $artists, 'mp3url' => $mp3url, 'mid' => $music_id, 'share_uri' => $share_uri); 

			    	}
			    }
			    if(!empty($queue_arr)){
			    	echo json_encode($queue_arr);
			    	die();
			    }else{
			    	echo json_encode($return_arr);
			    	die();
			    }
			}
			
			$radio = esc_html__('radio','miraculous');
			if($_POST['musictype'] == $radio){
				$ms_album_post_meta_option = '';
				$artists_name = array();
				if( function_exists('fw_get_db_post_option') ):
					$ms_album_post_meta_option = fw_get_db_post_option($_POST['musicid']);
			    endif;
		        if($ms_album_post_meta_option['radio_artists']):
		    		foreach ($ms_album_post_meta_option['radio_artists'] as $artists_id):
		    			$artists_name[] = get_the_title($artists_id);
		    		endforeach; 
		    	endif;
			    if(!empty($ms_album_post_meta_option['radio_songs'])){

			    	foreach ($ms_album_post_meta_option['radio_songs'] as $music_id) {
			    		$mpurl = get_post_meta($music_id, 'fw_option:mp3_full_songs', true);
			    		$title = get_the_title( $music_id );
			    		if(function_exists( 'fw_get_db_post_option' )):
			    		    
                        $miraclous_post_data = fw_get_db_post_option($music_id); 
                        endif;
        				if(!empty($mpurl['url'])):
        					$mp3url = $mpurl['url'];
        				else:
        				   $mp3url = '';
        				   if(!empty($miraclous_post_data['music_extranal_url'])):
        				      $mp3url = $miraclous_post_data['music_extranal_url'];
        				   endif;
        				endif;
			    		$image_uri = get_the_post_thumbnail_url ( $music_id );
			    		$artists = implode(', ', $artists_name);

			    		$share_uri = get_the_permalink($music_id);
			    		$queue_arr[] = array('status' => 'success', 'image' => $image_uri, 'song_name' => $title, 'artists' => $artists, 'mp3url' => $mp3url, 'mid' => $music_id, 'share_uri' => $share_uri);

			    	}
			    }
			    if(!empty($queue_arr)){
			    	echo json_encode($queue_arr);
			    	die();
			    }else{
			    	echo json_encode($return_arr);
			    	die();
			    }
			}
            $artist = esc_html__('artist','miraculous');
			if($_POST['musictype'] == $artist){
				$ms_artist_post_meta_option = '';
				if( function_exists('fw_get_db_post_option') ):
				   $ms_artist_post_meta_option = fw_get_db_post_option();
				endif;
				$m_args = array('post_type' => 'ms-music', 
				                'numberposts' => -1);
				$artists = $_POST['musicid'];
				$music_posts = get_posts($m_args);
				$art = false;
				$i = 1;
				if(!empty($music_posts)){
					foreach ($music_posts as $music_post) {
						$artists_ids = get_post_meta($music_post->ID, 'fw_option:music_artists', true);
						if( $artists_ids && in_array($artists, $artists_ids) ){
							$mpurl = get_post_meta($music_post->ID, 'fw_option:mp3_full_songs', true);
						if(function_exists( 'fw_get_db_post_option' )):	
                            $miraclous_post_data = fw_get_db_post_option($music_post->ID); 
                        endif;
        				if(!empty($mpurl['url'])):
        					$mp3url = $mpurl['url'];
        				else:
        				   $mp3url = '';
        				   if(!empty($miraclous_post_data['music_extranal_url'])):
        				      $mp3url = $miraclous_post_data['music_extranal_url'];
        				   endif;
        				endif;
							$image_uri = get_the_post_thumbnail_url ( $music_post->ID );
							$title = get_the_title($music_post->ID);
							$artists_name = array();
							foreach ($artists_ids as $artists_id) {
							    $artists_name[] = get_the_title($artists_id);
							}
							$artists_n = implode(', ', $artists_name);
							$share_uri = get_the_permalink($music_post->ID);

							$queue_arr[] = array('status' => 'success', 'image' => $image_uri, 'song_name' => $title, 'artists' => $artists_n, 'mp3url' => $mp3url, 'mid' => $music_post->ID, 'share_uri' => $share_uri); 
						}
					}
					if(!empty($queue_arr)){
						echo json_encode($queue_arr);
						die();
					}else{
						echo json_encode($return_arr);
						die();
					}
				}
			}
            $music = esc_html__('music','miraculous');
			if($_POST['musictype'] == $music){
				$mpurl = get_post_meta($_POST['musicid'], 'fw_option:mp3_full_songs', true);
			    if(function_exists( 'fw_get_db_post_option' )):	
                    $miraclous_post_data = fw_get_db_post_option($_POST['musicid']); 
                endif;
				if(!empty($mpurl['url'])):
					$mp3url = $mpurl['url'];
				else:
				   $mp3url = '';
				   if(!empty($miraclous_post_data['music_extranal_url'])):
				      $mp3url = $miraclous_post_data['music_extranal_url'];
				   endif;
				endif;
				$artists_ids = get_post_meta($_POST['musicid'], 'fw_option:music_artists', true);
				$artists_name = array();
				if($artists_ids){
					foreach ($artists_ids as $artists_id) {
					    $artists_name[] = get_the_title($artists_id);
					}
				}
				$image_uri = get_the_post_thumbnail_url ( $_POST['musicid'] );
				$title = get_the_title($_POST['musicid']);
				$artists_n = implode(', ', $artists_name);
				$share_uri = get_the_permalink($_POST['musicid']);
				
				$queue_arr[] = array('status' => 'success', 'image' => $image_uri, 'song_name' => $title, 'artists' => $artists_n, 'mp3url' => $mp3url, 'mid' => $_POST['musicid'], 'share_uri' => $share_uri); 

				if(!empty($queue_arr)){
					echo json_encode($queue_arr);
					die();
				}else{
					echo json_encode($return_arr);
					die();
				}
			}

		}
		echo json_encode($return_arr);
		die();
		
		
	}

    /**
	 * All Music Plays
	 */

    function miraculous_play_all_music_action(){
		$return_arr[] = array('status' => 'false', 'msg' => 'Something went wrong.');
		$userid = get_current_user_id();
		if( isset($_POST['musicid']) && isset($_POST['musictype']) ){
			$attach_meta = array();
			$queue_arr = array();
			$album = esc_html__('album','miraculous');
			if($_POST['musictype'] == $album){
				$ms_album_post_meta_option = '';
				$artists_name = array();
				if( function_exists('fw_get_db_post_option') ):
					$ms_album_post_meta_option = fw_get_db_post_option($_POST['musicid']);
				endif;
				if($ms_album_post_meta_option['album_artists']):
					foreach ($ms_album_post_meta_option['album_artists'] as $artists_id):
						$artists_name[] = get_the_title($artists_id);
					endforeach; 
				endif;
				if(!empty($ms_album_post_meta_option['album_songs'])){
					$m = 1;
					foreach ($ms_album_post_meta_option['album_songs'] as $music_id) {
						$mpurl = get_post_meta($music_id, 'fw_option:mp3_full_songs', true);
						//$mpextranal_url = get_post_meta($music_id, 'fw_option:music_extranal_url', true);
						$title = get_the_title( $music_id );
						if(function_exists( 'fw_get_db_post_option' )):	
							$miraclous_post_data = fw_get_db_post_option($_POST['musicid']); 
						    $id = get_current_user_id();
    						if(!empty($miraclous_post_data['music_type_options']['premium']['music_sample_url'])){
    							$meta = $miraclous_post_data['music_type_options']['premium']['music_sample_url'];
    						} else{
							    $meta = $miraclous_post_data['music_type_options']['premium']['mp3_sample_songs']['url'];
						    }
					    endif;
					    
					global $wpdb;
					$pmt_tbl = $wpdb->prefix . 'ms_payments';
					$query = $wpdb->get_row( "SELECT * FROM `$pmt_tbl` WHERE user_id = $id AND expiretime > '$today'" );
					
					$music_type = get_post_meta($music_id, 'fw_option:music_type', true);
					if($music_type == "free"){
						if(!empty($mpurl['url'])){
								$mp3url = $mpurl['url'];
						}
						else{
							   $mp3url = get_post_meta($music_id, 'fw_option:music_extranal_url', true);
						}
					}
					else{
						if($userid == null && !empty($meta)){
						$mp3url = $meta;
						}
						else{
							if(!empty($mpurl['url'])){
								$mp3url = $mpurl['url'];
							}
							else{
								$mp3url = get_post_meta($music_id, 'fw_option:music_extranal_url', true);
							}
						}
					}
						$image_uri = get_the_post_thumbnail_url ( $music_id );
						$artists = implode(', ', $artists_name);

						$share_uri = get_the_permalink($music_id);
						$queue_arr[] = array('status' => 'success', 'image' => $image_uri, 'song_name' => $title, 'artists' => $artists, 'mp3url' => $mp3url, 'mid' => $music_id, 'share_uri' => $share_uri); 
						$songs = array();
						$songs[] = $music_id;

						if($userid && $m == 1){
							$hsmusic_id = get_user_meta($userid, 'history_songs_list_user_'.$userid, true);
							if( $hsmusic_id ) {

								if( in_array($music_id, $hsmusic_id) ) {

								}else{
									$new_arr = array_merge($hsmusic_id, $songs);
									update_user_meta($userid, 'history_songs_list_user_'.$userid, $new_arr);
								}

							}else{
								update_user_meta($userid, 'history_songs_list_user_'.$userid, $songs);
							}

						}
						$m++;
					}
				}
				if(!empty($queue_arr)){
					echo json_encode($queue_arr);
					die();
				}else{
					echo json_encode($return_arr);
					die();
				}
			}
			$radio = esc_html__('radio','miraculous');
			if($_POST['musictype'] == $radio){
				$ms_album_post_meta_option = '';
				$artists_name = array();
				if( function_exists('fw_get_db_post_option') ):
					$ms_album_post_meta_option = fw_get_db_post_option($_POST['musicid']);
				endif;
				if($ms_album_post_meta_option['radio_artists']):
					foreach ($ms_album_post_meta_option['radio_artists'] as $artists_id):
						$artists_name[] = get_the_title($artists_id);
					endforeach; 
				endif;
				if(!empty($ms_album_post_meta_option['radio_songs'])){
					$m = 1;
					foreach ($ms_album_post_meta_option['radio_songs'] as $music_id) {
						$mpurl = get_post_meta($music_id, 'fw_option:mp3_full_songs', true);
						$title = get_the_title( $music_id );
						if(function_exists( 'fw_get_db_post_option' )):	
						 $miraclous_post_data = fw_get_db_post_option($_POST['musicid']); 
						  $id = get_current_user_id();
						  if(!empty($miraclous_post_data['music_type_options']['premium']['music_sample_url'])){
								$meta = $miraclous_post_data['music_type_options']['premium']['music_sample_url'];
							}
							else{
								$meta = $miraclous_post_data['music_type_options']['premium']['mp3_sample_songs']['url'];
							}
					endif;
					
					global $wpdb;
					$pmt_tbl = $wpdb->prefix . 'ms_payments';
					$query = $wpdb->get_row( "SELECT * FROM `$pmt_tbl` WHERE user_id = $id AND expiretime > '$today'" );
					
					$music_type = get_post_meta($music_id, 'fw_option:music_type', true);
					if($music_type == "free"):
						if(!empty($mpurl['url'])):
								$mp3url = $mpurl['url'];
						else:
							   $mp3url = '';
							   if(!empty($miraclous_post_data['music_extranal_url'])):
								  $mp3url = $miraclous_post_data['music_extranal_url'];
							   endif;
						 endif;
					else:
						if($userid == null && !empty($meta)):
						$mp3url = $meta;
						else:
							if(!empty($mpurl['url'])):
								$mp3url = $mpurl['url'];
							else:
								$mp3url = '';
								if(!empty($miraclous_post_data['music_extranal_url'])):
									$mp3url = $miraclous_post_data['music_extranal_url'];
								endif;
							endif;
						endif;
					endif;
						$image_uri = get_the_post_thumbnail_url ( $music_id );
						$artists = implode(', ', $artists_name);

						$share_uri = get_the_permalink($music_id);
						$queue_arr[] = array('status' => 'success', 'image' => $image_uri, 'song_name' => $title, 'artists' => $artists, 'mp3url' => $mp3url, 'mid' => $music_id, 'share_uri' => $share_uri, 'data' => $query); 
						$songs = array();
						$songs[] = $music_id;

						if($userid && $m == 1){
							$hsmusic_id = get_user_meta($userid, 'history_songs_list_user_'.$userid, true);
							if( $hsmusic_id ) {

								if( in_array($music_id, $hsmusic_id) ) {

								}else{
									$new_arr = array_merge($hsmusic_id, $songs);
									update_user_meta($userid, 'history_songs_list_user_'.$userid, $new_arr);
								}

							}else{
								update_user_meta($userid, 'history_songs_list_user_'.$userid, $songs);
							}
							
						}
						$m++;
					}
				}
				if(!empty($queue_arr)){
					echo json_encode($queue_arr);
					die();
				}else{
					echo json_encode($return_arr);
					die();
				}
			}
			$artist = esc_html__('artist','miraculous');
			if($_POST['musictype'] == $artist){
				$ms_artist_post_meta_option = '';
				if( function_exists('fw_get_db_post_option') ):
				   $ms_artist_post_meta_option = fw_get_db_post_option();
				endif;
				$m_args = array('post_type' => 'ms-music', 
								'numberposts' => -1);
				$artists = $_POST['musicid'];
				$music_posts = get_posts($m_args);
				$art = false;
				$i = 1;
				if(!empty($music_posts)){ $m = 1;
					foreach ($music_posts as $music_post) {
						$artists_ids = get_post_meta($music_post->ID, 'fw_option:music_artists', true);
						if( $artists_ids && in_array($artists, $artists_ids) ){
							$mpurl = get_post_meta($music_post->ID, 'fw_option:mp3_full_songs', true);
							if(function_exists( 'fw_get_db_post_option' )):	
							   $miraclous_post_data = fw_get_db_post_option($_POST['musicid']); 
							 $id = get_current_user_id();
							if(!empty($miraclous_post_data['music_type_options']['premium']['music_sample_url'])){
								$meta = $miraclous_post_data['music_type_options']['premium']['music_sample_url'];
							}
							else{
								$meta = $miraclous_post_data['music_type_options']['premium']['mp3_sample_songs']['url'];
							}
						endif;
						
						global $wpdb;
						$pmt_tbl = $wpdb->prefix . 'ms_payments';
						$query = $wpdb->get_row( "SELECT * FROM `$pmt_tbl` WHERE user_id = $id AND expiretime > '$today'" );
						
						$music_type = get_post_meta($music_id, 'fw_option:music_type', true);
						if($music_type == "free"):
							if(!empty($mpurl['url'])):
									$mp3url = $mpurl['url'];
							else:
								   $mp3url = '';
								   if(!empty($miraclous_post_data['music_extranal_url'])):
									  $mp3url = $miraclous_post_data['music_extranal_url'];
								   endif;
							 endif;
						else:
							if($userid == null && !empty($meta)):
							$mp3url = $meta;
							else:
								if(!empty($mpurl['url'])):
									$mp3url = $mpurl['url'];
								else:
									$mp3url = '';
									if(!empty($miraclous_post_data['music_extranal_url'])):
										$mp3url = $miraclous_post_data['music_extranal_url'];
									endif;
								endif;
							endif;
						endif;
							$image_uri = get_the_post_thumbnail_url ( $music_post->ID );
							$title = get_the_title($music_post->ID);
							$artists_name = array();
							foreach ($artists_ids as $artists_id) {
								$artists_name[] = get_the_title($artists_id);
							}
							$artists_n = implode(', ', $artists_name);
							$share_uri = get_the_permalink($music_post->ID);

							$queue_arr[] = array('status' => 'success', 'image' => $image_uri, 'song_name' => $title, 'artists' => $artists_n, 'mp3url' => $mp3url, 'mid' => $music_post->ID, 'share_uri' => $share_uri); 
							$songs = array();
							$songs[] = $music_post->ID;

							if($userid && $m == 1){
								$hsmusic_id = get_user_meta($userid, 'history_songs_list_user_'.$userid, true);
								if( $hsmusic_id ) {

									if( in_array($music_post->ID, $hsmusic_id) ) {

									}else{
										$new_arr = array_merge($hsmusic_id, $songs);
										update_user_meta($userid, 'history_songs_list_user_'.$userid, $new_arr);
									}

								}else{
									update_user_meta($userid, 'history_songs_list_user_'.$userid, $songs);
								}
								
							}
						}
						$m++;
					}
					if(!empty($queue_arr)){
						echo json_encode($queue_arr);
						die();
					}else{
						echo json_encode($return_arr);
						die();
					}
				}
			}
			$music = esc_html__('music','miraculous');
			if($_POST['musictype'] == $music){
				$mpurl = get_post_meta($_POST['musicid'], 'fw_option:mp3_full_songs', true);
				if(function_exists( 'fw_get_db_post_option' )):	
					$miraclous_post_data = fw_get_db_post_option($_POST['musicid']); 
					$id = get_current_user_id();
					if(!empty($miraclous_post_data['music_type_options']['premium']['music_sample_url'])){
						$meta = $miraclous_post_data['music_type_options']['premium']['music_sample_url'];
					}
					else{
						$meta = $miraclous_post_data['music_type_options']['premium']['mp3_sample_songs']['url'];
					}
				endif;
				
				global $wpdb;
				$pmt_tbl = $wpdb->prefix . 'ms_payments';
				$query = $wpdb->get_row( "SELECT * FROM `$pmt_tbl` WHERE user_id = $id AND expiretime > '$today'" );
				
				$music_type = get_post_meta($music_id, 'fw_option:music_type', true);
				if($music_type == "free"):
					if(!empty($mpurl['url'])):
							$mp3url = $mpurl['url'];
					else:
						   $mp3url = '';
						   if(!empty($miraclous_post_data['music_extranal_url'])):
							  $mp3url = $miraclous_post_data['music_extranal_url'];
						   endif;
					 endif;
				else:
					if($userid == null && !empty($meta)):
					$mp3url = $meta;
					else:
						if(!empty($mpurl['url'])):
							$mp3url = $mpurl['url'];
						else:
							$mp3url = '';
							if(!empty($miraclous_post_data['music_extranal_url'])):
								$mp3url = $miraclous_post_data['music_extranal_url'];
							endif;
						endif;
					endif;
				endif;
				$artists_ids = get_post_meta($_POST['musicid'], 'fw_option:music_artists', true);
				$artists_name = array();
				if($artists_ids){
					foreach ($artists_ids as $artists_id) {
						$artists_name[] = get_the_title($artists_id);
					}
				}
				$image_uri = get_the_post_thumbnail_url ( $_POST['musicid'] );
				$title = get_the_title($_POST['musicid']);
				$artists_n = implode(', ', $artists_name);
				$share_uri = get_the_permalink($_POST['musicid']);
				$queue_arr[] = array('status' => 'success', 'image' => $image_uri, 'song_name' => $title, 'artists' => $artists_n, 'mp3url' => $mp3url, 'mid' => $_POST['musicid'], 'share_uri' => $share_uri, 'data' => $meta ); 

				$songs = array();
				$songs[] = $_POST['musicid'];

				if($userid){
					$hsmusic_id = get_user_meta($userid, 'history_songs_list_user_'.$userid, true);
					if( $hsmusic_id ) {

						if( in_array($_POST['musicid'], $hsmusic_id) ) {

						}else{
							$new_arr = array_merge($hsmusic_id, $songs);
							update_user_meta($userid, 'history_songs_list_user_'.$userid, $new_arr);
						}

					}else{
						update_user_meta($userid, 'history_songs_list_user_'.$userid, $songs);
					}
				}

				if(!empty($queue_arr)){
					echo json_encode($queue_arr);
					die();
				}else{
					echo json_encode($return_arr);
					die();
				}
			}
			
			$podcast = esc_html__('podcast','miraculous');
			if($_POST['musictype'] == $podcast){
				$ms_album_post_meta_option = '';
				$artists_name = array();
				if( function_exists('fw_get_db_post_option') ):
					$ms_album_post_meta_option = fw_get_db_post_option($_POST['musicid']);
				endif;
				if($ms_album_post_meta_option['podcast_artists']):
					foreach ($ms_album_post_meta_option['podcast_artists'] as $artists_id):
						$artists_name[] = get_the_title($artists_id);
					endforeach; 
				endif;
				if(!empty($ms_album_post_meta_option['podcast_songs'])){
					$m = 1;
					foreach ($ms_album_post_meta_option['podcast_songs'] as $music_id) {
						$mpurl = get_post_meta($music_id, 'fw_option:mp3_full_songs', true);
						$title = get_the_title( $music_id );
						if(function_exists( 'fw_get_db_post_option' )):	
							$miraclous_post_data = fw_get_db_post_option($_POST['musicid']); 
						 $id = get_current_user_id();
						if(!empty($miraclous_post_data['music_type_options']['premium']['music_sample_url'])){
							$meta = $miraclous_post_data['music_type_options']['premium']['music_sample_url'];
						}
						else{
							$meta = $miraclous_post_data['music_type_options']['premium']['mp3_sample_songs']['url'];
						}
					endif;
					
					global $wpdb;
					$pmt_tbl = $wpdb->prefix . 'ms_payments';
					$query = $wpdb->get_row( "SELECT * FROM `$pmt_tbl` WHERE user_id = $id AND expiretime > '$today'" );
					
					$music_type = get_post_meta($music_id, 'fw_option:music_type', true);
					if($music_type == "free"){
						if(!empty($mpurl['url'])){
								$mp3url = $mpurl['url'];
						}
						else{
							   $mp3url = '';
							   if(!empty($miraclous_post_data['music_extranal_url'])):
								  $mp3url = $miraclous_post_data['music_extranal_url'];
							   endif;
						}
					}
					else{
						if($userid == null && !empty($meta)){
						$mp3url = $meta;
						}
						else{
							if(!empty($mpurl['url'])){
								$mp3url = $mpurl['url'];
							}
							else{
								$mp3url = '';
								if(!empty($miraclous_post_data['music_extranal_url'])){
									$mp3url = $miraclous_post_data['music_extranal_url'];
								}
							}
						}
					}
						$image_uri = get_the_post_thumbnail_url ( $music_id );
						$artists = implode(', ', $artists_name);

						$share_uri = get_the_permalink($music_id);
						$queue_arr[] = array('status' => 'success', 'image' => $image_uri, 'song_name' => $title, 'artists' => $artists, 'mp3url' => $mp3url, 'mid' => $music_id, 'share_uri' => $share_uri); 
						$songs = array();
						$songs[] = $music_id;

						if($userid && $m == 1){
							$hsmusic_id = get_user_meta($userid, 'history_songs_list_user_'.$userid, true);
							if( $hsmusic_id ) {

								if( in_array($music_id, $hsmusic_id) ) {

								}else{
									$new_arr = array_merge($hsmusic_id, $songs);
									update_user_meta($userid, 'history_songs_list_user_'.$userid, $new_arr);
								}

							}else{
								update_user_meta($userid, 'history_songs_list_user_'.$userid, $songs);
							}

						}
						$m++;
					}
				}
				if(!empty($queue_arr)){
					echo json_encode($queue_arr);
					die();
				}else{
					echo json_encode($return_arr);
					die();
				}
			}

		}
		echo json_encode($return_arr);
		die();
	}
	
	public function miraculous_play_user_playlist(){
	    $return_arr = array('status' => 'false', 'msg' => 'Playlist is empty.');
		$userid = get_current_user_id();
		/**
		 * Stop free song time set
		 */
		$miraculous_theme_data = '';
		if(function_exists('fw_get_db_settings_option')):  
		$miraculous_theme_data = fw_get_db_settings_option();     
		endif; 

		$free_listen_time = '';
		if(!empty($miraculous_theme_data['free_listen_time'])):
		$free_listen_time = $miraculous_theme_data['free_listen_time'];
		endif;

		/**
		 * Item Payment status check
		 */

		global $wpdb;
		$pmt_tbl = $wpdb->prefix . 'ms_orders'; 
		$item_id = $_POST['musicid'];
		$item_id = $music_types = '';
		if(!empty($_POST['album_id'])):
	  	  $item_id = $_POST['album_id'];
		  $music_types = get_post_meta($_POST['album_id'],'fw_option:album_type',true); 
		else:
		  $item_id = $_POST['musicid'];	
		  $music_types = get_post_meta($_POST['musicid'],'fw_option:music_types',true); 
		endif; 
		if($music_types == 'free'){
		    $query = 'true';
		}else{
			$query = $wpdb->get_row("SELECT * FROM $pmt_tbl WHERE itemid = '$item_id' And user_id in($userid)" );
			if($query){
		 	   $query = 'true';
			}else{
			   $query = 'false';
			}
		}
		$author_id = get_post_field ('post_author', $item_id);
        if($author_id == $userid):
			$query = 'true';
		endif;

		if (isset($_POST['playlist']) && $userid) {
            $queue_arr = array();
            $ms_favourite = esc_html__('ms_favourite','miraculous');
            if($_POST['playlist'] == $ms_favourite){
                $playlist_key = 'favourites_songs_lists'.$userid;
            }else{
                $playlist_key = 'miraculous_playlist_'.$userid.'_'.$_POST['playlist']; 
            }
            
            $musicsids = get_user_meta($userid, $playlist_key, true);
            if($musicsids){
                $sg_args = array('post_type' => 'ms-music',
                                'post__in' => $musicsids,
                            );
                $music_posts = new WP_Query( $sg_args );
                if($music_posts->have_posts()): 
                    while ( $music_posts->have_posts() ) : $music_posts->the_post();
                    
					$miraculous_meta_data = '';
					if (function_exists('fw_get_db_post_option')): 
						$miraculous_meta_data = fw_get_db_post_option(get_the_id());   
					endif; 
					if(!empty($miraculous_meta_data['music_extranal_url'])):
					  $mpurl = $miraculous_meta_data['music_extranal_url'];
					else:
					  $mpurl = $miraculous_meta_data['mp3_full_songs']['url'];
					endif;
					
					if($mpurl) {
                        $mp3url = $mpurl;
                    }
                    $artists_ids = get_post_meta(get_the_id(), 'fw_option:music_artists', true);
				    $artists_name = array();
				    if($artists_ids){
					    foreach ($artists_ids as $artists_id) {
					        $artists_name[] = get_the_title($artists_id);
					    }
				    }
                    $image_uri = get_the_post_thumbnail_url ();
                    $title = get_the_title();
				    $artists_n = implode(', ', $artists_name);
				    $share_uri = get_the_permalink();
					$queue_arr[] = array('status' => 'success', 
										'image' => $image_uri,
										'song_name' => $title, 
										'artists' => $artists_n, 
										'mp3url' => $mp3url,
										'mid' => $_POST['musicid'],
										'share_uri' => $share_uri,
										'paymentstatus' => $query,
									    'stop_time' => $free_listen_time
									   ); 
				    
                    endwhile;
                    
                endif;
                
            }
            if(!empty($queue_arr)){
				echo json_encode($queue_arr);
				die();
			}else{
				echo json_encode($return_arr);
				die();
			}
	    	echo json_encode($message);
	    	die();

		}
	    echo json_encode($message);
	    die();
	}

	public function miraculous_user_queue_data_action(){
		$message = array();

		$userid = get_current_user_id();

		if (isset($_POST['musiclist']) && $userid) {

	    	$queue_data = 'miraculous_queue_data_'.$userid; 
            
            $rst = update_user_meta($userid, $queue_data, $_POST['musiclist']);
            if($rst){
                $message['status'] = 'success';
		        $message['msg'] = 'Saved Successfully';
            }else{
                $message['status'] = 'false';
		        $message['msg'] = 'Something went wrong.';
            }
	    	echo json_encode($message);
	    	die();

		}

		$message['status'] = esc_html__('false','miraculous');
		$message['msg'] = esc_html__('Something went wrong.','miraculous');

		echo json_encode($message);

		die();
	}

	public function miraculous_user_load_queue_data_action(){
		$message = array();
		$userid = get_current_user_id();
        /**
		 * Stop free song time set
		 */
		$miraculous_theme_data = '';
		if(function_exists('fw_get_db_settings_option')):  
		$miraculous_theme_data = fw_get_db_settings_option();     
		endif; 

		$free_listen_time = '';
		if(!empty($miraculous_theme_data['free_listen_time'])):
		$free_listen_time = $miraculous_theme_data['free_listen_time'];
		endif;

		/**
		 * Item Payment status check
		 */
		global $wpdb;
		$pmt_tbl = $wpdb->prefix . 'ms_orders'; 
		$item_id = $_POST['musicid'];
		$item_id = $music_types = '';
		if(!empty($_POST['album_id'])):
		$item_id = $_POST['album_id'];
		$music_types = get_post_meta($_POST['album_id'],'fw_option:album_type',true); 
		else:
		$item_id = $_POST['musicid'];	
		$music_types = get_post_meta($_POST['musicid'],'fw_option:music_types',true); 
		endif; 
		if($music_types == 'free'){
	    	 $query = 'true';
		}else{
			$query = $wpdb->get_row("SELECT * FROM $pmt_tbl WHERE itemid = '$item_id' And user_id in($userid)" );
			if($query){
			  $query = 'true';
			}else{
			  $query = 'false';
			}
		}
		$author_id = get_post_field ('post_author', $item_id);
        if($author_id == $userid):
			$query = 'true';
		endif;
		if($userid){
	
			$queue_arr = array('status' => 'false',
							 'msg' => 'You need to login.', 
							 'plan_page' => '');

			echo json_encode($queue_arr);
		}else{

		if (isset($_POST['musiclist'])) {

	    	$queue_data = 'miraculous_queue_data_'.$userid; 
            
            $rst = get_user_meta($userid, $queue_data, true);
            if($rst){
                $message['status'] = 'success';
		        $message['msg'] = 'Added Successfully';
		        $message['queue_data'] = $rst;
		        echo json_encode($message);
    			die();
            }else{
                $sg_args = array('post_type' => 'ms-music',
                                 'orderby'   => 'rand',
                    			 'posts_per_page' => 1, 
                                 );
    		    $queue_arr = array();
                $music_posts = new WP_Query( $sg_args );
                if($music_posts->have_posts()): 
                    while ( $music_posts->have_posts() ) : $music_posts->the_post();
                    $miraculous_meta_data = '';
					if(function_exists('fw_get_db_post_option')): 
						$miraculous_meta_data = fw_get_db_post_option(get_the_ID());   
					endif; 
					if(!empty($miraculous_meta_data['music_extranal_url'])):
					  $mpurl = $miraculous_meta_data['music_extranal_url'];
					else:
					  $mpurl = $miraculous_meta_data['mp3_full_songs']['url'];
					endif;
					
                    if($mpurl) {
                        $mp3url = $mpurl;
                    }
                    $artists_ids = get_post_meta(get_the_id(), 'fw_option:music_artists', true);
    			    $artists_name = array();
    			    if($artists_ids){
    				    foreach ($artists_ids as $artists_id) {
    				        $artists_name[] = get_the_title($artists_id);
    				    }
    			    }
                    $image_uri = get_the_post_thumbnail_url();
                    $title = get_the_title();
                    $musicid = get_the_id();
    			    $artists_n = implode(', ', $artists_name);
    			    $share_uri = get_the_permalink();
					$queue_arr = array('status' => 'default', 
									   'image' => $image_uri, 
									   'song_name' => $title, 
									   'artists' => $artists_n,
									   'mp3url' => $mp3url, 
									   'mid' => $musicid, 
									   'share_uri' => $share_uri,
									   'paymentstatus' => $query,
									   'stop_time' => $free_listen_time
									  ); 
    			    
                    endwhile;
                    
                endif;
			}
                if(!empty($queue_arr)){
    				echo json_encode($queue_arr);
    				die();
				}else{
					$message['status'] = esc_html__('false','miraculous');
					$message['msg'] = esc_html__('Something went wrong.','miraculous');
					echo json_encode($message);
				}
				
            }

		}

		die();
	}

	public function miraculous_play_single_music_action(){
		$return_arr = array('status' => 'false', 'msg' => 'Something went wrong.');
		$userid = get_current_user_id();
		$queue_arr = array();
		if(isset($_POST['musicid']) && $_POST['musicid'] != ''){
		    $music_types = '';
		    $music_types = get_post_meta($_POST['musicid'],'fw_option:music_types',true);
		    if($music_types == 'premium' ){
		        if(empty($userid)){
		            $return_arr = array('status' => 'needtologin',
	                 'msg' => 'You need to login.', 
					 'plan_page' => '');
		        } else {
		            $miraculous_meta_data = '';
        			if (function_exists('fw_get_db_post_option')): 
        				$miraculous_meta_data = fw_get_db_post_option($_POST['musicid']);   
        			endif; 
        			if(!empty($miraculous_meta_data['music_extranal_url'])):
        			  $mpurl = $miraculous_meta_data['music_extranal_url'];
        			else:
        			  $mpurl = $miraculous_meta_data['mp3_full_songs']['url'];
        			endif;
        			
        			if($mpurl) {
        				$mp3url = $mpurl;
        			}
        			$artists_ids = get_post_meta($_POST['musicid'], 'fw_option:music_artists', true);
        			$artists_name = array();
        			if($artists_ids){
        				foreach ($artists_ids as $artists_id) {
        				    $artists_name[] = get_the_title($artists_id);
        				}
        			}
        			$image_uri = get_the_post_thumbnail_url ( $_POST['musicid'] );
        			
        			
        			$title = get_the_title($_POST['musicid']);
        			$artists_n = implode(', ', $artists_name);
        			$share_uri = get_the_permalink($_POST['musicid']);
        			$queue_arr = array('status' => 'success', 'image' => $image_uri, 'song_name' => $title, 'artists' => $artists_n, 'mp3url' => $mp3url, 'mid' => $_POST['musicid'], 'share_uri' => $share_uri); 
        
        			$songs = array();
        			$songs[] = $_POST['musicid'];
        
        			if($userid){
        				$hsmusic_id = get_user_meta($userid, 'history_songs_list_user_'.$userid, true);
        				if( $hsmusic_id ) {
        
        					if( in_array($_POST['musicid'], $hsmusic_id) ) {
        
        				  	}else{
        				        $new_arr = array_merge($hsmusic_id, $songs);
        				        update_user_meta($userid, 'history_songs_list_user_'.$userid, $new_arr);
        				  	}
        
        				}else{
        					update_user_meta($userid, 'history_songs_list_user_'.$userid, $songs);
        				}
        			}
        
        			if(!empty($queue_arr)){
        				echo json_encode($queue_arr);
        				die();
        			}else{
        				echo json_encode($return_arr);
        				die();
        			}
		        }
		    } else {
		        $miraculous_meta_data = '';
			if (function_exists('fw_get_db_post_option')): 
				$miraculous_meta_data = fw_get_db_post_option($_POST['musicid']);   
			endif; 
			if(!empty($miraculous_meta_data['music_extranal_url'])):
			  $mpurl = $miraculous_meta_data['music_extranal_url'];
			else:
			  $mpurl = $miraculous_meta_data['mp3_full_songs']['url'];
			endif;
			
			if($mpurl) {
				$mp3url = $mpurl;
			}
			$artists_ids = get_post_meta($_POST['musicid'], 'fw_option:music_artists', true);
			$artists_name = array();
			if($artists_ids){
				foreach ($artists_ids as $artists_id) {
				    $artists_name[] = get_the_title($artists_id);
				}
			}
			$image_uri = get_the_post_thumbnail_url ( $_POST['musicid'] );
			
			
			$title = get_the_title($_POST['musicid']);
			$artists_n = implode(', ', $artists_name);
			$share_uri = get_the_permalink($_POST['musicid']);
			$queue_arr = array('status' => 'success', 'image' => $image_uri, 'song_name' => $title, 'artists' => $artists_n, 'mp3url' => $mp3url, 'mid' => $_POST['musicid'], 'share_uri' => $share_uri); 

			$songs = array();
			$songs[] = $_POST['musicid'];

			if($userid){
				$hsmusic_id = get_user_meta($userid, 'history_songs_list_user_'.$userid, true);
				if( $hsmusic_id ) {

					if( in_array($_POST['musicid'], $hsmusic_id) ) {

				  	}else{
				        $new_arr = array_merge($hsmusic_id, $songs);
				        update_user_meta($userid, 'history_songs_list_user_'.$userid, $new_arr);
				  	}

				}else{
					update_user_meta($userid, 'history_songs_list_user_'.$userid, $songs);
				}
			}

			if(!empty($queue_arr)){
				echo json_encode($queue_arr);
				die();
			}else{
				echo json_encode($return_arr);
				die();
			}
		    }
			
		}

		echo json_encode($return_arr);
		die();

	}

	public function miraculous_remove_history_music_action(){
		$message = array();

		$userid = get_current_user_id();

		if (isset($_POST['songid']) && $userid) {

	    	$songs = array();

	    	$songs[] = $_POST['songid'];

	    	$music_id = get_user_meta($userid, 'history_songs_list_user_'.$userid, true);

	    	if( $music_id ) {

	      		if( in_array($_POST['songid'], $music_id) ) {

	        		$key = array_search($_POST['songid'], $music_id); 

	        		unset($music_id[$key]);

	        		$new_arr = array_values($music_id);

	        		update_user_meta($userid, 'history_songs_list_user_'.$userid, $new_arr);

	        		$message['status'] = esc_html__('success','miraculous');

	                $message['msg'] = esc_html__('Removed successfully','miraculous');

	      		}

	    	}

	    	echo json_encode($message);
	    	die();

		}

		$message['status'] = esc_html__('error','miraculous');

		$message['msg'] = esc_html__('Something went wrong.','miraculous');

		echo json_encode($message);

		die();
	}


   public function miraculous_freeplane_optionajax(){
    
    $first_name = '';
    if(isset($_POST['first_name'])):
      $first_name = $_POST['first_name'];
    endif;
   $last_name = '';
    if(isset($_POST['last_name'])):
      $last_name = $_POST['last_name'];
    endif;
   $payer_email = '';
    if(isset($_POST['payer_email'])):
      $payer_email = $_POST['payer_email'];
    endif;
   $user_id = '';
    if(isset($_POST['user_id'])):
      $user_id = $_POST['user_id'];
    endif;
   $item_number = '';
    if(isset($_POST['item_number'])):
      $item_number = $_POST['item_number'];
    endif;
    $item_name = '';
    if(isset($_POST['item_name'])):
      $item_name = $_POST['item_name'];
    endif;
    $payment_amount = esc_html__('Free','miraculous');
    $payment_status = esc_html__('Accept','miraculous');
    $txnid = esc_html__('Free','miraculous');
    $itemAmount = get_post_meta($_POST['item_number'], 'fw_option:plan_price', true);
    $plan_validity = get_post_meta($_POST['item_number'], 'fw_option:plan_validity', true);
    $monthly_download = get_post_meta($_POST['item_number'], 'fw_option:plan_monthly_download', true);
    $monthly_upload = get_post_meta($_POST['item_number'], 'fw_option:plan_monthly_uploads', true) ? get_post_meta($_POST['item_number'], 'fw_option:plan_monthly_uploads', true) : 50;
    global $wpdb;
	$tbl_pay = $wpdb->prefix. 'ms_payments';
	$m = $plan_validity;
	$data = array(
               "plan_name" => $item_name,
               "plan_number" => $item_number,
               "user_id" => $user_id,
               "plan_validity" => $plan_validity,
               "monthly_download" => $monthly_download,
               "monthly_upload" => $monthly_upload,
               "payment_status" => 'Accept',
               "payment_amount" => '0.0',
               "payment_currency" => 'USA',
               "txn_id" => 'Free',
               "receiver_email" => $payer_email,
               "receiver_email" => $payer_email
               );
       $wpdb->insert( 
			$tbl_pay, 
			array(
				'user_id' => $user_id, 
				'txnid' => $txnid, 
				'payment_amount' => $payment_amount,
				'payment_status' => $payment_status,
				'itemid' => $item_number,
				'monthly_download' => $monthly_download,
				'monthly_upload' => $monthly_upload,
				'createdtime' => date('Y-m-d H:i:s'),
				'expiretime' => date("Y-m-d H:i:s", strtotime("+$m months")),
				'remains_download' => $monthly_download,
				'remains_upload' => $monthly_upload,
				'extra_data' => json_encode($data),
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
				'%s'
			) 
		);
 	 echo esc_html($wpdb->insert_id);
     wp_die(); 
    }
}

$Miraculous_Ajax = new Miraculous_Ajax_Call();

$Miraculous_Ajax->init();
?>