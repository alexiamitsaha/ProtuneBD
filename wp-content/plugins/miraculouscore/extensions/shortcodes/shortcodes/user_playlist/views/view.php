<?php if (!defined('FW')) die('Forbidden');

$playlist_heading = $mpurl = '';
if(!empty($atts['user_playlist_heading'])):
  $playlist_heading = $atts['user_playlist_heading'];
endif;

$user_id = '';
if(get_current_user_id()):
   $user_id = get_current_user_id();
endif;
$miraculous_theme_data = '';
if (function_exists('fw_get_db_settings_option')):  
    $miraculous_theme_data = fw_get_db_settings_option();     
endif; 
$currency = '';
if(!empty($miraculous_theme_data['paypal_currency']) && function_exists('miraculous_currency_symbol')):
    $currency = miraculous_currency_symbol( $miraculous_theme_data['paypal_currency'] );
endif;
$list_type = 'music';
$close_url = get_template_directory_uri().'/assets/images/svg/close.svg';
$play_icone = get_template_directory_uri().'/assets/images/svg/play.svg';
$more_img = get_template_directory_uri().'/assets/images/svg/more.svg';
$default_playlist_img = get_template_directory_uri().'/assets/images/img13.jpg';
$default_favourite_img = get_template_directory_uri().'/assets/images/img2.jpg';
$playlists = '';

if($user_id):
    
    global $wpdb;
    if(is_multisite()):
        $usermeta_tbl = $wpdb->get_blog_prefix(0) . 'usermeta';
    else:
        $usermeta_tbl = $wpdb->prefix . 'usermeta';
    endif;
    $sql = "SELECT * FROM $usermeta_tbl WHERE `user_id` = $user_id AND `meta_key` LIKE 'miraculous_playlist_%'";
    $playlists = $wpdb->get_results($sql);


if( isset($_GET['do']) && $_GET['do'] != '' ):
    $songs_type = '';
    if('favourites' == $_GET['do']):
        $key = 'favourites_songs_lists'.$user_id;
        $songs_type = 'favourites';
    else:
        $key = 'miraculous_playlist_'.$user_id.'_'.$_GET['do']; 
        $songs_type = $_GET['do'];
    endif;
    $musicsids = get_user_meta($user_id, $key, true); 
