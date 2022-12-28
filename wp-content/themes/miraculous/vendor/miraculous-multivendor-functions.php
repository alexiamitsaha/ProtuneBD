<?php
$miraculous_core = '';
if(class_exists('Miraculouscore')):
/**
 * String limit function
 */ 
function limit($value, $limit = 100, $end = '...'){
    if (mb_strwidth($value, 'UTF-8') <= $limit) {
        return $value;
    }
    return rtrim(mb_strimwidth($value, 0, $limit, '', 'UTF-8')).$end;
}

/**
 * Miraculous in Add Menu  
 */ 
add_action( 'after_setup_theme', 'miraculous_profilemenu_setup' );
function miraculous_profilemenu_setup(){
    
        register_nav_menus( array(
			'profile' => esc_html__( 'Profile', 'miraculous' ),
			'profilehorizontal' => esc_html__( 'Profile Horizontal', 'miraculous' ),
		) );
}

/**
 * Miraculous Audio Delete
 */
add_action( 'wp_ajax_miraculous_audio_deletes', 'miraculous_audio_deletes' );
add_action( 'wp_ajax_nopriv_miraculous_audio_deletes', 'miraculous_audio_deletes' );
function miraculous_audio_deletes(){
    $bsaudio_id = '';
    if(isset($_POST['bsaudio_id'])):
     $bsaudio_id = $_POST['bsaudio_id'];
     $check = wp_delete_post($bsaudio_id);
     if($check):
         echo esc_html__('success','miraculous');
     endif;
    endif; 
wp_die();   
} 

/**
 * Miraculous Products Delete
 */
add_action( 'wp_ajax_miraculous_products_deletes', 'miraculous_products_deletes' );
add_action( 'wp_ajax_nopriv_miraculous_products_deletes', 'miraculous_products_deletes' );
function miraculous_products_deletes(){
    $bsproducts_id = '';
    if(isset($_POST['bsproducts_id'])):
     $bsproducts_id = $_POST['bsproducts_id'];
     $check = wp_delete_post($bsproducts_id);
     if($check):
         echo esc_html__('success','miraculous');
     endif;
    endif; 
wp_die();   
}  
  
/**
 * Miraculous Albums Delete
 */
add_action( 'wp_ajax_miraculous_albums_deletes', 'miraculous_albums_deletes' );
add_action( 'wp_ajax_nopriv_miraculous_albums_deletes', 'miraculous_albums_deletes' );
function miraculous_albums_deletes(){
    $bsalbums_id = '';
    if(isset($_POST['bsalbums_id'])):
     $bsalbums_id = $_POST['bsalbums_id'];
     $check = wp_delete_post($bsalbums_id);
     if($check):
         echo esc_html__('success','miraculous');
     endif;
    endif; 
wp_die();   
}   

/**
 * Artists Find Function 
 */ 
add_action( 'wp_ajax_miraculous_artists_search', 'miraculous_artists_search' );
add_action( 'wp_ajax_nopriv_miraculous_artists_search', 'miraculous_artists_search' );
function miraculous_artists_search(){
    $preview = get_template_directory_uri().'/assets/images/pro_img.png';
    if(!empty($_POST['artistsname'])):
        $artistsname = $_POST['artistsname'];
    endif; 
    
    $args = array (
        'role' => '',
        'order' => 'ASC',
        'orderby' => 'display_name',
        'search' => '*'.esc_attr( $artistsname ).'*',
	       'meta_query' => array(
                'relation' => 'OR',
                array(
                    'key'     => 'first_name',
                    'value'   => $artistsname,
                    'compare' => 'LIKE'
                ),
                array(
                    'key'     => 'last_name',
                    'value'   => $artistsname,
                    'compare' => 'LIKE'
                ),
                array(
                    'key' => 'description',
                    'value' => $artistsname ,
                    'compare' => 'LIKE'
                )
            )
        );
     
    $wp_user_query = new WP_User_Query($args);
    
    $authors = $wp_user_query->get_results();
    // Check for results
    if (!empty($authors)) {
       
    // loop through each author
    foreach ($authors as $author) {
        // get all the user's data
        $author_info = get_userdata($author->ID);
        $img_src = get_user_meta($author->ID, 'user_profile_img', true);
    ?>   
    <div class="mv_user_div bw_artists_data"  data-artistsids="<?php echo esc_attr($author->ID); ?>">
            <div class="mv_avtar_img">
                <?php if(!empty($img_src)): ?>
                <img src="<?php echo esc_url($img_src); ?>" data-artistsids="<?php echo esc_attr($author->ID); ?>" alt="<?php echo esc_attr($author_info->first_name); ?>" class="img-fluid bw_artists_data">
                <?php else: ?> 
                <img src="<?php echo esc_url($preview); ?>" data-artistsids="<?php echo esc_attr($author->ID); ?>"  alt="<?php echo esc_attr($author_info->first_name); ?>" class="img-fluid bw_artists_data">
                <?php endif; ?>
            </div>    
            <div class="mv_user_name">
                <a href="javascript:;" class="bw_artists_data" data-artistsids="<?php echo esc_attr($author->ID); ?>"><?php echo esc_html($author_info->first_name); ?></a>
                <p>Active</p>
                <input type="hidden"  name="current_artistsids" id="current_artistsids" value="<?php echo get_current_user_id(); ?>">
                <input type="hidden"  name="receiver_artistsids" id="receiver_artistsids" value="<?php echo esc_attr($author->ID); ?>">
            </div> 
        </div>
        <?php
        }
       
    } else {
    echo '' ;
    } 
    
 wp_die();   
}


