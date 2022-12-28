<?php
/**
 * Awesomesauce class.
 *
 * @category   Class
 */

namespace ElementorMiraculous;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use \Elementor\Group_Control_Typography;

// Security Note: Blocks direct access to the plugin PHP files.
defined( 'ABSPATH' ) || die();

/**
 * Awesomesauce widget class.
 *
 * @since 1.0.0
 */
class Miraculous_purchasedtrack extends Widget_Base {

	/**
	 * Retrieve the widget name.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'Purchased Tracks';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Purchased Tracks', 'miraculous' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-parallax';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * Note that currently Elementor supports only one category.
	 * When multiple categories passed, Elementor uses the first one.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return array( 'miraculous-widget' );
	}
	
	/**
	 * Register the widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function register_controls() {
	    $options = array();
		$this->start_controls_section(
            'heading',
            [
                'label' => esc_html__( 'Purchased Tracks', 'miraculous' ),
            ]
        );
        $this->add_control(
            'purchased_heading',
            [
                'label'       => esc_html__( 'Heading', 'miraculous' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'default'     => esc_html__( '', 'miraculous' ),
            ]
        );
        $this->add_control(
			'style_format',
			[
				'label' => esc_html__( 'Style format', 'miraculous' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'abstyle1',
				'options' => [
					'arstyle1'  => esc_html__( 'Style 1', 'miraculous' ),
					'arstyle2' => esc_html__( 'Style 2', 'miraculous' ),
				],
			]
		);
        $this->end_controls_section();
	}

	/**
	 * Render the widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
        
        $miraculous_theme_data = '';
        if (function_exists('fw_get_db_settings_option')):  
            $miraculous_theme_data = fw_get_db_settings_option();     
        endif; 
        $currency = '';
        if(!empty($miraculous_theme_data['currency']) && function_exists('miraculous_currency_symbol')):
            $currency = miraculous_currency_symbol( $miraculous_theme_data['currency'] );
        endif;
        $list_type = 'music';
        $close_icone = get_template_directory_uri().'/assets/images/svg/close.svg';
        $user_id = get_current_user_id();
        $lang_data = get_option('language_filter_ids_'.$user_id);
        $fav_music_ids = '';
        if($user_id){
            $fav_music_ids = get_user_meta($user_id, 'favourites_songs_lists'.$user_id, true);
        }
        
        $music_ids = get_user_meta($user_id, 'premium_downloaded_songs_by_user_'.$user_id, true);
        $sg_number = -1;
        if( is_user_logged_in() && $lang_data ){
            $sg_args = array('post_type' => 'ms-music',
                        'posts_per_page' => $sg_number,
                        'post__in' => $music_ids,
                        'tax_query' => array(
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
                        'post__in' => $music_ids,
                        'tax_query' => array(
                                array(
                                    'taxonomy' => 'language',
                                    'terms' => $lang_data
                                )
                            )
                        );
        }else{
            $sg_args = array('post_type' => 'ms-music',
                        'posts_per_page' => $sg_number,
                        'post__in' => $music_ids,
                        );
        }
        
        // the query
        $music_posts = new \WP_Query( $sg_args );
        if( $music_posts->have_posts() && $user_id && $music_ids): 
        if($settings['style_format'] == 'arstyle2'){ ?>
                <div class="ms_download_inner">
                    <div class="album_inner_list">
                        <div class="slider_heading_wrap marger_bottom30">
                            <?php if(!empty($settings['purchased_heading'])){ ?>
                            <div class="slider_cheading">
                                <h4 class="cheading_title"><?php echo esc_html($settings['purchased_heading']); ?></h4>
                            </div> 
                            <?php } ?>
                        </div>
                    <div class="album_list_wrapper">
                        <ul class="album_list_name">
                            <li>#</li>
                            <li>Song Title</li>
                            <li>Album</li>
                            <li class="text-center">Duration</li>
                            <li class="text-center">Add To Favourites</li>
                            <li class="text-center">More</li>
                            <li class="text-center">remove</li>
                        </ul>
                         <?php $i=1; while ( $music_posts->have_posts() ) : $music_posts->the_post(); ?>
                        <ul>
                            <li>
                                <a href="javascript:;" class="dwld_sn">
                                    <span class="play_no"><?php echo (strlen($i) < 2) ? '0'.$i : $i; ?></span>
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
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:;" data-musicid="<?php echo esc_attr(get_the_id()); ?>" class="play_single_music"><?php the_title(); ?>
                                </a>
                            </li>
                                    <?php
                                        $artists_name = array();
                                        $music_price = '';
                                        if(function_exists('fw_get_db_post_option')){
                                            $artists_ids = fw_get_db_post_option(get_the_id(), 'music_artists'); 
                                            foreach($artists_ids as $artists_id) {
                                                $artists_name[] = get_the_title($artists_id);
                                            } 
        									$music_price = get_post_meta(get_the_ID(),'fw_option:single_music_prices',true);
                                        }
                                    ?>
                            <li>
                                <a href="javascript:;" class="play_single_music"><?php echo implode(', ', $artists_name); ?>
                                </a>
                            </li>
                           <?php $music_extranal_url = get_post_meta(get_the_id(), 'fw_option:music_extranal_url', true);
                                        if(!empty($music_extranal_url)):
                                            $mpurl = $music_extranal_url;
                                        else:
                                            $mpurl = get_post_meta(get_the_id(), 'fw_option:mp3_full_songs', true);
                                        endif;
                                        $attach_meta = '';
                                        if($mpurl) {
                                            $attach_meta = wp_get_attachment_metadata( $mpurl['attachment_id'] );
                                        }
                                        $fav_class = 'icon_fav';
                                        if(!empty($fav_music_ids)){
                                            if( in_array(get_the_id(), $fav_music_ids) ) {
                			                    $fav_class = 'icon_fav_add';
                		      	            }
                                        } ?>
                                        
                            <li class="text-center"><a href="javascript:;"><?php echo (isset($attach_meta['length_formatted'])) ? $attach_meta['length_formatted'] : "0.00"; ?></a></li>
                            <li class="text-center">
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
                                                
                            </li>
                            <li class="list_more">
                                <a href="javascript:;" class="songslist_moreicon">
                                    <span >
                                        <svg xmlns:xlink="http://www.w3.org/1999/xlink" width="4px" height="20px"><path fill-rule="evenodd" fill="rgb(124, 142, 165)" d="M2.000,12.000 C0.895,12.000 -0.000,11.105 -0.000,10.000 C-0.000,8.895 0.895,8.000 2.000,8.000 C3.104,8.000 4.000,8.895 4.000,10.000 C4.000,11.105 3.104,12.000 2.000,12.000 ZM2.000,4.000 C0.895,4.000 -0.000,3.105 -0.000,2.000 C-0.000,0.895 0.895,-0.000 2.000,-0.000 C3.104,-0.000 4.000,0.895 4.000,2.000 C4.000,3.105 3.104,4.000 2.000,4.000 ZM2.000,16.000 C3.104,16.000 4.000,16.895 4.000,18.000 C4.000,19.104 3.104,20.000 2.000,20.000 C0.895,20.000 -0.000,19.104 -0.000,18.000 C-0.000,16.895 0.895,16.000 2.000,16.000 Z"/></svg>
                                    </span>
                                </a>
                                <ul class="ms_common_dropdown ms_downlod_list">
                                    <li>
                                        <a href="javascript:;" class="favourite_music" data-musicid="<?php echo esc_attr(get_the_id()); ?>">
                                            <span class="common_drop_icon drop_fav"><span class="icon <?php echo esc_attr($fav_class); ?>">
        										<svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 22 22"><g id="_08-5" data-name=" 08-5"><path id="_08-6" data-name=" 08-6" class="cls-1" d="M13.7,4.49a4.34,4.34,0,0,0-2,.48,3.83,3.83,0,0,0-.73.48A3.54,3.54,0,0,0,10.27,5,4.3,4.3,0,0,0,4,8.83a7.6,7.6,0,0,0,2.46,5.05,22.38,22.38,0,0,0,4,3.29l.51.34.52-.34a23.09,23.09,0,0,0,4-3.29A7.63,7.63,0,0,0,18,8.83,4.34,4.34,0,0,0,13.7,4.49ZM8.31,6.36a2.42,2.42,0,0,1,1.94,1l.75,1,.76-1a2.39,2.39,0,0,1,1.94-1,2.45,2.45,0,0,1,2.43,2.47,5.89,5.89,0,0,1-1.95,3.78A20.15,20.15,0,0,1,11,15.26a20.07,20.07,0,0,1-3.17-2.65A5.89,5.89,0,0,1,5.88,8.83,2.45,2.45,0,0,1,8.31,6.36Z"/></g></svg>
        									</span></span><?php esc_html_e('Favourites', 'miraculous'); ?></a>
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
                            </li>
                            <li class="text-center">
                                <a href="javascript:;" class="remove_<?php echo esc_attr($sg_type); ?>_music" musicid="<?php echo esc_attr(get_the_id()); ?>">
                                    <?php if(!empty($close_icone)): ?>
                                    <span class="list_close">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink"
                                                width="8px" height="8px">
                                                <path fill-rule="evenodd"  fill="rgb(124 142 165)"
                                                d="M4.945,3.993 L7.802,1.135 C8.065,0.872 8.065,0.446 7.802,0.183 C7.539,-0.080 7.113,-0.080 6.850,0.183 L3.993,3.040 L1.135,0.183 C0.872,-0.080 0.446,-0.080 0.183,0.183 C-0.080,0.446 -0.080,0.872 0.183,1.135 L3.040,3.993 L0.183,6.850 C-0.080,7.113 -0.080,7.539 0.183,7.802 C0.446,8.065 0.872,8.065 1.135,7.802 L3.993,4.945 L6.850,7.802 C7.113,8.065 7.539,8.065 7.802,7.802 C8.065,7.539 8.065,7.113 7.802,6.850 L4.945,3.993 Z"/>
                                        </svg>
                                    </span>
                                    <?php endif; ?>  
                                </a>
                            </li>
                        </ul>
                        <?php $i++; endwhile; ?>
                    </div>
                    <div class="ms_view_more padder_bottom20 padder_top50 text-center">
                        <a href="javascript:;" class="ms_btn">view more</a>
                    </div>
                </div>
            </div>
            </div>
            
        <?php } else { ?>
            <!-- Free Download Css Start -->
            <div class="ms_free_download ms_purchase_wrapper">
                <?php if(!empty($settings['purchased_heading'])){ ?>
                <div class="ms_heading">
                    <h1><?php echo esc_html( $settings['purchased_heading'] ); ?></h1>
                </div>
                <?php } ?>
                <div class="album_inner_list">
                    <div class="album_list_wrapper">
                        <ul class="album_list_name">
                            <li><?php esc_html_e('#', 'miraculous'); ?></li>
                            <li><?php esc_html_e('Song Title', 'miraculous'); ?></li>
                            <li><?php esc_html_e('Artist', 'miraculous'); ?></li>
                            <li class="text-center"><?php esc_html_e('price', 'miraculous'); ?></li>
                            <li class="text-center"><?php esc_html_e('Duration', 'miraculous'); ?></li>
                            <li class="text-center"><?php esc_html_e('More', 'miraculous') ?></li>
                            <li class="text-center">
                                <?php esc_html_e('remove','miraculous');?></li>
                        </ul>
                        <?php $i=1; while ( $music_posts->have_posts() ) : $music_posts->the_post(); ?>
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
                                            foreach($artists_ids as $artists_id) {
                                                $artists_name[] = get_the_title($artists_id);
                                            } 
                                            
                                            $music_type  = fw_get_db_post_option(get_the_id(), 'music_types');
                                            if( !empty( $music_type == 'premium') ){
                                                $music_price = fw_get_db_post_option(get_the_id(), 'single_music_prices');
                                            }
                                            
                                        }
                                     $sg_type ='premium';
                                    ?>
                                    <li><a href="javascript:;" class="play_single_music"><?php echo implode(', ', $artists_name); ?></a></li>
                                    <?php if($sg_type == 'free'): ?>
                                            <li class="text-center"><a href="javascript:;" data-id="test"><?php esc_html_e('Free', 'miraculous'); ?></a></li>
                                        <?php else: 
                                            if( !empty( $music_type == 'premium') ){
                                            ?>
                                            <li class="text-center"><a href="javascript:;"><?php printf( __('%s %s', 'miraculous'), $currency, $music_price ); ?></a></li>
                                            <?php 
                                            }else{
                                               ?>
                                                <li class="text-center"><a href="javascript:;" data-id="test"><?php esc_html_e('Free', 'miraculous'); ?></a></li>
                                            <?php 
                                            }
                                        endif;
                                        $music_extranal_url = get_post_meta(get_the_id(), 'fw_option:music_extranal_url', true);
                                        if(!empty($music_extranal_url)):
                                            $mpurl = $music_extranal_url;
                                        else:
                                            $mpurl = get_post_meta(get_the_id(), 'fw_option:mp3_full_songs', true);
                                        endif;
                                        $attach_meta = '';
                                        if(!empty($mpurl['attachment_id'])) {
                                            $attach_meta = wp_get_attachment_metadata( $mpurl['attachment_id'] );
                                        }
                                        $fav_class = 'icon_fav';
                                        if(!empty($fav_music_ids)){
                                            if( in_array(get_the_id(), $fav_music_ids) ) {
                			                    $fav_class = 'icon_fav_add';
                		      	            }
                                        } ?>
                                    <li class="text-center"><a href="javascript:;"><?php echo (isset($attach_meta['length_formatted'])) ? $attach_meta['length_formatted'] : "0.00"; ?></a></li>
                                    <li class="text-center ms_more_icon"><a href="javascript:;"><span class="ms_icon1 ms_active_icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="15px" height="4px">
                                        <path fill-rule="evenodd" d="M13.000,3.999 C11.897,3.999 11.000,3.102 11.000,1.999 C11.000,0.897 11.897,-0.001 13.000,-0.001 C14.103,-0.001 15.000,0.897 15.000,1.999 C15.000,3.102 14.103,3.999 13.000,3.999 ZM7.500,3.999 C6.397,3.999 5.500,3.102 5.500,1.999 C5.500,0.897 6.397,-0.001 7.500,-0.001 C8.603,-0.001 9.500,0.897 9.500,1.999 C9.500,3.102 8.603,3.999 7.500,3.999 ZM2.000,3.999 C0.897,3.999 -0.000,3.102 -0.000,1.999 C-0.000,0.897 0.897,-0.001 2.000,-0.001 C3.103,-0.001 4.000,0.897 4.000,1.999 C4.000,3.102 3.103,3.999 2.000,3.999 Z"/>
                                        </svg>
                                    </span></a>
                                        <ul class="more_option">
                                            <li><a href="javascript:;" class="favourite_music" data-musicid="<?php esc_attr(get_the_id()); ?>"><span class="opt_icon"><span class="icon <?php echo esc_attr($fav_class); ?>">
        										<svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 22 22"><g id="_08-5" data-name=" 08-5"><path id="_08-6" data-name=" 08-6" class="cls-1" d="M13.7,4.49a4.34,4.34,0,0,0-2,.48,3.83,3.83,0,0,0-.73.48A3.54,3.54,0,0,0,10.27,5,4.3,4.3,0,0,0,4,8.83a7.6,7.6,0,0,0,2.46,5.05,22.38,22.38,0,0,0,4,3.29l.51.34.52-.34a23.09,23.09,0,0,0,4-3.29A7.63,7.63,0,0,0,18,8.83,4.34,4.34,0,0,0,13.7,4.49ZM8.31,6.36a2.42,2.42,0,0,1,1.94,1l.75,1,.76-1a2.39,2.39,0,0,1,1.94-1,2.45,2.45,0,0,1,2.43,2.47,5.89,5.89,0,0,1-1.95,3.78A20.15,20.15,0,0,1,11,15.26a20.07,20.07,0,0,1-3.17-2.65A5.89,5.89,0,0,1,5.88,8.83,2.45,2.45,0,0,1,8.31,6.36Z"/></g></svg>
        									</span></span><?php esc_html_e('Favourites', 'miraculous'); ?></a></li>
                                            <li><a href="javascript:;" class="add_to_queue" data-musicid="<?php esc_attr_e(get_the_id()); ?>" data-musictype="<?php esc_attr_e($list_type); ?>"><span class="opt_icon"><span class="icon icon_queue">
        										<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="12px" height="12px">
        													<path fill-rule="evenodd" fill="rgb(119, 119, 119)" d="M11.359,5.172 L6.847,5.172 L6.847,0.660 C6.847,0.455 6.568,0.009 6.010,0.009 C5.452,0.009 5.172,0.455 5.172,0.660 L5.172,5.172 L0.661,5.172 C0.455,5.172 0.010,5.451 0.010,6.009 C0.010,6.567 0.455,6.846 0.661,6.846 L5.173,6.846 L5.173,11.358 C5.173,11.563 5.452,12.009 6.010,12.009 C6.568,12.009 6.847,11.563 6.847,11.358 L6.847,6.846 L11.359,6.846 C11.564,6.846 12.010,6.567 12.010,6.009 C12.010,5.451 11.564,5.172 11.359,5.172 Z"/>
        													</svg>
        									</span></span><?php esc_html_e('Add To Queue', 'miraculous'); ?></a></li>
                                            <li><a href="javascript:;" class="ms_download" data-msmusic="<?php esc_attr_e(get_the_id()); ?>"><span class="opt_icon"><span class="icon icon_dwn">
        										<svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 22 22"><g id="_06-4" data-name=" 06-4"><path id="_06-5" data-name=" 06-5" class="cls-1" d="M10.65,13.85a.48.48,0,0,0,.7,0l3.27-3.5a.41.41,0,0,0,.07-.47.48.48,0,0,0-.42-.26H12.4V4.94a.46.46,0,0,0-.47-.44H10.07a.46.46,0,0,0-.47.44V9.63H7.73a.44.44,0,0,0-.42.25.41.41,0,0,0,.07.47Zm5.48-.73v2.63H5.87V13.12H4v3.5a.9.9,0,0,0,.93.88H17.07a.9.9,0,0,0,.93-.88v-3.5Z"/></g></svg>
        									</span></span><?php esc_html_e('Download Now', 'miraculous'); ?></a></li>
                                            <li><a href="javascript:;" class="ms_add_playlist" data-msmusic="<?php esc_attr_e(get_the_id()); ?>"><span class="opt_icon"><span class="icon icon_playlst">
        										<svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 22 22"><g id="_03-2" data-name=" 03-2"><path id="_03-3" data-name=" 03-3" class="cls-1" d="M13,5.5H3.5V7.07H13V5.5Zm0,3.14H3.5v1.57H13V8.64ZM3.5,13.36H9.82V11.79H3.5ZM14.55,5.5v6.43a2.35,2.35,0,1,0,1.58,2.21V7.07H18.5V5.5Z"/></g></svg>
        									</span></span><?php esc_html_e('Add To Playlist', 'miraculous'); ?></a></li>
                                            <li><a href="javascript:;" class="ms_share_music" data-shareuri="<?php esc_attr_e(get_the_permalink()); ?>" data-sharename="<?php the_title_attribute(); ?>"><span class="opt_icon"><span class="icon icon_share">
        										<svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 22 22"><g id="_14-2" data-name=" 14-2"><path id="_13" data-name=" 13" class="cls-1" d="M8.68,13.18A2.78,2.78,0,0,1,4.77,13l-.07-.08a3,3,0,0,1,0-3.85,2.77,2.77,0,0,1,3.89-.36.52.52,0,0,1,.11.1l3-2.11.09-.06a1.09,1.09,0,0,0,.63-1.08A2.76,2.76,0,0,1,15.05,3,2.84,2.84,0,0,1,17.9,5.22a3,3,0,0,1-1.36,3.22,2.72,2.72,0,0,1-3.34-.5l-.27-.3C11.81,8.41,10.7,9.18,9.6,10a.37.37,0,0,0-.09.28q0,.75,0,1.5a.51.51,0,0,0,.13.34c1.08.77,2.18,1.52,3.3,2.3a2.89,2.89,0,0,1,1.76-1.15A2.83,2.83,0,0,1,18,15.56h0A2.92,2.92,0,0,1,15.72,19a2.82,2.82,0,0,1-3.28-2.28,3.33,3.33,0,0,1,0-.63.55.55,0,0,0-.16-.38ZM6.82,9.55a1.45,1.45,0,0,0,0,2.9,1.45,1.45,0,0,0,0-2.9ZM15.2,7.36a1.43,1.43,0,0,0,1.39-1.45h0A1.4,1.4,0,1,0,15.2,7.36Zm0,7.29a1.42,1.42,0,0,0-1.4,1.43h0a1.4,1.4,0,0,0,1.44,1.36,1.4,1.4,0,0,0,0-2.8Z"/></g></svg>
        									</span></span><?php esc_html_e('Share', 'miraculous'); ?></a></li>
                                        </ul>
                                    </li>
                                    <li class="text-center">
                                        <a href="javascript:;" class="remove_<?php echo esc_attr($sg_type); ?>_music" musicid="<?php echo esc_attr(get_the_id()); ?>">
                                        <?php if(!empty($close_icone)): ?>
                                             <span class="ms_close">
                                                <img src="<?php echo esc_url($close_icone); ?>" alt="<?php echo esc_attr__('close icone','miraculous'); ?>">
                                             </span>
                                        <?php endif; ?>  
                                        </a>
                                    </li>
                                </ul>
                        <?php $i++; endwhile; ?>
                    </div>
                </div>
            </div>
        <?php
        }
        endif; 
        if(!$user_id): ?>
            <script>
                $(document).ready(function(){
                   $("#myModal1").modal("show");
                });
            </script>
        <?php endif;
	}
}
