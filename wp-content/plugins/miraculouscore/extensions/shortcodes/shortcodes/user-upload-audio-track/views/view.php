<?php if (!defined('FW')) die('Forbidden');

$sg_label = '';
if(!empty($atts['user_music_label'])):
    $sg_label = $atts['user_music_label'];
endif;
$sg_number = 12;
if(!empty($atts['user_music_number'])):
    $sg_number = $atts['user_music_number'];
endif;
$miraculous_theme_data ='';
if(function_exists('fw_get_db_settings_option')):  
    $miraculous_theme_data = fw_get_db_settings_option();     
endif; 
$upload_page = '#';
if(!empty($miraculous_theme_data['user_music_upload_page'])):
    $upload_page = get_the_permalink( $miraculous_theme_data['user_music_upload_page'] );
endif;
$list_type = 'music';
$user_id = get_current_user_id();
$lang_data = get_option('language_filter_ids_'.$user_id);
$fav_music_ids = '';
if($user_id){
    $fav_music_ids = get_user_meta($user_id, 'favourites_songs_lists'.$user_id, true);
}
$currency = '';
if(!empty($miraculous_theme_data['paypal_currency']) && function_exists('miraculous_currency_symbol')):
    $currency = miraculous_currency_symbol( $miraculous_theme_data['paypal_currency'] );
endif;

 $sg_args = array('post_type' => 'ms-music',
                'posts_per_page' => $sg_number,
                'author' => $user_id,
                );
// the query
$music_posts = new WP_Query( $sg_args );
if(wp_get_current_user()):
    if( $music_posts->have_posts() && $user_id ): ?>
        <!-- Free Download Css Start -->
        <div class="ms_free_download ms_purchase_wrapper">
            <div class="ms_heading">
                <h1><?php echo esc_html( $sg_label ); ?></h1>
            </div>
            <div class="album_inner_list">
                <div class="album_list_wrapper">
                    <ul class="album_list_name">
                        <li><?php esc_html_e('#', 'miraculous'); ?></li>
                        <li><?php esc_html_e('Song Title', 'miraculous'); ?></li>
                        <li class="text-center"><?php esc_html_e('price', 'miraculous'); ?></li>
                        <li class="text-center"><?php esc_html_e('Duration', 'miraculous'); ?></li>
                        <li class="text-center"><?php esc_html_e('More', 'miraculous') ?></li>
                    </ul>
                    <?php
                    $i=1; 
                    while ( $music_posts->have_posts() ) : $music_posts->the_post(); 
                    ?>
                    <ul class="ms_list_songs">
                        <li><a href="javascript:;"><span class="play_no"><?php echo (strlen($i) < 2) ? '0'.$i : $i; ?></span><span class="play_hover">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="35px" height="35px">
