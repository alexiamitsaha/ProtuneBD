<?php if (!defined('FW')) die('Forbidden');
$upload_heading_one = '';
if(!empty($atts['upload_heading_one'])):
  $upload_heading_one = $atts['upload_heading_one'];
endif;
$preview = get_stylesheet_directory_uri().'/assets/images/artist_default_img.jpg';
$play_icon = get_template_directory_uri().'/assets/images/svg/play.svg';
$more_icon = get_template_directory_uri().'/assets/images/svg/more.svg';
$ar_type = '';
if(!empty($atts['albums_type'])):
  $ar_type = $atts['albums_type'];
else:
 $ar_type = 31;   
endif;
?> 
<div class="ms_fea_album_slider mv_artist_parent">
    <?php if(!empty($upload_heading_one)): ?>
    <div class="ms_heading">
        <h1><?php echo esc_html( $upload_heading_one ); ?></h1>
    </div>
    <?php endif; ?>
    <div class="ms_relative_inner ">
        <div class="ms_slider<?php esc_attr_e($ar_type); ?>  swiper-container swiper-container-horizontal" data-type="<?php esc_attr_e($ar_type); ?>">
          <div class="swiper-wrapper">
            <?php
            $i=0;
            $roles = array('subscriber');
            $user_query = new WP_User_Query(array('role' => $roles ));
            // User Loop 
            if(!empty( $user_query->get_results() ) ) {
            	foreach ( $user_query->get_results() as $user ) {
            	?>	
            	<div class="swiper-slide<?php echo ($i==0) ? ' swiper-slide-active' : '';?>" data-swiper-slide-index="<?php echo _e($i); ?>">
                    <div class="ms_rcnt_box">
                        <div class="ms_rcnt_box_img">
                            <?php 
                            $img_src = get_user_meta($user->ID, 'user_profile_img', true); 
                            if(!empty($img_src)) { ?>
                            <a href="<?php echo esc_url(home_url('/overview/?artistid='.$user->ID)); ?>"><img src="<?php echo esc_url($img_src); ?>" alt="<?php esc_attr_e('preview','miraculous'); ?>" id="img-preview" class="img-fluid"></a>
                            <?php }else{ ?>
                            <a href="<?php echo esc_url(home_url('/overview/?artistid='.$user->ID)); ?>"><img src="<?php echo esc_url($preview); ?>" alt="<?php esc_attr_e('preview','miraculous'); ?>" id="img-preview" class="img-fluid"></a>
                            <?php }
                            ?>	
                        </div>
                        <div class="ms_rcnt_box_text">
                            <?php if($user->display_name): ?>
                              <h3><a href="<?php echo esc_url(home_url('/overview/?artistid='.$user->ID)); ?>">
                              <?php echo $user->display_name; ?></a></h3>
                              <p class="mv_artist_name"><?php esc_html_e('Artist','miraculous'); ?></p>
                            <?php endif;
                            $address = get_user_meta($user->ID, 'user_address', true); 
                            if(!empty($address)):
                            ?><p><?php echo esc_html($address); ?></p>
                            <?php endif; ?> 
                        </div>
                     </div>
                 </div>	
            	<?php	
            	 $i++;
            	 }
               } else {
            	echo esc_html__('No Artists found.','miraculous');
              }
            ?>
         </div>
        <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
        <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
       </div>
      <div class="swiper-button-next<?php esc_attr_e($ar_type); ?> slider_nav_next" tabindex="0" role="button" aria-label="<?php esc_attr_e('Next slide','miraculous'); ?>"></div>
     <div class="swiper-button-prev<?php esc_attr_e($ar_type); ?> slider_nav_prev" tabindex="0" role="button" aria-label="<?php esc_attr_e('Previous slide','miraculous'); ?>"></div>
    </div>
</div>