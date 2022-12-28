<?php if (!defined('FW')) die('Forbidden');
$sg_label = $mpurl = '';
if(!empty($atts['music_label'])):
    $sg_label = $atts['music_label'];
endif;
$sg_number = 12;
if(!empty($atts['music_number'])):
    $sg_number = $atts['music_number'];
endif;
$post_type = '';
if(!empty($atts['post_type_top'])):
  $post_type = $atts['post_type_top'];
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
$musictype = 'artist';
$more_img = get_template_directory_uri().'/assets/images/svg/more.svg';
$play_img = get_template_directory_uri().'/assets/images/svg/play.svg';
$more_icone = get_template_directory_uri().'/assets/images/svg/more.svg';
$play_icone = get_template_directory_uri().'/assets/images/svg/play.svg';
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


// Top Music
if($post_type == 'music'){
    if($music_song_view == "on"){
        if( is_user_logged_in() && $lang_data ){
            $sg_args = array('post_type' => 'ms-music',
                'posts_per_page' => $sg_number,
                'meta_key' => 'song_views_count',
                'orderby' => 'meta_value_num',
                'tax_query' => array(
                    array(
                        'taxonomy' => 'language',
                        'terms' => $lang_data
                    )
                )
            );
        } elseif ( isset($_COOKIE['lang_filter']) ) {
             $lang_data = explode(',', $_COOKIE['lang_filter']);
             $sg_args = array('post_type' => 'ms-music',
                'meta_key' => 'song_views_count',
                'orderby' => 'meta_value_num',
                'posts_per_page' => $sg_number,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'language',
                        'terms' => $lang_data
                    )
                )
            );
        } else{
            $sg_args = array('post_type' => 'ms-music',
                'posts_per_page' => $sg_number,
                'meta_key' => 'song_views_count',
                'orderby' => 'meta_value_num',
            );
        }
    }
    else{
        if( is_user_logged_in() && $lang_data ){
            $sg_args = array('post_type' => 'ms-music',
                'posts_per_page' => $sg_number,
                'meta_key' => 'song_dowenload_counter',
                'orderby' => 'meta_value_num',
                'tax_query' => array(
                    array(
                        'taxonomy' => 'language',
                        'terms' => $lang_data
                    )
                )
            );
        } elseif ( isset($_COOKIE['lang_filter']) ) {
             $lang_data = explode(',', $_COOKIE['lang_filter']);
             $sg_args = array('post_type' => 'ms-music',
                'meta_key' => 'song_dowenload_counter',
                'orderby' => 'meta_value_num',
                'posts_per_page' => $sg_number,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'language',
                        'terms' => $lang_data
                    )
                )
            );
        } else{
            $sg_args = array('post_type' => 'ms-music',
                'posts_per_page' => $sg_number,
                'meta_key' => 'song_dowenload_counter',
                'orderby' => 'meta_value_num',
            );
        }
    }
// the query
$music_posts = new WP_Query( $sg_args );
if( $music_posts->have_posts() ):  ?>
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
			while ( $music_posts->have_posts() ) : $music_posts->the_post(); ?>
                <div class="col-lg-4 col-md-6">
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
                                <i class="ms_icon1 dwnload_icon"></i>
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
    
<?php 
endif; 
}

// Top ALBUM
if($post_type == 'album'){
    if( is_user_logged_in() && $lang_data ){
        $ar_args = array('post_type' => 'ms-albums',
            'posts_per_page' => $sg_number,
            'meta_key' => 'album_views_count',
            'orderby' => 'meta_value_num',
            'tax_query' => array(
                array(
                    'taxonomy' => 'language',
                    'terms' => $lang_data
                )
            )
        );
    } elseif ( isset($_COOKIE['lang_filter']) ) {
        $lang_data = explode(',', $_COOKIE['lang_filter']);
        $ar_args = array('post_type' => 'ms-albums',
            'posts_per_page' => $sg_number,
            'meta_key' => 'album_views_count',
            'orderby' => 'meta_value_num',
            'tax_query' => array(
                array(
                    'taxonomy' => 'language',
                    'terms' => $lang_data
                )
            )
        );
    } else{
        $ar_args = array('post_type' => 'ms-albums',
            'posts_per_page' => $sg_number,
            'meta_key' => 'album_views_count',
            'orderby' => 'meta_value_num',
            'tax_query' => array(
                array(
                    'taxonomy' => 'album-type',
                    'terms' => $ar_type
                )
            )
        );
    }
    $album_posts = new WP_Query( $ar_args ); 
     ?>
    <div class="ms_weekly_wrapper">
                    <div class="ms_weekly_inner">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="ms_heading">
                                    <h1><?php echo esc_html($sg_label); ?></h1>
                                </div>
                            </div>
                        <?php $i=1; $n = $album_posts->found_posts; $rm = $n%3;
                        if(!empty($miraculous_theme_data['miraculous_layout']) && $miraculous_theme_data['miraculous_layout'] == '2'):
                            $more_icon = get_template_directory_uri().'/assets/images/svg/more1.svg';
                        endif;
                        while ( $album_posts->have_posts() ) : $album_posts->the_post(); 
                        ?>
                        <div class="col-lg-4 col-md-6">
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
                <?php
        
}

