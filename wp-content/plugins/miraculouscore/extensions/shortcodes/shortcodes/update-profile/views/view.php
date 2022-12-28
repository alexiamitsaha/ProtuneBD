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
$address = get_user_meta($user_id, 'user_address', true); 
$aboutyou = get_user_meta($user_id, 'user_aboutme', true); 
?>
<div class="ms_profile_wrapper beatswipe_profile_wrapper"> 
    <?php if(!empty($profile_heading)): ?>
       <h1><?php echo esc_html($profile_heading); ?></h1>
    <?php endif; ?>
    <div class="ms_profile_box">
        <form id="bw_profile_edit" method="post" enctype="multipart/form-data">
            <div class="ms_pro_img">
                <?php 
                $img_src = get_user_meta($user_id, 'user_profile_img', true); 
                if($img_src) { ?>
                    <img src="<?php echo esc_url($img_src); ?>" alt="<?php esc_attr_e('img preview', 'miraculous'); ?>" id="img-preview" class="img-fluid">
                <?php }else{ ?>
                    <img src="<?php echo esc_url($img_preview); ?>" alt="<?php esc_attr_e('img preview', 'miraculous'); ?>" id="img-preview" class="img-fluid">
                <?php }
                ?>
                <!-- img_edit_plus <div class="pro_img_overlay">
                    <i class="fa_icon edit_icon"></i>
                </div> -->
            </div>
            <div class="ms_pro_form">
                <div class="form-group">
                    <label><?php esc_html_e('Your Name *', 'miraculous'); ?></label>
                    <input type="text" class="form-control" id="ed_username" name="ed_username" value="<?php echo esc_attr($name); ?>">
                </div>
                <div class="form-group">
                    <label><?php esc_html_e('Your Email *', 'miraculous'); ?></label>
                    <input type="text" class="form-control" id="ed_useremail" name="ed_useremail" value="<?php echo esc_attr($email); ?>">
                </div>
                <div class="form-group">
                    <label><?php esc_html_e('Your Profile Images *', 'miraculous'); ?></label>
                    <input type="file" class="form-control" id="ed_profileimages" name="ed_profileimages" accept="image/*">
                    <?php wp_nonce_field( 'ed_profileimages', 'ed_profileimages_nonce' ); ?>
                </div>
                <div class="form-group">
                    <label><?php esc_html_e('Your Profile Cover Images *', 'miraculous'); ?></label>
                    <input type="file" class="form-control" id="ed_profilebackgroundimages" name="ed_profilebackgroundimages" accept="image/*">
                    <?php wp_nonce_field( 'ed_profilebackgroundimages', 'ed_profilebackgroundimages_nonce' ); ?>
                </div>
                <div class="form-group">
                    <label><?php esc_html_e('Your Address *', 'miraculous'); ?></label>
                    <textarea rows="5" id="ed_address" name="ed_address" cols="50"><?php echo esc_html($address); ?></textarea>
                </div>
                <div class="form-group">
                    <label><?php esc_html_e('About You*', 'miraculous'); ?></label>
                    <textarea rows="5" id="ed_aboutyou" name="ed_aboutyou" cols="50"><?php echo esc_html($aboutyou); ?></textarea>
                </div> 
                <div class="pro-change-form-btn text-center">
                    <a href="javascript:;" class="ms_btn change_pass"><?php esc_html_e('Change Password', 'miraculous'); ?></a>
                </div>
                <div class="change_password_slide">
                    <div class="form-group">
                        <label><?php esc_html_e('New Password *', 'miraculous'); ?></label>
                        <input type="password" placeholder="<?php esc_attr_e('******','miraculous'); ?>" id="ed_password" name="ed_password" class="form-control">
                    </div>
                    <div class="form-group">
                        <label><?php esc_html_e('Confirm Password *', 'miraculous'); ?></label>
                        <input type="password" placeholder="<?php esc_attr_e('******','miraculous'); ?>" id="ed_confpassword" name="ed_confpassword" class="form-control">
                    </div>
                </div>
                <div class="pro-form-btn text-center marger_top15">
                    <input type="hidden" id="image-url" value="">
                    <input type="hidden" id="cur_user_id" name="cur_user_id" value="<?php echo esc_attr($user_id); ?>">
                    <input type="submit" id="bw_profile_update" name="bw_profile_update" class="ms_btn" value="Save">
                    <button class="hst_loader"><i class="fa fa-circle-o-notch fa-spin"></i> 
					<?php esc_html_e('Loading', 'miraculous'); ?></button>
                    <input type="reset" class="ms_btn reset_form" value="reset">
                </div>
            </div>
        </form>
     </div>
</div>
<?php 
if(isset($_POST['bw_profile_update'])){
    
    print_r($_POST);
    $error = array();
    extract($_POST);
    $current_user = wp_get_current_user();
    
    if( $current_user->user_email != trim($ed_useremail) ) {
        
        if( email_exists($ed_useremail) ) {
            $error['status'] = 'false';
            $error['msg'] = "Email is already exist!";
        }
    }
	$full_name = explode(' ', $ed_username);
    $first_name = $full_name[0];
    unset($full_name[0]);
    $last_name = implode(' ', $full_name);	  
    if( empty($error) ) {
        if( isset($password) && isset($confpassword) && $password != '' && $confpassword != '' ) {
    
            $userdata = array(
               'ID' => $cur_user_id,
               'user_pass' => $password,
               'first_name' => $first_name,
               'last_name' => $last_name,
               'user_email' => $ed_useremail,
               'display_name' => $ed_username
              );

    	}else{
    
            $userdata = array(
                'ID' => $cur_user_id,
                'first_name' => $first_name,
                'last_name' => $last_name,
                'user_email' => $ed_useremail,
                'display_name' => $ed_username
                );
    
        }
        $user_id = wp_update_user( $userdata );
        require_once( ABSPATH . 'wp-admin/includes/image.php' );
        require_once( ABSPATH . 'wp-admin/includes/file.php' );
        require_once( ABSPATH . 'wp-admin/includes/media.php' ); 
        
        $attachmentp_url = '';
        $attachp_id = media_handle_upload('ed_profileimages', $user_id);
        $attachmentp_url = wp_get_attachment_url($attachp_id);
        
        $attachmentbg_url = '';
        $attachbg_id = media_handle_upload('ed_profilebackgroundimages', $user_id);
        $attachmentbg_url = wp_get_attachment_url($attachbg_id);
       
        if (!is_wp_error( $user_id)) {
            if(!empty($attachmentp_url)):
              update_user_meta($user_id, 'user_profile_img', $attachmentp_url);
            endif;
            if(!empty($attachmentbg_url)):
               update_user_meta($user_id, 'user_profilebg_img', $attachmentbg_url);
            endif;
            if(!empty($ed_address)):
             update_user_meta($user_id, 'user_address', $ed_address);
            endif;
            if(!empty($ed_aboutyou)):
             update_user_meta($user_id, 'user_aboutme', $ed_aboutyou);
            endif;
        ?>
        <script>
        jQuery(document).ready(function($){
         "use strict";
        toastr.success('upload success full');
          window.location.replace('<?php echo esc_url(home_url('/overview/')); ?>');
        }); 
        </script>
        <?php
        }else{
         
        }
      }else{
        echo esc_html($error->msg);
      }
    }
endif; ?> 