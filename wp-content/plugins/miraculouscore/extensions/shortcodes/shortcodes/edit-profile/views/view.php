<?php if (!defined('FW')) die('Forbidden');

$profile_heading = '';
if(!empty($atts['profile_heading'])):
  $profile_heading = $atts['profile_heading'];
endif;
$img_preview = get_template_directory_uri().'/assets/images/pro_img.png';
$user_id = get_current_user_id();
if( $user_id ):
$name = get_the_author_meta('display_name', $user_id);
$email = get_the_author_meta('user_email', $user_id);
$bdetails = get_the_author_meta('bdetails', $user_id);
?>
<div class="ms_profile_wrapper edit-profil-wrap">
    <h1><?php echo esc_html($profile_heading); ?></h1>
    <div class="ms_profile_box">
        <form id="ms_profile_edit" method="post">
            <div class="ms_pro_img img_edit_plus">
                <?php $img_src = get_user_meta($user_id, 'user_profile_img', true); 
                if($img_src) { ?>
                    <img src="<?php echo esc_url($img_src); ?>" alt="<?php esc_attr_e('img preview', 'miraculous'); ?>" id="img-preview" class="img-fluid">
                <?php }else{ ?>
                    <img src="<?php echo esc_url($img_preview); ?>" alt="<?php esc_attr_e('img preview', 'miraculous'); ?>" id="img-preview" class="img-fluid">
                <?php }
                ?>
                <div class="pro_img_overlay">
                    <i class="fa_icon edit_icon"></i>
                </div>
            </div>
            <div class="ms_pro_form">
                <div class="form-group">
                    <label><?php esc_html_e('Your Name *', 'miraculous'); ?></label>
                    <input type="text" class="form-control" id="ed_username" value="<?php echo esc_attr($name); ?>">
                </div>
                <div class="form-group">
                    <label><?php esc_html_e('Your Email *', 'miraculous'); ?></label>
                    <input type="text" class="form-control" id="ed_useremail" value="<?php echo esc_attr($email); ?>">
                </div>
				<div class="form-group">
                    <label><?php esc_html_e('Your Bank Details *', 'miraculous'); ?></label>
                    <textarea name="miratextarea" class="form-control" id="ed_bdetails" rows="4" cols="50"><?php echo esc_attr($bdetails); ?></textarea>
                </div>
                <div class="pro-change-form-btn text-center">
                    <a href="javascript:;" class="ms_btn change_pass"><?php esc_html_e('Change Password', 'miraculous'); ?></a>
                </div>
                <div class="change_password_slide">
                    <div class="form-group">
                        <label><?php esc_html_e('New Password *', 'miraculous'); ?></label>
                        <input type="password" placeholder="<?php esc_attr_e('******','miraculous'); ?>" id="ed_password" class="form-control">
                    </div>
                    <div class="form-group">
                        <label><?php esc_html_e('Confirm Password *', 'miraculous'); ?></label>
                        <input type="password" placeholder="<?php esc_attr_e('******','miraculous'); ?>" id="ed_confpassword" class="form-control">
                    </div>
                </div>
                <div class="pro-form-btn text-center marger_top15">
                    <input type="hidden" id="image-url" value="">
                    <input type="hidden" id="cur_user_id" value="<?php echo esc_attr($user_id); ?>">
                    <input type="submit" id="ms_profile_update" class="ms_btn" value="Save">
                    <button class="hst_loader"><i class="fa fa-circle-o-notch fa-spin"></i> 
					<?php esc_html_e('Loading', 'miraculous'); ?></button>
                    <input type="reset" class="ms_btn reset_form" value="reset">
                </div>
            </div>
        </form>
     </div>
</div>
<?php endif; ?> 