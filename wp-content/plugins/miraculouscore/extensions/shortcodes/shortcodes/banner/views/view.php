<?php if (!defined('FW')) die('Forbidden');
$banner_heading = '';
if(!empty($atts['banner_heading'])):
	$banner_heading = $atts['banner_heading'];
endif; 
$banner_sub_heading = '';
if(!empty($atts['banner_sub_heading'])):
 $banner_sub_heading = $atts['banner_sub_heading'];
endif;
$banner_desc = '';
if(!empty($atts['banner_desc'])):
	$banner_desc = $atts['banner_desc'];
endif;
$banner_image ='';
if(!empty($atts['banner_image'])):
	$banner_image = $atts['banner_image'];
endif;
$banner_image_postion = '';
if(!empty($atts['banner_image_postion'])):
 $banner_image_postion = $atts['banner_image_postion'];
endif;
$banner_button1_sw = '';
if(!empty($atts['banner_button1_sw'])):
	$banner_button1_sw = $atts['banner_button1_sw'];
endif;
$banner_button1 = '';
if(!empty($atts['banner_button1'])):
  $banner_button1 = $atts['banner_button1'];
endif;
$banner_button1_url = '';
if(!empty($atts['banner_button1_url'])):
  $banner_button1_url = $atts['banner_button1_url'];
endif;
$banner_button2_sw = '';
if(!empty($atts['banner_button2_sw'])):
  $banner_button2_sw = $atts['banner_button2_sw'];
endif;
$banner_button2 = '';
if(!empty($atts['banner_button2'])):
 $banner_button2 = $atts['banner_button2'];
endif;
$banner_button2_url = '';
if(!empty($atts['banner_button2_url'])):
 $banner_button2_url = $atts['banner_button2_url'];
endif;
$banner_fullwidth_postion = '';
if(!empty($atts['banner_fullwidth_postion'])):
 $banner_fullwidth_postion = $atts['banner_fullwidth_postion'];
endif;
if($banner_fullwidth_postion =='full'):
   $containerclass = 'container-fluid';
else:
   $containerclass = 'container';
endif;
if($banner_image_postion == "left"):
?>
<div class="ms-banner">
    <div class="<?php echo esc_attr($containerclass); ?>">     
        <div class="row">
            <div class="col-lg-12 col-md-12 padding-right padding-left">            
			<?php if(!empty($banner_image['url'])): ?>
                <div class="ms_banner_img">
                    <img src="<?php echo esc_url($banner_image['url']); ?>" alt="<?php echo esc_attr('Banner Img','miraculous'); ?>" class="img-fluid">
                </div>
			<?php endif; ?>
                <div class="ms_banner_text">
				  <?php if(!empty($banner_heading)): ?>
                    <h1><?php echo esc_html($banner_heading); ?></h1>
				  <?php endif;
                   if(!empty($banner_sub_heading)):
				  ?><h1 class="ms_color"><?php echo esc_html($banner_sub_heading); ?></h1>
				  <?php endif;
				  if(!empty($banner_desc)):
				  ?><p><?php echo esc_html($banner_desc); ?></p>
				  <?php endif; ?>
                    <div class="ms_banner_btn">
                        <?php if( $banner_button1_sw == 'on' ): ?>
                            <a href="<?php echo esc_url( $banner_button1_url ); ?>" class="ms_btn"><?php echo ($banner_button1) ? $banner_button1 : esc_html__( 'Listen Now', 'miraculous' ); ?></a>
                        <?php endif; 
                        if( $banner_button2_sw == 'on' ): ?>
                            <a href="<?php echo esc_url( $banner_button2_url ); ?>" class="ms_btn"><?php echo ($banner_button2) ? $banner_button2 : esc_html__( 'Add To Queue', 'miraculous' ); ?></a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php else: ?>
<div class="ms-banner">
    <div class="<?php echo esc_attr($containerclass); ?>">
        <div class="row">
            <div class="col-lg-12 col-md-12 padding-right padding-left">
                <div class="ms_banner_text">
				<?php if(!empty($banner_heading)): ?>
                    <h1><?php echo esc_html( $banner_heading ); ?></h1>
				<?php endif;
				if(!empty($banner_sub_heading)):
				?><h1 class="ms_color"><?php echo esc_html($banner_sub_heading); ?></h1>
				<?php endif;
				if(!empty($banner_desc)):
				?><p><?php echo esc_html($banner_desc); ?></p>
				<?php endif; ?>
                    <div class="ms_banner_btn">
                        <?php if( $banner_button1_sw == 'on' ): ?>
                            <a href="<?php echo esc_url( $banner_button1_url ); ?>" class="ms_btn"><?php echo ($banner_button1) ? $banner_button1 : esc_html__( 'Listen Now','miraculous'); ?></a>
                        <?php endif; 
                        if( $banner_button2_sw == 'on' ): ?>
                            <a href="<?php echo esc_url( $banner_button2_url ); ?>" class="ms_btn"><?php echo ($banner_button2) ? $banner_button2 : esc_html__( 'Add To Queue' ,'miraculous'); ?></a>
                        <?php endif; ?>
                    </div>
                </div>
				<?php if(!empty($banner_image['url'])): ?>
                <div class="ms_banner_img">
                    <img src="<?php echo esc_url($banner_image['url']); ?>" alt="<?php echo esc_attr('Banner Img','miraculous'); ?>" class="img-fluid">
                </div>
				<?php endif; ?>
            </div> 
        </div>
    </div>
</div>
<?php endif; ?> 