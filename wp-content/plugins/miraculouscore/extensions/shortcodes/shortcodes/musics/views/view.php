<?php if (!defined('FW')) die('Forbidden');
$sg_label = $mpurl = '';
if(!empty($atts['music_label'])):
    $sg_label = $atts['music_label'];
endif;
$sg_style = 'abstyle1';
if(!empty($atts['music_style'])):
    $sg_style = $atts['music_style'];
endif;
$sg_download = '';
if(!empty($atts['music_downloadable'])):
    $sg_download = $atts['music_downloadable'];
endif;
$sg_music_types = '';
if(!empty($atts['music_types'])):
    $sg_music_types = $atts['music_types'];
endif;
$sg_number = 12;
if(!empty($atts['music_number'])):
    $sg_number = $atts['music_number'];
endif;

$music_filter = '';
if(!empty($atts['music_filter'])):
    $music_filter = $atts['music_filter'];
endif;

$music_song_view = '';
if(!empty($atts['music_song_view'])):
  $music_song_view = $atts['music_song_view'];
endif;

$music_song_dowenload = '';
if(!empty($atts['music_song_dowenload'])):
  $music_song_dowenload = $atts['music_song_dowenload'];
endif;

$list_type = 'music';
$more_img = get_template_directory_uri().'/assets/images/svg/more.svg';
$play_img = get_template_directory_uri().'/assets/images/svg/play.svg';
$miraculous_theme_data = '';
if (function_exists('fw_get_db_settings_option')):  
  $miraculous_theme_data = fw_get_db_settings_option();     
endif; 
$currency = '';
if(!empty($miraculous_theme_data['paypal_currency']) && function_exists('miraculous_currency_symbol')):
    $currency = miraculous_currency_symbol( $miraculous_theme_data['paypal_currency'] );
endif;

$user_id = get_current_user_id();
$lang_data = get_option('language_filter_ids_'.$user_id);

$fav_music_ids = '';
if($user_id){
    $fav_music_ids = get_user_meta($user_id, 'favourites_songs_lists'.$user_id, true);
}

if( is_user_logged_in() && $lang_data ){
    $sg_args = array('post_type' => 'ms-music',
                'posts_per_page' => $sg_number,
                'meta_query' => array(
                    'relation' => 'OR',
                    'music_types' => array(
                		'key' => 'fw_option:music_types',
                		'value' => $sg_download
                	),
                	'music_filter' => array(
                		'key' => $music_filter,
                	)
                ),
                'orderby' => array(
		            'music_filter' => 'DESC',
	            ),
                'tax_query' => array(
                        array(
                            'taxonomy' => 'music-type',
                            'terms' => $sg_music_types
                        ),
                        array(
                            'taxonomy' => 'language',
                            'terms' => $lang_data
                        )
                    )
                );
}elseif ( isset($_COOKIE['lang_filter']) ) {
     $lang_data = explode(',', $_COOKIE['lang_filter']);
     $sg_args = array('post_type' => 'ms-music',
                'posts_per_page' => $sg_number,
                'meta_query' => array(
                    'relation' => 'OR',
                    'music_types' => array(
                		'key' => 'fw_option:music_types',
                		'value' => $sg_download
                	),
                	'music_filter' => array(
                		'key' => $music_filter,
                	)
                ),
                'orderby' => array(
		            'music_filter' => 'DESC',
	            ),
                'tax_query' => array(
                        array(
                            'taxonomy' => 'music-type',
                            'terms' => $sg_music_types
                        ),
                        array(
                            'taxonomy' => 'language',
                            'terms' => $lang_data
                        )
                    )
                );
}else{
    $sg_args = array('post_type' => 'ms-music',
                'posts_per_page' => $sg_number,
                'meta_query' => array(
                    'relation' => 'OR',
                    'music_types' => array(
                		'key' => 'fw_option:music_types',
                		'value' => $sg_download
                	),
                	'music_filter' => array(
                		'key' => $music_filter,
                	)
                ),
                'orderby' => array(
		            'music_filter' => 'DESC',
	            ),
                'tax_query' => array(
                        array(
                            'taxonomy' => 'music-type',
                            'terms' => $sg_music_types
                        ),
                    )
            );
}

