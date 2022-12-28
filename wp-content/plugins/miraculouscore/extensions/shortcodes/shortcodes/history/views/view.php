<?php if (!defined('FW')) die('Forbidden');
$history_heading = $mpurl ='';
if(!empty($atts['history_heading'])):
 $history_heading = $atts['history_heading'];
endif;
$number_limits = 15;
if(!empty($atts['number_limits'])):
 $number_limits = $atts['number_limits'];
endif;

$more_img = get_template_directory_uri().'/assets/images/svg/more.svg';
$play_img = get_template_directory_uri().'/assets/images/svg/play.svg';

$userid = get_current_user_id();
$music_ids = get_user_meta($userid, 'history_songs_list_user_'.$userid, true);

$fav_music_ids = '';
if($userid){
    $fav_music_ids = get_user_meta($userid, 'favourites_songs_lists'.$userid, true);
}else{
    ?>
    <script>
        $(document).ready(function(){
           $("#myModal1").modal("show");
        });
    </script>
    <?php
}

if($music_ids && $userid):

	$sg_args = array('post_type' => 'ms-music',
	                'posts_per_page' => $number_limits,
	                'orderby' => 'date',
            		'order'   => 'DESC',
            		'suppress_filters' => true,
	                'post__in' => $music_ids,
	                );
	$music_posts = new WP_Query( $sg_args );
	$list_type = 'music';
    if( $music_posts->have_posts() ):
   ?>
