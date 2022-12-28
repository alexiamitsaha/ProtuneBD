<?php if (!defined('FW')) die('Forbidden');
$need_heading = '';
if(!empty($atts['need_heading'])):
    $need_heading = $atts['need_heading'];
endif;
$need_logoimage = '';
if(!empty($atts['need_logoimage']['url'])):
    $need_logoimage = $atts['need_logoimage']['url'];
else:
   $need_logoimage = get_template_directory_uri().'/assets/images/headphones.svg';
endif;
if(!is_user_logged_in()):
?>
	<div class="ms_needlogin">
		<div class="needlogin_img">
			<img src="<?php echo esc_url($need_logoimage); ?>" alt="<?php esc_attr_e('Need Logo Image','miraculous'); ?>">
		</div>
		<?php if(!empty($need_heading)): ?>
	    	<h2><?php echo esc_html($need_heading); ?></h2>
		<?php endif; ?>
		<a href="javascript:;" class="ms_btn reg_btn" data-toggle="modal" data-target="#myModal"><span><?php esc_html_e('register/login','miraculous'); ?></span></a>
	</div>
<?php
endif;