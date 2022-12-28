<?php if (!defined('FW')) die('Forbidden');
$about_heading = '';
if(!empty($atts['about_heading'])):
  $about_heading = $atts['about_heading'];
endif;
$user_id ='';
if(!empty($_GET['artistid'])):
$user_id = $_GET['artistid'];
else:
$user_id = get_current_user_id(); 
endif;
$name = get_the_author_meta('display_name', $user_id);
$email = get_the_author_meta('user_email', $user_id);
$bdetails = get_user_meta($user_id, 'bdetails', true);
if(!empty($bdetails)){

?>
<div class="ms_upload_wrapper mv_video_wrap">
    <?php if(!empty($about_heading)): ?>
    <div class="ms_heading">
        <h1><?php echo esc_html($about_heading); ?></h1>
    </div>
    <?php endif; ?>
	<div class="beatswipe_aboutme_page"> 
		<table>
		  <tr>
			<td><?php echo esc_html_e('User Name','miraculous'); ?></td>
			<td><?php  echo esc_html($name); ?></td> 
		  </tr>
		  <tr>
			<td><?php echo esc_html_e('User Email','miraculous'); ?></td>
			<td><?php  echo esc_html($email); ?></td> 
		  </tr>
		  <tr>
			<td><?php echo esc_html_e('User Bank Details','miraculous'); ?></td>
			<td><?php  echo esc_html($bdetails); ?></td> 
		  </tr>
		</table>
	</div> 
</div>
<?php
}
else{
?>
<div class="ms_upload_wrapper mv_video_wrap">
    <div class="beatswipe_aboutme_page"> 
    <?php if(!empty($about_heading)): ?>
    <div class="ms_heading">
        <h1><?php echo esc_html($about_heading); ?></h1>
    </div>
    <?php endif; ?>
    <?php 
    $userlogin_id = get_current_user_id();
    $user_info = get_userdata($userlogin_id);
    $user_roles = '';
    if(!empty($user_info)):
      $user_roles = implode(', ', $user_info->roles);
    endif;
    if($user_roles=='subscriber' || $user_roles=='administrator'):
    ?>
    <a href="<?php echo esc_url(home_url('/edit-profile/?artistid='.$userlogin_id)); ?>"><?php esc_html_e('No data available please complete your profile','miraculous'); ?></a>
    <?php 
    else:
      esc_html_e('No data available','miraclous');
    endif;
    ?>
   </div>
</div>
<?php
}
?>