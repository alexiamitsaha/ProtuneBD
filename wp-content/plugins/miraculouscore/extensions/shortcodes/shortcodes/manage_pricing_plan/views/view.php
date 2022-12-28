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
$currency = '';
if(!empty($miraculous_theme_data['currency'])):
    $currency = $miraculous_theme_data['currency'];
endif;
$id = '';
if(!empty($atts['id'])):
  $id = $atts['id'];
endif;
$icon_doolor = get_template_directory_uri().'/assets/images/icon_doolor.png';

if(!empty($id)){
  $ms_args = array(
    			 'post_type' => 'ms-plans',
                 'post__in'=> $id
                 ); 
}
else{
  $ms_args = array('post_type' => 'ms-plans',
                 'numberposts' => -1,
                 'order' => 'DSC'
                 ); 
}

$music_plans = new WP_Query( $ms_args );
$current_user = wp_get_current_user();
?>
<div class="ms_account_wrapper">
    <div class="container">
        <div class="row justify-content-center">
            <?php if(!empty($heading)): ?>
                <div class="col-lg-12">
                    <div class="ms_heading">
                        <h1><?php echo __($heading); ?></h1>
                    </div>
                </div>
            <?php endif; ?>

            <?php
            if( $music_plans->have_posts() ):
  			$i = 1; 
            while ( $music_plans->have_posts() ) : $music_plans->the_post();
            
            $monthly_uploads = get_post_meta(get_the_id(), 'fw_option:plan_monthly_uploads', true);

            $monthly_price = get_post_meta(get_the_id(), 'fw_option:plan_monthly_price', true);

            $monthly_request_limite = get_post_meta(get_the_id(), 'fw_option:plan_monthly_request_limite', true);

            $plan_validity = get_post_meta(get_the_id(), 'fw_option:plan_validity', true);
            $miraculous_meta_data = '';
			if(function_exists('fw_get_db_post_option')): 
				$miraculous_meta_data = fw_get_db_post_option(get_the_id());   
			endif; 
            $free_plane_switch = '';
        	if(!empty($miraculous_meta_data['free_plane_switch'])):
        	    $free_plane_switch = $miraculous_meta_data['free_plane_switch'];
        	endif;

            global $wpdb;
            $pmt_tbl = $wpdb->prefix .'ms_payments'; 
            $itemid = get_the_ID();
            $query = $wpdb->get_results( "SELECT * FROM {$pmt_tbl} WHERE user_id = {$current_user->ID} AND itemid ={$itemid}" );
            $freecheck = '';
            if(isset($query[0])){
                $freecheck = $query[0]->txnid;
            }
              if($freecheck == 'Free'):
              else:
			  if (in_array($itemid, (array) isset($query[0]))) {
					echo '';
				 }else{
					 ?>
            <div class="col-lg-4">
                <div class="ms_plan_box <?php echo $i==2 ? 'paln_active' : ''; ?>">
                    <div class="ms_plan_header">
                        <div class="ms_plan_img">
                            <?php the_post_thumbnail( 'thumbnail' ); ?>
                        </div>
                    </div>
                    <h3 class="plan_heading"><?php the_title(); ?></h3>
                    <div class="plan_price">
					<div class="plan_dolar">
					<sup>
                    <?php
                    if(function_exists('miraculous_currency_symbol')){
                      echo miraculous_currency_symbol($currency);
                    }
					?>
                    </sup>
                    <span class="monthly_price">
                        <?php  echo esc_attr($monthly_price);
                         ?>
                    </span> 
                    </div> 
					</div>
                    <div class="plancontent">
                        <?php echo the_content(); ?>
                    </div>
                    <div class="ms_plan_btn">
                    <?php
                        if ( is_user_logged_in() ) { 
        					if($free_plane_switch == 'on'){ ?>
                                    <?php if( !empty($current_user) && $current_user->ID ){ ?>
                                        <form class="paypal" action="" method="post">
                                            <input type="hidden" name="cmd" value="_xclick" />
                                            <input type="hidden" name="lc" value="UK" />
                                            <input type="hidden" name="first_name" id="first_name" value="<?php echo esc_attr($current_user->user_firstname); ?>" />
                                            <input type="hidden" name="last_name" id="last_name" value="<?php echo esc_attr($current_user->user_lastname); ?>" />
                                            <input type="hidden" name="payer_email" id="payer_email" value="<?php echo esc_attr($current_user->user_email); ?>" />
                                            <input type="hidden" name="user_id" id="user_id" value="<?php echo esc_attr($current_user->ID); ?>" />
                                            <input type="hidden" name="item_number" id="item_number" value="<?php echo esc_attr(get_the_id()); ?>" / >
                                            <input type="hidden" name="item_name" id="item_name" value="<?php the_title_attribute(); ?>" / >
                                            <input type="submit" name="submit" id="free_plane_switch" class="mira_price ms_btn" value="<?php    esc_attr_e('buy now', 'miraculous'); ?>"/>
                                        </form>
                                    <?php } else{ ?>
            						<a href="javascript:;" class="ms_btn" data-toggle="modal" data-target="#myModal1"><?php esc_html_e('buy now', 'miraculous'); ?></a>
            						<?php } ?>
            					<?php  } else { ?>
            						<a href="javascript:;" class="ms_btn bynow_btn" data-toggle="modal" data-target="#bynow" order_id="<?php echo esc_attr(get_the_id()); ?>"><?php esc_html_e('buy now', 'miraculous'); ?></a>
            					<?php } 
            				} else { ?>
					<a href="javascript:;" class="ms_btn bynow_btn" data-toggle="modal" data-target="#myModal" order_id="<?php echo esc_attr(get_the_id()); ?>"><?php esc_html_e('buy now', 'miraculous'); ?></a>
					 <?php }
					?>
					</div>
				  </div> 
                </div>  
             <?php  }
					endif;
					$i++; endwhile; ?>
            <?php wp_reset_postdata();
            endif; ?>
        </div>
     </div>
</div> 



<!-- Modal -->
<div class="modal fade plan_modal" id="bynow" tabindex="-1" role="dialog" aria-labelledby="payment_method" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <img src="<?php echo esc_url($icon_doolor); ?>" class="payment_icon">
      <div class="modal-header">
        <h5 class="modal-title" id="payment_method"><?php esc_html_e('Choose your payment method', 'miraculous'); ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">X</span>
        </button>
        <div id="payment_div"></div>
      </div>
    </div>
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
    
</style>