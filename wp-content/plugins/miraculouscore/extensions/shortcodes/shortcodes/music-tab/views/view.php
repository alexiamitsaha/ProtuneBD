<?php if (!defined('FW')) die('Forbidden');
$sg_label = $mpurl = '';
if(!empty($atts['tab_lable'])):
    $sg_label = $atts['tab_lable'];
endif;
$sg_number = 12;
if(!empty($atts['music_number'])):
    $sg_number = $atts['music_number'];
endif;
$featured_args = array('post_type' => 'ms-music',
    'posts_per_page' => $sg_number,
    'meta_key' => 'fw_option:music_type',
    'tax_query' => array(
        array(
            'taxonomy' => 'music-type',
            'terms' => 'featured-musics',
            'field' => 'slug',
            'include_children' => true,
            'operator' => 'IN'
        )
    )
);
$featured_music_posts = new WP_Query( $featured_args );

$top_args = array('post_type' => 'ms-music',
    'posts_per_page' => $sg_number,
    'meta_key' => 'fw_option:music_type',
    'tax_query' => array(
        array(
            'taxonomy' => 'music-type',
            'terms' => 'top-musics',
            'field' => 'slug',
            'include_children' => true,
            'operator' => 'IN'
        )
    )
);
$top_music_posts = new WP_Query( $top_args );