<path fill-rule="evenodd" d="M19.660,12.585 C18.969,15.165 17.314,17.321 15.000,18.656 C13.459,19.545 11.749,20.000 10.016,20.000 C9.147,20.000 8.273,19.886 7.411,19.655 C4.831,18.963 2.675,17.309 1.339,14.996 C0.003,12.683 -0.352,9.989 0.340,7.409 C1.031,4.830 2.686,2.674 4.999,1.338 C7.313,0.003 10.008,-0.352 12.588,0.339 C15.169,1.031 17.325,2.685 18.661,4.998 C19.997,7.311 20.352,10.005 19.660,12.585 ZM17.759,5.519 C16.562,3.446 14.630,1.964 12.319,1.345 C11.547,1.138 10.764,1.036 9.985,1.036 C8.433,1.036 6.901,1.443 5.520,2.240 C3.448,3.436 1.965,5.368 1.346,7.679 C0.726,9.990 1.044,12.404 2.241,14.476 C3.437,16.548 5.369,18.030 7.681,18.649 C9.993,19.268 12.407,18.950 14.480,17.754 C16.552,16.558 18.035,14.626 18.654,12.316 C19.273,10.004 18.956,7.590 17.759,5.519 ZM15.736,6.087 C15.581,6.087 15.427,6.017 15.324,5.885 C14.251,4.499 12.638,3.568 10.899,3.331 C10.614,3.292 10.414,3.029 10.453,2.744 C10.492,2.459 10.755,2.260 11.040,2.299 C13.047,2.573 14.909,3.648 16.148,5.247 C16.324,5.475 16.282,5.802 16.055,5.978 C15.960,6.051 15.848,6.087 15.736,6.087 ZM15.343,9.997 C15.343,10.391 15.140,10.744 14.799,10.941 L8.368,14.652 C8.198,14.751 8.010,14.800 7.823,14.800 C7.636,14.800 7.449,14.751 7.278,14.652 C6.937,14.455 6.733,14.103 6.733,13.709 L6.733,6.286 C6.733,5.892 6.937,5.539 7.278,5.342 C7.620,5.145 8.027,5.145 8.368,5.342 L14.798,9.054 C15.140,9.250 15.343,9.603 15.343,9.997 ZM14.278,9.955 L7.847,6.244 C7.843,6.241 7.835,6.236 7.824,6.236 C7.817,6.236 7.809,6.238 7.799,6.244 C7.775,6.258 7.775,6.277 7.775,6.286 L7.775,13.709 C7.775,13.718 7.775,13.737 7.799,13.751 C7.823,13.764 7.840,13.755 7.847,13.751 L14.278,10.039 C14.285,10.034 14.302,10.025 14.302,9.997 C14.302,9.969 14.285,9.960 14.278,9.955 Z"/>
</svg>
                        </span></a></li>
                            <li><a href="javascript:;" data-musicid="<?php echo esc_attr(get_the_id()); ?>" class="play_single_music"><?php the_title(); ?></a></li>
                                <?php
                                    $artists_name = array();
                                    $music_price = '';
                                    if(function_exists('fw_get_db_post_option')){
                                        $artists_ids = fw_get_db_post_option(get_the_id(), 'music_artists'); 
                                        foreach($artists_ids as $artists_id) {
                                            $artists_name[] = get_the_title($artists_id);
                                        } 
                                        
                                        $music_price = fw_get_db_post_option(get_the_id(), 'single_music_prices');
                                    }
                                ?>
                                 <?php 
                                 if(!empty($music_price)): 
                                 if($music_price == "undefined"){?>
                                 <li class="text-center"><a href="javascript:;"><?php esc_html_e('Free', 'miraculous'); ?></a></li>
                                 <?php }else{  ?>
                                 <li class="text-center"><a href="javascript:;"><?php printf( __('%s%s', 'miraculous'), $currency, $music_price ); ?></a></li>
                                 <?php }
                                  else: ?>
                                 <li class="text-center"><a href="javascript:;"><?php esc_html_e('Free', 'miraculous'); ?></a></li>
                                 <?php endif;
                                    $mpurl = get_post_meta(get_the_id(), 'fw_option:mp3_full_songs', true);
                                    $attach_meta = '';
                                    if($mpurl) {
                                        $attach_meta = wp_get_attachment_metadata( $mpurl['attachment_id'] );
                                    }
                                    $fav_class = 'icon_fav';
                                    if(!empty($fav_music_ids)){
                                        if( in_array(get_the_id(), $fav_music_ids) ) {
            			                    $fav_class = 'icon_fav_add';
            		      	            }
                                    }
                                ?>
                                <li class="text-center">
                                <a href="javascript:;"><?php echo (isset($attach_meta['length_formatted'])) ? $attach_meta['length_formatted'] : "0.25"; ?></a></li>
                                <li class="text-center ms_more_icon">
                                   <a href="javascript:;"><span class="ms_icon1 ms_active_icon">
                                       <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="15px" height="4px">
                                            <path fill-rule="evenodd" d="M13.000,3.999 C11.897,3.999 11.000,3.102 11.000,1.999 C11.000,0.897 11.897,-0.001 13.000,-0.001 C14.103,-0.001 15.000,0.897 15.000,1.999 C15.000,3.102 14.103,3.999 13.000,3.999 ZM7.500,3.999 C6.397,3.999 5.500,3.102 5.500,1.999 C5.500,0.897 6.397,-0.001 7.500,-0.001 C8.603,-0.001 9.500,0.897 9.500,1.999 C9.500,3.102 8.603,3.999 7.500,3.999 ZM2.000,3.999 C0.897,3.999 -0.000,3.102 -0.000,1.999 C-0.000,0.897 0.897,-0.001 2.000,-0.001 C3.103,-0.001 4.000,0.897 4.000,1.999 C4.000,3.102 3.103,3.999 2.000,3.999 Z"/>
                                            </svg>
                                   </span></a>
                                    <ul class="more_option">
                                        <li>
                                        <a href="<?php echo esc_url(home_url('/audio-update/')); ?>?track_id=<?php echo get_the_ID(); ?>" class="bs_audio_edite"><span class="opt_icon"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></span><?php esc_html_e('Edit','miraculous'); ?>
                                        </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                    <?php $i++; endwhile; ?>
                </div>
            </div>
        </div>
      <?php 
      else: 
    ?>
    <div class="ms_upload_wrapper marger_top60">
        <div class="ms_upload_box">
            <h2><?php echo esc_html__('You have not Uploaded Tracks yet.', 'miraculous'); ?></h2>
            <a href="<?php echo esc_url($upload_page); ?>" class="ms_btn"><?php echo esc_html__('Click Here', 'miraculous'); ?></a>
        </div>
    </div>
<?php 
  endif;
else:
?>
<div class="ms_upload_wrapper marger_top60">
    <div class="ms_upload_box">
        <h2><?php echo esc_html__('You have not permission to access this page.', 'miraculous'); ?></h2>
        <a href="<?php echo esc_url(home_url('/')); ?>" class="ms_btn"><?php echo esc_html__('Go Back', 'miraculous'); ?></a>
    </div>
</div>
<?php
endif;
?>