<!-- Top Artist Section -->
<div class="ms_top_artist">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="ms_heading">
                    <h1><?php echo esc_html( $history_heading ); ?></h1>
                </div>
            </div>
            <?php while ( $music_posts->have_posts() ) : $music_posts->the_post(); ?>
                <div class="col-lg-2">
                    <div class="ms_rcnt_box marger_bottom30">
                        <div class="ms_rcnt_box_img">
                            <?php the_post_thumbnail( 'large' ); ?>
                            <div class="ms_main_overlay">
                                <div class="ms_box_overlay"></div>
                                <div class="ms_more_icon">
                                    <img src="<?php echo esc_url($more_img); ?>" alt="<?php esc_attr_e('More', 'miraculous'); ?>">
                                </div>
                                <?php $attach_meta = array();
                                    $music_extranal_url = get_post_meta(get_the_id(), 'fw_option:music_extranal_url', true);
                                    if(!empty($music_extranal_url)):
                                    	$mpurl = $music_extranal_url;
                                    else:
                                    	$mpurl = get_post_meta(get_the_id(), 'fw_option:mp3_full_songs', true);
                                    endif;
                                    if($mpurl) {
                                        if(!empty($mpurl['attachment_id'])){
                                            $attach_meta = wp_get_attachment_metadata( $mpurl['attachment_id'] );
                                        }
                                    }
                                    $image_uri = get_the_post_thumbnail_url ( get_the_id() );
                                    $fav_class = 'icon_fav';
                                    if(!empty($fav_music_ids)){
                                        if( in_array(get_the_id(), $fav_music_ids) ) {
            			                    $fav_class = 'icon_fav_add';
            		      	            }
                                    } ?>
                                <ul class="more_option">
                                    <li>
									  <a href="javascript:;" class="favourite_music" data-musicid="<?php echo esc_attr(get_the_id()); ?>"><span class="opt_icon"><span class="icon <?php echo esc_attr($fav_class); ?>">
										<svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 22 22"><g id="_08-5" data-name=" 08-5"><path id="_08-6" data-name=" 08-6" class="cls-1" d="M13.7,4.49a4.34,4.34,0,0,0-2,.48,3.83,3.83,0,0,0-.73.48A3.54,3.54,0,0,0,10.27,5,4.3,4.3,0,0,0,4,8.83a7.6,7.6,0,0,0,2.46,5.05,22.38,22.38,0,0,0,4,3.29l.51.34.52-.34a23.09,23.09,0,0,0,4-3.29A7.63,7.63,0,0,0,18,8.83,4.34,4.34,0,0,0,13.7,4.49ZM8.31,6.36a2.42,2.42,0,0,1,1.94,1l.75,1,.76-1a2.39,2.39,0,0,1,1.94-1,2.45,2.45,0,0,1,2.43,2.47,5.89,5.89,0,0,1-1.95,3.78A20.15,20.15,0,0,1,11,15.26a20.07,20.07,0,0,1-3.17-2.65A5.89,5.89,0,0,1,5.88,8.83,2.45,2.45,0,0,1,8.31,6.36Z"/></g></svg>
									  </span></span><?php esc_html_e('Favourites', 'miraculous'); ?></a>
									</li>
                                    <li>
									  <a href="javascript:;" class="add_to_queue" data-musicid="<?php esc_attr(get_the_id()); ?>" data-musictype="<?php printf($list_type); ?>"><span class="opt_icon"><span class="icon icon_queue">
										<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
											<path fill-rule="evenodd" d="M11.359,5.172 L6.847,5.172 L6.847,0.660 C6.847,0.455 6.568,0.009 6.010,0.009 C5.452,0.009 5.172,0.455 5.172,0.660 L5.172,5.172 L0.661,5.172 C0.455,5.172 0.010,5.451 0.010,6.009 C0.010,6.567 0.455,6.846 0.661,6.846 L5.173,6.846 L5.173,11.358 C5.173,11.563 5.452,12.009 6.010,12.009 C6.568,12.009 6.847,11.563 6.847,11.358 L6.847,6.846 L11.359,6.846 C11.564,6.846 12.010,6.567 12.010,6.009 C12.010,5.451 11.564,5.172 11.359,5.172 Z"/>
											</svg>
									  </span></span><?php esc_html_e('Add To Queue', 'miraculous'); ?>
									  </a>
									</li>
                                    <li>
									 <a href="javascript:;" class="ms_download" data-msmusic="<?php echo esc_attr(get_the_id()); ?>"><span class="opt_icon"><span class="icon icon_dwn">	
										<svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 22 22"><g id="_06-4" data-name=" 06-4"><path id="_06-5" data-name=" 06-5" class="cls-1" d="M10.65,13.85a.48.48,0,0,0,.7,0l3.27-3.5a.41.41,0,0,0,.07-.47.48.48,0,0,0-.42-.26H12.4V4.94a.46.46,0,0,0-.47-.44H10.07a.46.46,0,0,0-.47.44V9.63H7.73a.44.44,0,0,0-.42.25.41.41,0,0,0,.07.47Zm5.48-.73v2.63H5.87V13.12H4v3.5a.9.9,0,0,0,.93.88H17.07a.9.9,0,0,0,.93-.88v-3.5Z"/></g></svg>
									 </span></span><?php esc_html_e('Download Now', 'miraculous'); ?>
									 </a>
									</li>
                                    <li>
									  <a href="javascript:;" class="ms_add_playlist" data-msmusic="<?php echo esc_attr(get_the_id()); ?>"><span class="opt_icon"><span class="icon icon_playlst">
										<svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 22 22"><g id="_03-2" data-name=" 03-2"><path id="_03-3" data-name=" 03-3" class="cls-1" d="M13,5.5H3.5V7.07H13V5.5Zm0,3.14H3.5v1.57H13V8.64ZM3.5,13.36H9.82V11.79H3.5ZM14.55,5.5v6.43a2.35,2.35,0,1,0,1.58,2.21V7.07H18.5V5.5Z"/></g></svg>
									  </span></span>
									  <?php esc_html_e('Add To Playlist', 'miraculous'); ?>
									  </a>
									</li>
                                    <li>
									  <a href="javascript:;" class="ms_share_music" data-shareuri="<?php esc_attr_e(get_the_permalink()); ?>" data-sharename="<?php the_title_attribute(); ?>"><span class="opt_icon"><span class="icon icon_share">
										<svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 22 22"><g id="_14-2" data-name=" 14-2"><path id="_13" data-name=" 13" class="cls-1" d="M8.68,13.18A2.78,2.78,0,0,1,4.77,13l-.07-.08a3,3,0,0,1,0-3.85,2.77,2.77,0,0,1,3.89-.36.52.52,0,0,1,.11.1l3-2.11.09-.06a1.09,1.09,0,0,0,.63-1.08A2.76,2.76,0,0,1,15.05,3,2.84,2.84,0,0,1,17.9,5.22a3,3,0,0,1-1.36,3.22,2.72,2.72,0,0,1-3.34-.5l-.27-.3C11.81,8.41,10.7,9.18,9.6,10a.37.37,0,0,0-.09.28q0,.75,0,1.5a.51.51,0,0,0,.13.34c1.08.77,2.18,1.52,3.3,2.3a2.89,2.89,0,0,1,1.76-1.15A2.83,2.83,0,0,1,18,15.56h0A2.92,2.92,0,0,1,15.72,19a2.82,2.82,0,0,1-3.28-2.28,3.33,3.33,0,0,1,0-.63.55.55,0,0,0-.16-.38ZM6.82,9.55a1.45,1.45,0,0,0,0,2.9,1.45,1.45,0,0,0,0-2.9ZM15.2,7.36a1.43,1.43,0,0,0,1.39-1.45h0A1.4,1.4,0,1,0,15.2,7.36Zm0,7.29a1.42,1.42,0,0,0-1.4,1.43h0a1.4,1.4,0,0,0,1.44,1.36,1.4,1.4,0,0,0,0-2.8Z"/></g></svg>
									  </span></span>
									  <?php esc_html_e('Share', 'miraculous'); ?>
									  </a>
									</li>
                                    <li>
									  <a href="javascript:;" class="ms_remove_history_music" data-musicid="<?php echo esc_attr(get_the_id()); ?>"><span class="opt_icon"><span class="icon icon_close">
										<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                            <path fill-rule="evenodd" d="M4.945,3.993 L7.802,1.135 C8.065,0.872 8.065,0.446 7.802,0.183 C7.539,-0.080 7.113,-0.080 6.850,0.183 L3.993,3.040 L1.135,0.183 C0.872,-0.080 0.446,-0.080 0.183,0.183 C-0.080,0.446 -0.080,0.872 0.183,1.135 L3.040,3.993 L0.183,6.850 C-0.080,7.113 -0.080,7.539 0.183,7.802 C0.446,8.065 0.872,8.065 1.135,7.802 L3.993,4.945 L6.850,7.802 C7.113,8.065 7.539,8.065 7.802,7.802 C8.065,7.539 8.065,7.113 7.802,6.850 L4.945,3.993 Z"/>
                                        </svg>
									  </span></span>
									  <?php esc_html_e('Remove', 'miraculous'); ?>
									  </a>
								    </li>
                                </ul>
                                <div class="ms_play_icon play_btn play_music" data-musicid="<?php esc_html_e(get_the_id()); ?>" data-musictype="<?php printf($list_type); ?>">
                                    <img src="<?php echo esc_url($play_img); ?>" alt="<?php  esc_attr_e('Play', 'miraculous'); ?>">
                                </div>
                            </div>
                        </div>
                        <div class="ms_rcnt_box_text">
                            <h3><a href="<?php echo esc_url(get_the_permalink()); ?>"><?php the_title(); ?></a></h3>
                            <?php $artists_name = array(); $artists_ids = fw_get_db_post_option(get_the_id(), 'music_artists'); 
                            foreach ($artists_ids as $artists_id) {
                                 $artists_name[] = get_the_title($artists_id);
                             } ?>
                            <p><?php echo implode(', ', $artists_name); ?></p>
                        </div>
                    </div>
                </div>
              <?php endwhile; 
             wp_reset_postdata();
            ?>
        </div>
    </div>
</div>
 <?php endif;
endif;