// Top ALBUM
if($post_type == 'artist'){
    if( is_user_logged_in() && $lang_data ){
        $ar_args = array('post_type' => 'ms-artists',
            'posts_per_page' => $sg_number,
            'meta_key' => 'artist_views_count',
            'orderby' => 'meta_value_num',
        );
    }elseif( isset($_COOKIE['lang_filter']) ) {
        $lang_data = explode(',', $_COOKIE['lang_filter']);
        $ar_args = array('post_type' => 'ms-artists',
            'posts_per_page' => $sg_number,
            'meta_key' => 'artist_views_count',
            'orderby' => 'meta_value_num',
        );
    }else{
        $ar_args = array('post_type' => 'ms-artists',
            'posts_per_page' => $sg_number,
            'meta_key' => 'artist_views_count',
            'orderby' => 'meta_value_num',
        );
    }
    
    $artist_posts = new WP_Query($ar_args); ?>
    <div class="ms_top_artist">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
        			<?php if(!empty($sg_label)): ?>
                        <div class="ms_heading">
                            <h1><?php echo esc_html($sg_label); ?></h1>
                        </div>
        			<?php endif; ?>
                    </div>
                    <?php while ( $artist_posts->have_posts() ) : $artist_posts->the_post(); ?>
                        <div class="col-lg-2">
                            <div class="ms_rcnt_box marger_bottom30">
                                <div class="ms_rcnt_box_img">
                                    <?php the_post_thumbnail( 'large' ); ?>
                                    <div class="ms_main_overlay">
                                        <div class="ms_box_overlay"></div>
        								<?php if(!empty($more_icone)): ?>
                                        <div class="ms_more_icon">
                                            <img src="<?php echo esc_url($more_icone); ?>" alt="<?php esc_attr_e('more icone','miraculous'); ?>">
                                        </div>
        								<?php endif; 
                                            $fav_class = 'icon_fav';
                                            if(function_exists('miraculous_get_favourite_div_class')){
                                                $fav_class = miraculous_get_favourite_div_class(get_the_id(), $musictype);
                                            }
                                        ?>
                                        <ul class="more_option">
                                            <li>
        									<a href="javascript:;" class="favourite_artist" data-artistid="<?php echo esc_attr(get_the_id()); ?>">
        									<span class="opt_icon">
        									<span class="icon <?php echo esc_attr($fav_class); ?>">
												<svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 22 22"><g id="_08-5" data-name=" 08-5"><path id="_08-6" data-name=" 08-6" class="cls-1" d="M13.7,4.49a4.34,4.34,0,0,0-2,.48,3.83,3.83,0,0,0-.73.48A3.54,3.54,0,0,0,10.27,5,4.3,4.3,0,0,0,4,8.83a7.6,7.6,0,0,0,2.46,5.05,22.38,22.38,0,0,0,4,3.29l.51.34.52-.34a23.09,23.09,0,0,0,4-3.29A7.63,7.63,0,0,0,18,8.83,4.34,4.34,0,0,0,13.7,4.49ZM8.31,6.36a2.42,2.42,0,0,1,1.94,1l.75,1,.76-1a2.39,2.39,0,0,1,1.94-1,2.45,2.45,0,0,1,2.43,2.47,5.89,5.89,0,0,1-1.95,3.78A20.15,20.15,0,0,1,11,15.26a20.07,20.07,0,0,1-3.17-2.65A5.89,5.89,0,0,1,5.88,8.83,2.45,2.45,0,0,1,8.31,6.36Z"/></g></svg>
											</span>
        									</span>
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
											 </span>
        									 </span>
        									 <?php esc_html_e('Add To Queue','miraculous'); ?>
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
        								<?php if(!empty($play_icone)): ?>
                                        <div class="ms_play_icon play_btn play_music" data-musicid="<?php esc_html_e(get_the_id()); ?>" data-musictype="<?php printf($musictype); ?>">
                                            <img src="<?php echo esc_url($play_icone); ?>" alt="<?php esc_attr_e('play icone','miraculous');?>">
                                        </div>
        								<?php endif; ?>
                                    </div>
                                </div>
                                <div class="ms_rcnt_box_text">
                                    <h3><a href="<?php echo esc_url(get_the_permalink()); ?>">
        							<?php the_title(); ?></a>
									</h3>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                    <?php wp_reset_postdata(); ?>
                </div>
            </div>
        </div><?php 
}