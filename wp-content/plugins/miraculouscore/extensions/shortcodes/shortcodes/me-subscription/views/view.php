<?php if (!defined('FW')) die('Forbidden');
$heading = '';
if(!empty($atts['manage_plan_heading'])):
  $heading = $atts['manage_plan_heading'];
endif;
$priceplan = '';
if(!empty($atts['priceplan_switch'])):
  $priceplan = $atts['priceplan_switch'];
endif;
$miraculous_theme_data = '';
if (function_exists('fw_get_db_settings_option')):  
    $miraculous_theme_data = fw_get_db_settings_option();     
endif;
$miraculous_theme_data = '';
if (function_exists('fw_get_db_settings_option')):  
    $miraculous_theme_data = fw_get_db_settings_option();     
endif; 
$pricing_plan = '';
if(!empty($miraculous_theme_data['user_pricing_plan_page'])):
    $pricing_plan = get_the_permalink( $miraculous_theme_data['user_pricing_plan_page'] );
endif;
$currency = '';
if(!empty($miraculous_theme_data['currency'])):
    $currency = $miraculous_theme_data['currency'];
endif;
$submit_url = plugins_url().'/miraculouscore/paypal/payments.php';

$ms_args = array('post_type' => 'ms-plans',
                'numberposts' => -1,
                'order' => 'ASC'
                );
$music_plans = new WP_Query( $ms_args );
$current_user = wp_get_current_user();
?>
<div class="ms_account_wrapper">
    <div class="container">
        <?php 
		if( !empty($current_user) && $current_user->ID ):
          if($priceplan =='on'):
		?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="ms_acc_overview">
                       <?php   
                        global $wpdb;
                        $pmt_tbl = $wpdb->prefix . 'ms_payments'; 
                        $today = date('Y-m-d H:i:s');
                        $query = $wpdb->get_results( "SELECT * FROM `$pmt_tbl` WHERE user_id = $current_user->ID AND expiretime > '$today'" );
                        if($query): 
                        ?>
                        <div class="ms_heading">
                            <h1><?php esc_html_e('Account Overview','miraculous'); ?></h1>
                        </div>
                        <div class="ms_acc_ovrview_list">
                                <?php $i=1; foreach($query as $row): ?>
                                    <ul>
                                        <?php 
                                        $start = date_create($today);
                                        $end = date_create($row->expiretime);
                                        $days_between = date_diff($start, $end); ?>
                                        <li><?php printf( __('Your Subscribed Plan <span>- %s</span>', 'miraculous'), get_the_title($row->itemid) ); ?></li>
                                        <li><?php printf( __('Amount Paid <span>- '. miraculous_currency_symbol($currency) . ' %s</span>', 'miraculous'), $row->payment_amount ); ?></li>
                                        <li><?php printf( __('Validity Expires In <span>- %s Days</span>', 'miraculous'), $days_between->format("%a") ); ?></li>
                                        <li><?php printf( __('Monthly Download <span>- %s Tracks</span>'), $row->monthly_download ); ?></li>
                                        <li><?php printf( __('Monthly Upload  <span>- %s Tracks</span>'), $row->monthly_upload ); ?></li>
                                        <li><?php printf( __('Downloads Remaining <span>- %s Tracks</span>'), $row->remains_download ); ?></li>
                                        <li><?php printf( __('Upload Remaining <span>- %s Tracks</span>'), $row->remains_upload ); ?></li>
                                    </ul>
                                    <?php if($i == 1){ 
                                        $free_plane_switch = '';
                                    	    $free_plane_switch = get_post_meta($row->itemid, 'fw_options', true);
                                    if($free_plane_switch['free_plane_switch'] == 'on'){ ?>
                                    <?php if( !empty($current_user) && $current_user->ID ){ ?>
                                        <form class="paypal" action="" method="post">
                                            <input type="hidden" name="cmd" value="_xclick" />
                                            <input type="hidden" name="lc" value="UK" />
                                            <input type="hidden" name="first_name" id="first_name" value="<?php echo esc_attr($current_user->user_firstname); ?>" />
                                            <input type="hidden" name="last_name" id="last_name" value="<?php echo esc_attr($current_user->user_lastname); ?>" />
                                            <input type="hidden" name="payer_email" id="payer_email" value="<?php echo esc_attr($current_user->user_email); ?>" />
                                            <input type="hidden" name="user_id" id="user_id" value="<?php echo esc_attr($current_user->ID); ?>" />
                                            <input type="hidden" name="item_number" id="item_number" value="<?php echo esc_attr($row->itemid); ?>" / >
                                            <input type="hidden" name="item_name" id="item_name" value="<?php the_title_attribute(); ?>" / >
                                            <input type="submit" name="submit" id="free_plane_switch" class="mira_price ms_btn" value="<?php    esc_attr_e('Renew now', 'miraculous'); ?>"/>
                                        </form>
                                    <?php } else{ ?>
            						<a href="javascript:;" class="ms_btn" data-toggle="modal" data-target="#myModal1"><?php esc_html_e('Renew now', 'miraculous'); ?></a>
            						<?php } ?>
            					<?php  } else { ?>
            						<a href="javascript:;" class="ms_btn bynow_btn" data-toggle="modal" data-target="#bynow" order_id="<?php echo esc_attr($row->itemid); ?>"><?php esc_html_e('Renew now', 'miraculous'); ?></a>
            					<?php }  ?>
                                    <?php } ?>
                                <?php endforeach; ?>
                            </div>
                        <?php else: ?>
                          <div>
                            <?php esc_html_e('You have not subscribed any plan yet.', 'miraculous'); ?>
                          </div>
                         <div class="bw_price_plane_page">
                            <a href="<?php echo esc_url($pricing_plan); ?>" class="ms_btn"><?php echo esc_html('Get Price Plan','miraclous'); ?></a>
                         </div>
                         <?php endif; ?> 
                    </div>
                </div>
            </div>
        <?php 
		 endif;
		endif; 
		?>
      </div>
</div>  