/**
 * Payment Request for admin
 */ 
add_action( 'wp_ajax_miraculous_all_payement_request', 'miraculous_all_payement_request');
add_action( 'wp_ajax_nopriv_miraculous_all_payement_request','miraculous_all_payement_request');  
function miraculous_all_payement_request(){
    $user_id = '';
    if(!empty($_POST['user_id'])):
      $user_id = $_POST['user_id'];
    endif;
    $miraculous_theme_data = '';
    if (function_exists('fw_get_db_settings_option')):	
    	$miraculous_theme_data = fw_get_db_settings_option();     
    endif;
    $commision = '';
    if(!empty($miraculous_theme_data['commission_value'])):
      $commision = $miraculous_theme_data['commission_value'];
    endif;
    $totalamount = 0;
    $ar_args = array('post_type' => 'product',
                 'author' =>  $user_id,
                 'posts_per_page' => -1,
                 );
    global $wpdb;
    $pmt_tbl = $wpdb->prefix . 'payement_request'; 
    $query = $wpdb->get_results( "SELECT * FROM `$pmt_tbl` WHERE payment_receiver_id = $user_id AND us_payment_receiver = 'complete'" );
    $userdata = array();
    foreach ($query as $query_child){
    $user_data = $query_child->extradata;
    $user_datas = explode(" ",$user_data);
    foreach($user_datas as $user_dataschild ){
        $user_orid = $user_dataschild;
        $userdata[] = $user_orid;
    }
    }
    $album_posts = new WP_Query($ar_args);
    if( $album_posts->have_posts() ): 
        $order_id = array();
        while ( $album_posts->have_posts() ) : $album_posts->the_post();
            
            $userproduct_id = get_the_ID();
            global $wpdb;
            $currency = get_woocommerce_currency();
            $table_name =$wpdb->prefix.'woocommerce_order_itemmeta';
            $table_name2 =$wpdb->prefix.'woocommerce_order_items';
            $result = $wpdb->get_results("SELECT * FROM {$table_name} WHERE meta_value='{$userproduct_id}'");
            foreach($result as $getvalues){
               $order_item_id = $getvalues->order_item_id;
               $get_orderid = $wpdb->get_results("SELECT * FROM {$table_name2} WHERE order_item_id = '{$order_item_id}'");
               
               $orderid = $wpdb->get_results("SELECT 'order_id' FROM {$table_name2} WHERE order_item_id = '{$order_item_id}'");
               
                foreach($get_orderid as $get_values){
                $order_total = get_post_meta($get_values->order_id, '_order_total', true);
                
                $order = wc_get_order($get_values->order_id);
                if(in_array($get_values->order_id, $userdata, false)){
                    
                }
                else{
                $date_created  = $order->get_date_created();
                $order_status  = $order->get_status();
                if($order_status == 'completed'):
                    $order_id[] = $get_values->order_id;
                    $commisontotal = $order_total * $commision;
                    $commisontotal = $commisontotal/100;
                    $totalamounts = $order_total-$commisontotal;
                    $totalamount += $totalamounts;
                else:
                    $totalamount = 0;
                endif; 
                }
                }
            }
       endwhile;
       wp_reset_postdata();
    endif;
    if(!empty($totalamount)):
        global $wpdb;
        $order_no = implode(' ', $order_id);
        $table_name =$wpdb->prefix.'payement_request';
        $success = $wpdb->insert($table_name, array(
		 "payment_receiver_id" => $user_id,
         "us_payment_receiver" => 'waiting',
         "amount" => $totalamount,
         "payment_type" => 'allamount',
         "extradata" => $order_no
        )); 
        if($success) {
           echo '<h2>Request Send Successfully </h2>';
        }
    endif;
 wp_die();  
} 

/**
 * Vandore Request
 */