// the query
$music_posts = new WP_Query( $sg_args );
if( $music_posts->have_posts() ): 
if( $sg_style == 'abstyle1' ): ?>
<div class="ms_fea_album_slider">
    <div class="ms_heading">
        <h1><?php echo esc_html( $sg_label ); ?></h1>
    </div>
    <div class="ms_relative_inner">
        <div class="ms_feature_slider swiper-container swiper-container-horizontal">
            <div class="swiper-wrapper">
                <?php
                $i=0; 
                while ( $music_posts->have_posts() ) : $music_posts->the_post();
                ?>
                <div class="swiper-slide<?php echo ($i==0) ? ' swiper-slide-active' : '';?>" data-swiper-slide-index="<?php echo _e($i); ?>">
                        <div class="ms_rcnt_box">
                            <div class="ms_rcnt_box_img">
                                <?php the_post_thumbnail( 'large' ); ?>
                                <div class="ms_main_overlay">
                                    <div class="ms_box_overlay"></div>
                                    <div class="ms_more_icon">
                                        <img src="<?php echo esc_url($more_img); ?>" alt="<?php echo esc_attr('More', 'miraculous'); ?>">
                                    </div>
                                    <?php $attach_meta = array();
                                        $music_extranal_url = get_post_meta(get_the_id(), 'fw_option:music_extranal_url', true);
                                        if(!empty($music_extranal_url)):
                                           $mpurl = $music_extranal_url;
                                        else:
                                           $mpurl = get_post_meta(get_the_id(), 'fw_option:mp3_full_songs', true);
                                        endif;
                                        if($mpurl) {
                                           // $attach_meta = wp_get_attachment_metadata( $mpurl['attachment_id'] );
                                        }
                                        $image_uri = get_the_post_thumbnail_url ( get_the_id() );
                                        $fav_class = 'icon_fav';
                                        if(!empty($fav_music_ids)){
                                            if( in_array(get_the_id(), $fav_music_ids) ) {
                			                    $fav_class = 'icon_fav_add';
                		      	            }
                                        } ?>
                                    <ul class="more_option">
                                        <li><a href="javascript:;" class="favourite_music" data-musicid="<?php echo esc_attr(get_the_id()); ?>"><span class="opt_icon"><span class="icon <?php echo esc_attr($fav_class); ?>">
											<svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 22 22"><g id="_08-5" data-name=" 08-5"><path id="_08-6" data-name=" 08-6" class="cls-1" d="M13.7,4.49a4.34,4.34,0,0,0-2,.48,3.83,3.83,0,0,0-.73.48A3.54,3.54,0,0,0,10.27,5,4.3,4.3,0,0,0,4,8.83a7.6,7.6,0,0,0,2.46,5.05,22.38,22.38,0,0,0,4,3.29l.51.34.52-.34a23.09,23.09,0,0,0,4-3.29A7.63,7.63,0,0,0,18,8.83,4.34,4.34,0,0,0,13.7,4.49ZM8.31,6.36a2.42,2.42,0,0,1,1.94,1l.75,1,.76-1a2.39,2.39,0,0,1,1.94-1,2.45,2.45,0,0,1,2.43,2.47,5.89,5.89,0,0,1-1.95,3.78A20.15,20.15,0,0,1,11,15.26a20.07,20.07,0,0,1-3.17-2.65A5.89,5.89,0,0,1,5.88,8.83,2.45,2.45,0,0,1,8.31,6.36Z"/></g></svg>
										</span></span><?php esc_html_e('Favourites', 'miraculous'); ?></a></li>
                                        <li><a href="javascript:;" class="add_to_queue" data-musicid="<?php esc_attr_e(get_the_id()); ?>" data-musictype="<?php printf($list_type); ?>"><span class="opt_icon"><span class="icon icon_queue">
											<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
													<path fill-rule="evenodd" d="M11.359,5.172 L6.847,5.172 L6.847,0.660 C6.847,0.455 6.568,0.009 6.010,0.009 C5.452,0.009 5.172,0.455 5.172,0.660 L5.172,5.172 L0.661,5.172 C0.455,5.172 0.010,5.451 0.010,6.009 C0.010,6.567 0.455,6.846 0.661,6.846 L5.173,6.846 L5.173,11.358 C5.173,11.563 5.452,12.009 6.010,12.009 C6.568,12.009 6.847,11.563 6.847,11.358 L6.847,6.846 L11.359,6.846 C11.564,6.846 12.010,6.567 12.010,6.009 C12.010,5.451 11.564,5.172 11.359,5.172 Z"/>
													</svg>
										</span></span><?php esc_html_e('Add To Queue', 'miraculous'); ?></a></li>
                                        <li><a href="javascript:;" class="ms_download" data-msmusic="<?php echo esc_attr(get_the_id()); ?>"><span class="opt_icon"><span class="icon icon_dwn">
											<svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 22 22"><g id="_06-4" data-name=" 06-4"><path id="_06-5" data-name=" 06-5" class="cls-1" d="M10.65,13.85a.48.48,0,0,0,.7,0l3.27-3.5a.41.41,0,0,0,.07-.47.48.48,0,0,0-.42-.26H12.4V4.94a.46.46,0,0,0-.47-.44H10.07a.46.46,0,0,0-.47.44V9.63H7.73a.44.44,0,0,0-.42.25.41.41,0,0,0,.07.47Zm5.48-.73v2.63H5.87V13.12H4v3.5a.9.9,0,0,0,.93.88H17.07a.9.9,0,0,0,.93-.88v-3.5Z"/></g></svg>
										</span></span><?php esc_html_e('Download Now', 'miraculous'); ?></a></li>
                                        <li><a href="javascript:;" class="ms_add_playlist" data-msmusic="<?php echo esc_attr(get_the_id()); ?>"><span class="opt_icon"><span class="icon icon_playlst">
											<svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 22 22"><g id="_03-2" data-name=" 03-2"><path id="_03-3" data-name=" 03-3" class="cls-1" d="M13,5.5H3.5V7.07H13V5.5Zm0,3.14H3.5v1.57H13V8.64ZM3.5,13.36H9.82V11.79H3.5ZM14.55,5.5v6.43a2.35,2.35,0,1,0,1.58,2.21V7.07H18.5V5.5Z"/></g></svg>
										</span></span><?php esc_html_e('Add To Playlist', 'miraculous'); ?></a></li>
                                        <li><a href="javascript:;" class="ms_share_music" data-shareuri="<?php esc_attr_e(get_the_permalink()); ?>" data-sharename="<?php the_title_attribute(); ?>"><span class="opt_icon"><span class="icon icon_share">
											<svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 22 22"><g id="_14-2" data-name=" 14-2"><path id="_13" data-name=" 13" class="cls-1" d="M8.68,13.18A2.78,2.78,0,0,1,4.77,13l-.07-.08a3,3,0,0,1,0-3.85,2.77,2.77,0,0,1,3.89-.36.52.52,0,0,1,.11.1l3-2.11.09-.06a1.09,1.09,0,0,0,.63-1.08A2.76,2.76,0,0,1,15.05,3,2.84,2.84,0,0,1,17.9,5.22a3,3,0,0,1-1.36,3.22,2.72,2.72,0,0,1-3.34-.5l-.27-.3C11.81,8.41,10.7,9.18,9.6,10a.37.37,0,0,0-.09.28q0,.75,0,1.5a.51.51,0,0,0,.13.34c1.08.77,2.18,1.52,3.3,2.3a2.89,2.89,0,0,1,1.76-1.15A2.83,2.83,0,0,1,18,15.56h0A2.92,2.92,0,0,1,15.72,19a2.82,2.82,0,0,1-3.28-2.28,3.33,3.33,0,0,1,0-.63.55.55,0,0,0-.16-.38ZM6.82,9.55a1.45,1.45,0,0,0,0,2.9,1.45,1.45,0,0,0,0-2.9ZM15.2,7.36a1.43,1.43,0,0,0,1.39-1.45h0A1.4,1.4,0,1,0,15.2,7.36Zm0,7.29a1.42,1.42,0,0,0-1.4,1.43h0a1.4,1.4,0,0,0,1.44,1.36,1.4,1.4,0,0,0,0-2.8Z"/></g></svg>
										</span></span><?php esc_html_e('Share', 'miraculous'); ?></a></li>
                                    </ul>
                                    <div class="ms_play_icon play_btn play_music" data-musicid="<?php esc_attr_e(get_the_id()); ?>" data-musictype="<?php printf($list_type); ?>">
                                        <img src="<?php echo esc_url($play_img); ?>" alt="<?php  esc_attr_e('play', 'miraculous'); ?>">
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

                <?php $i++; endwhile; ?>
                <?php wp_reset_postdata(); ?>
            </div>

            <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
            <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>

        </div>
        <!-- Add Arrows -->
         <div class="swiper-button-next swiper-button-next-elementor" tabindex="0" role="button" aria-label="<?php esc_attr_e('Next slide','miraculous'); ?>">
    	    <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" width="512" height="512" x="0" y="0" viewBox="0 0 128 128" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><path xmlns="http://www.w3.org/2000/svg" id="Down_Arrow_3_" d="m64 88c-1.023 0-2.047-.391-2.828-1.172l-40-40c-1.563-1.563-1.563-4.094 0-5.656s4.094-1.563 5.656 0l37.172 37.172 37.172-37.172c1.563-1.563 4.094-1.563 5.656 0s1.563 4.094 0 5.656l-40 40c-.781.781-1.805 1.172-2.828 1.172z" data-original="#000000" class=""></path></g></svg>
    	</div>
    	<div class="swiper-button-prev swiper-button-prev-elementor" tabindex="0" role="button" aria-label="<?php esc_attr_e('Previous slide','miraculous'); ?>">
    	    <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" width="512" height="512" x="0" y="0" viewBox="0 0 128 128" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><path xmlns="http://www.w3.org/2000/svg" id="Down_Arrow_3_" d="m64 88c-1.023 0-2.047-.391-2.828-1.172l-40-40c-1.563-1.563-1.563-4.094 0-5.656s4.094-1.563 5.656 0l37.172 37.172 37.172-37.172c1.563-1.563 4.094-1.563 5.656 0s1.563 4.094 0 5.656l-40 40c-.781.781-1.805 1.172-2.828 1.172z" data-original="#000000" class=""></path></g></svg>
    	</div>
    </div>
