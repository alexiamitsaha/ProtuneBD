<?php if (!defined('FW')) die('Forbidden');
$sg_label = '';
if(!empty($atts['user_music_label'])):
    $sg_label = $atts['user_music_label'];
endif;

$user_id = get_current_user_id();
$lang_data = get_option('language_filter_ids_'.$user_id);
$fav_music_ids = '';
if($user_id){
    $fav_music_ids = get_user_meta($user_id, 'favourites_songs_lists'.$user_id, true);
}
$miraculous_theme_data ='';
if(function_exists('fw_get_db_settings_option')):  
    $miraculous_theme_data = fw_get_db_settings_option();     
endif; 
$currency = '';
if(!empty($miraculous_theme_data['paypal_currency']) && function_exists('miraculous_currency_symbol')):
    $currency = miraculous_currency_symbol( $miraculous_theme_data['paypal_currency'] );
endif;

global $wpdb; 
$today = date('Y-m-d H:i:s');
$pmt_tbl = $wpdb->prefix . 'ms_orders'; 
$query = $wpdb->get_results( "SELECT * FROM $pmt_tbl WHERE user_id in($user_id)");
?> 
<div class="ms_free_download ms_purchase_wrapper">
    <div class="ms_heading">
        <h1><?php echo esc_html( $sg_label ); ?></h1>
    </div>
    <div class="album_inner_list">
        <div class="album_list_wrapper">
            <ul class="album_list_name">
                <li><?php esc_html_e('Order Id', 'miraculous'); ?></li>
                <li><?php esc_html_e('Track/Album Name', 'miraculous'); ?></li>
                <li class="text-center"><?php esc_html_e('price', 'miraculous'); ?></li>
                <li class="text-center"><?php esc_html_e('More', 'miraculous') ?></li>
            </ul> 
            <?php
            foreach ($query as $orderdata) {
            ?>
            <ul class="ms_list_songs">
                <li><a href="javascript:;"><span class="play_no">
                <?php echo esc_html($orderdata->id); ?></span>
                <span class="play_hover equlizer">
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
                <li><a href="javascript:;" data-musicid="<?php echo esc_attr($orderdata->itemid); ?>" class="play_single_music">
                <?php echo get_the_title($orderdata->itemid); ?></a></li>
                <?php 
                $music_price = get_post_meta($orderdata->itemid,'fw_option:single_music_prices',true);
                if(empty($music_price)){
                  $music_price = get_post_meta($orderdata->itemid,'fw_option:album_full_prices',true);
                }
                if(empty($music_price)):
                ?>
                <li class="text-center"><a href="javascript:;">
                <?php esc_html_e('Free', 'miraculous'); ?></a></li>
                <?php else: ?>
                <li class="text-center">
                 <a href="javascript:;">
                 <?php printf( __('%s%s', 'miraculous'), $currency, $music_price ); ?>
                 </a>
                </li>
                <?php endif; 
                $fav_class = 'icon_fav';
                if(!empty($fav_music_ids)){
                    if( in_array($orderdata->itemid, $fav_music_ids) ) {
                        $fav_class = 'icon_fav_add';
                    }
                }
               if('ms-music' == get_post_type($orderdata->itemid)){
                  $list_type = 'music';
                }else{
                  $list_type = 'album'; 
                }
              ?>
              <li class="text-center ms_more_icon">
                <a href="javascript:;">
                <span class="ms_icon1 ms_active_icon">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="15px" height="4px">
<path fill-rule="evenodd" d="M13.000,3.999 C11.897,3.999 11.000,3.102 11.000,1.999 C11.000,0.897 11.897,-0.001 13.000,-0.001 C14.103,-0.001 15.000,0.897 15.000,1.999 C15.000,3.102 14.103,3.999 13.000,3.999 ZM7.500,3.999 C6.397,3.999 5.500,3.102 5.500,1.999 C5.500,0.897 6.397,-0.001 7.500,-0.001 C8.603,-0.001 9.500,0.897 9.500,1.999 C9.500,3.102 8.603,3.999 7.500,3.999 ZM2.000,3.999 C0.897,3.999 -0.000,3.102 -0.000,1.999 C-0.000,0.897 0.897,-0.001 2.000,-0.001 C3.103,-0.001 4.000,0.897 4.000,1.999 C4.000,3.102 3.103,3.999 2.000,3.999 Z"/>
</svg>
                </span></a>
                <ul class="more_option">
                    <li><a href="javascript:;" class="favourite_music" data-musicid="<?php esc_attr($orderdata->itemid); ?>"><span class="opt_icon"><span class="icon <?php echo esc_attr($fav_class); ?>">
						<svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 22 22"><g id="_08-5" data-name=" 08-5"><path id="_08-6" data-name=" 08-6" class="cls-1" d="M13.7,4.49a4.34,4.34,0,0,0-2,.48,3.83,3.83,0,0,0-.73.48A3.54,3.54,0,0,0,10.27,5,4.3,4.3,0,0,0,4,8.83a7.6,7.6,0,0,0,2.46,5.05,22.38,22.38,0,0,0,4,3.29l.51.34.52-.34a23.09,23.09,0,0,0,4-3.29A7.63,7.63,0,0,0,18,8.83,4.34,4.34,0,0,0,13.7,4.49ZM8.31,6.36a2.42,2.42,0,0,1,1.94,1l.75,1,.76-1a2.39,2.39,0,0,1,1.94-1,2.45,2.45,0,0,1,2.43,2.47,5.89,5.89,0,0,1-1.95,3.78A20.15,20.15,0,0,1,11,15.26a20.07,20.07,0,0,1-3.17-2.65A5.89,5.89,0,0,1,5.88,8.83,2.45,2.45,0,0,1,8.31,6.36Z"/></g></svg>
					</span><?php esc_html_e('Favourites', 'miraculous'); ?></a></li>
 
                    <li><a href="javascript:;" class="add_to_queue" data-musicid="<?php esc_attr_e($orderdata->itemid); ?>" data-musictype="<?php esc_attr_e($list_type); ?>"><span class="opt_icon"><span class="icon icon_queue">
						<svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 22 22"><g id="_03-2" data-name=" 03-2"><path id="_03-3" data-name=" 03-3" class="cls-1" d="M13,5.5H3.5V7.07H13V5.5Zm0,3.14H3.5v1.57H13V8.64ZM3.5,13.36H9.82V11.79H3.5ZM14.55,5.5v6.43a2.35,2.35,0,1,0,1.58,2.21V7.07H18.5V5.5Z"></path></g></svg>
						</span><?php esc_html_e(' Add To Queue', 'miraculous'); ?></a></li>

                    <?php if($list_type == 'album'){ ?>

                    <li>
                    <a href="<?php echo esc_url(get_the_permalink($orderdata->itemid)); ?>" class="ms_download_album"><span class="opt_icon"><span class="icon icon_dwn">
						<svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 22 22"><g id="_06-4" data-name=" 06-4"><path id="_06-5" data-name=" 06-5" class="cls-1" d="M10.65,13.85a.48.48,0,0,0,.7,0l3.27-3.5a.41.41,0,0,0,.07-.47.48.48,0,0,0-.42-.26H12.4V4.94a.46.46,0,0,0-.47-.44H10.07a.46.46,0,0,0-.47.44V9.63H7.73a.44.44,0,0,0-.42.25.41.41,0,0,0,.07.47Zm5.48-.73v2.63H5.87V13.12H4v3.5a.9.9,0,0,0,.93.88H17.07a.9.9,0,0,0,.93-.88v-3.5Z"/></g></svg>
					</span></span><?php esc_html_e('Download Now', 'miraculous'); ?></a></li>

                    <?php }else{ ?>
                    <li><a href="javascript:;" class="ms_download" data-msmusic="<?php esc_attr_e($orderdata->itemid); ?>"><span class="opt_icon"><span class="icon icon_dwn">
						<svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 22 22"><g id="_06-4" data-name=" 06-4"><path id="_06-5" data-name=" 06-5" class="cls-1" d="M10.65,13.85a.48.48,0,0,0,.7,0l3.27-3.5a.41.41,0,0,0,.07-.47.48.48,0,0,0-.42-.26H12.4V4.94a.46.46,0,0,0-.47-.44H10.07a.46.46,0,0,0-.47.44V9.63H7.73a.44.44,0,0,0-.42.25.41.41,0,0,0,.07.47Zm5.48-.73v2.63H5.87V13.12H4v3.5a.9.9,0,0,0,.93.88H17.07a.9.9,0,0,0,.93-.88v-3.5Z"/></g></svg>
					</span></span><?php esc_html_e('Download Now', 'miraculous'); ?></a></li>

                   <?php } ?>

                     <li><a href="javascript:;" class="ms_add_playlist" data-msmusic="<?php esc_attr_e($orderdata->itemid); ?>"><span class="opt_icon"><span class="icon icon_playlst">
						<svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 22 22"><g id="_03-2" data-name=" 03-2"><path id="_03-3" data-name=" 03-3" class="cls-1" d="M13,5.5H3.5V7.07H13V5.5Zm0,3.14H3.5v1.57H13V8.64ZM3.5,13.36H9.82V11.79H3.5ZM14.55,5.5v6.43a2.35,2.35,0,1,0,1.58,2.21V7.07H18.5V5.5Z"/></g></svg>
					 </span></span><?php esc_html_e('Add To Playlist', 'miraculous'); ?></a></li>

                    <li><a href="javascript:;" class="ms_share_music" data-shareuri="<?php esc_attr_e(get_the_permalink($orderdata->itemid)); ?>" data-sharename="<?php the_title_attribute($orderdata->itemid); ?>"><span class="opt_icon"><span class="icon icon_share">
						<svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 22 22"><g id="_14-2" data-name=" 14-2"><path id="_13" data-name=" 13" class="cls-1" d="M8.68,13.18A2.78,2.78,0,0,1,4.77,13l-.07-.08a3,3,0,0,1,0-3.85,2.77,2.77,0,0,1,3.89-.36.52.52,0,0,1,.11.1l3-2.11.09-.06a1.09,1.09,0,0,0,.63-1.08A2.76,2.76,0,0,1,15.05,3,2.84,2.84,0,0,1,17.9,5.22a3,3,0,0,1-1.36,3.22,2.72,2.72,0,0,1-3.34-.5l-.27-.3C11.81,8.41,10.7,9.18,9.6,10a.37.37,0,0,0-.09.28q0,.75,0,1.5a.51.51,0,0,0,.13.34c1.08.77,2.18,1.52,3.3,2.3a2.89,2.89,0,0,1,1.76-1.15A2.83,2.83,0,0,1,18,15.56h0A2.92,2.92,0,0,1,15.72,19a2.82,2.82,0,0,1-3.28-2.28,3.33,3.33,0,0,1,0-.63.55.55,0,0,0-.16-.38ZM6.82,9.55a1.45,1.45,0,0,0,0,2.9,1.45,1.45,0,0,0,0-2.9ZM15.2,7.36a1.43,1.43,0,0,0,1.39-1.45h0A1.4,1.4,0,1,0,15.2,7.36Zm0,7.29a1.42,1.42,0,0,0-1.4,1.43h0a1.4,1.4,0,0,0,1.44,1.36,1.4,1.4,0,0,0,0-2.8Z"/></g></svg>
					</span></span><?php esc_html_e('Share', 'miraculous'); ?></a></li>

                </ul>
            </li>
          </ul>
        <?php } ?>
      </div>
   </div>
</div>