<?php if (!defined('FW')) die('Forbidden');
$notify_label = '';
if(!empty($atts['notify_label'])):
 $notify_label = $atts['notify_label'];
else:
 $notify_label = esc_html__('Notification Songs','miraculous');
endif;

$notify_number ='';
if(!empty($atts['fav_music_number'])):
  $notify_number = $atts['fav_music_number'];
else:
  $notify_number =  10; 
endif;

$user_id = get_current_user_id();
$notify = get_user_meta($user_id, 'notification', true);
$follow_cont = get_user_meta($user_id, 'follow_id', true);
$author= '';
if($user_id){
	if($notify == '1'){
		if($follow_cont){
			$sg_args = array('post_type' => 'ms-music',
                    'posts_per_page' => $notify_number,
                        );
				$music_posts = new WP_Query( $sg_args );
				$i=1; 
				while ( $music_posts->have_posts() ) : $music_posts->the_post(); 
					$author_id = get_post_field('post_author', get_the_ID());
					if(in_array($author_id, $follow_cont)){
						$namep = get_the_author_meta('display_name', $author_id);?>
							<div class="ms-notification">
							<h3><a href="<?php echo esc_url(get_the_permalink())?>"><span><?php echo esc_html__($namep); ?> </span> <?php esc_html_e('Uploaded New Song', 'miraculous'); ?> <?php echo esc_html__(get_the_title()); ?> </a></span></h3>
							</div>
					<?php }	
				$i++; endwhile;
				wp_reset_postdata();
		} else {?>
			<div class="ms_upload_wrapper marger_top60">
				<div class="ms_upload_box">
					<h2><?php echo esc_html__('No Notification Found', 'miraculous'); ?></h2>
				</div>
			</div> 
		<?php
		}
	} else {?>
			<div class="ms_upload_wrapper marger_top60">
				<div class="ms_upload_box">
					<h2><?php echo esc_html__('First You Click Bell Icon', 'miraculous'); ?></h2>
				</div>
			</div> 
		<?php
	}
} else { 
?>
<div class="ms_upload_wrapper marger_top60">
    <div class="ms_upload_box">
        <h2><?php echo esc_html__('You have not permission to access this page.', 'miraculous'); ?></h2>
        <a href="<?php echo esc_url(home_url('/')); ?>" class="ms_btn"><?php echo esc_html__('Go Back', 'miraculous'); ?></a>
    </div>
</div> 
<?php }