</div>
<?php endif; 
if( $sg_style == 'abstyle3' ): ?>
<!----Top Artist Section---->
<div class="ms_top_artist">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="ms_heading">
                    <h1><?php echo esc_html( $sg_label ); ?></h1>
                </div>
            </div>
            <?php while ( $music_posts->have_posts() ) : $music_posts->the_post(); 
                ?>
                <div class="col-lg-2 col-md-6 col-sm-6 col-12">
                    <div class="ms_rcnt_box marger_bottom30">
                        <div class="ms_rcnt_box_img">
                            <?php the_post_thumbnail( 'large' ); ?>
                            <div class="ms_main_overlay">
                                <div class="ms_box_overlay"></div>
                                <div class="ms_more_icon">
                                    <img src="<?php echo esc_url($more_img); ?>" alt="<?php echo esc_attr__('More', 'miraculous'); ?>">
                                </div>
                                <?php $attach_meta = array();
                                    $music_extranal_url = get_post_meta(get_the_id(), 'fw_option:music_extranal_url', true);
                                    if(!empty($music_extranal_url)):
                                        $mpurl = $music_extranal_url;
                                    else:
                                        $mpurl = get_post_meta(get_the_id(), 'fw_option:mp3_full_songs', true);
                                    endif;
                                    if($mpurl) {
                                       // $attach_meta = wp_get_attachment_metadata( $mpurl['attachment_id'] );
                                    }
                                    $image_uri = get_the_post_thumbnail_url ( get_the_id() );
                                    $fav_class = 'icon_fav';
                                    if(!empty($fav_music_ids)){
                                        if( in_array(get_the_id(), $fav_music_ids) ) {
            			                    $fav_class = 'icon_fav_add';
            		      	            }
                                    } ?>
                                <ul class="more_option">
                                        <li><a href="javascript:;" class="favourite_music" data-musicid="<?php echo esc_attr(get_the_id()); ?>"><span class="opt_icon"><span class="icon <?php echo esc_attr($fav_class); ?>">
											<svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 22 22"><g id="_08-5" data-name=" 08-5"><path id="_08-6" data-name=" 08-6" class="cls-1" d="M13.7,4.49a4.34,4.34,0,0,0-2,.48,3.83,3.83,0,0,0-.73.48A3.54,3.54,0,0,0,10.27,5,4.3,4.3,0,0,0,4,8.83a7.6,7.6,0,0,0,2.46,5.05,22.38,22.38,0,0,0,4,3.29l.51.34.52-.34a23.09,23.09,0,0,0,4-3.29A7.63,7.63,0,0,0,18,8.83,4.34,4.34,0,0,0,13.7,4.49ZM8.31,6.36a2.42,2.42,0,0,1,1.94,1l.75,1,.76-1a2.39,2.39,0,0,1,1.94-1,2.45,2.45,0,0,1,2.43,2.47,5.89,5.89,0,0,1-1.95,3.78A20.15,20.15,0,0,1,11,15.26a20.07,20.07,0,0,1-3.17-2.65A5.89,5.89,0,0,1,5.88,8.83,2.45,2.45,0,0,1,8.31,6.36Z"/></g></svg>
										</span></span><?php esc_html_e('Favourites', 'miraculous'); ?></a></li>
                                        <li><a href="javascript:;" class="add_to_queue" data-musicid="<?php esc_attr_e(get_the_id()); ?>" data-musictype="<?php printf($list_type); ?>"><span class="opt_icon"><span class="icon icon_queue">
											<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
													<path fill-rule="evenodd" d="M11.359,5.172 L6.847,5.172 L6.847,0.660 C6.847,0.455 6.568,0.009 6.010,0.009 C5.452,0.009 5.172,0.455 5.172,0.660 L5.172,5.172 L0.661,5.172 C0.455,5.172 0.010,5.451 0.010,6.009 C0.010,6.567 0.455,6.846 0.661,6.846 L5.173,6.846 L5.173,11.358 C5.173,11.563 5.452,12.009 6.010,12.009 C6.568,12.009 6.847,11.563 6.847,11.358 L6.847,6.846 L11.359,6.846 C11.564,6.846 12.010,6.567 12.010,6.009 C12.010,5.451 11.564,5.172 11.359,5.172 Z"/>
													</svg>
										</span></span><?php esc_html_e('Add To Queue', 'miraculous'); ?></a></li>
                                        <li><a href="javascript:;" class="ms_download" data-msmusic="<?php echo esc_attr(get_the_id()); ?>"><span class="opt_icon"><span class="icon icon_dwn">
											<svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 22 22"><g id="_06-4" data-name=" 06-4"><path id="_06-5" data-name=" 06-5" class="cls-1" d="M10.65,13.85a.48.48,0,0,0,.7,0l3.27-3.5a.41.41,0,0,0,.07-.47.48.48,0,0,0-.42-.26H12.4V4.94a.46.46,0,0,0-.47-.44H10.07a.46.46,0,0,0-.47.44V9.63H7.73a.44.44,0,0,0-.42.25.41.41,0,0,0,.07.47Zm5.48-.73v2.63H5.87V13.12H4v3.5a.9.9,0,0,0,.93.88H17.07a.9.9,0,0,0,.93-.88v-3.5Z"/></g></svg>
										</span></span><?php esc_html_e('Download Now', 'miraculous'); ?></a></li>
                                        <li><a href="javascript:;" class="ms_add_playlist" data-msmusic="<?php echo esc_attr(get_the_id()); ?>"><span class="opt_icon"><span class="icon icon_playlst">
											<svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 22 22"><g id="_03-2" data-name=" 03-2"><path id="_03-3" data-name=" 03-3" class="cls-1" d="M13,5.5H3.5V7.07H13V5.5Zm0,3.14H3.5v1.57H13V8.64ZM3.5,13.36H9.82V11.79H3.5ZM14.55,5.5v6.43a2.35,2.35,0,1,0,1.58,2.21V7.07H18.5V5.5Z"/></g></svg>
										</span></span><?php esc_html_e('Add To Playlist', 'miraculous'); ?></a></li>
                                        <li><a href="javascript:;" class="ms_share_music" data-shareuri="<?php esc_attr_e(get_the_permalink()); ?>" data-sharename="<?php the_title_attribute(); ?>"><span class="opt_icon"><span class="icon icon_share">
											<svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 22 22"><g id="_14-2" data-name=" 14-2"><path id="_13" data-name=" 13" class="cls-1" d="M8.68,13.18A2.78,2.78,0,0,1,4.77,13l-.07-.08a3,3,0,0,1,0-3.85,2.77,2.77,0,0,1,3.89-.36.52.52,0,0,1,.11.1l3-2.11.09-.06a1.09,1.09,0,0,0,.63-1.08A2.76,2.76,0,0,1,15.05,3,2.84,2.84,0,0,1,17.9,5.22a3,3,0,0,1-1.36,3.22,2.72,2.72,0,0,1-3.34-.5l-.27-.3C11.81,8.41,10.7,9.18,9.6,10a.37.37,0,0,0-.09.28q0,.75,0,1.5a.51.51,0,0,0,.13.34c1.08.77,2.18,1.52,3.3,2.3a2.89,2.89,0,0,1,1.76-1.15A2.83,2.83,0,0,1,18,15.56h0A2.92,2.92,0,0,1,15.72,19a2.82,2.82,0,0,1-3.28-2.28,3.33,3.33,0,0,1,0-.63.55.55,0,0,0-.16-.38ZM6.82,9.55a1.45,1.45,0,0,0,0,2.9,1.45,1.45,0,0,0,0-2.9ZM15.2,7.36a1.43,1.43,0,0,0,1.39-1.45h0A1.4,1.4,0,1,0,15.2,7.36Zm0,7.29a1.42,1.42,0,0,0-1.4,1.43h0a1.4,1.4,0,0,0,1.44,1.36,1.4,1.4,0,0,0,0-2.8Z"/></g></svg>
										</span></span><?php esc_html_e('Share', 'miraculous'); ?></a></li>
                                    </ul>
                                <div class="ms_play_icon play_btn play_music" data-musicid="<?php esc_html_e(get_the_id()); ?>" data-musictype="<?php printf($list_type); ?>">
                                    <img src="<?php echo esc_url($play_img); ?>" alt="<?php echo esc_attr('Play', 'miraculous'); ?>">
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
            <?php endwhile; ?>
            <?php wp_reset_postdata(); ?>
        </div>
    </div>