?>
<div class="ms_free_download ms_purchase_wrapper">
        <div class="ms_heading">
            <h1><?php echo esc_html( str_replace('-', ' ', $_GET['do']) ); ?></h1>
        </div>
        <div class="album_inner_list">
                <div class="album_list_wrapper">
                    <ul class="album_list_name">
                        <li><?php esc_html_e('#','miraculous'); ?></li> 
                        <li><?php esc_html_e('Song Title','miraculous'); ?></li>
                        <li><?php esc_html_e('Artists','miraculous'); ?></li>
                        <li class="text-center"><?php esc_html_e('price','miraculous'); ?></li>
                        <li class="text-center"><?php esc_html_e('Duration','miraculous'); ?></li>
                        <li class="text-center"><?php esc_html_e('More','miraculous'); ?></li>
                        <li class="text-center"><?php esc_html_e('remove','miraculous'); ?></li>
                    </ul>
                   <?php 
                    if($musicsids): 
                    $sg_args = array('post_type' => 'ms-music',
                                     'post__in' => $musicsids,
                                     );
                    $music_posts = new WP_Query( $sg_args );
                    if($music_posts->have_posts()): 
                    $i=1;
                    while ( $music_posts->have_posts() ) : $music_posts->the_post(); 
                    $attach_meta = array();
                    $music_extranal_url = get_post_meta(get_the_id(), 'fw_option:music_extranal_url', true);
                    if(!empty($music_extranal_url)):
                    	$mpurl = $music_extranal_url;
                    else:
                    	$mpurl = get_post_meta(get_the_id(), 'fw_option:mp3_full_songs', true);
                    endif;
                    if($mpurl) {
                        $attach_meta = wp_get_attachment_metadata( $mpurl['attachment_id'] );
                    }
                    $image_uri = get_the_post_thumbnail_url ( get_the_id() );
                    ?>
                    <ul class="ms_list_songs">
                        <li><a href="javascript:;"><span class="play_no"><?php echo (strlen($i) < 2) ? '0'.$i : $i; ?></span><span class="play_hover equlizer">
                                <svg class="lds-equalizer" width="40px"  height="40px"  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid"><g transform="rotate(180 50 50)"><rect ng-attr-x="{{7.6923076923076925 - config.width/2}}" y="36" ng-attr-width="{{config.width}}" height="24.0108" fill="#2ec8e6" x="4.6923076923076925" width="3">
                                    <animate attributeName="height" calcMode="spline" values="20;30;4;20" times="0;0.33;0.66;1" ng-attr-dur="{{config.speed}}" keySplines="0.5 0 0.5 1;0.5 0 0.5 1;0.5 0 0.5 1" repeatCount="indefinite" begin="-0.5833333333333334s" dur="1">
                                    </animate></rect><rect ng-attr-x="{{15.384615384615385 - config.width/2}}" y="36" ng-attr-width="{{config.width}}" height="28.4181" fill="#2ec8e6" x="12.384615384615385" width="3">
                                    <animate attributeName="height" calcMode="spline" values="20;30;4;20" times="0;0.33;0.66;1" ng-attr-dur="{{config.speed}}" keySplines="0.5 0 0.5 1;0.5 0 0.5 1;0.5 0 0.5 1" repeatCount="indefinite" begin="-0.6666666666666666s" dur="1">
                                    </animate></rect><rect ng-attr-x="{{23.076923076923077 - config.width/2}}" y="36" ng-attr-width="{{config.width}}" height="8.11305" fill="#2ec8e6" x="20.076923076923077" width="3">
                                    <animate attributeName="height" calcMode="spline" values="20;30;4;20" times="0;0.33;0.66;1" ng-attr-dur="{{config.speed}}" keySplines="0.5 0 0.5 1;0.5 0 0.5 1;0.5 0 0.5 1" repeatCount="indefinite" begin="0s" dur="1">
                                    </animate></rect><rect ng-attr-x="{{30.76923076923077 - config.width/2}}" y="36" ng-attr-width="{{config.width}}" height="29.9656" fill="#2ec8e6" x="27.76923076923077" width="3">
                                    <animate attributeName="height" calcMode="spline" values="20;30;4;20" times="0;0.33;0.66;1" ng-attr-dur="{{config.speed}}" keySplines="0.5 0 0.5 1;0.5 0 0.5 1;0.5 0 0.5 1" repeatCount="indefinite" begin="-0.75s" dur="1">
                                    </animate></rect><rect ng-attr-x="{{38.46153846153846 - config.width/2}}" y="36" ng-attr-width="{{config.width}}" height="4.08943" fill="#2ec8e6" x="35.46153846153846" width="3">
                                    <animate attributeName="height" calcMode="spline" values="20;30;4;20" times="0;0.33;0.66;1" ng-attr-dur="{{config.speed}}" keySplines="0.5 0 0.5 1;0.5 0 0.5 1;0.5 0 0.5 1" repeatCount="indefinite" begin="-0.08333333333333333s" dur="1">
                                    </animate></rect><rect ng-attr-x="{{46.15384615384615 - config.width/2}}" y="36" ng-attr-width="{{config.width}}" height="10.4173" fill="#2ec8e6" x="43.15384615384615" width="3">
                                    <animate attributeName="height" calcMode="spline" values="20;30;4;20" times="0;0.33;0.66;1" ng-attr-dur="{{config.speed}}" keySplines="0.5 0 0.5 1;0.5 0 0.5 1;0.5 0 0.5 1" repeatCount="indefinite" begin="-0.25s" dur="1">
                                    </animate></rect>
                                </g></svg>
                            </span>
                            <span class="play_hover">
                                <svg class="play_Svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="35px" height="35px">
                                <path fill-rule="evenodd" d="M19.660,12.585 C18.969,15.165 17.314,17.321 15.000,18.656 C13.459,19.545 11.749,20.000 10.016,20.000 C9.147,20.000 8.273,19.886 7.411,19.655 C4.831,18.963 2.675,17.309 1.339,14.996 C0.003,12.683 -0.352,9.989 0.340,7.409 C1.031,4.830 2.686,2.674 4.999,1.338 C7.313,0.003 10.008,-0.352 12.588,0.339 C15.169,1.031 17.325,2.685 18.661,4.998 C19.997,7.311 20.352,10.005 19.660,12.585 ZM17.759,5.519 C16.562,3.446 14.630,1.964 12.319,1.345 C11.547,1.138 10.764,1.036 9.985,1.036 C8.433,1.036 6.901,1.443 5.520,2.240 C3.448,3.436 1.965,5.368 1.346,7.679 C0.726,9.990 1.044,12.404 2.241,14.476 C3.437,16.548 5.369,18.030 7.681,18.649 C9.993,19.268 12.407,18.950 14.480,17.754 C16.552,16.558 18.035,14.626 18.654,12.316 C19.273,10.004 18.956,7.590 17.759,5.519 ZM15.736,6.087 C15.581,6.087 15.427,6.017 15.324,5.885 C14.251,4.499 12.638,3.568 10.899,3.331 C10.614,3.292 10.414,3.029 10.453,2.744 C10.492,2.459 10.755,2.260 11.040,2.299 C13.047,2.573 14.909,3.648 16.148,5.247 C16.324,5.475 16.282,5.802 16.055,5.978 C15.960,6.051 15.848,6.087 15.736,6.087 ZM15.343,9.997 C15.343,10.391 15.140,10.744 14.799,10.941 L8.368,14.652 C8.198,14.751 8.010,14.800 7.823,14.800 C7.636,14.800 7.449,14.751 7.278,14.652 C6.937,14.455 6.733,14.103 6.733,13.709 L6.733,6.286 C6.733,5.892 6.937,5.539 7.278,5.342 C7.620,5.145 8.027,5.145 8.368,5.342 L14.798,9.054 C15.140,9.250 15.343,9.603 15.343,9.997 ZM14.278,9.955 L7.847,6.244 C7.843,6.241 7.835,6.236 7.824,6.236 C7.817,6.236 7.809,6.238 7.799,6.244 C7.775,6.258 7.775,6.277 7.775,6.286 L7.775,13.709 C7.775,13.718 7.775,13.737 7.799,13.751 C7.823,13.764 7.840,13.755 7.847,13.751 L14.278,10.039 C14.285,10.034 14.302,10.025 14.302,9.997 C14.302,9.969 14.285,9.960 14.278,9.955 Z"/>
                                </svg>
                            </span></a></li>
                        <li><a href="javascript:;" data-musicid="<?php echo esc_attr(get_the_id()); ?>" class="play_single_music"><?php the_title(); ?></a></li>
                        <?php 
                        $artists_name = array(); 
                        $music_price = '';
                        if(function_exists('fw_get_db_post_option')){
                            $artists_ids = fw_get_db_post_option(get_the_id(), 'music_artists'); 
                            foreach ($artists_ids as $artists_id):
                                $artists_name[] = get_the_title($artists_id);
                            endforeach;

                            $music_price_arr = fw_get_db_post_option(get_the_id());
                            if( !empty( $music_price_arr['single_music_prices'] ) ){
                                $music_price = $music_price_arr['single_music_prices'];
                            }
                            //print_r($music_price_arr['single_music_prices']);
                        }
                    ?>
                    <li><a href="javascript:;" class="play_single_music"><?php echo implode(', ', $artists_name); ?></a></li>
                   <?php if(empty($music_price)): ?>
                           <li class="text-center"><a href="javascript:;"><?php esc_html_e('Free', 'miraculous'); ?></a></li>
                       <?php else: ?>
                           <li class="text-center"><a href="javascript:;"><?php printf( __('%s%s', 'miraculous'), $currency, $music_price ); ?></a></li>
                   <?php endif;
                    ?>
                    <li class="text-center"><a href="javascript:;"><?php echo (isset($attach_meta['length_formatted'])) ? $attach_meta['length_formatted'] : "0.00"; ?></a></li>
                        <li class="text-center ms_more_icon"><a href="javascript:;"><span class="ms_icon1 ms_active_icon">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="15px" height="4px">