$trending_args = array('post_type' => 'ms-music',
    'posts_per_page' => $sg_number,
    'meta_key' => 'fw_option:music_type',
    'tax_query' => array(
        array(
            'taxonomy' => 'music-type',
            'terms' => 'trending-musics',
            'field' => 'slug',
            'include_children' => true,
            'operator' => 'IN'
        )
    )
);
$trending_music_posts = new WP_Query( $trending_args );
$list_type = 'music';
$user_id = get_current_user_id();
if($user_id){
    $fav_music_ids = get_user_meta($user_id, 'favourites_songs_lists'.$user_id, true);
}
?>
<div class="ms_songslist_main">
    <?php
        if(!empty($sg_label)){
        ?>
            <div class="ms_heading">
                <h1><?php echo esc_html( $sg_label ); ?></h1>
            </div>  
        <?php 
        }
    ?>
    <div class="ms_songslist_wrap">
        <ul class="ms_songslist_nav nav nav-pills" role="tablist">
            <li>
                <a class="active" data-toggle="pill" href="#top-picks" role="tab" aria-controls="top-picks" aria-selected="true">Today Top Picks</a>
            </li>
            <li>
                <a class="" data-toggle="pill" href="#trending-songs" role="tab" aria-controls="trending-songs" aria-selected="false">Trending Songs</a>
            </li>
            <li>
                <a class="" data-toggle="pill" href="#new-release" role="tab" aria-controls="new-release" aria-selected="false">New Release</a>
            </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="top-picks" role="tabpanel" aria-labelledby="top-picks">
                <div class="ms_songslist_box">
                    <ul class="ms_songlist ms_index_songlist">
                    <?php $i=01; $n = $featured_music_posts->found_posts; $rm = $n%3; 
                    while ( $featured_music_posts->have_posts() ) : $featured_music_posts->the_post(); ?>
                        <li>
                            <div class="ms_songslist_inner">
                                <div class="ms_songslist_left">
                                    <div class="songslist_number play_btn play_music" data-musicid="<?php esc_html_e(get_the_id()); ?>" data-musictype="<?php printf($list_type); ?>">
                                        <h4 class="songslist_sn">
                                            <?php echo (strlen($i) <2) ? '0'.$i : $i; ?>
                                        </h4>
                                        <span class="songslist_play"><img src="<?php echo plugin_dir_url( __FILE__ ); ?>/play_songlist.svg" alt="Play" class="img-fluid"/></span>
                                    </div> 
                                    <div class="songslist_details">
                                        <div class="songslist_thumb">
                                            <?php the_post_thumbnail( 'thumbnail' ); ?>
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
                                    <span class="ms_songslist_like" >
                                        <?php
                                            $fav_class = 'icon_fav';
                                            if(!empty($fav_music_ids)){
                                                if(in_array(get_the_id(), $fav_music_ids) ) {
			                                    $fav_class = 'icon_fav_add';
		      	                                }
                                            }
                                        ?>
                                        <a href="javascript:;" class="favourite_music" data-musicid="<?php echo esc_attr(get_the_id()); ?>"><span class="opt_icon"><span class="icon <?php echo esc_attr($fav_class); ?>"><svg xmlns:xlink="http://www.w3.org/1999/xlink" width="17px" height="16px"><path fill-rule="evenodd" d="M11.777,-0.000 C10.940,-0.000 10.139,0.197 9.395,0.585 C9.080,0.749 8.783,0.947 8.506,1.173 C8.230,0.947 7.931,0.749 7.618,0.585 C6.874,0.197 6.073,-0.000 5.236,-0.000 C2.354,-0.000 0.009,2.394 0.009,5.337 C0.009,7.335 1.010,9.428 2.986,11.557 C4.579,13.272 6.527,14.702 7.881,15.599 L8.506,16.012 L9.132,15.599 C10.487,14.701 12.436,13.270 14.027,11.557 C16.002,9.428 17.004,7.335 17.004,5.337 C17.004,2.394 14.659,-0.000 11.777,-0.000 ZM5.236,2.296 C6.168,2.296 7.027,2.738 7.590,3.507 L8.506,4.754 L9.423,3.505 C9.986,2.737 10.844,2.296 11.777,2.296 C13.403,2.296 14.727,3.660 14.727,5.337 C14.727,6.734 13.932,8.298 12.364,9.986 C11.114,11.332 9.604,12.490 8.506,13.255 C7.409,12.490 5.899,11.332 4.649,9.986 C3.081,8.298 2.286,6.734 2.286,5.337 C2.286,3.660 3.610,2.296 5.236,2.296 Z"/></svg></span></span>
                                            
                                        </a>
                                    </span>
                                    <span class="ms_songslist_time"></span>
                                    <div class="ms_songslist_more">
                                        <span class="songslist_moreicon"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="4px" height="20px"><path fill-rule="evenodd" fill="rgb(124, 142, 165)" d="M2.000,12.000 C0.895,12.000 -0.000,11.105 -0.000,10.000 C-0.000,8.895 0.895,8.000 2.000,8.000 C3.104,8.000 4.000,8.895 4.000,10.000 C4.000,11.105 3.104,12.000 2.000,12.000 ZM2.000,4.000 C0.895,4.000 -0.000,3.105 -0.000,2.000 C-0.000,0.895 0.895,-0.000 2.000,-0.000 C3.104,-0.000 4.000,0.895 4.000,2.000 C4.000,3.105 3.104,4.000 2.000,4.000 ZM2.000,16.000 C3.104,16.000 4.000,16.895 4.000,18.000 C4.000,19.105 3.104,20.000 2.000,20.000 C0.895,20.000 -0.000,19.105 -0.000,18.000 C-0.000,16.895 0.895,16.000 2.000,16.000 Z"/></svg></span>
                                        <ul class="ms_common_dropdown ms_songslist_dropdown">
                                            <li>
                                                <a href="javascript:;" class="favourite_music" data-musicid="<?php echo esc_attr(get_the_id()); ?>">
                                                    <span class="common_drop_icon drop_fav"><span class="icon <?php echo esc_attr($fav_class); ?>">
														<svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 22 22"><g id="_08-5" data-name=" 08-5"><path id="_08-6" data-name=" 08-6" class="cls-1" d="M13.7,4.49a4.34,4.34,0,0,0-2,.48,3.83,3.83,0,0,0-.73.48A3.54,3.54,0,0,0,10.27,5,4.3,4.3,0,0,0,4,8.83a7.6,7.6,0,0,0,2.46,5.05,22.38,22.38,0,0,0,4,3.29l.51.34.52-.34a23.09,23.09,0,0,0,4-3.29A7.63,7.63,0,0,0,18,8.83,4.34,4.34,0,0,0,13.7,4.49ZM8.31,6.36a2.42,2.42,0,0,1,1.94,1l.75,1,.76-1a2.39,2.39,0,0,1,1.94-1,2.45,2.45,0,0,1,2.43,2.47,5.89,5.89,0,0,1-1.95,3.78A20.15,20.15,0,0,1,11,15.26a20.07,20.07,0,0,1-3.17-2.65A5.89,5.89,0,0,1,5.88,8.83,2.45,2.45,0,0,1,8.31,6.36Z"/></g></svg>
													</span></span><?php esc_html_e('Favourites', 'miraculous'); ?>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;" class="ms_download" data-msmusic="<?php echo esc_attr(get_the_id()); ?>">
                                                    <span class="common_drop_icon drop_downld">
														<svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 22 22"><g id="_06-4" data-name=" 06-4"><path id="_06-5" data-name=" 06-5" class="cls-1" d="M10.65,13.85a.48.48,0,0,0,.7,0l3.27-3.5a.41.41,0,0,0,.07-.47.48.48,0,0,0-.42-.26H12.4V4.94a.46.46,0,0,0-.47-.44H10.07a.46.46,0,0,0-.47.44V9.63H7.73a.44.44,0,0,0-.42.25.41.41,0,0,0,.07.47Zm5.48-.73v2.63H5.87V13.12H4v3.5a.9.9,0,0,0,.93.88H17.07a.9.9,0,0,0,.93-.88v-3.5Z"/></g></svg>
													</span><?php esc_html_e('Download Now', 'miraculous'); ?>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;" class="ms_add_playlist" data-msmusic="<?php echo esc_attr(get_the_id()); ?>">
                                                    <span class="common_drop_icon drop_playlist">
														<svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 22 22"><g id="_03-2" data-name=" 03-2"><path id="_03-3" data-name=" 03-3" class="cls-1" d="M13,5.5H3.5V7.07H13V5.5Zm0,3.14H3.5v1.57H13V8.64ZM3.5,13.36H9.82V11.79H3.5ZM14.55,5.5v6.43a2.35,2.35,0,1,0,1.58,2.21V7.07H18.5V5.5Z"/></g></svg>
													</span><?php esc_html_e('Add To Playlist', 'miraculous'); ?>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;" class="ms_share_music" data-shareuri="<?php esc_attr_e(get_the_permalink()); ?>" data-sharename="<?php the_title_attribute(); ?>">
                                                    <span class="common_drop_icon drop_share">
														<svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 22 22"><g id="_14-2" data-name=" 14-2"><path id="_13" data-name=" 13" class="cls-1" d="M8.68,13.18A2.78,2.78,0,0,1,4.77,13l-.07-.08a3,3,0,0,1,0-3.85,2.77,2.77,0,0,1,3.89-.36.52.52,0,0,1,.11.1l3-2.11.09-.06a1.09,1.09,0,0,0,.63-1.08A2.76,2.76,0,0,1,15.05,3,2.84,2.84,0,0,1,17.9,5.22a3,3,0,0,1-1.36,3.22,2.72,2.72,0,0,1-3.34-.5l-.27-.3C11.81,8.41,10.7,9.18,9.6,10a.37.37,0,0,0-.09.28q0,.75,0,1.5a.51.51,0,0,0,.13.34c1.08.77,2.18,1.52,3.3,2.3a2.89,2.89,0,0,1,1.76-1.15A2.83,2.83,0,0,1,18,15.56h0A2.92,2.92,0,0,1,15.72,19a2.82,2.82,0,0,1-3.28-2.28,3.33,3.33,0,0,1,0-.63.55.55,0,0,0-.16-.38ZM6.82,9.55a1.45,1.45,0,0,0,0,2.9,1.45,1.45,0,0,0,0-2.9ZM15.2,7.36a1.43,1.43,0,0,0,1.39-1.45h0A1.4,1.4,0,1,0,15.2,7.36Zm0,7.29a1.42,1.42,0,0,0-1.4,1.43h0a1.4,1.4,0,0,0,1.44,1.36,1.4,1.4,0,0,0,0-2.8Z"/></g></svg>
													</span><?php esc_html_e('Share', 'miraculous'); ?>
                                                </a>
                                             </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <?php 
                            $i++; endwhile;
                            wp_reset_postdata(); 
                        ?>
                    </ul>
                </div>
            </div>
            <div class="tab-pane fade" id="trending-songs" role="tabpanel" aria-labelledby="trending-songs">
                <div class="ms_songslist_box">
                    <ul class="ms_songlist ms_index_songlist">
                    <?php $i=01; $n = $top_music_posts->found_posts; $rm = $n%3; 
                    while ( $top_music_posts->have_posts() ) : $top_music_posts->the_post(); ?>
                        <li>
                            <div class="ms_songslist_inner">
                                <div class="ms_songslist_left">
                                    <div class="songslist_number play_btn play_music" data-musicid="<?php esc_html_e(get_the_id()); ?>" data-musictype="<?php printf($list_type); ?>">
                                        <h4 class="songslist_sn">
                                            <?php echo (strlen($i) <2) ? '0'.$i : $i; ?>
                                        </h4>
                                        <span class="songslist_play"><img src="<?php echo plugin_dir_url( __FILE__ ); ?>/play_songlist.svg" alt="Play" class="img-fluid"/></span>
                                    </div> 
                                    <div class="songslist_details">
                                        <div class="songslist_thumb">
                                            <?php the_post_thumbnail( 'thumbnail' ); ?>
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
                                    <span class="ms_songslist_like" >
                                        <?php
                                            $fav_class = 'icon_fav';
                                            if(!empty($fav_music_ids)){
                                                if(in_array(get_the_id(), $fav_music_ids) ) {
			                                    $fav_class = 'icon_fav_add';
		      	                                }
                                            }
                                        ?>
                                        <a href="javascript:;" class="favourite_music" data-musicid="<?php echo esc_attr(get_the_id()); ?>"><span class="opt_icon"><span class="icon <?php echo esc_attr($fav_class); ?>"><svg xmlns:xlink="http://www.w3.org/1999/xlink" width="17px" height="16px"><path fill-rule="evenodd" d="M11.777,-0.000 C10.940,-0.000 10.139,0.197 9.395,0.585 C9.080,0.749 8.783,0.947 8.506,1.173 C8.230,0.947 7.931,0.749 7.618,0.585 C6.874,0.197 6.073,-0.000 5.236,-0.000 C2.354,-0.000 0.009,2.394 0.009,5.337 C0.009,7.335 1.010,9.428 2.986,11.557 C4.579,13.272 6.527,14.702 7.881,15.599 L8.506,16.012 L9.132,15.599 C10.487,14.701 12.436,13.270 14.027,11.557 C16.002,9.428 17.004,7.335 17.004,5.337 C17.004,2.394 14.659,-0.000 11.777,-0.000 ZM5.236,2.296 C6.168,2.296 7.027,2.738 7.590,3.507 L8.506,4.754 L9.423,3.505 C9.986,2.737 10.844,2.296 11.777,2.296 C13.403,2.296 14.727,3.660 14.727,5.337 C14.727,6.734 13.932,8.298 12.364,9.986 C11.114,11.332 9.604,12.490 8.506,13.255 C7.409,12.490 5.899,11.332 4.649,9.986 C3.081,8.298 2.286,6.734 2.286,5.337 C2.286,3.660 3.610,2.296 5.236,2.296 Z"/></svg></span></span>
                                            
                                        </a>
                                    </span>
                                    <span class="ms_songslist_time">04:23</span>
                                    <div class="ms_songslist_more">
                                        <span class="songslist_moreicon"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="4px" height="20px"><path fill-rule="evenodd" fill="rgb(124, 142, 165)" d="M2.000,12.000 C0.895,12.000 -0.000,11.105 -0.000,10.000 C-0.000,8.895 0.895,8.000 2.000,8.000 C3.104,8.000 4.000,8.895 4.000,10.000 C4.000,11.105 3.104,12.000 2.000,12.000 ZM2.000,4.000 C0.895,4.000 -0.000,3.105 -0.000,2.000 C-0.000,0.895 0.895,-0.000 2.000,-0.000 C3.104,-0.000 4.000,0.895 4.000,2.000 C4.000,3.105 3.104,4.000 2.000,4.000 ZM2.000,16.000 C3.104,16.000 4.000,16.895 4.000,18.000 C4.000,19.105 3.104,20.000 2.000,20.000 C0.895,20.000 -0.000,19.105 -0.000,18.000 C-0.000,16.895 0.895,16.000 2.000,16.000 Z"/></svg></span>
                                        <ul class="ms_common_dropdown ms_songslist_dropdown">
                                            <li>
                                                <a href="javascript:;" class="favourite_music" data-musicid="<?php echo esc_attr(get_the_id()); ?>">
                                                    <span class="common_drop_icon drop_fav"><span class="icon <?php echo esc_attr($fav_class); ?>">
														<svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 22 22"><g id="_08-5" data-name=" 08-5"><path id="_08-6" data-name=" 08-6" class="cls-1" d="M13.7,4.49a4.34,4.34,0,0,0-2,.48,3.83,3.83,0,0,0-.73.48A3.54,3.54,0,0,0,10.27,5,4.3,4.3,0,0,0,4,8.83a7.6,7.6,0,0,0,2.46,5.05,22.38,22.38,0,0,0,4,3.29l.51.34.52-.34a23.09,23.09,0,0,0,4-3.29A7.63,7.63,0,0,0,18,8.83,4.34,4.34,0,0,0,13.7,4.49ZM8.31,6.36a2.42,2.42,0,0,1,1.94,1l.75,1,.76-1a2.39,2.39,0,0,1,1.94-1,2.45,2.45,0,0,1,2.43,2.47,5.89,5.89,0,0,1-1.95,3.78A20.15,20.15,0,0,1,11,15.26a20.07,20.07,0,0,1-3.17-2.65A5.89,5.89,0,0,1,5.88,8.83,2.45,2.45,0,0,1,8.31,6.36Z"/></g></svg>
													</span></span><?php esc_html_e('Favourites', 'miraculous'); ?>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;" class="ms_download" data-msmusic="<?php echo esc_attr(get_the_id()); ?>">
                                                    <span class="common_drop_icon drop_downld">
														<svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 22 22"><g id="_06-4" data-name=" 06-4"><path id="_06-5" data-name=" 06-5" class="cls-1" d="M10.65,13.85a.48.48,0,0,0,.7,0l3.27-3.5a.41.41,0,0,0,.07-.47.48.48,0,0,0-.42-.26H12.4V4.94a.46.46,0,0,0-.47-.44H10.07a.46.46,0,0,0-.47.44V9.63H7.73a.44.44,0,0,0-.42.25.41.41,0,0,0,.07.47Zm5.48-.73v2.63H5.87V13.12H4v3.5a.9.9,0,0,0,.93.88H17.07a.9.9,0,0,0,.93-.88v-3.5Z"/></g></svg>
													</span><?php esc_html_e('Download Now', 'miraculous'); ?>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;" class="ms_add_playlist" data-msmusic="<?php echo esc_attr(get_the_id()); ?>">
                                                    <span class="common_drop_icon drop_playlist">
														<svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 22 22"><g id="_03-2" data-name=" 03-2"><path id="_03-3" data-name=" 03-3" class="cls-1" d="M13,5.5H3.5V7.07H13V5.5Zm0,3.14H3.5v1.57H13V8.64ZM3.5,13.36H9.82V11.79H3.5ZM14.55,5.5v6.43a2.35,2.35,0,1,0,1.58,2.21V7.07H18.5V5.5Z"/></g></svg>
													</span><?php esc_html_e('Add To Playlist', 'miraculous'); ?>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;" class="ms_share_music" data-shareuri="<?php esc_attr_e(get_the_permalink()); ?>" data-sharename="<?php the_title_attribute(); ?>">
                                                    <span class="common_drop_icon drop_share">
														<svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 22 22"><g id="_14-2" data-name=" 14-2"><path id="_13" data-name=" 13" class="cls-1" d="M8.68,13.18A2.78,2.78,0,0,1,4.77,13l-.07-.08a3,3,0,0,1,0-3.85,2.77,2.77,0,0,1,3.89-.36.52.52,0,0,1,.11.1l3-2.11.09-.06a1.09,1.09,0,0,0,.63-1.08A2.76,2.76,0,0,1,15.05,3,2.84,2.84,0,0,1,17.9,5.22a3,3,0,0,1-1.36,3.22,2.72,2.72,0,0,1-3.34-.5l-.27-.3C11.81,8.41,10.7,9.18,9.6,10a.37.37,0,0,0-.09.28q0,.75,0,1.5a.51.51,0,0,0,.13.34c1.08.77,2.18,1.52,3.3,2.3a2.89,2.89,0,0,1,1.76-1.15A2.83,2.83,0,0,1,18,15.56h0A2.92,2.92,0,0,1,15.72,19a2.82,2.82,0,0,1-3.28-2.28,3.33,3.33,0,0,1,0-.63.55.55,0,0,0-.16-.38ZM6.82,9.55a1.45,1.45,0,0,0,0,2.9,1.45,1.45,0,0,0,0-2.9ZM15.2,7.36a1.43,1.43,0,0,0,1.39-1.45h0A1.4,1.4,0,1,0,15.2,7.36Zm0,7.29a1.42,1.42,0,0,0-1.4,1.43h0a1.4,1.4,0,0,0,1.44,1.36,1.4,1.4,0,0,0,0-2.8Z"/></g></svg>
													</span><?php esc_html_e('Share', 'miraculous'); ?>
                                                </a>
                                             </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <?php 
                            $i++; endwhile;
                            wp_reset_postdata(); 
                        ?>
                    </ul>
                </div>
            </div>
            <div class="tab-pane fade" id="new-release" role="tabpanel" aria-labelledby="new-release">
                <div class="ms_songslist_box">
                    <ul class="ms_songlist ms_index_songlist">
                    <?php $i=01; $n = $trending_music_posts->found_posts; $rm = $n%3; 
                    while ( $trending_music_posts->have_posts() ) : $trending_music_posts->the_post(); ?>
                        <li>
                            <div class="ms_songslist_inner">
                                <div class="ms_songslist_left">
                                    <div class="songslist_number play_btn play_music" data-musicid="<?php esc_html_e(get_the_id()); ?>" data-musictype="<?php printf($list_type); ?>">
                                        <h4 class="songslist_sn">
                                            <?php echo (strlen($i) <2) ? '0'.$i : $i; ?>
                                        </h4>
                                        <span class="songslist_play"><img src="<?php echo plugin_dir_url( __FILE__ ); ?>/play_songlist.svg" alt="Play" class="img-fluid"/></span>
                                    </div> 
                                    <div class="songslist_details">
                                        <div class="songslist_thumb">
                                            <?php the_post_thumbnail( 'thumbnail' ); ?>
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
                                    <span class="ms_songslist_like" >
                                        <?php
                                            $fav_class = 'icon_fav';
                                            if(!empty($fav_music_ids)){
                                                if(in_array(get_the_id(), $fav_music_ids) ) {
			                                    $fav_class = 'icon_fav_add';
		      	                                }
                                            }
                                        ?>
                                        <a href="javascript:;" class="favourite_music" data-musicid="<?php echo esc_attr(get_the_id()); ?>"><span class="opt_icon"><span class="icon <?php echo esc_attr($fav_class); ?>"><svg xmlns:xlink="http://www.w3.org/1999/xlink" width="17px" height="16px"><path fill-rule="evenodd" d="M11.777,-0.000 C10.940,-0.000 10.139,0.197 9.395,0.585 C9.080,0.749 8.783,0.947 8.506,1.173 C8.230,0.947 7.931,0.749 7.618,0.585 C6.874,0.197 6.073,-0.000 5.236,-0.000 C2.354,-0.000 0.009,2.394 0.009,5.337 C0.009,7.335 1.010,9.428 2.986,11.557 C4.579,13.272 6.527,14.702 7.881,15.599 L8.506,16.012 L9.132,15.599 C10.487,14.701 12.436,13.270 14.027,11.557 C16.002,9.428 17.004,7.335 17.004,5.337 C17.004,2.394 14.659,-0.000 11.777,-0.000 ZM5.236,2.296 C6.168,2.296 7.027,2.738 7.590,3.507 L8.506,4.754 L9.423,3.505 C9.986,2.737 10.844,2.296 11.777,2.296 C13.403,2.296 14.727,3.660 14.727,5.337 C14.727,6.734 13.932,8.298 12.364,9.986 C11.114,11.332 9.604,12.490 8.506,13.255 C7.409,12.490 5.899,11.332 4.649,9.986 C3.081,8.298 2.286,6.734 2.286,5.337 C2.286,3.660 3.610,2.296 5.236,2.296 Z"/></svg></span></span>
                                            
                                        </a>
                                    </span>
                                    <span class="ms_songslist_time">04:23</span>
                                    <div class="ms_songslist_more">
                                        <span class="songslist_moreicon"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="4px" height="20px"><path fill-rule="evenodd" fill="rgb(124, 142, 165)" d="M2.000,12.000 C0.895,12.000 -0.000,11.105 -0.000,10.000 C-0.000,8.895 0.895,8.000 2.000,8.000 C3.104,8.000 4.000,8.895 4.000,10.000 C4.000,11.105 3.104,12.000 2.000,12.000 ZM2.000,4.000 C0.895,4.000 -0.000,3.105 -0.000,2.000 C-0.000,0.895 0.895,-0.000 2.000,-0.000 C3.104,-0.000 4.000,0.895 4.000,2.000 C4.000,3.105 3.104,4.000 2.000,4.000 ZM2.000,16.000 C3.104,16.000 4.000,16.895 4.000,18.000 C4.000,19.105 3.104,20.000 2.000,20.000 C0.895,20.000 -0.000,19.105 -0.000,18.000 C-0.000,16.895 0.895,16.000 2.000,16.000 Z"/></svg></span>
                                        <ul class="ms_common_dropdown ms_songslist_dropdown">
                                            <li>
                                                <a href="javascript:;" class="favourite_music" data-musicid="<?php echo esc_attr(get_the_id()); ?>">
                                                    <span class="common_drop_icon drop_fav"><span class="icon <?php echo esc_attr($fav_class); ?>">
														<svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 22 22"><g id="_08-5" data-name=" 08-5"><path id="_08-6" data-name=" 08-6" class="cls-1" d="M13.7,4.49a4.34,4.34,0,0,0-2,.48,3.83,3.83,0,0,0-.73.48A3.54,3.54,0,0,0,10.27,5,4.3,4.3,0,0,0,4,8.83a7.6,7.6,0,0,0,2.46,5.05,22.38,22.38,0,0,0,4,3.29l.51.34.52-.34a23.09,23.09,0,0,0,4-3.29A7.63,7.63,0,0,0,18,8.83,4.34,4.34,0,0,0,13.7,4.49ZM8.31,6.36a2.42,2.42,0,0,1,1.94,1l.75,1,.76-1a2.39,2.39,0,0,1,1.94-1,2.45,2.45,0,0,1,2.43,2.47,5.89,5.89,0,0,1-1.95,3.78A20.15,20.15,0,0,1,11,15.26a20.07,20.07,0,0,1-3.17-2.65A5.89,5.89,0,0,1,5.88,8.83,2.45,2.45,0,0,1,8.31,6.36Z"/></g></svg>
													</span></span><?php esc_html_e('Favourites', 'miraculous'); ?>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;" class="ms_download" data-msmusic="<?php echo esc_attr(get_the_id()); ?>">
                                                    <span class="common_drop_icon drop_downld">
														<svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 22 22"><g id="_06-4" data-name=" 06-4"><path id="_06-5" data-name=" 06-5" class="cls-1" d="M10.65,13.85a.48.48,0,0,0,.7,0l3.27-3.5a.41.41,0,0,0,.07-.47.48.48,0,0,0-.42-.26H12.4V4.94a.46.46,0,0,0-.47-.44H10.07a.46.46,0,0,0-.47.44V9.63H7.73a.44.44,0,0,0-.42.25.41.41,0,0,0,.07.47Zm5.48-.73v2.63H5.87V13.12H4v3.5a.9.9,0,0,0,.93.88H17.07a.9.9,0,0,0,.93-.88v-3.5Z"/></g></svg>
													</span><?php esc_html_e('Download Now', 'miraculous'); ?>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;" class="ms_add_playlist" data-msmusic="<?php echo esc_attr(get_the_id()); ?>">
                                                    <span class="common_drop_icon drop_playlist">
														<svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 22 22"><g id="_03-2" data-name=" 03-2"><path id="_03-3" data-name=" 03-3" class="cls-1" d="M13,5.5H3.5V7.07H13V5.5Zm0,3.14H3.5v1.57H13V8.64ZM3.5,13.36H9.82V11.79H3.5ZM14.55,5.5v6.43a2.35,2.35,0,1,0,1.58,2.21V7.07H18.5V5.5Z"/></g></svg>
													</span><?php esc_html_e('Add To Playlist', 'miraculous'); ?>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;" class="ms_share_music" data-shareuri="<?php esc_attr_e(get_the_permalink()); ?>" data-sharename="<?php the_title_attribute(); ?>">
                                                    <span class="common_drop_icon drop_share">
														<svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 22 22"><g id="_14-2" data-name=" 14-2"><path id="_13" data-name=" 13" class="cls-1" d="M8.68,13.18A2.78,2.78,0,0,1,4.77,13l-.07-.08a3,3,0,0,1,0-3.85,2.77,2.77,0,0,1,3.89-.36.52.52,0,0,1,.11.1l3-2.11.09-.06a1.09,1.09,0,0,0,.63-1.08A2.76,2.76,0,0,1,15.05,3,2.84,2.84,0,0,1,17.9,5.22a3,3,0,0,1-1.36,3.22,2.72,2.72,0,0,1-3.34-.5l-.27-.3C11.81,8.41,10.7,9.18,9.6,10a.37.37,0,0,0-.09.28q0,.75,0,1.5a.51.51,0,0,0,.13.34c1.08.77,2.18,1.52,3.3,2.3a2.89,2.89,0,0,1,1.76-1.15A2.83,2.83,0,0,1,18,15.56h0A2.92,2.92,0,0,1,15.72,19a2.82,2.82,0,0,1-3.28-2.28,3.33,3.33,0,0,1,0-.63.55.55,0,0,0-.16-.38ZM6.82,9.55a1.45,1.45,0,0,0,0,2.9,1.45,1.45,0,0,0,0-2.9ZM15.2,7.36a1.43,1.43,0,0,0,1.39-1.45h0A1.4,1.4,0,1,0,15.2,7.36Zm0,7.29a1.42,1.42,0,0,0-1.4,1.43h0a1.4,1.4,0,0,0,1.44,1.36,1.4,1.4,0,0,0,0-2.8Z"/></g></svg>
													</span><?php esc_html_e('Share', 'miraculous'); ?>
                                                </a>
                                             </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <?php 
                            $i++; endwhile;
                            wp_reset_postdata(); 
                        ?>
                    </ul>
                </div>
            </div>
        </div>    
    </div>
</div>