</div>
<?php endif; 
if( $sg_style == 'abstyle2' ): ?>
<!-- Weekly Top 15 -->
<div class="ms_weekly_wrapper ms_free_music">
    <div class="ms_weekly_inner">
        <div class="row">
            <div class="col-lg-12">
                <div class="ms_heading">
                    <h1><?php echo esc_html( $sg_label ); ?></h1>
                </div>
            </div>
            <?php 
			$i=01; $n = $music_posts->found_posts; $rm = $n%3;
			while ( $music_posts->have_posts() ) : $music_posts->the_post(); 
			?>
                <div class="col-lg-4 col-md-6 cl-sm-12">
                    <div class="ms_weekly_box">
                        <div class="weekly_left">
						   <span class="w_top_no">
                                <?php echo (strlen($i) <2) ? '0'.$i : $i; ?>
                            </span> 
                            <div class="w_top_song">
							  <div class="w_tp_song_img">
                                    <?php the_post_thumbnail( 'thumbnail' ); ?>
                                    <div class="ms_song_overlay">
                                    </div>
                                    <div class="ms_play_icon play_btn play_music" data-musicid="<?php esc_html_e(get_the_id()); ?>" data-musictype="<?php printf($list_type); ?>">
                                        <img src="<?php echo esc_url($play_img); ?>" alt="<?php echo esc_attr('Play', 'miraculous'); ?>">
                                    </div>
                                </div>
                                <div class="w_tp_song_name">
                                    <h3><a href="<?php echo esc_url(get_the_permalink()); ?>"><?php the_title(); ?></a></h3>
                                    <?php $artists_name = array(); $artists_ids = fw_get_db_post_option(get_the_id(), 'music_artists'); 
                                    foreach ($artists_ids as $artists_id) {
                                         $artists_name[] = get_the_title($artists_id);
                                     } ?>
                                    <p><?php echo implode(', ', $artists_name); ?></p>
                                </div>
                            </div>
                        </div>
                        <?php $attach_meta = array(); $music_price = '';
                            $music_extranal_url = get_post_meta(get_the_id(), 'fw_option:music_extranal_url', true);
                            if(!empty($music_extranal_url)):
                                $mpurl = $music_extranal_url;
                            else:
                                $mpurl = get_post_meta(get_the_id(), 'fw_option:mp3_full_songs', true);
                            endif;
                            if(isset($mpurl['attachment_id'])) {
                                $attach_meta = wp_get_attachment_metadata( $mpurl['attachment_id'] );
                            }
                            $image_uri = get_the_post_thumbnail_url ( get_the_id() );
                            if(!empty($miraculous_theme_data['miraculous_layout']) && $miraculous_theme_data['miraculous_layout'] == '2'):
                                $more_img = get_template_directory_uri().'/assets/images/svg/more1.svg';
                            endif;
                            if(function_exists('fw_get_db_post_option')){
                                $music_price_arr = fw_get_db_post_option(get_the_id(), 'music_type_options');
                                if( !empty( $music_price_arr['premium']['single_music_price'] ) ){
                                    $music_price = $music_price_arr['premium']['single_music_price'];
                                }
                            } 
                            ?>
                        <div class="weekly_right">
                            <?php
                            $duration = fw_get_db_post_option(get_the_ID(), 'music_extranal_url');
				            $data_s = get_post_meta( get_the_ID(), 'fb_gal_ids', true );
                            ?>
                            <span class="w_song_time">
                                <?php
                                if(!empty($duration)){
                				echo esc_html($data_s);
                                }
                				else{
                    			echo (isset($attach_meta['length_formatted'])) ? $attach_meta['length_formatted'] : "0.00";
                				}?></span>
                            
                            <span class="ms_more_icon" data-other="1">
                                <img src="<?php echo esc_url($more_img); ?>" alt="<?php echo esc_attr('More', 'miraculous'); ?>">                                
                            </span>
                            <span class="w_song_dwnload ms_download" data-msmusic="<?php echo esc_attr(get_the_id()); ?>">
                                <i class="ms_icon1 dwnload_icon fa fa-download"></i>
                                <?php 
                                if($music_song_dowenload == 'on'):
                                if(function_exists('miraculous_song_dowenload_counter')):
                                  miraculous_song_dowenload_counter(get_the_id());
                                endif;
                                endif;
                                ?>
                            </span>
                            <span class="w_song_dwnload ">
                            <?php
                            if($music_song_view == 'on'):
                            if(function_exists('miraculous_song_view_counter')):
                                miraculous_song_view_counter(get_the_id());
                            endif; 
                            endif;
                            ?>
                            </span>
                        </div>
                        <?php
                        $fav_class = 'icon_fav';
                        if(!empty($fav_music_ids)){
                            if(in_array(get_the_id(), $fav_music_ids) ) {
			                    $fav_class = 'icon_fav_add';
		      	            }
                        }
                        ?>
                        <ul class="more_option">
                            <li><a href="javascript:;" class="favourite_music" data-musicid="<?php echo esc_attr(get_the_id()); ?>"><span class="opt_icon"><span class="icon <?php echo esc_attr($fav_class); ?>">
								<svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 22 22"><g id="_08-5" data-name=" 08-5"><path id="_08-6" data-name=" 08-6" class="cls-1" d="M13.7,4.49a4.34,4.34,0,0,0-2,.48,3.83,3.83,0,0,0-.73.48A3.54,3.54,0,0,0,10.27,5,4.3,4.3,0,0,0,4,8.83a7.6,7.6,0,0,0,2.46,5.05,22.38,22.38,0,0,0,4,3.29l.51.34.52-.34a23.09,23.09,0,0,0,4-3.29A7.63,7.63,0,0,0,18,8.83,4.34,4.34,0,0,0,13.7,4.49ZM8.31,6.36a2.42,2.42,0,0,1,1.94,1l.75,1,.76-1a2.39,2.39,0,0,1,1.94-1,2.45,2.45,0,0,1,2.43,2.47,5.89,5.89,0,0,1-1.95,3.78A20.15,20.15,0,0,1,11,15.26a20.07,20.07,0,0,1-3.17-2.65A5.89,5.89,0,0,1,5.88,8.83,2.45,2.45,0,0,1,8.31,6.36Z"/></g></svg>
							</span></span><?php esc_html_e('Favourites', 'miraculous'); ?></a></li>
                            <li><a href="javascript:;" class="add_to_queue" data-musicid="<?php esc_attr_e(get_the_id()); ?>" data-musictype="<?php printf($list_type); ?>"><span class="opt_icon"><span class="icon icon_queue">
								<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
										<path fill-rule="evenodd" d="M11.359,5.172 L6.847,5.172 L6.847,0.660 C6.847,0.455 6.568,0.009 6.010,0.009 C5.452,0.009 5.172,0.455 5.172,0.660 L5.172,5.172 L0.661,5.172 C0.455,5.172 0.010,5.451 0.010,6.009 C0.010,6.567 0.455,6.846 0.661,6.846 L5.173,6.846 L5.173,11.358 C5.173,11.563 5.452,12.009 6.010,12.009 C6.568,12.009 6.847,11.563 6.847,11.358 L6.847,6.846 L11.359,6.846 C11.564,6.846 12.010,6.567 12.010,6.009 C12.010,5.451 11.564,5.172 11.359,5.172 Z"/>
										</svg>
							</span></span><?php esc_html_e('Add To Queue', 'miraculous'); ?></a></li>
                            <li><a href="javascript:;" class="ms_download" data-msmusic="<?php echo esc_attr(get_the_id()); ?>"><span class="opt_icon"><span class="icon icon_dwn">
								<svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 22 22"><g id="_06-4" data-name=" 06-4"><path id="_06-5" data-name=" 06-5" class="cls-1" d="M10.65,13.85a.48.48,0,0,0,.7,0l3.27-3.5a.41.41,0,0,0,.07-.47.48.48,0,0,0-.42-.26H12.4V4.94a.46.46,0,0,0-.47-.44H10.07a.46.46,0,0,0-.47.44V9.63H7.73a.44.44,0,0,0-.42.25.41.41,0,0,0,.07.47Zm5.48-.73v2.63H5.87V13.12H4v3.5a.9.9,0,0,0,.93.88H17.07a.9.9,0,0,0,.93-.88v-3.5Z"/></g></svg>
							</span></span><?php esc_html_e('Download Now', 'miraculous'); ?></a></li>
                            <li><a href="javascript:;" class="ms_add_playlist" data-msmusic="<?php echo esc_attr(get_the_id()); ?>"><span class="opt_icon"><span class="icon icon_playlst">
								<svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 22 22"><g id="_03-2" data-name=" 03-2"><path id="_03-3" data-name=" 03-3" class="cls-1" d="M13,5.5H3.5V7.07H13V5.5Zm0,3.14H3.5v1.57H13V8.64ZM3.5,13.36H9.82V11.79H3.5ZM14.55,5.5v6.43a2.35,2.35,0,1,0,1.58,2.21V7.07H18.5V5.5Z"/></g></svg>
							</span></span><?php esc_html_e('Add To Playlist', 'miraculous'); ?></a></li>
                            <li><a href="javascript:;" class="ms_share_music" data-shareuri="<?php esc_attr_e(get_the_permalink()); ?>" data-sharename="<?php the_title_attribute(); ?>"><span class="opt_icon"><span class="icon icon_share">
								<svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 22 22"><g id="_14-2" data-name=" 14-2"><path id="_13" data-name=" 13" class="cls-1" d="M8.68,13.18A2.78,2.78,0,0,1,4.77,13l-.07-.08a3,3,0,0,1,0-3.85,2.77,2.77,0,0,1,3.89-.36.52.52,0,0,1,.11.1l3-2.11.09-.06a1.09,1.09,0,0,0,.63-1.08A2.76,2.76,0,0,1,15.05,3,2.84,2.84,0,0,1,17.9,5.22a3,3,0,0,1-1.36,3.22,2.72,2.72,0,0,1-3.34-.5l-.27-.3C11.81,8.41,10.7,9.18,9.6,10a.37.37,0,0,0-.09.28q0,.75,0,1.5a.51.51,0,0,0,.13.34c1.08.77,2.18,1.52,3.3,2.3a2.89,2.89,0,0,1,1.76-1.15A2.83,2.83,0,0,1,18,15.56h0A2.92,2.92,0,0,1,15.72,19a2.82,2.82,0,0,1-3.28-2.28,3.33,3.33,0,0,1,0-.63.55.55,0,0,0-.16-.38ZM6.82,9.55a1.45,1.45,0,0,0,0,2.9,1.45,1.45,0,0,0,0-2.9ZM15.2,7.36a1.43,1.43,0,0,0,1.39-1.45h0A1.4,1.4,0,1,0,15.2,7.36Zm0,7.29a1.42,1.42,0,0,0-1.4,1.43h0a1.4,1.4,0,0,0,1.44,1.36,1.4,1.4,0,0,0,0-2.8Z"/></g></svg>
							</span></span><?php esc_html_e('Share', 'miraculous'); ?></a></li>
                        </ul>
                    </div>
                    <?php if($rm == 0){
                        if($i > $n-3){
                            
                        }else{
                            echo '<div class="ms_divider"></div>';
                        }
                        }elseif($rm == 2 && $i > $n-2){
                            
                        }elseif($rm == 1 && $i > $n-1){
                            
                        }else{
                            echo '<div class="ms_divider"></div>';
                        }
                    ?>
                </div>
            <?php $i++;
			endwhile; 
            wp_reset_postdata(); ?>
        </div>
    </div>