<path fill-rule="evenodd" d="M13.000,3.999 C11.897,3.999 11.000,3.102 11.000,1.999 C11.000,0.897 11.897,-0.001 13.000,-0.001 C14.103,-0.001 15.000,0.897 15.000,1.999 C15.000,3.102 14.103,3.999 13.000,3.999 ZM7.500,3.999 C6.397,3.999 5.500,3.102 5.500,1.999 C5.500,0.897 6.397,-0.001 7.500,-0.001 C8.603,-0.001 9.500,0.897 9.500,1.999 C9.500,3.102 8.603,3.999 7.500,3.999 ZM2.000,3.999 C0.897,3.999 -0.000,3.102 -0.000,1.999 C-0.000,0.897 0.897,-0.001 2.000,-0.001 C3.103,-0.001 4.000,0.897 4.000,1.999 C4.000,3.102 3.103,3.999 2.000,3.999 Z"/>
</svg>
                        </span></a>
                            <ul class="more_option">
                                <li>
									<a href="javascript:;" class="add_to_queue" data-musicid="<?php esc_html_e(get_the_id()); ?>" data-musictype="<?php esc_html_e($list_type); ?>">
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
									<a href="javascript:;" class="ms_download" data-msmusic="<?php echo esc_attr(get_the_id()); ?>">
									<span class="opt_icon">
									<span class="icon icon_dwn">
										<svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 22 22"><g id="_06-4" data-name=" 06-4"><path id="_06-5" data-name=" 06-5" class="cls-1" d="M10.65,13.85a.48.48,0,0,0,.7,0l3.27-3.5a.41.41,0,0,0,.07-.47.48.48,0,0,0-.42-.26H12.4V4.94a.46.46,0,0,0-.47-.44H10.07a.46.46,0,0,0-.47.44V9.63H7.73a.44.44,0,0,0-.42.25.41.41,0,0,0,.07.47Zm5.48-.73v2.63H5.87V13.12H4v3.5a.9.9,0,0,0,.93.88H17.07a.9.9,0,0,0,.93-.88v-3.5Z"/></g></svg>
									</span>
									</span>
									<?php esc_html_e('Download Now','miraculous'); ?>
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
                        </li>
                        <?php if(!empty($close_url)): ?>
                           <li class="text-center">
                                <?php if($songs_type == 'favourites'): ?>
    						    <a href="javascript:;" class="remove_favourite_music" musicid="<?php echo esc_attr(get_the_id()); ?>">
                                    <span class="ms_close">
                                        <img src="<?php echo esc_url($close_url); ?>" alt="<?php esc_attr_e('Close', 'miraculous'); ?>">
                                    </span>
    							</a>
                                <?php else: ?>
                                        <a href="javascript:;" class="remove_user_playlist_music" musicid="<?php echo esc_attr(get_the_id()); ?>" data-list="<?php echo esc_attr($songs_type); ?>">
                                            <span class="ms_close">
                                                <img src="<?php echo esc_url($close_url); ?>" alt="<?php esc_attr_e('Close', 'miraculous'); ?>">
                                            </span>
                                        </a>
                                <?php endif; ?>
						   </li>
                        <?php endif; ?>
                        </ul>
                    <?php 
                     $i++;
                     endwhile; 
                     wp_reset_postdata();
                     endif;
                    endif;
                  ?>
                </div>
            </div>
        </div>
