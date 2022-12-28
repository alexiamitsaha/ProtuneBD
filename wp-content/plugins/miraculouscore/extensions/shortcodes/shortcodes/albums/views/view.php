<?php if (!defined('FW')) die('Forbidden');
$ar_label = '';
if(!empty($atts['albums_label'])):
  $ar_label = $atts['albums_label'];
endif;
$ar_style = 'abstyle1';
if(!empty($atts['albums_style'])):
  $ar_style = $atts['albums_style'];
endif;
$ar_type = '';
if(!empty($atts['albums_type'])):
  $ar_type = $atts['albums_type'];
endif;
$ar_number = 12;
if(!empty($atts['albums_number'])):
  $ar_number = $atts['albums_number'];
endif;

$albums_par_slide = '';
if(!empty($atts['albums_par_slide'])):
  $albums_par_slide = $atts['albums_par_slide'];
endif;
$musictype = 'album';
$list_type = 'music';
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
$fav_album_ids = ''; 
if($user_id){
    $fav_album_ids = get_user_meta($user_id, 'favourites_albums_lists'.$user_id, true);
}
$play_icon = get_template_directory_uri().'/assets/images/svg/play.svg';
$more_icon = get_template_directory_uri().'/assets/images/svg/more.svg';
if( is_user_logged_in() && $lang_data ){

    $ar_args = array('post_type' => 'ms-albums',
                'posts_per_page' => $ar_number,
                'meta_key' => 'fw_option:album_type',
                'tax_query' => array(
                        array(
                            'taxonomy' => 'album-type',
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

    $ar_args = array('post_type' => 'ms-albums',
                'posts_per_page' => $ar_number,
                'meta_key' => 'fw_option:album_type',
                'tax_query' => array(
                        array(
                            'taxonomy' => 'album-type',
                            'terms' => $ar_type
                        ),
                        array(
                            'taxonomy' => 'language',
                            'terms' => $lang_data
                        )
                    )
                );
}else{
    $ar_args = array('post_type' => 'ms-albums',
                'posts_per_page' => $ar_number,
                'meta_key' => 'fw_option:album_type',
                'tax_query' => array(
                        array(
                            'taxonomy' => 'album-type',
                            'terms' => $ar_type
                        )
                    )
                );
}

$album_posts = new WP_Query( $ar_args );

if( $album_posts->have_posts() ): 
$slidermeta = array('per_view' => $albums_par_slide);
    if( $ar_style == 'abstyle1' ): ?>
        <div class="ms_fea_album_slider">
            <div class="ms_heading">
                <h1><?php echo esc_html( $ar_label ); ?></h1> 
            </div>
            <div class="ms_relative_inner">
                <div class="ms_slider<?php esc_attr_e($ar_type); ?> swiper-container swiper-container-horizontal" data-blogmeta="<?php echo esc_attr(json_encode($slidermeta))?>" data-type="<?php esc_attr_e($ar_type); ?>">
                    <div class="swiper-wrapper">
                        <?php $i=0;
						while ( $album_posts->have_posts() ) : $album_posts->the_post(); ?>
                        <div class="swiper-slide<?php echo ($i==0) ? ' swiper-slide-active' : '';?>" data-swiper-slide-index="<?php echo _e($i); ?>">
                                <div class="ms_rcnt_box">
                                    <div class="ms_rcnt_box_img">
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
                                    <div class="ms_rcnt_box_text">
                                        <h3><a href="<?php echo esc_url(get_the_permalink()); ?>">
                                        <?php the_title(); ?></a></h3>
                                        <?php
                                        $artists_name = array(); 
                                        $artists_ids = fw_get_db_post_option(get_the_id(), 'album_artists'); 
                                        foreach ($artists_ids as $artists_id) {
                                             $artists_name[] = get_the_title($artists_id);
                                         } ?>
                                        <p><?php echo implode(', ', $artists_name); ?></p>
                                    </div>
                                </div>
                            </div>
                         <?php 
                         $i++;
                         endwhile;
                         wp_reset_postdata();
                         ?>
                    </div>
                    <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
                    <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
                 </div>
                  
                <div class="swiper-button-next swiper-button-next-elementor" tabindex="0" role="button" aria-label="<?php esc_attr_e('Next slide','miraculous'); ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" width="512" height="512" x="0" y="0" viewBox="0 0 128 128" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><path xmlns="http://www.w3.org/2000/svg" id="Down_Arrow_3_" d="m64 88c-1.023 0-2.047-.391-2.828-1.172l-40-40c-1.563-1.563-1.563-4.094 0-5.656s4.094-1.563 5.656 0l37.172 37.172 37.172-37.172c1.563-1.563 4.094-1.563 5.656 0s1.563 4.094 0 5.656l-40 40c-.781.781-1.805 1.172-2.828 1.172z" data-original="#000000" class=""></path></g></svg>
                </div>
                <div class="swiper-button-prev swiper-button-prev-elementor" tabindex="0" role="button" aria-label="<?php esc_attr_e('Previous slide','miraculous'); ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" width="512" height="512" x="0" y="0" viewBox="0 0 128 128" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><path xmlns="http://www.w3.org/2000/svg" id="Down_Arrow_3_" d="m64 88c-1.023 0-2.047-.391-2.828-1.172l-40-40c-1.563-1.563-1.563-4.094 0-5.656s4.094-1.563 5.656 0l37.172 37.172 37.172-37.172c1.563-1.563 4.094-1.563 5.656 0s1.563 4.094 0 5.656l-40 40c-.781.781-1.805 1.172-2.828 1.172z" data-original="#000000" class=""></path></g></svg>
                </div>
            </div>
        </div>
    <?php endif;

    if( $ar_style == 'abstyle2' ): ?>
        <div class="ms_top_artist">
            <div class="container-fluid">
                <div class="row">
                <?php if(!empty($ar_label)): ?>
                    <div class="col-lg-12">
                        <div class="ms_heading">
                          <h1><?php echo esc_html($ar_label); ?></h1>
                        </div>
                    </div>
                <?php endif;
                     while ( $album_posts->have_posts() ) : $album_posts->the_post(); ?>
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
                                    <?php $artists_name = array(); $artists_ids = fw_get_db_post_option(get_the_id(), 'album_artists'); 
                                    foreach ($artists_ids as $artists_id) {
                                         $artists_name[] = get_the_title($artists_id);
                                     } ?>
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

    if( $ar_style == 'abstyle3' ): ?>
        <div class="ms_weekly_wrapper">
                    <div class="ms_weekly_inner">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="ms_heading">
                                    <h1><?php echo esc_html($ar_label); ?></h1>
                                </div>
                            </div>
                        <?php $i=1; $n = $album_posts->found_posts; $rm = $n%3;
                        if(!empty($miraculous_theme_data['miraculous_layout']) && $miraculous_theme_data['miraculous_layout'] == '2'):
                            $more_icon = get_template_directory_uri().'/assets/images/svg/more1.svg';
                        endif;
                        while ( $album_posts->have_posts() ) : $album_posts->the_post(); 
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
                                                    <div class="ms_song_overlay"></div>
                                                    <?php if(!empty($play_icon)): ?>
                                                    <div class="ms_play_icon play_btn play_music" data-musicid="<?php esc_html_e(get_the_id()); ?>" data-musictype="<?php printf($musictype); ?>">
                                                        <img src="<?php echo esc_url($play_icon); ?>" alt="<?php esc_attr_e('play image','miraculous');?>">
                                                    </div>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="w_tp_song_name">
                                                    <h3><a href="<?php esc_url(the_permalink()); ?>"><?php the_title(); ?></a></h3>
                                                    <?php $artists_name = array(); $artists_ids = fw_get_db_post_option(get_the_id(), 'album_artists'); 
                                                    foreach ($artists_ids as $artists_id) {
                                                         $artists_name[] = get_the_title($artists_id);
                                                     } ?>
                                                    <p><?php echo implode(', ', $artists_name); ?></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="weekly_right">
                                            <span class="w_song_time">
                                            <?php if(function_exists('miraculous_total_album_length')){
                                                miraculous_total_album_length(get_the_id());
                                            } ?></span>
                                            <?php if(!empty($more_icon)): ?>
                                                <span class="ms_more_icon" data-other="1">
                                                    <img src="<?php echo esc_url($more_icon); ?>" alt="<?php esc_attr_e('more image','miraculous');?>">
                                                </span>
                                            <?php endif; ?>
                                        </div> 
                                        <?php
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
                                              <a href="javascript:;" class="add_to_queue" data-musicid="<?php esc_html_e(get_the_id()); ?>" data-musictype="<?php printf($musictype); ?>"><span class="opt_icon"><span class="icon icon_queue">
											  <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
															<path fill-rule="evenodd" d="M11.359,5.172 L6.847,5.172 L6.847,0.660 C6.847,0.455 6.568,0.009 6.010,0.009 C5.452,0.009 5.172,0.455 5.172,0.660 L5.172,5.172 L0.661,5.172 C0.455,5.172 0.010,5.451 0.010,6.009 C0.010,6.567 0.455,6.846 0.661,6.846 L5.173,6.846 L5.173,11.358 C5.173,11.563 5.452,12.009 6.010,12.009 C6.568,12.009 6.847,11.563 6.847,11.358 L6.847,6.846 L11.359,6.846 C11.564,6.846 12.010,6.567 12.010,6.009 C12.010,5.451 11.564,5.172 11.359,5.172 Z"/>
														</svg>
											  </span></span><?php esc_html_e('Add To Queue','miraculous'); ?>
                                              </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;" class="ms_share_music" data-shareuri="<?php esc_attr_e(get_the_permalink()); ?>" data-sharename="<?php the_title_attribute(); ?>">
                                                    <span class="opt_icon">
                                                     <span class="icon icon_share">
														<svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 22 22"><g id="_14-2" data-name=" 14-2"><path id="_13" data-name=" 13" class="cls-1" d="M8.68,13.18A2.78,2.78,0,0,1,4.77,13l-.07-.08a3,3,0,0,1,0-3.85,2.77,2.77,0,0,1,3.89-.36.52.52,0,0,1,.11.1l3-2.11.09-.06a1.09,1.09,0,0,0,.63-1.08A2.76,2.76,0,0,1,15.05,3,2.84,2.84,0,0,1,17.9,5.22a3,3,0,0,1-1.36,3.22,2.72,2.72,0,0,1-3.34-.5l-.27-.3C11.81,8.41,10.7,9.18,9.6,10a.37.37,0,0,0-.09.28q0,.75,0,1.5a.51.51,0,0,0,.13.34c1.08.77,2.18,1.52,3.3,2.3a2.89,2.89,0,0,1,1.76-1.15A2.83,2.83,0,0,1,18,15.56h0A2.92,2.92,0,0,1,15.72,19a2.82,2.82,0,0,1-3.28-2.28,3.33,3.33,0,0,1,0-.63.55.55,0,0,0-.16-.38ZM6.82,9.55a1.45,1.45,0,0,0,0,2.9,1.45,1.45,0,0,0,0-2.9ZM15.2,7.36a1.43,1.43,0,0,0,1.39-1.45h0A1.4,1.4,0,1,0,15.2,7.36Zm0,7.29a1.42,1.42,0,0,0-1.4,1.43h0a1.4,1.4,0,0,0,1.44,1.36,1.4,1.4,0,0,0,0-2.8Z"/></g></svg>
													 </span>
                                                    </span>
                                                    <?php esc_html_e('Share','miraculous'); ?>
                                                </a>
                                            </li>
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
                             <?php 
                              $i++; 
                              endwhile;
                              wp_reset_postdata();
                            ?>
                        </div>
                    </div>
                </div>
    <?php endif;
   if( $ar_style == 'abstyle4' ): ?>
        <div class="ms_releases_wrapper">
            <div class="ms_heading">
                <h1><?php echo esc_html($ar_label); ?></h1>
                <span class="veiw_all">
                </span>
            </div>
            <div class="ms_release_slider swiper-container swiper-container-horizontal" data-blogmeta="<?php echo esc_attr(json_encode($slidermeta))?>">
                <div class="ms_divider"></div>
                <div class="swiper-wrapper">
                    <?php while ( $album_posts->have_posts() ) : $album_posts->the_post(); ?>
                        <div class="swiper-slide">
                            <div class="ms_release_box">
                                <div class="w_top_song">
                                    <span class="slider_dot"></span>
                                    <div class="w_tp_song_img">
                                        <?php the_post_thumbnail( 'thumbnail' ); ?>
                                        <div class="ms_song_overlay"></div>
                                        <?php if(!empty($play_icon)): ?>
                                            <div class="ms_play_icon play_btn play_music" data-musicid="<?php esc_html_e(get_the_id()); ?>" data-musictype="<?php printf($musictype); ?>">
                                                <img src="<?php echo esc_url($play_icon); ?>" alt="<?php esc_attr_e('play icone','miraculous'); ?>">
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="w_tp_song_name">
                                        <h3>
										<a href="<?php echo esc_url(get_the_permalink()); ?>">
                                        <?php the_title(); ?></a>
                                        </h3>
                                        <?php 
                                        $artists_name = array();
                                        $artists_ids = fw_get_db_post_option(get_the_id(), 'album_artists'); 
                                        foreach ($artists_ids as $artists_id) {
                                             $artists_name[] = get_the_title($artists_id);
                                         } 
                                        ?>
                                        <p><?php echo implode(', ', $artists_name); ?></p>
                                    </div>
                                </div>
                                <div class="weekly_right">
                                    <span class="w_song_time"><?php if(function_exists('miraculous_total_album_length')){
                                        echo miraculous_total_album_length(get_the_id());
                                    } ?></span>
                                </div>
                            </div>
                        </div>
                     <?php 
                     endwhile;
                     wp_reset_postdata();
                    ?>
                </div>
            </div>
            <div class="swiper-button-next2 swiper-button-next-elementor" tabindex="0" role="button" aria-label="<?php esc_attr_e('Next slide','miraculous'); ?>">
        	    <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" width="512" height="512" x="0" y="0" viewBox="0 0 128 128" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><path xmlns="http://www.w3.org/2000/svg" id="Down_Arrow_3_" d="m64 88c-1.023 0-2.047-.391-2.828-1.172l-40-40c-1.563-1.563-1.563-4.094 0-5.656s4.094-1.563 5.656 0l37.172 37.172 37.172-37.172c1.563-1.563 4.094-1.563 5.656 0s1.563 4.094 0 5.656l-40 40c-.781.781-1.805 1.172-2.828 1.172z" data-original="#000000" class=""></path></g></svg>
        	</div>
        
        	<div class="swiper-button-prev2 swiper-button-prev-elementor" tabindex="0" role="button" aria-label="<?php esc_attr_e('Previous slide','miraculous'); ?>">
            	<svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" width="512" height="512" x="0" y="0" viewBox="0 0 128 128" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><path xmlns="http://www.w3.org/2000/svg" id="Down_Arrow_3_" d="m64 88c-1.023 0-2.047-.391-2.828-1.172l-40-40c-1.563-1.563-1.563-4.094 0-5.656s4.094-1.563 5.656 0l37.172 37.172 37.172-37.172c1.563-1.563 4.094-1.563 5.656 0s1.563 4.094 0 5.656l-40 40c-.781.781-1.805 1.172-2.828 1.172z" data-original="#000000" class=""></path></g></svg>
        	</div>
        </div>
    <?php endif;
    if( $ar_style == 'abstyle5' ): ?>
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
                        <div class="ms_artist_innerslider ">  
                            <div class="ms_slider<?php esc_attr_e($ar_type); ?> swiper-container swiper-container-horizontal" data-blogmeta="<?php echo esc_attr(json_encode($slidermeta))?>" data-type="<?php esc_attr_e($ar_type); ?>">
                                <div class="swiper-wrapper">
                                    <?php $i=0;
						                while ( $album_posts->have_posts() ) : $album_posts->the_post(); ?>
                                    <div class="swiper-slide">
                                        <div class="slider_cbox slider_artist_box text-center">
                                            <div class="slider_cimgbox slider_artist_imgbox">
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
                                                    <svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 22 22"><g id="_08-5" data-name=" 08-5"><path id="_08-6" data-name=" 08-6" class="cls-1" d="M13.7,4.49a4.34,4.34,0,0,0-2,.48,3.83,3.83,0,0,0-.73.48A3.54,3.54,0,0,0,10.27,5,4.3,4.3,0,0,0,4,8.83a7.6,7.6,0,0,0,2.46,5.05,22.38,22.38,0,0,0,4,3.29l.51.34.52-.34a23.09,23.09,0,0,0,4-3.29A7.63,7.63,0,0,0,18,8.83,4.34,4.34,0,0,0,13.7,4.49ZM8.31,6.36a2.42,2.42,0,0,1,1.94,1l.75,1,.76-1a2.39,2.39,0,0,1,1.94-1,2.45,2.45,0,0,1,2.43,2.47,5.89,5.89,0,0,1-1.95,3.78A20.15,20.15,0,0,1,11,15.26a20.07,20.07,0,0,1-3.17-2.65A5.89,5.89,0,0,1,5.88,8.83,2.45,2.45,0,0,1,8.31,6.36Z"></path></g></svg>
                                                </span></span>
                                                <?php esc_html_e('Favourites','miraculous'); ?></a>
                                            </li>
                                            <li> 
                                               <a href="javascript:;" class="add_to_queue" data-musicid="<?php esc_html_e(get_the_id()); ?>" data-musictype="<?php printf($musictype); ?>"><span class="opt_icon"><span class="icon icon_queue">
                                                   <svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 22 22"><g id="_03-2" data-name=" 03-2"><path id="_03-3" data-name=" 03-3" class="cls-1" d="M13,5.5H3.5V7.07H13V5.5Zm0,3.14H3.5v1.57H13V8.64ZM3.5,13.36H9.82V11.79H3.5ZM14.55,5.5v6.43a2.35,2.35,0,1,0,1.58,2.21V7.07H18.5V5.5Z"></path></g></svg>
                                               </span></span><?php esc_html_e('Add To Queue','miraculous'); ?></a> 
                                            </li>
                                            <li>
                                              <a href="javascript:;" class="ms_share_music" data-shareuri="<?php esc_attr_e(get_the_permalink()); ?>" data-sharename="<?php the_title_attribute(); ?>"><span class="opt_icon"><span class="icon icon_share">
                                                  <svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 22 22"><g id="_14-2" data-name=" 14-2"><path id="_13" data-name=" 13" class="cls-1" d="M8.68,13.18A2.78,2.78,0,0,1,4.77,13l-.07-.08a3,3,0,0,1,0-3.85,2.77,2.77,0,0,1,3.89-.36.52.52,0,0,1,.11.1l3-2.11.09-.06a1.09,1.09,0,0,0,.63-1.08A2.76,2.76,0,0,1,15.05,3,2.84,2.84,0,0,1,17.9,5.22a3,3,0,0,1-1.36,3.22,2.72,2.72,0,0,1-3.34-.5l-.27-.3C11.81,8.41,10.7,9.18,9.6,10a.37.37,0,0,0-.09.28q0,.75,0,1.5a.51.51,0,0,0,.13.34c1.08.77,2.18,1.52,3.3,2.3a2.89,2.89,0,0,1,1.76-1.15A2.83,2.83,0,0,1,18,15.56h0A2.92,2.92,0,0,1,15.72,19a2.82,2.82,0,0,1-3.28-2.28,3.33,3.33,0,0,1,0-.63.55.55,0,0,0-.16-.38ZM6.82,9.55a1.45,1.45,0,0,0,0,2.9,1.45,1.45,0,0,0,0-2.9ZM15.2,7.36a1.43,1.43,0,0,0,1.39-1.45h0A1.4,1.4,0,1,0,15.2,7.36Zm0,7.29a1.42,1.42,0,0,0-1.4,1.43h0a1.4,1.4,0,0,0,1.44,1.36,1.4,1.4,0,0,0,0-2.8Z"></path></g></svg>
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
                                                        $date_publish = date_create(fw_get_db_post_option(get_the_id(), 'album_release_date'));
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
    if( $ar_style == 'abstyle6' ): ?>
        <div class="music_center_slider">
    <div class="swiper-container" data-blogmeta="<?php echo esc_attr(json_encode($slidermeta))?>">
        <div class="swiper-wrapper">
            <?php $i=0;
				while ( $album_posts->have_posts() ) : $album_posts->the_post(); ?>
                <div class="swiper-slide<?php echo ($i==0) ? ' swiper-slide-active' : '';?>" data-swiper-slide-index="<?php echo _e($i); ?>">
                    <div class="music_center_mainbox text-center">
                        <div class="music_center_img">
                            <?php the_post_thumbnail( 'full' ); ?>
                        </div>
                        <div class="music_center_info">
                            <a href="<?php echo esc_url(get_the_permalink()); ?>" class="music_center_title"><?php the_title(); ?></a>
                            <p class="music_center_sub"> Harry Jackson, Virginia Harris</p>
                            <div class="music_center_details">
                               <a class="ms_btn ms_play_icon play_btn play_music" data-musicid="<?php esc_html_e(get_the_id()); ?>" data-musictype="<?php printf($musictype); ?>" href="javascript:void(0);"> Play All</a>
                              <?php  $fav_class = 'icon_fav';
                                                if(!empty($fav_album_ids)){
                                                    if( in_array(get_the_id(), $fav_album_ids) ) {
                        			                    $fav_class = 'icon_fav_add';
                        		      	            }
                                                } 
                                            ?>
                                    <a href="javascript:;" class="favourite_albums" data-albumid="<?php echo esc_attr(get_the_id()); ?>">
                                        <span class="music_center_dwld">
                                                    <span class="opt_icon">
                                                    <span class="icon <?php echo esc_attr($fav_class); ?>">
														<svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 22 22"><g id="_08-5" data-name=" 08-5"><path id="_08-6" data-name=" 08-6" class="cls-1" d="M13.7,4.49a4.34,4.34,0,0,0-2,.48,3.83,3.83,0,0,0-.73.48A3.54,3.54,0,0,0,10.27,5,4.3,4.3,0,0,0,4,8.83a7.6,7.6,0,0,0,2.46,5.05,22.38,22.38,0,0,0,4,3.29l.51.34.52-.34a23.09,23.09,0,0,0,4-3.29A7.63,7.63,0,0,0,18,8.83,4.34,4.34,0,0,0,13.7,4.49ZM8.31,6.36a2.42,2.42,0,0,1,1.94,1l.75,1,.76-1a2.39,2.39,0,0,1,1.94-1,2.45,2.45,0,0,1,2.43,2.47,5.89,5.89,0,0,1-1.95,3.78A20.15,20.15,0,0,1,11,15.26a20.07,20.07,0,0,1-3.17-2.65A5.89,5.89,0,0,1,5.88,8.83,2.45,2.45,0,0,1,8.31,6.36Z"/></g></svg>
													</span></span>
                                </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php 
                 $i++;
                endwhile;
                wp_reset_postdata();
                ?>
            </div>                                
        </div>
    <!-- Add Arrows -->
    <div class="slider_music_controls">       
        <span class="swiper-music-next">
            <svg xmlns:xlink="http://www.w3.org/1999/xlink"><path fill-rule="evenodd"d="M5.715,8.455 L2.316,5.062 C2.275,5.022 2.275,4.957 2.316,4.918 L5.715,1.525 C6.065,1.176 6.065,0.610 5.715,0.261 L5.715,0.261 C5.365,-0.088 4.798,-0.088 4.448,0.261 L0.199,4.501 C-0.072,4.771 -0.072,5.209 0.199,5.479 L4.448,9.719 C4.798,10.068 5.365,10.068 5.715,9.719 L5.715,9.719 C6.065,9.370 6.065,8.804 5.715,8.455 Z"/></svg>
        </span>
        <span class="swiper-music-prev">
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><path fill-rule="evenodd" d="M5.715,8.455 L2.316,5.062 C2.275,5.022 2.275,4.957 2.316,4.918 L5.715,1.525 C6.065,1.176 6.065,0.610 5.715,0.261 L5.715,0.261 C5.365,-0.088 4.798,-0.088 4.448,0.261 L0.199,4.501 C-0.072,4.771 -0.072,5.209 0.199,5.479 L4.448,9.719 C4.798,10.068 5.365,10.068 5.715,9.719 L5.715,9.719 C6.065,9.370 6.065,8.804 5.715,8.455 Z"/></svg>
        </span>
    </div>
</div>
    <?php endif;
endif;