</div>
<?php endif; 
if( $sg_style == 'abstyle4' ): ?>
<!-- New Releases Section Start -->
<div class="ms_releases_wrapper">
    <div class="ms_heading">
        <h1><?php echo esc_html( $sg_label ); ?></h1>
    </div>
    <div class="ms_release_slider swiper-container">
        <div class="ms_divider"></div>
        <div class="swiper-wrapper">
            <?php while ( $music_posts->have_posts() ) : $music_posts->the_post(); ?>
                <div class="swiper-slide">
                    <div class="ms_release_box">
                        <div class="w_top_song">
                            <span class="slider_dot"></span>
                            <div class="w_tp_song_img">
                                <?php the_post_thumbnail( 'thumbnail' ); ?>
                                <div class="ms_song_overlay">
                                </div>
                                <div class="ms_play_icon play_btn play_music" data-musicid="<?php esc_attr_e(get_the_id()); ?>" data-musictype="<?php printf($list_type); ?>">
                                    <img src="<?php echo esc_url($play_img); ?>" alt="<?php echo esc_attr('play', 'miraculous'); ?>">
                                </div>
                            </div>
                            <div class="w_tp_song_name">
                                <h3><a href="<?php echo esc_url(get_the_permalink()); ?>"><?php the_title(); ?></a></h3>
                                <?php $artists_name = array(); $artists_ids = fw_get_db_post_option(get_the_id(), 'music_artists'); 
                                foreach ($artists_ids as $artists_id) {
                                     $artists_name[] = get_the_title($artists_id);
                                 } ?>
                                <p><?php echo implode(', ', $artists_name); ?></p>
                            </div>
                        </div>
                        <?php $attach_meta = array();
                            $music_extranal_url = get_post_meta(get_the_id(), 'fw_option:music_extranal_url', true);
                            if(!empty($music_extranal_url)):
                                $mpurl = $music_extranal_url;
                            else:
                                $mpurl = get_post_meta(get_the_id(), 'fw_option:mp3_full_songs', true);
                            endif;
                            if(isset($mpurl['attachment_id'])) {
                                $attach_meta = wp_get_attachment_metadata( $mpurl['attachment_id'] );
                            }
                            ?>
                        <div class="weekly_right">
                            <span class="w_song_time"><?php echo (isset($attach_meta['length_formatted'])) ? $attach_meta['length_formatted'] : "0.00"; ?></span>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
            <?php wp_reset_postdata(); ?>
        </div>
    </div>
    <!-- Add Arrows -->
    <div class="swiper-button-next2 swiper-button-next-elementor" tabindex="0" role="button" aria-label="<?php esc_attr_e('Next slide','miraculous'); ?>">
	    <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" width="512" height="512" x="0" y="0" viewBox="0 0 128 128" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><path xmlns="http://www.w3.org/2000/svg" id="Down_Arrow_3_" d="m64 88c-1.023 0-2.047-.391-2.828-1.172l-40-40c-1.563-1.563-1.563-4.094 0-5.656s4.094-1.563 5.656 0l37.172 37.172 37.172-37.172c1.563-1.563 4.094-1.563 5.656 0s1.563 4.094 0 5.656l-40 40c-.781.781-1.805 1.172-2.828 1.172z" data-original="#000000" class=""></path></g></svg>
	</div>

	<div class="swiper-button-prev2 swiper-button-prev-elementor" tabindex="0" role="button" aria-label="<?php esc_attr_e('Previous slide','miraculous'); ?>">
    	<svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" width="512" height="512" x="0" y="0" viewBox="0 0 128 128" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><path xmlns="http://www.w3.org/2000/svg" id="Down_Arrow_3_" d="m64 88c-1.023 0-2.047-.391-2.828-1.172l-40-40c-1.563-1.563-1.563-4.094 0-5.656s4.094-1.563 5.656 0l37.172 37.172 37.172-37.172c1.563-1.563 4.094-1.563 5.656 0s1.563 4.094 0 5.656l-40 40c-.781.781-1.805 1.172-2.828 1.172z" data-original="#000000" class=""></path></g></svg>
	</div>