<?php else: ?>
<div class="ms_top_artist">
    <div class="container-fluid">
        <div class="row">
            <?php if(!empty($playlist_heading)): ?>
                <div class="col-lg-12">
                    <div class="ms_heading">
                        <h1><?php echo esc_html($playlist_heading); ?></h1>
                    </div>
                </div>
            <?php endif; 
            if(!empty($user_id)): ?>
                <div class="col-lg-4 col-md-6">
                <div class="ms_rcnt_box marger_bottom25">
                    <?php
                    $fav = 'ms_favourite';
                    $key = 'favourites_songs_lists'.$user_id; 
                    $data = miraculous_user_playlist_songs($key);
                    ?>
                    <div class="ms_rcnt_box_img">
                        <?php if(!empty($data['image'])): ?>
                                <img src="<?php echo esc_url($data['image']); ?>" alt="<?php esc_attr_e('song images','miraculous')?>" class="img-fluid">
                        <?php else: ?>
                                <img src="<?php echo esc_url($default_favourite_img); ?>" alt="<?php esc_attr_e('favourite', 'miraculous'); ?>" class="img-fluid">
                        <?php endif; ?>
                        <?php if(!empty($play_icone)): ?>
                            <div class="ms_main_overlay">
                                <div class="ms_box_overlay"></div>
                                 <div class="ms_play_icon play_btn play_list_music" data-list="<?php echo esc_attr($fav); ?>">
                                    <img src="<?php echo esc_url($play_icone); ?>" alt="<?php esc_attr_e('Play', 'miraculous'); ?>">
                                 </div>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="ms_rcnt_box_text">
                        <h3><a href="<?php echo get_the_permalink(); ?>?do=favourites">
                            <?php esc_html_e('My Favourites', 'miraculous'); ?></a></h3>
                        <p>
                        <?php 
                        $total = '';
                        if(!empty($data['total'])):
                           $total = $data['total'];
                        endif;
                        printf(esc_html__('%s songs', 'miraculous'), $total);
                        ?>
                        </p>
                    </div>
                </div>
            </div>
            <?php endif;
			$i = 1;
            if(!empty($playlists)):
                foreach($playlists as $playlist): ?>
                <div class="col-lg-4 col-md-6">
                    <div class="ms_rcnt_box marger_bottom30">
                        <?php 
                        $key = explode('_', $playlist->meta_key);
                        $name = str_replace('-', ' ', end($key));
                        $data = miraculous_user_playlist_songs($playlist->meta_key);
                        ?>
                        <div class="ms_rcnt_box_img">
                            <?php if(!empty($data['image'])): ?>
                                <img src="<?php echo esc_url($data['image']); ?>" alt="<?php esc_attr_e('song images','miraculous')?>" class="img-fluid">
                            <?php else: ?>
                                <img src="<?php echo esc_url($default_playlist_img); ?>" alt="<?php esc_attr_e('song images','miraculous')?>" class="img-fluid">
                            <?php endif; ?>
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
                                        $attach_meta = wp_get_attachment_metadata( $mpurl['attachment_id'] );
                                    }
                                    $image_uri = get_the_post_thumbnail_url ( get_the_id() ); ?>
                                <ul class="more_option">
                                    <li><a href="javascript:;" class="ms_remove_user_playlist" data-list="<?php echo esc_attr(end($key)); ?>"><span class="opt_icon"><span class="icon icon_playlst"><i class="fa fa-times" aria-hidden="true"></i></span></span><?php esc_html_e('Remove Playlist', 'miraculous'); ?></a></li>
                                </ul>
                                <div class="ms_play_icon play_btn play_list_music" data-list="<?php echo esc_attr(end($key)); ?>">
                                    <img src="<?php echo esc_url($play_icone); ?>" alt="<?php esc_attr_e('Play','miraculous'); ?>">
                                </div>
                            </div>
                        </div>
                        <div class="ms_rcnt_box_text">
                            <h3><a href="<?php echo get_the_permalink(); ?>?do=<?php echo esc_attr_e(end($key)); ?>"><?php echo esc_html($name); ?></a></h3>
                            <p>
                            <?php 
                            printf( __('%s songs', 'miraculous'), $data['total']); 
                            ?>
                            </p>
                        </div>
                    </div>
                </div>
			
            <?php 
			$i++;
			endforeach;
            endif; ?>
            <div class="col-lg-4">
                <div class="ms_rcnt_box marger_bottom30">
                    <a href="javascript:;" data-toggle="modal" data-target="#create_playlist_modal">
                        <div class="create_playlist">
                            <i class="ms_icon icon_playlist"></i>
                        </div>
                    </a>
                    <div class="ms_rcnt_box_text">
                        <h3><a href="javascript:;"><?php esc_html_e('Create New Playlist','miraculous'); ?></a></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif;
else: ?>
    <script>
        $(document).ready(function(){
           $("#myModal1").modal("show");
        });
    </script>
    <?php
endif;