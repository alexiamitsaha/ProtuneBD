<?php if (!defined('FW')) die('Forbidden');
$ar_label = '';
if(!empty($atts['podcast_label'])):
  $ar_label = $atts['podcast_label'];
endif;
$ar_style = 'abstyle1';
if(!empty($atts['podcast_style'])):
  $ar_style = $atts['podcast_style'];
endif;
$ar_download = '';
if(!empty($atts['podcast_downloadable'])):
  $ar_download = $atts['podcast_downloadable'];
endif;
$ar_type = '';
if(!empty($atts['podcast_type'])):
  $ar_type = $atts['podcast_type'];
endif;
$ar_number = 12;
if(!empty($atts['podcasts_number'])):
  $ar_number = $atts['podcasts_number'];
endif; 
$podcast_par_slide = '';
if(!empty($atts['podcast_par_slide'])):
  $podcast_par_slide = $atts['podcast_par_slide'];
endif;

$musictype = 'podcast';
$list_type = 'music';
$miraculous_theme_data = '';
if (function_exists('fw_get_db_settings_option')):  
  $miraculous_theme_data = fw_get_db_settings_option();     
endif;

$user_id = get_current_user_id();
$lang_data = get_option('language_filter_ids_'.$user_id);
$fav_album_ids = '';
if($user_id){
    $fav_album_ids = get_user_meta($user_id, 'favourites_podcast_lists'.$user_id, true);
}
$play_icon = get_template_directory_uri().'/assets/images/svg/play.svg';
$more_icon = get_template_directory_uri().'/assets/images/svg/more.svg';
if( is_user_logged_in() && $lang_data ){ 

    $ar_args = array('post_type' => 'ms-podcasts',
                'posts_per_page' => $ar_number,
                'meta_key' => 'fw_option:podcast_type',
                'meta_value' => $ar_download,
                'tax_query' => array(
                        'relation' => 'OR',
                        array(
                            'taxonomy' => 'podcast_type',
                            'terms' => $ar_type
                        ),
                        array(
                            'taxonomy' => 'language',
                            'terms' => $lang_data
                        )
                    )
                );

}elseif ( isset($_COOKIE['lang_filter']) ) {
    $lang_data = explode(',', $_COOKIE['lang_filter']);

    $ar_args = array('post_type' => 'ms-podcasts',
                'posts_per_page' => $ar_number,
                'meta_key' => 'fw_option:podcast_type',
                'meta_value' => $ar_download,
                'tax_query' => array(
                        'relation' => 'OR',
                        array(
                            'taxonomy' => 'podcast_type',
                            'terms' => $ar_type
                        ),
                        array(
                            'taxonomy' => 'language',
                            'terms' => $lang_data
                        )
                    )
                );
}else{
    $ar_args = array('post_type' => 'ms-podcasts',
                'posts_per_page' => $ar_number,
                'meta_key' => 'fw_option:podcast_type',
                'meta_value' => $ar_download,
                'tax_query' => array(
                        array(
                            'taxonomy' => 'podcast_type',
                            'terms' => $ar_type
                        )
                    )
                );
}
$podcasts_posts = new WP_Query( $ar_args );