</div>
<?php endif; 
if( $sg_style == 'abstyle6' ): ?>
    <h2 class="music_listwrap_tttl"><?php echo esc_html( $sg_label ); ?></h2>
    <div class="music_listwrap">
        <div class="ms_songslist_box">
            <ul class="ms_songlist">
                <?php 
                $i=1; 
                while ( $music_posts->have_posts() ) : $music_posts->the_post();
                ?>
                <li>
                    <div class="ms_songslist_inner">
                        <div class="ms_songslist_left">
                            <div class="songslist_number play_btn play_music" data-musicid="<?php esc_html_e(get_the_id()); ?>" data-musictype="<?php printf($list_type); ?>">
                                <h4 class="songslist_sn"><?php echo (strlen($i) <2) ? '0'.$i : $i; ?></h4>
                                <span class="songslist_play"><img src="<?php echo plugin_dir_url( __FILE__ ); ?>/play_songlist.svg" alt="Play" class="img-fluid"/></span>
                            </div> 
                            <div class="songslist_details">
                                <div class="songslist_thumb">
                                    <?php the_post_thumbnail( 'large' ); ?>
                                </div>
                                <div class="songslist_name">
                                    
                                    <h3 class="song_name"><a href="<?php echo esc_url(get_the_permalink()); ?>"><?php the_title(); ?></a></h3>
                                    <?php $artists_name = array(); $artists_ids = fw_get_db_post_option(get_the_id(), 'music_artists'); 
                                    foreach ($artists_ids as $artists_id) {
                                         $artists_name[] = get_the_title($artists_id);
                                     } ?>
                                    <p class="song_artist"><?php echo implode(', ', $artists_name); ?></p>
                                </div> 
                            </div> 
                        </div>
                        <div class="ms_songslist_right">
                            <span class="ms_songslist_like">
                                <?php
                                    $fav_class = 'icon_fav';
                                    if(!empty($fav_music_ids)){
                                       if(in_array(get_the_id(), $fav_music_ids) ) {
                                            $fav_class = 'icon_fav_add';
                                          }
                                    }
                                ?>
                                <a href="javascript:;" class="favourite_music" data-musicid="<?php echo esc_attr(get_the_id()); ?>">
                                    <span class="opt_icon"><span class="icon <?php echo esc_attr($fav_class); ?>"><svg xmlns:xlink="http://www.w3.org/1999/xlink" width="17px" height="16px"><path fill-rule="evenodd" d="M11.777,-0.000 C10.940,-0.000 10.139,0.197 9.395,0.585 C9.080,0.749 8.783,0.947 8.506,1.173 C8.230,0.947 7.931,0.749 7.618,0.585 C6.874,0.197 6.073,-0.000 5.236,-0.000 C2.354,-0.000 0.009,2.394 0.009,5.337 C0.009,7.335 1.010,9.428 2.986,11.557 C4.579,13.272 6.527,14.702 7.881,15.599 L8.506,16.012 L9.132,15.599 C10.487,14.701 12.436,13.270 14.027,11.557 C16.002,9.428 17.004,7.335 17.004,5.337 C17.004,2.394 14.659,-0.000 11.777,-0.000 ZM5.236,2.296 C6.168,2.296 7.027,2.738 7.590,3.507 L8.506,4.754 L9.423,3.505 C9.986,2.737 10.844,2.296 11.777,2.296 C13.403,2.296 14.727,3.660 14.727,5.337 C14.727,6.734 13.932,8.298 12.364,9.986 C11.114,11.332 9.604,12.490 8.506,13.255 C7.409,12.490 5.899,11.332 4.649,9.986 C3.081,8.298 2.286,6.734 2.286,5.337 C2.286,3.660 3.610,2.296 5.236,2.296 Z"/></svg></span>
                                    </span>
                                </a>
                            </span>
                            <?php $attach_meta = array();
                                $music_extranal_url = get_post_meta(get_the_id(), 'fw_option:music_extranal_url', true);
                                if(!empty($music_extranal_url)):
                                    $mpurl = $music_extranal_url;
                                else:
                                    $mpurl = get_post_meta(get_the_id(), 'fw_option:mp3_full_songs', true);
                                    if($mpurl) {
                                        $attach_meta = wp_get_attachment_metadata( $mpurl['attachment_id'] );
                                    }
                                endif;
                            ?>
                            <span class="ms_songslist_time"><?php echo (isset($attach_meta['length_formatted'])) ? $attach_meta['length_formatted'] : "0.00"; ?></span>
                            <div class="ms_songslist_more">
                                <span class="songslist_moreicon"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><path fill-rule="evenodd" d="M2.000,12.000 C0.895,12.000 -0.000,11.105 -0.000,10.000 C-0.000,8.895 0.895,8.000 2.000,8.000 C3.104,8.000 4.000,8.895 4.000,10.000 C4.000,11.105 3.104,12.000 2.000,12.000 ZM2.000,4.000 C0.895,4.000 -0.000,3.105 -0.000,2.000 C-0.000,0.895 0.895,-0.000 2.000,-0.000 C3.104,-0.000 4.000,0.895 4.000,2.000 C4.000,3.105 3.104,4.000 2.000,4.000 ZM2.000,16.000 C3.104,16.000 4.000,16.895 4.000,18.000 C4.000,19.105 3.104,20.000 2.000,20.000 C0.895,20.000 -0.000,19.105 -0.000,18.000 C-0.000,16.895 0.895,16.000 2.000,16.000 Z"/></svg></span>
                                <ul class="ms_common_dropdown ms_songslist_dropdown">
                                    <li>
                                        <a href="javascript:;" class="favourite_music" data-musicid="<?php echo esc_attr(get_the_id()); ?>">
                                            <span class="common_drop_icon drop_fav"><span class="icon <?php echo esc_attr($fav_class); ?>">
                                                <svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 22 22"><g id="_08-5" data-name=" 08-5"><path id="_08-6" data-name=" 08-6" class="cls-1" d="M13.7,4.49a4.34,4.34,0,0,0-2,.48,3.83,3.83,0,0,0-.73.48A3.54,3.54,0,0,0,10.27,5,4.3,4.3,0,0,0,4,8.83a7.6,7.6,0,0,0,2.46,5.05,22.38,22.38,0,0,0,4,3.29l.51.34.52-.34a23.09,23.09,0,0,0,4-3.29A7.63,7.63,0,0,0,18,8.83,4.34,4.34,0,0,0,13.7,4.49ZM8.31,6.36a2.42,2.42,0,0,1,1.94,1l.75,1,.76-1a2.39,2.39,0,0,1,1.94-1,2.45,2.45,0,0,1,2.43,2.47,5.89,5.89,0,0,1-1.95,3.78A20.15,20.15,0,0,1,11,15.26a20.07,20.07,0,0,1-3.17-2.65A5.89,5.89,0,0,1,5.88,8.83,2.45,2.45,0,0,1,8.31,6.36Z"></path></g></svg>
                                            </span></span><?php esc_html_e('Favourites', 'miraculous'); ?></a>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;" class="ms_download" data-msmusic="<?php echo esc_attr(get_the_id()); ?>">
                                            <span class="common_drop_icon drop_downld">
                                                <svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 22 22"><g id="_06-4" data-name=" 06-4"><path id="_06-5" data-name=" 06-5" class="cls-1" d="M10.65,13.85a.48.48,0,0,0,.7,0l3.27-3.5a.41.41,0,0,0,.07-.47.48.48,0,0,0-.42-.26H12.4V4.94a.46.46,0,0,0-.47-.44H10.07a.46.46,0,0,0-.47.44V9.63H7.73a.44.44,0,0,0-.42.25.41.41,0,0,0,.07.47Zm5.48-.73v2.63H5.87V13.12H4v3.5a.9.9,0,0,0,.93.88H17.07a.9.9,0,0,0,.93-.88v-3.5Z"></path></g></svg>
                                            </span><?php esc_html_e('Download Now', 'miraculous'); ?>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;" class="ms_add_playlist" data-msmusic="<?php echo esc_attr(get_the_id()); ?>">
                                            <span class="common_drop_icon drop_playlist">
                                                <svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 22 22"><g id="_03-2" data-name=" 03-2"><path id="_03-3" data-name=" 03-3" class="cls-1" d="M13,5.5H3.5V7.07H13V5.5Zm0,3.14H3.5v1.57H13V8.64ZM3.5,13.36H9.82V11.79H3.5ZM14.55,5.5v6.43a2.35,2.35,0,1,0,1.58,2.21V7.07H18.5V5.5Z"></path></g></svg>
                                            </span><?php esc_html_e('Add To Playlist', 'miraculous'); ?>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;" class="ms_share_music" data-shareuri="<?php esc_attr_e(get_the_permalink()); ?>" data-sharename="<?php the_title_attribute(); ?>">
                                            <span class="common_drop_icon drop_share">
                                                <svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 22 22"><g id="_14-2" data-name=" 14-2"><path id="_13" data-name=" 13" class="cls-1" d="M8.68,13.18A2.78,2.78,0,0,1,4.77,13l-.07-.08a3,3,0,0,1,0-3.85,2.77,2.77,0,0,1,3.89-.36.52.52,0,0,1,.11.1l3-2.11.09-.06a1.09,1.09,0,0,0,.63-1.08A2.76,2.76,0,0,1,15.05,3,2.84,2.84,0,0,1,17.9,5.22a3,3,0,0,1-1.36,3.22,2.72,2.72,0,0,1-3.34-.5l-.27-.3C11.81,8.41,10.7,9.18,9.6,10a.37.37,0,0,0-.09.28q0,.75,0,1.5a.51.51,0,0,0,.13.34c1.08.77,2.18,1.52,3.3,2.3a2.89,2.89,0,0,1,1.76-1.15A2.83,2.83,0,0,1,18,15.56h0A2.92,2.92,0,0,1,15.72,19a2.82,2.82,0,0,1-3.28-2.28,3.33,3.33,0,0,1,0-.63.55.55,0,0,0-.16-.38ZM6.82,9.55a1.45,1.45,0,0,0,0,2.9,1.45,1.45,0,0,0,0-2.9ZM15.2,7.36a1.43,1.43,0,0,0,1.39-1.45h0A1.4,1.4,0,1,0,15.2,7.36Zm0,7.29a1.42,1.42,0,0,0-1.4,1.43h0a1.4,1.4,0,0,0,1.44,1.36,1.4,1.4,0,0,0,0-2.8Z"></path></g></svg>
                                            </span><?php esc_html_e('Share', 'miraculous'); ?>
                                        </a>
                                     </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </li>
                <?php $i++; endwhile; ?>
                <?php wp_reset_postdata(); ?>
            </ul>
        </div>
    </div>
<?php endif;
endif; ?>