function miraculous_register_vandore_request_menu_page() {

    add_menu_page('Vendor Request', 'Vendor Request', 'manage_options', 'vendore_request', 'miraculous_vendore_list_menu_page', null, 6); 
}
add_action('admin_menu', 'miraculous_register_vandore_request_menu_page');

function miraculous_vendore_list_menu_page(){
?>
<div class="wrap">
	<h1><?php esc_html_e('Vendor Payment Request','miraclous'); ?></h1>
	<table class="wp-list-table widefat fixed striped table-view-list users">
		<thead>
		  <tr>
			<td class="check-column"><?php esc_html_e('Srn.','miraclous'); ?></td>
			<th class="manage-column column-title column-primary desc"><?php esc_html_e('Vendor Name','miraclous'); ?></th>
			<th class="manage-column column-title column-primary desc"><?php esc_html_e('Vendor Email','miraclous'); ?></th>
			<th class="manage-column column-title column-primary desc"><?php esc_html_e('Vendor Bank Details','miraclous'); ?></th>
			<th class="manage-column column-title column-primary desc"><?php esc_html_e('Payment Type','miraclous'); ?></th>
			<th class="manage-column column-title column-primary desc"><?php esc_html_e('Amount','miraclous'); ?></th>
			<th class="manage-column column-title column-primary desc"><?php esc_html_e('Action','miraclous'); ?></th>
			<th class="manage-column column-title column-primary desc"><?php esc_html_e('Status','miraclous'); ?></th>
		  </tr>
		</thead>
	  <?php 
	   global $wpdb;
	   $miraculous_theme_data = '';
        if (function_exists('fw_get_db_settings_option')):	
        	$miraculous_theme_data = fw_get_db_settings_option();     
        endif;
	    $currency = '';
        if(!empty($miraculous_theme_data['currency']) && function_exists('miraculous_currency_symbol')):
        $currency = miraculous_currency_symbol( $miraculous_theme_data['currency'] );
        endif;
	   $table_name = $wpdb->prefix.'payement_request';
	   $result = $wpdb->get_results("SELECT * FROM {$table_name} ORDER BY srn DESC" ); 
	   
	   $i=1; 
	   foreach($result as $get_value):
		$user_id = $get_value->payment_receiver_id; 
		$name = get_the_author_meta('display_name', $user_id);
		$email = get_the_author_meta('user_email', $user_id);
		$bankname = get_user_meta($user_id, 'bankname', true);
		$bank_acc = get_user_meta($user_id, 'bank_acc', true);
		$stutus_pay = $get_value->us_payment_receiver;
	   ?>
	   <tr>
		<td><?php echo esc_html($i); ?></td>
		<td><?php echo esc_html($name); ?></td>
		<td><?php echo esc_html($email); ?></td>
		<td><?php 
		    if(!empty($bankname) || !empty($bank_acc)){
		        echo esc_html($bankname.' ('. $bank_acc .')');
		    }
		 ?></td>
		<td><?php echo esc_html($get_value->payment_type); ?></td>
		<td><?php echo esc_html($currency.' '.$get_value->amount); ?></td>
		<td>
		<?php 
		    if($stutus_pay == 'complete'){
		        echo '<a href="javascript:void(0);" class ="vendor-paid">'. esc_html_e('Paid','miraclous') .'</a>';
		    } else {
		        echo '<a href="javascript:void(0);" class ="paid vendor-paid" data-productid = "'. esc_html($user_id).'">'. esc_html__('Pay Now','miraclous').'</a>';
		    }
		?>
		</td>
		<td class="stutus_pay"><?php echo esc_html($get_value->us_payment_receiver); ?></td>
	  </tr>
	  <?php 
	  $i++;
	  endforeach;
	  ?>
	  <tfoot>
		  <tr>
			<td class="check-column"><?php esc_html_e('Srn.','miraclous'); ?></td>
			<th class="manage-column column-title column-primary desc"><?php esc_html_e('Vendor Name','miraclous'); ?></th>
			<th class="manage-column column-title column-primary desc"><?php esc_html_e('Vendor Email','miraclous'); ?></th>
			<th class="manage-column column-title column-primary desc"><?php esc_html_e('Vendor Bank Details','miraclous'); ?></th>
			<th class="manage-column column-title column-primary desc"><?php esc_html_e('Payment Type','miraclous'); ?></th>
			<th class="manage-column column-title column-primary desc"><?php esc_html_e('Amount','miraclous'); ?></th>
			<th class="manage-column column-title column-primary desc"><?php esc_html_e('Action','miraclous'); ?></th>
			<th class="manage-column column-title column-primary desc"><?php esc_html_e('Status','miraclous'); ?></th>
		  </tr>
		</tfoot>
	</table>
</div>
<?php
}
endif;