if( $podcasts_posts->have_posts() ): 
$slidermeta = array('per_view' => $podcast_par_slide);
    if( $ar_style == 'abstyle2' ): ?>
        <div class="ms_artist_wrapper common_pages_space">
                <div class="ms_artist_inner">
                    <!-- Top Albums section -->
                    <div class="ms_artist_slider ms-slider">
                        <div class="slider_heading_wrap">
                            <div class="slider_cheading">
                                <h4 class="cheading_title"><?php echo esc_html($ar_label); ?></h4>
                            </div>
                            <!-- Add Arrows -->
                           <div class="slider_cmn_controls">
                                <div class="slider_cmn_nav"><span class="swiper-button-prev-<?php esc_attr_e($ar_type); ?> slider_nav_prev"></span></div>
                                <div class="slider_cmn_nav"><span class="swiper-button-next-<?php esc_attr_e($ar_type); ?> slider_nav_next"></span></div>
                            </div>
                        </div>
                        <div class="ms_artist_innerslider">
                            <div class="ms_slider<?php esc_attr_e($ar_type); ?> swiper-container swiper-container-horizontal" data-blogmeta="<?php echo esc_attr(json_encode($slidermeta))?>" data-type="<?php esc_attr_e($ar_type); ?>">
                                <div class="swiper-wrapper">
                                    <?php $i=0;
						                while ( $podcasts_posts->have_posts() ) : $podcasts_posts->the_post(); ?>
                                    <div class="swiper-slide">
                                        <div class="slider_cbox slider_artist_box text-center">
                                            <div class="slider_cimgbox slider_artist_imgbox">
                                                <?php the_post_thumbnail( 'large' ); ?>
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
                                                        <li>
                                                            <a href="javascript:;" class="favourite_albums" data-albumid="<?php echo esc_attr(get_the_id()); ?>">
                                                            <span class="opt_icon">
                                                            <span class="icon <?php echo esc_attr($fav_class); ?>">
																<svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 22 22"><g id="_08-5" data-name=" 08-5"><path id="_08-6" data-name=" 08-6" class="cls-1" d="M13.7,4.49a4.34,4.34,0,0,0-2,.48,3.83,3.83,0,0,0-.73.48A3.54,3.54,0,0,0,10.27,5,4.3,4.3,0,0,0,4,8.83a7.6,7.6,0,0,0,2.46,5.05,22.38,22.38,0,0,0,4,3.29l.51.34.52-.34a23.09,23.09,0,0,0,4-3.29A7.63,7.63,0,0,0,18,8.83,4.34,4.34,0,0,0,13.7,4.49ZM8.31,6.36a2.42,2.42,0,0,1,1.94,1l.75,1,.76-1a2.39,2.39,0,0,1,1.94-1,2.45,2.45,0,0,1,2.43,2.47,5.89,5.89,0,0,1-1.95,3.78A20.15,20.15,0,0,1,11,15.26a20.07,20.07,0,0,1-3.17-2.65A5.89,5.89,0,0,1,5.88,8.83,2.45,2.45,0,0,1,8.31,6.36Z"/></g></svg>
															</span></span>
                                                            <?php esc_html_e('Favourites','miraculous'); ?>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="javascript:;" class="add_to_queue" data-musicid="<?php esc_html_e(get_the_id()); ?>" data-musictype="<?php printf($musictype); ?>">
                                                            <span class="opt_icon">
                                                            <span class="icon icon_queue">
																<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
													<path fill-rule="evenodd" d="M11.359,5.172 L6.847,5.172 L6.847,0.660 C6.847,0.455 6.568,0.009 6.010,0.009 C5.452,0.009 5.172,0.455 5.172,0.660 L5.172,5.172 L0.661,5.172 C0.455,5.172 0.010,5.451 0.010,6.009 C0.010,6.567 0.455,6.846 0.661,6.846 L5.173,6.846 L5.173,11.358 C5.173,11.563 5.452,12.009 6.010,12.009 C6.568,12.009 6.847,11.563 6.847,11.358 L6.847,6.846 L11.359,6.846 C11.564,6.846 12.010,6.567 12.010,6.009 C12.010,5.451 11.564,5.172 11.359,5.172 Z"/>
													</svg>
															</span></span><?php esc_html_e('Add To Queue','miraculous'); ?>
                                                            </a>
                                                        </li>
                                                        <li>
                                                         <a href="javascript:;" class="ms_share_music" data-shareuri="<?php esc_attr_e(get_the_permalink()); ?>" data-sharename="<?php the_title_attribute(); ?>"><span class="opt_icon"><span class="icon icon_share">
															<svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 22 22"><g id="_14-2" data-name=" 14-2"><path id="_13" data-name=" 13" class="cls-1" d="M8.68,13.18A2.78,2.78,0,0,1,4.77,13l-.07-.08a3,3,0,0,1,0-3.85,2.77,2.77,0,0,1,3.89-.36.52.52,0,0,1,.11.1l3-2.11.09-.06a1.09,1.09,0,0,0,.63-1.08A2.76,2.76,0,0,1,15.05,3,2.84,2.84,0,0,1,17.9,5.22a3,3,0,0,1-1.36,3.22,2.72,2.72,0,0,1-3.34-.5l-.27-.3C11.81,8.41,10.7,9.18,9.6,10a.37.37,0,0,0-.09.28q0,.75,0,1.5a.51.51,0,0,0,.13.34c1.08.77,2.18,1.52,3.3,2.3a2.89,2.89,0,0,1,1.76-1.15A2.83,2.83,0,0,1,18,15.56h0A2.92,2.92,0,0,1,15.72,19a2.82,2.82,0,0,1-3.28-2.28,3.33,3.33,0,0,1,0-.63.55.55,0,0,0-.16-.38ZM6.82,9.55a1.45,1.45,0,0,0,0,2.9,1.45,1.45,0,0,0,0-2.9ZM15.2,7.36a1.43,1.43,0,0,0,1.39-1.45h0A1.4,1.4,0,1,0,15.2,7.36Zm0,7.29a1.42,1.42,0,0,0-1.4,1.43h0a1.4,1.4,0,0,0,1.44,1.36,1.4,1.4,0,0,0,0-2.8Z"/></g></svg>
														 </span></span><?php esc_html_e('Share','miraculous'); ?>
                                                        </a>
                                                        </li> 
                                                    </ul>
                                                    <?php if(!empty($play_icon)): ?>
                                                        <div class="ms_play_icon play_btn play_music" data-musicid="<?php esc_html_e(get_the_id()); ?>" data-musictype="<?php printf($musictype); ?>">
                                                            <img src="<?php echo esc_url($play_icon); ?>" alt="<?php esc_attr_e('play icone','miraculous'); ?>">
                                                        </div> 
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <div class="slider_ctext slider_artist_text">
                                                <a class="slider_ctitle slider_artist_ttl" href="<?php echo esc_url(get_the_permalink()); ?>">
                                                    <?php the_title(); ?>
                                                </a> 
                                                <p class="slider_cdescription slider_artist_des">
                                                    <?php  
                                                        $date_publish = date_create(fw_get_db_post_option(get_the_id(), 'podcast_release_date'));
                                                        echo date_format($date_publish,"Y");
                                                    ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div> 
                                    <?php 
                                        endwhile;
                                        wp_reset_postdata();
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    <?php endif;

    if( $ar_style == 'abstyle1' ): ?>
        <div class="ms_top_artist">
            <div class="container-fluid">
                <div class="row">
                <?php if(!empty($ar_label)): ?>
                    <div class="col-lg-12">
                        <div class="ms_heading">
                          <h1><?php echo esc_html($ar_label); echo $ar_number; ?></h1>
                        </div>
                    </div>
                <?php endif;
                     while ( $podcasts_posts->have_posts() ) : $podcasts_posts->the_post(); ?>
                        <div class="col-lg-2 col-md-6 col-sm-6 col-12">
                            <div class="ms_rcnt_box marger_bottom30">
                                <div class="ms_rcnt_box_img">
                                    <?php the_post_thumbnail( 'large' ); ?>
                                    <div class="ms_main_overlay">
                                        <div class="ms_box_overlay"></div>
                                        <?php if(!empty($more_icon)): ?>
                                            <div class="ms_more_icon">
                                                <img src="<?php echo esc_url($more_icon); ?>" alt="<?php  esc_attr_e('more image','miraculous'); ?>">
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
                                            <li>
                                                <a href="javascript:;" class="favourite_albums" data-albumid="<?php echo esc_attr(get_the_id()); ?>">
                                                <span class="opt_icon">
                                                <span class="icon <?php echo esc_attr($fav_class); ?>">
													<svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 22 22"><g id="_08-5" data-name=" 08-5"><path id="_08-6" data-name=" 08-6" class="cls-1" d="M13.7,4.49a4.34,4.34,0,0,0-2,.48,3.83,3.83,0,0,0-.73.48A3.54,3.54,0,0,0,10.27,5,4.3,4.3,0,0,0,4,8.83a7.6,7.6,0,0,0,2.46,5.05,22.38,22.38,0,0,0,4,3.29l.51.34.52-.34a23.09,23.09,0,0,0,4-3.29A7.63,7.63,0,0,0,18,8.83,4.34,4.34,0,0,0,13.7,4.49ZM8.31,6.36a2.42,2.42,0,0,1,1.94,1l.75,1,.76-1a2.39,2.39,0,0,1,1.94-1,2.45,2.45,0,0,1,2.43,2.47,5.89,5.89,0,0,1-1.95,3.78A20.15,20.15,0,0,1,11,15.26a20.07,20.07,0,0,1-3.17-2.65A5.89,5.89,0,0,1,5.88,8.83,2.45,2.45,0,0,1,8.31,6.36Z"/></g></svg>
												</span></span>
                                                <?php esc_html_e('Favourites','miraculous'); ?></a>
                                            </li>
                                            <li>
                                               <a href="javascript:;" class="add_to_queue" data-musicid="<?php esc_html_e(get_the_id()); ?>" data-musictype="<?php printf($musictype); ?>"><span class="opt_icon"><span class="icon icon_queue">
												<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
													<path fill-rule="evenodd" d="M11.359,5.172 L6.847,5.172 L6.847,0.660 C6.847,0.455 6.568,0.009 6.010,0.009 C5.452,0.009 5.172,0.455 5.172,0.660 L5.172,5.172 L0.661,5.172 C0.455,5.172 0.010,5.451 0.010,6.009 C0.010,6.567 0.455,6.846 0.661,6.846 L5.173,6.846 L5.173,11.358 C5.173,11.563 5.452,12.009 6.010,12.009 C6.568,12.009 6.847,11.563 6.847,11.358 L6.847,6.846 L11.359,6.846 C11.564,6.846 12.010,6.567 12.010,6.009 C12.010,5.451 11.564,5.172 11.359,5.172 Z"/>
													</svg>
											   </span></span><?php esc_html_e('Add To Queue','miraculous'); ?></a>
                                            </li>
                                            <li>
                                              <a href="javascript:;" class="ms_share_music" data-shareuri="<?php esc_attr_e(get_the_permalink()); ?>" data-sharename="<?php the_title_attribute(); ?>"><span class="opt_icon"><span class="icon icon_share">
												<svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 22 22"><g id="_14-2" data-name=" 14-2"><path id="_13" data-name=" 13" class="cls-1" d="M8.68,13.18A2.78,2.78,0,0,1,4.77,13l-.07-.08a3,3,0,0,1,0-3.85,2.77,2.77,0,0,1,3.89-.36.52.52,0,0,1,.11.1l3-2.11.09-.06a1.09,1.09,0,0,0,.63-1.08A2.76,2.76,0,0,1,15.05,3,2.84,2.84,0,0,1,17.9,5.22a3,3,0,0,1-1.36,3.22,2.72,2.72,0,0,1-3.34-.5l-.27-.3C11.81,8.41,10.7,9.18,9.6,10a.37.37,0,0,0-.09.28q0,.75,0,1.5a.51.51,0,0,0,.13.34c1.08.77,2.18,1.52,3.3,2.3a2.89,2.89,0,0,1,1.76-1.15A2.83,2.83,0,0,1,18,15.56h0A2.92,2.92,0,0,1,15.72,19a2.82,2.82,0,0,1-3.28-2.28,3.33,3.33,0,0,1,0-.63.55.55,0,0,0-.16-.38ZM6.82,9.55a1.45,1.45,0,0,0,0,2.9,1.45,1.45,0,0,0,0-2.9ZM15.2,7.36a1.43,1.43,0,0,0,1.39-1.45h0A1.4,1.4,0,1,0,15.2,7.36Zm0,7.29a1.42,1.42,0,0,0-1.4,1.43h0a1.4,1.4,0,0,0,1.44,1.36,1.4,1.4,0,0,0,0-2.8Z"/></g></svg>
											  </span></span><?php esc_html_e('Share','miraculous'); ?>
                                              </a>
                                            </li>
                                        </ul>
                                        <?php if(!empty($play_icon)): ?>
                                            <div class="ms_play_icon play_btn play_music" data-musicid="<?php esc_html_e(get_the_id()); ?>" data-musictype="<?php printf($musictype); ?>">
                                              <img src="<?php echo esc_url($play_icon); ?>" alt="<?php esc_attr_e('play icone','miraculous'); ?>">
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="ms_rcnt_box_text">
                                    <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                    <?php  
                                    $artists_name = array(); $artists_ids = fw_get_db_post_option(get_the_id(), 'podcast_artists'); 
                                    foreach ($artists_ids as $artists_id) {
                                         $artists_name[] = get_the_title($artists_id);
                                     }?>
                                    <p><?php echo implode(',', $artists_name); ?></p>
                                    
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                    <?php wp_reset_postdata(); ?>
                </div>
            </div>
        </div>
    <?php endif;
endif;