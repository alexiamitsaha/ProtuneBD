<?php if (!defined('FW')) die('Forbidden');

$profile_heading ='';
if(!empty($atts['profile_heading'])):
  $profile_heading = $atts['profile_heading'];
endif;
$preview = get_template_directory_uri().'/assets/images/pro_img.png';
$user_id = get_current_user_id();
if(!empty($user_id)):
$name = get_the_author_meta('display_name', $user_id);
$email = get_the_author_meta('user_email', $user_id);
$profile_settings = '';
if(!empty($atts['user_setting_page'])):
    $profile_edit_page = $atts['user_setting_page'];
endif;
?>
<div class="ms_profile_wrapper">
    <?php if(!empty($profile_heading)): ?>
       <h1><?php echo esc_html($profile_heading); ?></h1>
    <?php endif; ?>
    <div class="ms_profile_box ms_view_profile">
		<div class="pro-form-btn">
			<a href="<?php echo esc_url($profile_edit_page); ?>" class="ms_btn"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> <?php echo esc_html__('Edit profile', 'miraculous'); ?></a>
		</div>
        <div class="ms_pro_img">
            <?php $img_src = get_user_meta($user_id, 'user_profile_img', true); 
            if($img_src) { ?>
                <img src="<?php echo esc_url($img_src); ?>" alt="<?php esc_attr_e('preview','miraculous'); ?>" id="img-preview" class="img-fluid">
            <?php }else{ ?>
                <img src="<?php echo esc_url($preview); ?>" alt="<?php esc_attr_e('preview','miraculous'); ?>" id="img-preview" class="img-fluid">
            <?php }
            ?>
            <div class="pro_img_overlay">
            </div>
        </div>
        <div class="ms_pro_form">
			<h1 class="ms_pro_name"><?php echo esc_html($name); ?></h1>
			<span class="ms_pro_email"><?php echo esc_html($email); ?></span>
        </div>
    </div>
</div>
<?php endif; ?>