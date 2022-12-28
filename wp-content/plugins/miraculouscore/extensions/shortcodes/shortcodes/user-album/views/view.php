<?php if (!defined('FW')) die('Forbidden');
$ar_label = '';
if(!empty($atts['albums_label'])):
  $ar_label = $atts['albums_label'];
endif;
$albums_number = '';
if(!empty($atts['album_number'])):
  $albums_number = $atts['album_number'];
endif;
$musictype = 'album';
$list_type = 'music';
$miraculous_theme_data = '';
if (function_exists('fw_get_db_settings_option')):  
  $miraculous_theme_data = fw_get_db_settings_option();     
endif;
$user_id ='';
if(!empty($_GET['artistid'])):
$user_id = $_GET['artistid'];
else:
$user_id = get_current_user_id(); 
endif;
$play_icon = get_template_directory_uri().'/assets/images/svg/play.svg';
$more_icon = get_template_directory_uri().'/assets/images/svg/more.svg';

$ar_args = array('post_type' => 'ms-albums',
                 'author' => $user_id,
                 'posts_per_page' => $albums_number,
                );
$album_posts = new WP_Query($ar_args);
?>
<div class="ms_fea_album_slider mv_videos_slider">
<?php if(!empty($ar_label)): ?>
<div class="ms_heading">
    <h1><?php echo esc_html($ar_label); ?></h1>
</div>
<?php endif;
if( $album_posts->have_posts() ):
?>
    <div class="ms_relative_inner ">
        <div class="mv_video_grid">
            <div class="row">
            <?php
            $i=0;
            while ( $album_posts->have_posts() ) : $album_posts->the_post();
             ?>
			   <div class="col-xl-3 col-lg-6">
                    <div class="ms_rcnt_box">
                            <div class="ms_rcnt_box_img">
                             <a class="bw_videos_opens" href="<?php echo esc_url(get_the_permalink(get_the_ID())); ?>" ><?php
                                the_post_thumbnail( 'large' );
                                ?>
                              </a>
                            <div class="ms_main_overlay">
                                <div class="ms_box_overlay"></div>
                                   <?php if(!empty($more_icon)): ?>
                                    <div class="ms_more_icon">
                                        <img src="<?php echo esc_url($more_icon); ?>" alt="<?php esc_attr_e('More Icone','miraculous'); ?>">
                                    </div>
                                    <?php endif;
                                        $fav_class = 'icon_fav';
                                        if(!empty($fav_album_ids)){
                                            if( in_array(get_the_id(), $fav_album_ids) ) {
                			                    $fav_class = 'icon_fav_add';
                		      	            }
                                        } 
                                    ?>
                                    <ul class="more_option">
                                        <?php 
                                        if(is_user_logged_in()):
                                        $user_id = get_current_user_id(); 
                                        $user_info = get_userdata($user_id);
                                        $user_roles = implode(', ', $user_info->roles);
                                        if($user_roles == 'artist' ||  $user_roles=='administrator'): 
                                        ?> 
                                        <li>
                                        <a href="<?php echo esc_url(home_url('/albums-update/')); ?>?albums_id=<?php echo get_the_ID(); ?>" class="bs_video_edite"><span class="opt_icon"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></span><?php esc_html_e('Edit','miraculous'); ?>
                                        </a>
                                        </li>
                                        <?php
                                          endif; 
                                        endif;
                                        ?>
                                        <li>
                                        <a href="javascript:;" class="ms_share_music" data-shareuri="<?php esc_attr_e(get_the_permalink()); ?>" data-sharename="<?php the_title_attribute(); ?>"><span class="opt_icon"><span class="icon icon_share">
											<svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 22 22"><g id="_14-2" data-name=" 14-2"><path id="_13" data-name=" 13" class="cls-1" d="M8.68,13.18A2.78,2.78,0,0,1,4.77,13l-.07-.08a3,3,0,0,1,0-3.85,2.77,2.77,0,0,1,3.89-.36.52.52,0,0,1,.11.1l3-2.11.09-.06a1.09,1.09,0,0,0,.63-1.08A2.76,2.76,0,0,1,15.05,3,2.84,2.84,0,0,1,17.9,5.22a3,3,0,0,1-1.36,3.22,2.72,2.72,0,0,1-3.34-.5l-.27-.3C11.81,8.41,10.7,9.18,9.6,10a.37.37,0,0,0-.09.28q0,.75,0,1.5a.51.51,0,0,0,.13.34c1.08.77,2.18,1.52,3.3,2.3a2.89,2.89,0,0,1,1.76-1.15A2.83,2.83,0,0,1,18,15.56h0A2.92,2.92,0,0,1,15.72,19a2.82,2.82,0,0,1-3.28-2.28,3.33,3.33,0,0,1,0-.63.55.55,0,0,0-.16-.38ZM6.82,9.55a1.45,1.45,0,0,0,0,2.9,1.45,1.45,0,0,0,0-2.9ZM15.2,7.36a1.43,1.43,0,0,0,1.39-1.45h0A1.4,1.4,0,1,0,15.2,7.36Zm0,7.29a1.42,1.42,0,0,0-1.4,1.43h0a1.4,1.4,0,0,0,1.44,1.36,1.4,1.4,0,0,0,0-2.8Z"/></g></svg>
										</span></span><?php esc_html_e('Share','miraculous'); ?>
                                        </a>
                                        </li>
                                    </ul>
                                    <?php if(!empty($play_icon)): ?>
                                    <div class="ms_play_icon play_btn">
                                        <a class="bw_ablum_opens"  href="<?php echo esc_url(get_the_permalink(get_the_ID())); ?>">
                                        <img src="<?php echo esc_url($play_icon); ?>" alt="<?php esc_attr_e('play icone','miraculous'); ?>">
                                        </a>
                                    </div>
                                    <?php endif; ?>
                                </div> 
                             </div> 
                            <div class="ms_rcnt_box_text">
                              <h3><a class="bw_videos_opens" href="<?php echo esc_url(get_the_permalink(get_the_ID())); ?>" ><?php the_title(); ?></a></h3>
                            </div>
                     </div>
                </div> 
             <?php 
             $i++;
            endwhile;
            wp_reset_postdata();
            ?>
            </div>
           <?php endif; ?>
         </div>
    </div>
 </div>