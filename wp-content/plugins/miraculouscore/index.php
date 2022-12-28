<?php
/**
 * Plugin Name: Miraculous Core Plugin
 * Plugin URI: https://kamleshyadav.com/wp/miraculous/
 * Description: This plugin create custom post type and some meta option and Shortcode .
 * Version: 1.1.4
 * Author: Kamleshyadav
 * Author URI: https://themeforest.net/user/kamleshyadav
 */
 
 /**
 * File correction: 28-01-2022
 * @create: @an
 **/ 
global $miraculous_plug_version;

$miraculous_plug_version = '1.1.4';

remove_action( 'wp_head', 'rest_output_link_wp_head');
/** 
 * miraculous Widgets
 */
require_once 'miraculous-widget.php';

/**
 * miraculous Post types 
 */ 
require_once 'custom-posttype/miraculous-custom-posttype.php';
 
/**
 * miraculous plan posttype menu page
 */ 
require_once 'menu-page/miraculous-menupage.php';

/**
 * miraculous ajax class 
 */ 
require_once 'miraculous-ajax-class.php';
/**
 * miraculous category meta
 */ 
require_once 'miraculous-category-meta.php';
/**
 * miraculous nav menu
 */ 
require_once 'miraculous-nav-menu.php';
/**
 * miraculous gmail signin/signup
 */ 
require_once 'miraculous-gmail.php';

/**
 * miraculous play song and dowenload counter
 */ 
require_once 'miraculous-custom-function.php';

/**
 * miraculous multivendor update ajax function
 */ 
require_once 'miraculous-multivendor-customs-functions.php';

/**
 * admin Js enqueue
 */ 
add_action( 'admin_enqueue_scripts', 'miraculous_widget_upload_script' );
function miraculous_widget_upload_script() {
    wp_enqueue_media();
    wp_enqueue_script( 'miraculous_widget_uploader', plugin_dir_url( __FILE__ ) . 'js/miraculous-admin.js', array('jquery'),12543,true );
    wp_localize_script('miraculous_widget_uploader', 'backend', array('ajax_url' => admin_url( 'admin-ajax.php' )) );
}

/**
 * Miraculouscore Payment Table
 */
function miraculous_add_payment_table() {
	global $wpdb;
	global $miraculous_plug_version;

    $table_name = $wpdb->prefix . 'ms_payments';
     
    $table_name_roders = $wpdb->prefix . 'ms_orders';

    $table_name_donation = $wpdb->prefix . 'ms_donation';
    
    $table_rp_request = $wpdb->prefix . 'ms_rp_request';
    
    $table_si_payme = $wpdb->prefix . 'ms_single_paymet';

	$charset_collate = $wpdb->get_charset_collate();
    /**
     * Price Plane
     */
	$sql = "CREATE TABLE IF NOT EXISTS $table_name (
				`id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
				`user_id` bigint(20) UNSIGNED NOT NULL,
				`txnid` varchar(50) NOT NULL,
				`payment_amount` double NOT NULL,
				`payment_status` varchar(20) NOT NULL,
				`itemid` bigint(20) UNSIGNED NOT NULL,
				`monthly_download` int(11) NOT NULL,
				`monthly_upload` int(11) NOT NULL,
				`createdtime` datetime DEFAULT '0000-00-00 00:00:00' NOT NULL, 
				`expiretime` datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
				`remains_download` int(11) NOT NULL,
				`remains_upload` int(11) NOT NULL,
				`extra_data` text NOT NULL,
				`payment_getway` varchar(50) NOT NULL,
				PRIMARY KEY  (id)
			) $charset_collate;";
    /**
     * Music Orders Payments
     */
    $sql_orders = "CREATE TABLE IF NOT EXISTS $table_name_roders (
        `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
        `user_id` bigint(20) UNSIGNED NOT NULL,
        `author_id` bigint(20) UNSIGNED NOT NULL,
        `itemid` bigint(20) UNSIGNED NOT NULL,
        `txnid` varchar(50) NOT NULL,
        `payment_amount` double NOT NULL,
        `payment_amount_admin` double NOT NULL,
        `payment_amount_author` double NOT NULL,
        `payment_status` varchar(20) NOT NULL,
        `monthly_download_limite` int(11) NOT NULL,
        `createdtime` datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
        `expiretime` datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
        `extra_data` text NOT NULL,
        PRIMARY KEY  (id)
    ) $charset_collate;";

    /**
     * Music donation Payments
     */
    $sql_donation = "CREATE TABLE IF NOT EXISTS $table_name_donation (
        `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
        `user_id` bigint(20) UNSIGNED NOT NULL,
        `author_id` bigint(20) UNSIGNED NOT NULL,
        `itemid` bigint(20) UNSIGNED NOT NULL,
        `txnid` varchar(50) NOT NULL,
        `payment_amount` double NOT NULL,
        `payment_amount_admin` double NOT NULL,
        `payment_amount_author` double NOT NULL,
        `payment_status` varchar(20) NOT NULL,
        `monthly_download_limite` int(11) NOT NULL,
        `createdtime` datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
        `expiretime` datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
        `extra_data` text NOT NULL,
        PRIMARY KEY  (id)
    ) $charset_collate;";
    
    /**
     * Single Music Payment
     */
    $sql_single = "CREATE TABLE IF NOT EXISTS $table_si_payme (
				`id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
				`user_id` bigint(20) UNSIGNED NOT NULL,
				`txnid` varchar(50) NOT NULL,
				`payment_amount` double NOT NULL,
				`payment_status` varchar(20) NOT NULL,
				`itemid` bigint(20) UNSIGNED NOT NULL,
				`music_type` varchar(20) NOT NULL,
				
				PRIMARY KEY  (id)
			) $charset_collate;";
			
	$tables_name = $wpdb->prefix . 'payement_request';

	$ms_sql = "CREATE TABLE IF NOT EXISTS $tables_name (
				`srn` bigint(9) UNSIGNED NOT NULL AUTO_INCREMENT,
				`payment_receiver_id` bigint(9) UNSIGNED NOT NULL,
				`us_payment_receiver` varchar(25) NOT NULL,
				`amount` float(9) NOT NULL,
				`payment_type` varchar(25) NOT NULL,
				`extradata` varchar(500) NOT NULL,
				PRIMARY KEY  (srn)
			) $charset_collate;";

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta($sql);
    dbDelta($sql_orders);
    dbDelta($sql_donation);
    dbDelta($sql_single);
    dbDelta($ms_sql);
    
    add_option( 'miraculous_plug_version', $miraculous_plug_version );
}

register_activation_hook( __FILE__, 'miraculous_add_payment_table' );

remove_action( 'shutdown', 'wp_ob_end_flush_all', 1 );
/**
 * miraculous add caps to upload files
 */
function miraculous_add_subscriber_caps() {
    if ( current_user_can('artist') && !current_user_can('upload_files') ){
        $artist = get_role('artist');
        $artist->add_cap('upload_files');
    } 
	if( current_user_can('listener') && !current_user_can('upload_files') ){
		$listener = get_role('listener');
        $listener->add_cap('upload_files');
	}
}
add_action( 'admin_init', 'miraculous_add_subscriber_caps');

/**
 * miraculous Restrict users to shows only own media
 */
 
 
add_filter( 'ajax_query_attachments_args', 'miraculous_show_current_user_attachments' );
 
function miraculous_show_current_user_attachments( $query ) {
    $current_user = wp_get_current_user();

    if ( $current_user && in_array('artist', $current_user->roles) ) {
        $query['author'] = $current_user->ID;
    }
	if ( $current_user && in_array('listener', $current_user->roles) ) {
        $query['author'] = $current_user->ID;
    }
    return $query;
} 

/**
 * Miraculous hide top bar
 */
add_action('after_setup_theme', 'miraculous_remove_admin_bar');
function miraculous_remove_admin_bar() {
    if (!current_user_can('administrator') && !is_admin()) {
      show_admin_bar(false);
    }
}

/**
 * Miraculous Shortcode Extensions
 */
function miraculous_shortcode_extensions($locations) {
	$locations[
		dirname(__FILE__) . '/extensions'
	] = plugin_dir_url( __FILE__ ) . 'extensions';

	return $locations;
}
add_filter('fw_extensions_locations','miraculous_shortcode_extensions');

/**
 *miraculous action theme custom fw settings
 */
add_action('fw_backend_add_custom_settings_menu', 'miraculous_action_theme_custom_fw_settings_menu');
function miraculous_action_theme_custom_fw_settings_menu($data) {
    add_menu_page(
        esc_html__( 'Miraculous Options', 'miraculous' ),
        esc_html__( 'Miraculous Options', 'miraculous' ),
        $data['capability'],
        $data['slug'],
        $data['content_callback']
      );
}
/**
 *miraculous function for shortcodes
 */ 
if( ! function_exists('get_custom_type_category') ):
  function get_custom_type_category($type){
    $terms = get_terms( array(
							'taxonomy' => $type,
							'hide_empty' => false
						) );

    $arr = array();
    if($terms):
      foreach ($terms as $term) {
        $arr[$term->term_id] = $term->name;
      }
    endif;

    return $arr;
  }
endif;
/**
 *miraculous currency function
 */ 
if( ! function_exists('miraculous_currency_symbol') ):
    function miraculous_currency_symbol( $currency = '' ){
        $currency_sym = array( 
                  'AED' => 'د.إ',  
                  'AFN' => '؋',  
                  'ALL' => 'L',  
                  'AMD' => 'AMD',  
                  'ANG' => 'ƒ',  
                  'AOA' => 'Kz',  
                  'ARS' => '$',  
                  'AUD' => '$',  
                  'AWG' => 'ƒ',  
                  'AZN' => 'AZN',  
                  'BAM' => 'KM',  
                  'BBD' => '$',  
                  'BDT' => '৳ ',  
                  'BGN' => 'лв.',  
                  'BHD' => '.د.ب',  
                  'BIF' => 'Fr',  
                  'BMD' => '$',  
                  'BND' => '$',  
                  'BOB' => 'Bs.',  
                  'BRL' => 'R$',  
                  'BSD' => '$',  
                  'BTC' => '฿',  
                  'BTN' => 'Nu.',  
                  'BWP' => 'P',  
                  'BYR' => 'Br',  
                  'BZD' => '$',  
                  'CAD' => '$',  
                  'CDF' => 'Fr',  
                  'CHF' => 'CHF',  
                  'CLP' => '$',  
                  'CNY' => '¥',  
                  'COP' => '$',  
                  'CRC' => '₡',  
                  'CUC' => '$',  
                  'CUP' => '$',  
                  'CVE' => '$',  
                  'CZK' => 'Kč',  
                  'DJF' => 'Fr',  
                  'DKK' => 'DKK',  
                  'DOP' => 'RD$',  
                  'DZD' => 'د.ج',  
                  'EGP' => 'EGP',  
                  'ERN' => 'Nfk',  
                  'ETB' => 'Br',  
                  'EUR' => '€',  
                  'FJD' => '$',  
                  'FKP' => '£',  
                  'GBP' => '£',  
                  'GEL' => 'ლ',  
                  'GGP' => '£',  
                  'GHS' => '₵',  
                  'GIP' => '£',  
                  'GMD' => 'D',  
                  'GNF' => 'Fr',  
                  'GTQ' => 'Q',  
                  'GYD' => '$',  
                  'HKD' => '$',  
                  'HNL' => 'L',  
                  'HRK' => 'Kn',  
                  'HTG' => 'G',  
                  'HUF' => 'Ft',  
                  'IDR' => 'Rp',  
                  'ILS' => '₪',  
                  'IMP' => '£',  
                  'INR' => '₹',  
                  'IQD' => 'ع.د',  
                  'IRR' => '﷼',  
                  'IRT' => 'تومان',  
                  'ISK' => 'kr.',  
                  'JEP' => '£',  
                  'JMD' => '$',  
                  'JOD' => 'د.ا',  
                  'JPY' => '¥',  
                  'KES' => 'KSh',  
                  'KGS' => 'сом',  
                  'KHR' => '៛',  
                  'KMF' => 'Fr',  
                  'KPW' => '₩',  
                  'KRW' => '₩',  
                  'KWD' => 'د.ك',  
                  'KYD' => '$',  
                  'KZT' => 'KZT',  
                  'LAK' => '₭',  
                  'LBP' => 'ل.ل',  
                  'LKR' => 'රු',  
                  'LRD' => '$',  
                  'LSL' => 'L',  
                  'LYD' => 'ل.د',  
                  'MAD' => 'د.م.',  
                  'MDL' => 'MDL',  
                  'MGA' => 'Ar',  
                  'MKD' => 'ден',  
                  'MMK' => 'Ks',  
                  'MNT' => '₮',  
                  'MOP' => 'P',  
                  'MRO' => 'UM',  
                  'MUR' => '₨',  
                  'MVR' => '.ރ',  
                  'MWK' => 'MK',  
                  'MXN' => '$',  
                  'MYR' => 'RM',  
                  'MZN' => 'MT',  
                  'NAD' => '$',  
                  'NGN' => '₦',  
                  'NIO' => 'C$',  
                  'NOK' => 'kr',  
                  'NPR' => '₨',  
                  'NZD' => '$',  
                  'OMR' => 'ر.ع.',  
                  'PAB' => 'B/.',  
                  'PEN' => 'S/.',  
                  'PGK' => 'K',  
                  'PHP' => '₱',  
                  'PKR' => '₨',  
                  'PLN' => 'zł',  
                  'PRB' => 'р.',  
                  'PYG' => '₲',  
                  'QAR' => 'ر.ق',  
                  'RMB' => '¥',  
                  'RON' => 'lei',  
                  'RSD' => 'дин.',  
                  'RUB' => '₽',  
                  'RWF' => 'Fr',  
                  'SAR' => 'ر.س',  
                  'SBD' => '$',  
                  'SCR' => '₨',  
                  'SDG' => 'ج.س.',  
                  'SEK' => 'kr',  
                  'SGD' => '$',  
                  'SHP' => '£',  
                  'SLL' => 'Le',  
                  'SOS' => 'Sh',  
                  'SRD' => '$',  
                  'SSP' => '£',  
                  'STD' => 'Db',  
                  'SYP' => 'ل.س',  
                  'SZL' => 'L',  
                  'THB' => '฿',  
                  'TJS' => 'ЅМ',  
                  'TMT' => 'm',  
                  'TND' => 'د.ت',  
                  'TOP' => 'T$',  
                  'TRY' => '₺',  
                  'TTD' => '$',  
                  'TWD' => 'NT$',  
                  'TZS' => 'Sh',  
                  'UAH' => '₴',  
                  'UGX' => 'UGX',  
                  'USD' => '$',  
                  'UYU' => '$',  
                  'UZS' => 'UZS',  
                  'VEF' => 'Bs F',  
                  'VND' => '₫',  
                  'VUV' => 'Vt',  
                  'WST' => 'T',  
                  'XAF' => 'Fr',  
                  'XCD' => '$',  
                  'XOF' => 'Fr',  
                  'XPF' => 'Fr',  
                  'YER' => '﷼',  
                  'ZAR' => 'R',  
                  'BRL' => 'R$', 
                  'ZMW' => 'ZK',  
                 );
        if(!empty($currency)){
            return $currency_sym[$currency];
        }else{
            return $currency_sym['USD'];
        }
    }
endif;

/**
 *miraculous function get current theme currency
 */ 
if( ! function_exists('miraculous_revolution_slider_fun') ):
    function miraculous_revolution_slider_fun(){
        global $wpdb;
        $slider_arr = array('' => 'Select Slider');
        $rev_tbl = $wpdb->prefix . 'revslider_sliders';
        $sql = "SELECT * FROM `$rev_tbl`";
        $results = $wpdb->get_results($sql);
        if(!empty($results)){
            foreach($results as $row){
                $slider_arr[$row->alias] = $row->title;
            }
        }
        
        return $slider_arr;
    }
endif;
 
/**
 *miraculous function get current theme currency
 */ 
if( ! function_exists('miraculous_get_current_theme_currency') ):
  function miraculous_get_current_theme_currency(){
    $miraculous_theme_data = '';
    if( function_exists('fw_get_db_settings_option') ):
      $miraculous_theme_data = fw_get_db_settings_option();
    endif;
    $currency = '';
    if(!empty($miraculous_theme_data['currency']) && function_exists('miraculous_currency_symbol')):
        $currency = miraculous_currency_symbol( $miraculous_theme_data['currency'] );
    endif;

    return $currency;
  }
endif;

/**
 *miraculous function to get favourite div class
 */ 
if( ! function_exists('miraculous_get_favourite_div_class') ):
  function miraculous_get_favourite_div_class($id, $type){
    $user_id = get_current_user_id();
    $fav_ids = '';
    $fav_class = 'icon_fav';
      if($user_id && $type == 'music'){
          $fav_ids = get_user_meta($user_id, 'favourites_songs_lists'.$user_id, true);

          if(!empty($fav_ids)){
              if( in_array($id, $fav_ids) ) {
                  $fav_class = 'icon_fav_add';
                }
          }
          return $fav_class;
      }

      if($user_id && $type == 'album'){
          $fav_ids = get_user_meta($user_id, 'favourites_albums_lists'.$user_id, true);

          if(!empty($fav_ids)){
              if( in_array($id, $fav_ids) ) {
                  $fav_class = 'icon_fav_add';
                }
          }
          return $fav_class;
      }

      if($user_id && $type == 'artist'){
          $fav_ids = get_user_meta($user_id, 'favourites_artists_lists'.$user_id, true);

          if(!empty($fav_ids)){
              if( in_array($id, $fav_ids) ) {
                  $fav_class = 'icon_fav_add';
                }
          }
          return $fav_class;
      }

      if($user_id && $type == 'radio'){
          $fav_ids = get_user_meta($user_id, 'favourites_radios_lists'.$user_id, true);

          if(!empty($fav_ids)){
              if( in_array($id, $fav_ids) ) {
                  $fav_class = 'icon_fav_add';
                }
          }
          return $fav_class;
      }

      return $fav_class;
  }
endif;

/**
 *miraculous function to count total duration of album
 */ 
 
if( ! function_exists('miraculous_total_album_length') ):
  function miraculous_total_album_length($id){

    $ms_album_post_meta_option = '';
    $length = 00;
    $sec = 00;
    if( function_exists('fw_get_db_post_option') ):
      $ms_album_post_meta_option = fw_get_db_post_option($id);
    endif;

    if( $ms_album_post_meta_option['album_songs'] ):

      foreach($ms_album_post_meta_option['album_songs'] as $mst_music_option):
        $attach_meta = array();
        $mpurl = get_post_meta($mst_music_option, 'fw_option:mp3_full_songs', true);
      endforeach;

    endif;
    if($length < 10){
        $length = '0'.$length;
    }
    if($sec < 10){
        $sec = '0'.$sec;
    }
    return $length.':'.$sec;

  }
endif;

/**
 *miraculous function to count total duration of album
 */ 
 
if( ! function_exists('miraculous_total_podcast_length') ):
  function miraculous_total_podcast_length($id){

    $ms_podcast_post_meta_option = '';
    $length = 00;
    $sec = 00;
    if( function_exists('fw_get_db_post_option') ):
      $ms_podcast_post_meta_option = fw_get_db_post_option($id);
    endif;

    if( $ms_podcast_post_meta_option['podcast_songs'] ):

      foreach($ms_podcast_post_meta_option['podcast_songs'] as $mst_music_option):
        $attach_meta = array();
        $mpurl = get_post_meta($mst_music_option, 'fw_option:mp3_full_songs', true);
      endforeach;

    endif;
    if($length < 10){
        $length = '0'.$length;
    }
    if($sec < 10){
        $sec = '0'.$sec;
    }
    return $length.':'.$sec;

  }
endif;

/**
 *miraculous function to count total duration of radio
 */ 
if( ! function_exists('miraculous_total_radio_length') ):
  function miraculous_total_radio_length($id){

    $ms_album_post_meta_option = '';
    $length = 0;
    $sec = 00;
    if( function_exists('fw_get_db_post_option') ):
      $ms_album_post_meta_option = fw_get_db_post_option($id);
    endif;

    if( $ms_album_post_meta_option['radio_songs'] ):

      foreach($ms_album_post_meta_option['radio_songs'] as $mst_music_option):
        $attach_meta = array();
        $mpurl = get_post_meta($mst_music_option, 'fw_option:mp3_full_songs', true);
        if($mpurl) {
          $attach_meta = wp_get_attachment_metadata( $mpurl['attachment_id'] );
          (int)$l = explode(':', $attach_meta['length_formatted']);
          $length += (int)$l[0];
          $sec += isset($l[1]);
          if($sec > 60){
            $length +=1;
            $sec = 00;
          }
        }
      endforeach;

    endif;
    if($length < 10){
        $length = '0'.$length;
    }
    if($sec < 10){
        $sec = '0'.$sec;
    }
    return $length.':'.$sec;

  }
endif;

/**
 *miraculous function for get all Artists
 */
if( ! function_exists('miraculous_get_all_artists_name_for_album_post') ):
  function miraculous_get_all_artists_name_for_album_post(){
    $ar_args = array('post_type' => 'ms-artists', 'numberposts' => -1);

    $myartists = get_posts( $ar_args );
    $artists = array();

    if($myartists):
      foreach ( $myartists as $myartist ): 
        $artists[$myartist->ID] = $myartist->post_title;
      endforeach; 
    endif;

    return $artists;
  }
endif;

/**
 *miraculous function for get all Songs of album
 */
if( ! function_exists('miraculous_get_all_songs_name_for_album_post') ):
  function miraculous_get_all_songs_name_for_album_post(){
    $ar_args = array('post_type' => 'ms-music', 'numberposts' => -1);

    $mymusics = get_posts( $ar_args );
    $musics = array();

    if($mymusics):
      foreach ( $mymusics as $mymusic ): 
        $musics[$mymusic->ID] = $mymusic->post_title;
      endforeach; 
    endif;

    return $musics;
  }
endif;

/**
 *miraculous function for get all Songs of album
 */
if( ! function_exists('miraculous_user_playlist_songs') ):
    function miraculous_user_playlist_songs($playlistkey){
        $user_id = get_current_user_id();
        $musics = get_user_meta($user_id, $playlistkey, true);
        $data = array('image' => '', 'total' => 0);
        if($musics){
            $data['image'] = get_the_post_thumbnail_url ( $musics[0] );
            $data['total'] = count($musics);
        }
        return $data;
    }
endif;
/**
 * Miraculouscore Core Function
 */
class Miraculouscore{
	
/**
 * Miraculouscore Construct
 */
public function __construct(){ }
  
/**
 *miraculous theme in login bar
 */ 
function miraculous_themeinloginbar(){
    $miraculous_loginbar_data = '';
	if (function_exists('fw_get_db_settings_option')):  
	  $miraculous_loginbar_data = fw_get_db_settings_option();     
	endif; 
    $header_style = '';
    if(!empty($miraculous_loginbar_data['header_style'])):
        $header_style = $miraculous_loginbar_data['header_style'];
    endif;
    if($header_style == 'style-one'){ ?> 
    <div class="ms_header <?php echo (is_user_logged_in()) ? 'ms_profile' : ''; ?>">
	  <div class="ms_top_left">
      <?php 
        $search_switch = '';
    	if(!empty($miraculous_loginbar_data['themeloginbar_switch']['on'])):
         $search_switch = $miraculous_loginbar_data['themeloginbar_switch']['on'];
    	endif;
    	$header_search_option = '';
    	if(!empty($search_switch['header_search_option'])):
    	  $header_search_option = $search_switch['header_search_option'];
    	endif;
        if($header_search_option == "on"): ?>
        <div class="ms_top_search">
            <form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
              <label>
                <span class="screen-reader-text">
				<?php esc_html_e('Search for:', 'miraculous'); ?></span>
                <input type="search" class="searchinput form-control" value="<?php esc_attr_e('Search Music Here..','miraculous'); ?>" name="s" onblur="if (this.value == '') {this.value = 'Search Music Here..';}"  onfocus="if (this.value == 'Search Music Here..') {this.value = '';}">
              </label>
              <button type="submit" class="search-submit">
                <svg 
                     xmlns="http://www.w3.org/2000/svg"
                     xmlns:xlink="http://www.w3.org/1999/xlink">
                    <path fill-rule="evenodd" d="M13.608,13.607 C13.097,14.119 12.267,14.119 11.755,13.607 L8.547,10.400 C9.290,9.922 9.922,9.290 10.400,8.546 L13.608,11.754 C14.120,12.266 14.120,13.096 13.608,13.607 ZM5.254,10.496 C2.358,10.496 0.011,8.149 0.011,5.253 C0.011,2.358 2.358,0.010 5.254,0.010 C8.149,0.010 10.497,2.358 10.497,5.253 C10.497,8.149 8.149,10.496 5.254,10.496 ZM5.254,1.321 C3.085,1.321 1.322,3.085 1.322,5.253 C1.322,7.422 3.085,9.186 5.254,9.186 C7.422,9.186 9.186,7.422 9.186,5.253 C9.186,3.085 7.422,1.321 5.254,1.321 ZM3.069,5.253 L2.195,5.253 C2.195,3.567 3.568,2.195 5.254,2.195 L5.254,3.069 C4.049,3.069 3.069,4.049 3.069,5.253 Z"/>
                    </svg>
                 </button>
            </form>
        </div>
		<?php endif; 
		$header_trend_title = '';
		if(!empty($search_switch['header_trend_title'])):
		   $header_trend_title = $search_switch['header_trend_title'];
		endif;
		$header_trend_url = '';
		if(!empty($search_switch['header_trend_url'])):
		   $header_trend_url = $search_switch['header_trend_url'];
		endif;
		$header_trend_desc = '';
		if(!empty($search_switch['header_trend_desc'])):
		   $header_trend_desc = $search_switch['header_trend_desc'];
		endif;
		?><div class="ms_top_trend">
				<span>
				<a href="<?php echo esc_url($header_trend_url); ?>"  class="ms_color">
				  <?php echo esc_html($header_trend_title); ?>
				</a></span>
				<span class="top_marquee">
					<a href="<?php echo esc_url($header_trend_url); ?>">
					  <?php echo esc_html($header_trend_desc); ?>
					</a>
				</span>
		  </div>
	  </div>
	  <div class="ms_top_right">
        <?php 
		$language_option = '';
		$languagesicone = get_template_directory_uri().'/assets/images/svg/lang.svg';
        if(!empty($miraculous_loginbar_data['miraculous_layout']) && $miraculous_loginbar_data['miraculous_layout'] == '2'):
          $languagesicone = get_template_directory_uri().'/assets/images/svg/lang-red.svg';
        endif;
		if(!empty($search_switch['header_language_option'])):
		   $language_option = $search_switch['header_language_option'];
		endif;
		if($language_option == 'on'): ?>
            <div class="ms_top_lang">
              <span data-toggle="modal" data-target="#lang_modal">
			  <?php esc_html_e('languages', 'miraculous'); ?> 
			  <img src="<?php echo esc_url($languagesicone); ?>" alt="<?php esc_attr_e('languagesicone','miraculous'); ?>"></span>
            </div>
        <?php 
		endif;
		$loginregister_switch = '';
		if(!empty($miraculous_loginbar_data['loginregister_switch'])):
		   $loginregister_switch = $miraculous_loginbar_data['loginregister_switch'];
		endif;
        if($loginregister_switch == 'on'):
		?>
        <div class="ms_top_btn">
          <?php
           
		  if(is_user_logged_in()):  
		    $userid = get_current_user_id();
            $full_name = get_the_author_meta('display_name', $userid);
            $split_name = explode(' ', $full_name);
            $n1 = ''; $n2 = '';
            if(!empty($split_name[0])){
                $n1 = substr($split_name[0], 0, 1);
            }
            if(!empty($split_name[1])){
                $n2 = substr($split_name[1], 0, 1);
            }
            $upload_switch = '';
            if(!empty($miraculous_loginbar_data['upload_switch'])):
              $upload_switch = $miraculous_loginbar_data['upload_switch'];
            endif;
            $upload_page = '';
            if(!empty($miraculous_loginbar_data['user_music_upload_page'])):
              $upload_page = get_the_permalink($miraculous_loginbar_data['user_music_upload_page']) ;
            endif;
            if($upload_switch == 'on'):
            ?>
            <a href="<?php echo esc_url($upload_page); ?>" class="ms_btn"><?php echo __('upload', 'miraculous'); ?></a>
            <?php
            endif;
            ?>
            <a href="javascript:;" class="ms_admin_name" title="<?php echo esc_attr(ucwords($full_name)); ?>">
			 <span class="ms_pro_name">
			  <?php printf( esc_html__('%s%s', 'miraculous'), $n1, $n2 ); ?>
			 </span>
			</a>
            <ul class="pro_dropdown_menu">
            <?php
            $profile_pages = '';
            if(!empty($miraculous_loginbar_data['profile_pages'])):
                $profile_pages = $miraculous_loginbar_data['profile_pages'];
            endif;
            if(!empty($profile_pages)):
                foreach($profile_pages as $getvalues):
                    $page_title = '';
                    if(!empty($getvalues['title'])):
                     $page_title = $getvalues['title'];
                    endif;
                    $page_url = '#';
                    if(!empty($getvalues['user_profile_page'])):
                      $page_url = get_the_permalink( $getvalues['user_profile_page'] );
                    endif;
                    if(!empty($page_title) && !empty($page_url)):
        		       echo '<li><a href="'.esc_url($page_url).'">'.esc_html($page_title).'</a></li>';
                    endif;
			    endforeach;
			endif;
			
			?>
			<li><a href="<?php echo wp_logout_url( home_url('/') ); ?>">
			     <?php esc_html_e('Logout', 'miraculous'); ?></a></li>
			 </ul>
            <?php 
            else:
            $registerlogin_switch = '';
            if(!empty($miraculous_loginbar_data['registerlogin_switch'])):
                $registerlogin_switch = $miraculous_loginbar_data['registerlogin_switch'];
            endif;
            if($registerlogin_switch == 'on'):
            ?>
            <a href="javascript:;" class="ms_btn reg_btn" data-toggle="modal" data-target="#myModal"><span><?php echo __('register', 'miraculous'); ?></span></a>
            <a href="javascript:;" class="ms_btn login_btn" data-toggle="modal" data-target="#myModal1"><span><?php echo __('login', 'miraculous'); ?></span></a>
            <?php 
            endif;
          endif; ?>
        </div>
		<?php
		endif; 
		?>
      </div>
	</div>
    <?php
    } elseif($header_style == 'style-two'){
        ?>
            <div class="ms_header <?php echo (is_user_logged_in()) ? 'ms_profile' : ''; ?>">
                <div class="ms_header_inner">
                    <div class="ms_top_left">
        <?php 
        $search_switch = '';
    	if(!empty($miraculous_loginbar_data['themeloginbar_switch']['on'])):
         $search_switch = $miraculous_loginbar_data['themeloginbar_switch']['on'];
    	endif;
    	$header_search_option = '';
    	if(!empty($search_switch['header_search_option'])):
    	  $header_search_option = $search_switch['header_search_option'];
    	endif;
        if($header_search_option == "on"): ?>
        <div class="ms_top_search">
            <form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
              <label>
                <span class="screen-reader-text">
				<?php esc_html_e('Search for:', 'miraculous'); ?></span>
                <input type="search" class="searchinput form-control" value="<?php esc_attr_e('Search Music Here..','miraculous'); ?>" name="s" onblur="if (this.value == '') {this.value = 'Search Music Here..';}"  onfocus="if (this.value == 'Search Music Here..') {this.value = '';}">
              </label>
              <button type="submit" class="search-submit">
                <svg  
                     xmlns="http://www.w3.org/2000/svg" 
                     xmlns:xlink="http://www.w3.org/1999/xlink">
                    <path fill-rule="evenodd" d="M13.608,13.607 C13.097,14.119 12.267,14.119 11.755,13.607 L8.547,10.400 C9.290,9.922 9.922,9.290 10.400,8.546 L13.608,11.754 C14.120,12.266 14.120,13.096 13.608,13.607 ZM5.254,10.496 C2.358,10.496 0.011,8.149 0.011,5.253 C0.011,2.358 2.358,0.010 5.254,0.010 C8.149,0.010 10.497,2.358 10.497,5.253 C10.497,8.149 8.149,10.496 5.254,10.496 ZM5.254,1.321 C3.085,1.321 1.322,3.085 1.322,5.253 C1.322,7.422 3.085,9.186 5.254,9.186 C7.422,9.186 9.186,7.422 9.186,5.253 C9.186,3.085 7.422,1.321 5.254,1.321 ZM3.069,5.253 L2.195,5.253 C2.195,3.567 3.568,2.195 5.254,2.195 L5.254,3.069 C4.049,3.069 3.069,4.049 3.069,5.253 Z"/>
                    </svg>
                 </button> 
            </form>
        </div>
        <form id="ms_noti_form" method="post" enctype="multipart/form-data">
            <div class="ms_noti_wrap">
               <a href="#" id="ms_noti_click">
                   <input type="hidden" id="notify" name="notify" value="1">
				   <?php 
						$user_id = get_current_user_id();
						$notify = get_user_meta($user_id, 'notification', true);
						if($notify == 1){ ?>
							<span class="noti_icon bg_cmn_iconwrap notify_ad">
							    <svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 22 22"><g id="_17-4" data-name=" 17-4"><path id="_11" data-name=" 11" class="cls-1" d="M11,21a3.06,3.06,0,0,0,2.94-2.5H8.06A3.06,3.06,0,0,0,11,21Zm7.5-5.91a5.67,5.67,0,0,1-1.9-4.27V8.49a5.76,5.76,0,0,0-4.8-5.77v-.9A.81.81,0,0,0,11,1a.8.8,0,0,0-.8.8h0v.9A5.76,5.76,0,0,0,5.4,8.49v2.32a5.7,5.7,0,0,1-1.91,4.28A1.48,1.48,0,0,0,3,16.19a1.42,1.42,0,0,0,1.4,1.46H17.6A1.42,1.42,0,0,0,19,16.19,1.48,1.48,0,0,0,18.5,15.08Z"/></g></svg>
							</span>
						<?php } else { ?>
							<span class="noti_icon bg_cmn_iconwrap notify"><svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 22 22"><g id="_17-4" data-name=" 17-4"><path id="_11" data-name=" 11" class="cls-1" d="M11,21a3.06,3.06,0,0,0,2.94-2.5H8.06A3.06,3.06,0,0,0,11,21Zm7.5-5.91a5.67,5.67,0,0,1-1.9-4.27V8.49a5.76,5.76,0,0,0-4.8-5.77v-.9A.81.81,0,0,0,11,1a.8.8,0,0,0-.8.8h0v.9A5.76,5.76,0,0,0,5.4,8.49v2.32a5.7,5.7,0,0,1-1.91,4.28A1.48,1.48,0,0,0,3,16.19a1.42,1.42,0,0,0,1.4,1.46H17.6A1.42,1.42,0,0,0,19,16.19,1.48,1.48,0,0,0,18.5,15.08Z"/></g></svg></span>
						<?php }
				   ?>
                   </a>
            </div>
        </form>
        
        </div>
    <?php endif; ?>
    <div class="ms_top_right">
        <?php 
		$language_option = '';
		$languagesicone = get_template_directory_uri().'/assets/images/svg/lang.svg';
        if(!empty($miraculous_loginbar_data['miraculous_layout']) && $miraculous_loginbar_data['miraculous_layout'] == '2'):
          $languagesicone = get_template_directory_uri().'/assets/images/svg/lang-red.svg';
        endif;
		if(!empty($search_switch['header_language_option'])):
		   $language_option = $search_switch['header_language_option'];
		endif;
		if($language_option == 'on'): ?>
            <div class="ms_top_lang">
              <span data-toggle="modal" data-target="#lang_modal">
			  <?php esc_html_e('languages', 'miraculous'); ?> 
			  <img src="<?php echo esc_url($languagesicone); ?>" alt="<?php esc_attr_e('languagesicone','miraculous'); ?>"></span>
            </div>
        <?php 
		endif;
		$loginregister_switch = '';
		if(!empty($miraculous_loginbar_data['loginregister_switch'])):
		   $loginregister_switch = $miraculous_loginbar_data['loginregister_switch'];
		endif;
        if($loginregister_switch == 'on'):
		?>
        <div class="ms_top_btn">
          <?php
           
		  if(is_user_logged_in()):  
		    $userid = get_current_user_id();
            $full_name = get_the_author_meta('display_name', $userid);
            $split_name = explode(' ', $full_name);
            $n1 = ''; $n2 = '';
            if(!empty($split_name[0])){
                $n1 = substr($split_name[0], 0, 1);
            }
            if(!empty($split_name[1])){
                $n2 = substr($split_name[1], 0, 1);
            }
            $upload_switch = '';
            if(!empty($miraculous_loginbar_data['upload_switch'])):
              $upload_switch = $miraculous_loginbar_data['upload_switch'];
            endif;
            $upload_page = '';
            if(!empty($miraculous_loginbar_data['user_music_upload_page'])):
              $upload_page = get_the_permalink($miraculous_loginbar_data['user_music_upload_page']) ;
            endif;
            if($upload_switch == 'on'):
            ?>
            <a href="<?php echo esc_url($upload_page); ?>" class="ms_btn"><?php echo __('upload', 'miraculous'); ?></a>
            <?php
            endif;
            ?>
            <a href="javascript:;" class="ms_admin_name" title="<?php echo esc_attr(ucwords($full_name)); ?>">
			 <span class="ms_pro_name">
			  <?php printf( esc_html__('%s%s', 'miraculous'), $n1, $n2 ); ?>
			 </span>
			</a>
            <ul class="pro_dropdown_menu">
            <?php
            $profile_pages = '';
            if(!empty($miraculous_loginbar_data['profile_pages'])):
                $profile_pages = $miraculous_loginbar_data['profile_pages'];
            endif;
            if(!empty($profile_pages)):
                foreach($profile_pages as $getvalues):
                    $page_title = '';
                    if(!empty($getvalues['title'])):
                     $page_title = $getvalues['title'];
                    endif;
                    $page_url = '#';
                    if(!empty($getvalues['user_profile_page'])):
                      $page_url = get_the_permalink( $getvalues['user_profile_page'] );
                    endif;
                    if(!empty($page_title) && !empty($page_url)):
        		       echo '<li><a href="'.esc_url($page_url).'">'.esc_html($page_title).'</a></li>';
                    endif;
			    endforeach;
			endif;
			
			?>
			<li><a href="<?php echo wp_logout_url( home_url('/') ); ?>">
			     <?php esc_html_e('Logout', 'miraculous'); ?></a></li>
			 </ul>
            <?php 
            else:
            $registerlogin_switch = '';
            if(!empty($miraculous_loginbar_data['registerlogin_switch'])):
                $registerlogin_switch = $miraculous_loginbar_data['registerlogin_switch'];
            endif;
            if($registerlogin_switch == 'on'):
            ?>
            <a href="javascript:;" class="ms_btn reg_btn" data-toggle="modal" data-target="#myModal"><span><?php echo __('register', 'miraculous'); ?></span></a>
            <a href="javascript:;" class="ms_btn login_btn" data-toggle="modal" data-target="#myModal1"><span><?php echo __('login', 'miraculous'); ?></span></a>
            <?php 
            endif;
          endif; ?>
        </div>
		<?php
		endif;
		?>
    </div>
                </div>
            </div>
        <?php
    }
?>

<?php
 }
/**
 *miraculous theme in login bar
 */ 
public function miraculous_theme_loader(){
	$miraculous_theme_data ='';
    if(function_exists('fw_get_db_settings_option')):  
       $miraculous_theme_data = fw_get_db_settings_option();     
    endif; 
	$loader_switch ='';
	if(!empty($miraculous_theme_data['loader_switch'])):
	  $loader_switch = $miraculous_theme_data['loader_switch']; 
	endif;
	$loader_img ='';
	if(!empty($miraculous_theme_data['loader_image']['url'])):
	  $loader_img = $miraculous_theme_data['loader_image']['url'];
	endif;
	if($loader_switch == 'on'):
			if( is_front_page() ): ?>
			<div class="ms_loader"> 
				<div class="wrap">
					<?php if($loader_img): ?>
						<img src="<?php echo esc_url($loader_img); ?>" alt="<?php echo esc_attr_e('site loader','miraculous'); ?>">
					<?php else: ?>
						<img src="<?php echo esc_url(get_template_directory_uri().'/assets/images/loader.gif'); ?>" alt="<?php esc_attr_e('site loader','miraculous'); ?>">
					<?php endif; ?>
				</div>
			</div>
			<?php else: ?>
			<div class="ms_inner_loader">
				<div class="ms_loader">
					<div class="ms_bars">
						<img src="<?php echo esc_url(get_template_directory_uri().'/assets/images/loader.gif'); ?>" alt="<?php esc_attr_e('site loader','miraculous'); ?>">
					</div>
				</div>
			</div>
		 <?php endif;
		endif;  ?>
		<div class="ms_ajax_loader">
            <div class="wrap">
                <img src="<?php echo esc_url(get_template_directory_uri().'/assets/images/loader.gif'); ?>" alt="<?php esc_attr_e('site loader','miraculous'); ?>">
            </div>
        </div>
<?php } 

public function miraculous_Single_buy_popup() { ?> 

    <!-- Modal -->
<div class="modal fade plan_modal centered-modal" id="bynow_single" tabindex="-1" role="dialog" aria-labelledby="payment_method" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
        <?php $icon_doolor = get_template_directory_uri().'/assets/images/icon_doolor.png'; ?>
        <img src="<?php echo esc_url($icon_doolor); ?>" class="payment_icon">
      <div class="modal-header">
        <h5 class="modal-title" id="payment_method"><?php esc_html_e('Choose your payment method', 'miraculous'); ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">X</span>
        </button> 
        <?php 
		$user_id = get_current_user_id();
		$paypal_icon = get_template_directory_uri().'/assets/images/paypal_icon.jpg';
		$Stripe_icon = get_template_directory_uri().'/assets/images/Stripe_icon.jpg';
		$Paytrac_icon = get_template_directory_uri().'/assets/images/Paytrac_icon.jpg';
		$miraculous_theme_data = '';
		if (function_exists('fw_get_db_settings_option')):  
			$miraculous_theme_data = fw_get_db_settings_option();     
		endif;	
		$theme_paypal_switch = '';
		if(!empty($miraculous_theme_data['theme_paypal_switch']['Paypal_switch_value'])):
		 $theme_paypal_switch = $miraculous_theme_data['theme_paypal_switch']['Paypal_switch_value'];
		endif;
		$currency = '';
		if(!empty($miraculous_theme_data['currency'])):
			$currency = $miraculous_theme_data['currency'];
		endif;
		$theme_stripe_switch = '';
		if(!empty($miraculous_theme_data['theme_stripe_switch']['stripe_switch_value'])):
			$theme_stripe_switch = $miraculous_theme_data['theme_stripe_switch']['stripe_switch_value'];
		endif;	
		$stripe_publishable_key = '';
		if(!empty($miraculous_theme_data['theme_stripe_switch']['on']['stripe_publishable_key'])):
			$stripe_publishable_key = $miraculous_theme_data['theme_stripe_switch']['on']['stripe_publishable_key'];
		endif;    
		$stripe_secret_key = '';
		if(!empty($miraculous_theme_data['theme_stripe_switch']['on']['stripe_secret_key'])):
			$stripe_secret_key = $miraculous_theme_data['theme_stripe_switch']['on']['stripe_secret_key'];
		endif;
		$stripe_email = '';
		if(!empty($miraculous_theme_data['theme_stripe_switch']['on']['stripe_email'])):
			$stripe_email = $miraculous_theme_data['theme_stripe_switch']['on']['stripe_email'];
		endif;
		$stripe_logo_image = '';
		if(!empty($miraculous_theme_data['theme_stripe_switch']['on']['stripe_logo_image']['url'])):
			$stripe_logo_image = $miraculous_theme_data['theme_stripe_switch']['on']['stripe_logo_image']['url'];
		endif;
		$stripe_store_name = '';
		if(!empty($miraculous_theme_data['theme_stripe_switch']['on']['stripe_store_name'])):
			$stripe_store_name = $miraculous_theme_data['theme_stripe_switch']['on']['stripe_store_name'];
		endif;   
		$stripe_store_description = '';
		if(!empty($miraculous_theme_data['theme_stripe_switch']['on']['stripe_store_description'])):
			$stripe_store_description = $miraculous_theme_data['theme_stripe_switch']['on']['stripe_store_description'];
		endif;
		$theme_paystack_switch = '';
		if(!empty($miraculous_theme_data['theme_paystack_switch']['paystack_switch_value'])):
			$theme_paystack_switch = $miraculous_theme_data['theme_paystack_switch']['paystack_switch_value'];
		endif;
		$stripe_submit_orders_url = plugins_url().'/miraculouscore/strippayment/music_orders.php';
		if ($theme_stripe_switch == 'on') { ?>
			<div class="ms_plan_btn_modal">
				<?php 
				if(!empty($user_id)){
					if(!empty(get_post_meta(get_the_id(), 'fw_option:single_music_prices', true)*100)){
						$product_price = get_post_meta(get_the_id(), 'fw_option:single_music_prices', true)*100;
					}
					else{
					$product_price = get_post_meta(get_the_id(), 'fw_option:plan_price', true)*100;
					}
					?>
				   <!-- Stripe Payment Option -->
					<form action="<?php echo esc_url($stripe_submit_orders_url); ?>" method="post">
						<script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
						data-label="<?php esc_attr_e('Buy Music','miraculous'); ?>"
						data-key="<?php echo esc_attr($stripe_publishable_key); ?>"
						data-name="<?php echo esc_attr($stripe_store_name); ?>"
						data-description="<?php echo esc_attr($stripe_store_description); ?>"
						data-image="<?php echo esc_attr($stripe_logo_image); ?>" 
						data-amount="<?php echo esc_attr($product_price); ?>"
						data-currency=<?php echo esc_attr($currency); ?>
						data-email="<?php echo esc_attr($stripe_email); ?>"
						data-locale="auto"></script>
						<?php /* you can pass parameters to php file in hidden fields, for example - plugin ID */ ?>
						<input type="hidden" name="item_id" value="<?php echo esc_attr(get_the_id()); ?>">
						<input type="hidden" name="data-post" id="data-post" value="">
					</form>
				<?php } ?>
			</div>
		<?php } 
		//paypal option
			$theme_paypal_switch = '';
			if(!empty($miraculous_theme_data['theme_paypal_switch']['Paypal_switch_value'])):
				$theme_paypal_switch = $miraculous_theme_data['theme_paypal_switch']['Paypal_switch_value'];
			endif;
			$submit_url = plugins_url().'/miraculouscore/paypal/music_orders.php';
		//Paypal Switch
		if ($theme_paypal_switch == 'on') { ?>
		<div class="ms_plan_btn_modal">
			<form class="paypal" action="<?php echo esc_url($submit_url); ?>" method="post">
				<input type="hidden" name="cmd" value="_xclick" />
				<input type="hidden" name="lc" value="UK" />
				<input type="hidden" name="first_name" value="<?php echo esc_attr($current_user->user_nicename); ?>" />
				<input type="hidden" name="last_name" value="<?php echo esc_attr($current_user->display_name); ?>" />
				<input type="hidden" name="payer_email" value="<?php echo esc_attr($current_user->user_email); ?>" />
				<input type="hidden" name="user_id" value="<?php echo esc_attr($current_user->ID); ?>" />
				<input type="hidden" name="item_number" value="<?php echo esc_attr(get_the_id()); ?>" / >
				<input type="hidden" name="item_name" value="<?php echo get_the_title(get_the_id()); ?>" / >
				<button type="submit" name="submit" class="ms_btn stripe-button-el" value="<?php esc_attr_e('Paypal', 'miraculous'); ?>">
						<img src="<?php echo esc_url($paypal_icon); ?>" alt="<?php esc_attr_e('Buy Now', 'miraculous'); ?>">
					</button>
			</form>
		</div>	
		<?php 
		}		
		if ($theme_paystack_switch == 'on') {
			 $current_user = wp_get_current_user();
		 ?>
		<div class="ms_plan_btn_modal">
			<?php if(!empty($user_id)){ ?>
				<!-- Paystack -->
				<form action="<?php echo plugins_url('miraculouscore/paystack/single_payment_initialize.php'); ?>" method="post">
					<input type="hidden" name="payer_email" value="<?php echo esc_attr($current_user->user_email); ?>" />
					<input type="hidden" name="plan_id" value="<?php echo esc_attr(get_the_id()); ?>" / >
					<input type="hidden" name="data-post" id="data-post" value="">
						<button type="submit" name="Paystack_submit" class="ms_btn ms-paystrack" value="<?php esc_attr_e('Paystack', 'miraculous'); ?>">
						<img src="<?php echo esc_url($Paytrac_icon); ?>" alt="<?php esc_attr_e('Buy Now', 'miraculous'); ?>">
					</button>
				</form> 
			<?php } ?> 
		</div>
		<?php 
		}
		?>
      </div>
    </div> 
  </div>
</div>

<style>
    button.stripe-button-el {
    background-image: url(<?php echo esc_url($Stripe_icon); ?>);
    width: 100%;
    max-width: 100%;
    height: 60px;
    margin: auto;
    display: flex;
    justify-content: center;
    align-items: center;
    padding-bottom: 10px;
    border-radius: 10px;
    background-repeat: no-repeat;
    background-size: 82%;
    background-position: center;
    background-color: white;
    margin: 15px auto;
}
.stripe-button-el:not(:disabled):active, .stripe-button-el.active {
    background-color: #005d9300!important;
    box-shadow: 0px 0 0 !important;
    background-image: url(<?php echo esc_url($Stripe_icon); ?>);
}
    button.stripe-button-el span {
        display: none!important;
    }
    .close span {
    font-size: 14px!important;
}
div#bynow_single {
    top: 20%;
}
    
</style> <?php

}


	
/** 
 *Login & Register Popup  
 */
public function miraculous_login_register_popup() {
	$miraculous_loginbar_data = '';
    if(function_exists('fw_get_db_settings_option')):  
          $miraculous_loginbar_data = fw_get_db_settings_option();     
    endif; 

	$loginregister_image = '';
	if(!empty($miraculous_loginbar_data['loginregister_image']['url'])):
	   $loginregister_image = $miraculous_loginbar_data['loginregister_image']['url'];
	else:
	   $loginregister_image = get_template_directory_uri().'/assets/images/register_img.png';
    endif;
    $artist_toltipe = '';
    if(!empty($miraculous_loginbar_data['register_artist_toltip'])):
        $artist_toltipe = $miraculous_loginbar_data['register_artist_toltip'];
    endif;
    $listener_toltipe = '';
    if(!empty($miraculous_loginbar_data['register_listener_toltip'])):
        $listener_toltipe = $miraculous_loginbar_data['register_listener_toltip'];
    endif;
   ?>
    <div class="ms_register_popup">
        <div id="myModal" class="modal  centered-modal" role="dialog">
            <div class="modal-dialog register_dialog modal-dialog-centered">
                <!-- Modal content--> 
                <div class="modal-content">
                    <button type="button" class="close" data-dismiss="modal">
                      <i class="fa fa-times" aria-hidden="true"></i>
                    </button>
                    <div class="modal-body">
					<?php if(!empty($loginregister_image)): ?>
                        <div class="ms_register_img">
                            <img src="<?php echo esc_url($loginregister_image); ?>" alt="<?php esc_attr_e('loginregister','miraculous'); ?>" class="img-fluid" />
                        </div>
					<?php endif; 
					?>
                        <div class="ms_register_form">
                            <h2><?php echo esc_html__('Register / Sign Up', 'miraculous'); ?></h2>
                            <div class="form-msg"></div>
                            <form id="form_register" method="post">
                              <div class="form-group">
								<label class="radio-title">
                                 <?php echo esc_html__('Select User Type','miraculous'); ?></label>
								<div class="radio-btn-wrap">
										<div class="radio ms-tooltip">
											<input id="radio-1" name="user_role" type="radio" checked value="artist">
                                            <label for="radio-1" class="radio-label">
                                                <?php esc_html_e('Artist','miraculous'); ?>
                                                <b class="why-choose">Why Artist <i class="fa fa-question-circle" aria-hidden="true"></i>
                                                    <span class="tooltip-text"><?php echo esc_html($artist_toltipe); ?></span>
                                                </b>
                                            </label>
										</div> 
										<div class="radio ms-tooltip">
											<input id="radio-2" name="user_role" type="radio" value="listener">
                                            <label  for="radio-2" class="radio-label">
                                                <?php esc_html_e('Listener','miraculous'); ?>
                                                <b class="why-choose">Why Listener <i class="fa fa-question-circle" aria-hidden="true"></i>
                                                    <span class="tooltip-text"><?php echo esc_html($listener_toltipe); ?></span>    
                                                </b>
                                            </label>
										</div>
								</div>
                              </div>
                              <div class="row">
	                            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
							  <div class="form-group">
                                  <input type="text" name="username" id="username" placeholder="<?php esc_attr_e('Enter Username','miraculous'); ?>" class="form-control required">
                                  <span class="form_icon">
                                  <i class="fa_icon form-user" aria-hidden="true"></i>
                                  </span>
                                  <span id="erroruser" class="error-row"></span>
                              </div>
                              </div>
                               <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                              <div class="form-group">
                                  <input type="text" name="full_name" id="full_name" placeholder="<?php esc_attr_e('Enter Your Name','miraculous'); ?>" class="form-control required">
                                  <span class="form_icon">
                                  <i class="fa_icon form-user" aria-hidden="true"></i>
                                  </span>
                                  <span id="errorname" class="error-row"></span>
                              </div>
                              </div>
                               <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                              <div class="form-group">
                                   <input type="text" name="useremail" id="useremail" placeholder="<?php esc_attr_e('Enter Your Email','miraculous'); ?>" class="form-control required">
                                   <span class="form_icon">
                                    <i class="fa_icon form-envelope" aria-hidden="true"></i>
                                   </span>
                                   <span id="erroremail" class="error-row"></span>
                              </div>
                               </div>
                               <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                              <div class="form-group">
                                  <input type="password" name="password" id="password" placeholder="<?php esc_attr_e('Enter Password','miraculous');  ?>" class="form-control required">
                                  <span class="form_icon">
                                  <i class="fa_icon form-lock" aria-hidden="true"></i>
                                  </span>
                                  <span id="errorpass" class="error-row"></span>
                              </div>
                               </div>
                               <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                              <div class="form-group">
                                  <input type="password" name="confirmpass" id="confirmpass" placeholder="<?php esc_attr_e('Confirm Password','miraculous'); ?>" class="form-control required">
                                  <span class="form_icon">
									<i class=" fa_icon form-lock" aria-hidden="true"></i>
                                 </span>
                                 <span id="errorcpass" class="error-row"></span>
                               </div>
                                </div>
                               <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
							   <div class="form-group">
									
									<select class="form-control" name="uagerGroup" id="uagerGroup">
									  <option><?php echo esc_html__('Select Age group','miraculous'); ?></option>
									  <option value="25">18-25</option>
									  <option value="30">25-30</option>
									  <option value="35">30-35</option>
									  <option value="40">35-40</option>
									  <option value="45">40-45</option>
									  <option value="50">45-50</option>
									  <option value="55">50-55</option>
									  <option value="60">55-60</option>
									  <option value="65">60-65</option>
									  <option value="70">65-70</option>
									  <option value="75">70-75</option>
									  <option value="80">75-80</option>
									</select>
							   </div>
							   </div>
                               <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
							  <div class="form-group">
								<label class="radio-title">
                                 <?php echo esc_html__('Select Gender Type','miraculous'); ?></label>
								<div class="radio-btn-wrap">
										<div class="radio ms-tooltip">
											<input id="radiomale" name="user_gender" type="radio" value="male" checked>
                                            <label for="radiomale" class="radio-label">
                                                <?php esc_html_e('Male','miraculous'); ?>
                                            </label>
										</div>
										<div class="radio ms-tooltip">
											<input id="radiofemale" name="user_gender" type="radio" value="female">
                                            <label  for="radiofemale" class="radio-label">
                                                <?php esc_html_e('Female','miraculous'); ?>
                                            </label>
										</div>
								</div>
                              </div>
                              </div>
							  <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                               <input type="submit" name="register_one" id="register_btn" class="ms_btn" value="register now">
                               <button class="hst_loader" style="display: none;">
							    <i class="fa fa-circle-o-notch fa-spin"></i>
							    <?php esc_html_e('Loading','miraculous'); ?>
							   </button>
                                <p>
							    <?php esc_html_e('Already Have An Account?','miraculous'); ?>   <a href="#myModal1" data-toggle="modal" class="ms_modal hideCurrentModel">
								<?php esc_html_e('login here','miraculous'); ?>
								</a>
							    </p>
							    </div>
							    </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="myModal1" class="modal  centered-modal" role="dialog">
            <div class="modal-dialog login_dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <button type="button" class="close" data-dismiss="modal">
                   <i class="fa fa-times" aria-hidden="true"></i>
                    </button>
                    <div class="modal-body">
					    <?php if(!empty($loginregister_image)): ?>
                        <div class="ms_register_img">
                            <img src="<?php echo esc_url($loginregister_image); ?>" alt="<?php esc_attr_e('loginregister','miraculous'); ?>" class="img-fluid" />
                        </div>
					    <?php endif; ?>
                        <div class="ms_register_form">
                            <h2><?php esc_html_e('login / Sign in','miraculous'); ?></h2>
                            <div class="form-lmsg"></div>
                            <form id="form_login" method="post">
                              <div class="form-group">
                                  <input type="text" placeholder="Enter Your Email or Username" id="lusername" class="form-control">
                                  <span class="form_icon">
									<i class="fa_icon form-envelope" aria-hidden="true"></i>
								  </span>
                              </div>
                              <div class="form-group">
                                  <input type="password" placeholder="Enter Password" id="lpassword" class="form-control">
                                  <span class="form_icon">
                                  <i class="fa_icon form-lock" aria-hidden="true"></i>
                                  </span>
                              </div>
                              <div class="remember_checkbox">
                                <label><?php esc_html_e('Keep me signed in','miraculous'); ?>
									<input type="checkbox" name="rem_check" id="rem_check">
									<span class="checkmark"></span>
							    </label>
                              </div>
                             <input type="submit" name="login_one" id="login_btn" class="ms_btn" value="login now">
                              <button class="hst_loader" style="display: none;"><i class="fa fa-circle-o-notch fa-spin"></i><?php esc_html_e('Loading','miraculous'); ?></button>
                              <div class="popup_forgot">
                                  <a href="<?php echo wp_lostpassword_url(); ?>"><?php esc_html_e('Forgot Password ?','miraculous'); ?></a>
                              </div>
                              <?php echo do_shortcode('[miraculos_google_button]'); ?>
                              <p><?php esc_html_e("Don't Have An Account?","miraculous"); ?> <a href="#myModal" data-toggle="modal" class="ms_modal1 hideCurrentModel"><?php esc_html_e('register here','miraculous'); ?></a></p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  <?php
}
/**
 * Language selector
 */
public function miraculous_language_selector() {
?>
   <div class="ms_lang_popup">
        <div id="lang_modal" class="modal  centered-modal" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal">
                 <i class="fa fa-times" aria-hidden="true"></i>
                </button>
                    <div class="modal-body">
                        <h1><?php esc_html_e('language selection','miraculous'); ?></h1>
                        <p><?php esc_html_e('Please select the language(s) of the music you listen to.','miraculous'); ?></p>
                        <?php 
                        if( is_user_logged_in() ){
                            $user_id = get_current_user_id();
                            $lang_data = get_option('language_filter_ids_'.$user_id);
                        }elseif( isset($_COOKIE['lang_filter']) ){
                            $lang_data = explode(',', $_COOKIE['lang_filter']);
                        }
                        if(empty($lang_data)){
                          $lang_data = array();
                        }
                        $terms = get_terms( array(
                            'taxonomy' => 'language',
                            'hide_empty' => false
                        ) );
                        
                        if($terms): ?>
                          <ul class="lang_list">
                          <?php foreach ($terms as $lang): ?>
                              <li>
                                <label class="lang_check_label">
                                    <?php echo _e( $lang->name ); ?> 
                                    <input type="checkbox" name="check" value="<?php echo _e( $lang->term_id ); ?>" class="lang_filter" <?php echo (in_array($lang->term_id, $lang_data)) ? 'checked="checked"' : ''; ?>> 
                                    <span class="label-text"></span>
                                </label>
                              </li>
                          <?php endforeach; ?>
                          </ul>
                          <?php
						  else:
                            esc_html_e('There is not have any language added.', 'miraculous');
                          endif; ?>
                        <div class="ms_lang_btn">
                            <a href="javascript:;" class="ms_btn language_filter">
							<?php esc_html_e('apply','miraculous'); ?></a>
                            <button class="hst_loader" style="display: none;"><i class="fa fa-circle-o-notch fa-spin"></i><?php esc_html_e('Loading','miraculous'); ?></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  <?php
}
/**
 *Add Music In Playlist Popup
 */
public function miraculous_add_music_in_playlist_popup(){
$playlist = '';	
$playlist = get_template_directory_uri().'/assets/images/playlist.svg';
?>
<div class="ms_add_in_playlist_modal">
    <div id="add_in_playlist_modal" class="modal  centered-modal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal">
                    <i class="fa_icon form_close"></i>
                </button>
                <div class="modal-body">
					<div class="ms_share_img">
						<img src="<?php echo esc_url($playlist); ?>" class="img-fluid" alt="<?php echo esc_attr('Playlist', 'miraculous'); ?>">
					</div>
					<div class="ms_share_text">
                    <h1><?php esc_html_e('Playlist','miraculous'); ?></h1>
                    <?php
                    global $wpdb;
                    $user_id = get_current_user_id();
                    if(is_multisite()):
                        $usermeta_tbl = $wpdb->get_blog_prefix(0) . 'usermeta';
                    else:
                        $usermeta_tbl = $wpdb->prefix . 'usermeta';
                    endif;
                    $sql1 = "SELECT * FROM $usermeta_tbl WHERE `user_id` = $user_id AND `meta_key` LIKE 'miraculous_playlist_%'";
                    $user_playlists = $wpdb->get_results($sql1);
                    if($user_playlists): ?>
                      <select name="playlistname" class="form-control">
                        <?php foreach($user_playlists as $user_playlist):
                            $key = explode('_', $user_playlist->meta_key);
                            $name = str_replace('-', ' ', end($key));
                        ?>
                            <option value="<?php echo esc_attr($user_playlist->meta_key); ?>"><?php echo esc_html($name); ?></option>
                        <?php endforeach; ?>
                        </select>
                        <div class="clr_modal_btn">
                            <a href="javascript:;" class="ms_add_in_playlist">
							  <?php esc_html_e('add to playlist','miraculous'); ?></a>
                             <button class="hst_loader"><i class="fa fa-circle-o-notch fa-spin"></i><?php esc_html_e('Loading','miraculous'); ?></button>
							 <a href="javascript:;" class="ms_create_playlist"><?php esc_html_e('create playlist', 'miraculous'); ?></a>
                        </div>
                        <?php else: ?>
                            <?php echo __('You have not created any playlist please create playlist.', 'miraculous'); ?>
                            <div class="clr_modal_btn">
                                <a href="javascript:;" class="ms_create_playlist">
								<?php esc_html_e('create playlist','miraculous'); ?></a>
                            </div>
                    <?php endif; ?>
					</div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
}
/**
 *Create Playlist Popup
 */
public function miraculous_create_playlist_popup(){
$playlist = '';	
$playlist = get_template_directory_uri().'/assets/images/playlist.svg';
$sharing = '';
$sharing = get_template_directory_uri().'/assets/images/sharing.svg';
?>
<div class="ms_create_playlist_modal">
    <div id="create_playlist_modal" class="modal  centered-modal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal">
                    <i class="fa_icon form_close"></i>
                </button>
                <div class="modal-body">
					<div class="ms_share_img">
						<img src="<?php echo esc_url($playlist); ?>" class="img-fluid" alt="<?php echo esc_attr('Playlist', 'miraculous'); ?>">
					</div>
					<div class="ms_share_text">
						<h1><?php esc_html_e('Create New Playlist','miraculous'); ?></h1>
						<input type="text" name="playlist_name" id="playlist_name" class="form-control" placeholder="<?php esc_attr_e('Playlist Name','miraculous'); ?>">
						<div class="clr_modal_btn">
							<a href="javascript:;" class="create_new_playlist">
							<?php esc_html_e('create','miraculous'); ?></a>
							<button class="hst_loader" style="display: none;">
							<i class="fa fa-circle-o-notch fa-spin"></i>
							<?php esc_html_e('Loading','miraculous'); ?>    
							</button>
						</div>
					</div>
                </div>
            </div>
        </div>
    </div>
</div> 

<div class="ms_create_playlist_modal">
    <div id="ms_edit_user_playlist" class="modal  centered-modal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal">
                    <i class="fa_icon form_close"></i>
                </button>
                <div class="modal-body">
					<div class="ms_share_img">
						<img src="<?php echo esc_url($playlist); ?>" class="img-fluid" alt="<?php echo esc_attr('Playlist', 'miraculous'); ?>">
					</div> 
					<div class="ms_share_text">
						<h1><?php esc_html_e('Modify Playlist','miraculous'); ?></h1>
						<input type="text" name="modify_playlist_name" id="modify_playlist_name" class="form-control" value="">

                        <input type="hidden" name="update_playlist_name" 
                        id="update_playlist_name" class="form-control" value="">

						<div class="clr_modal_btn"> 
							<a href="javascript:;" class="modify_playlist">
							<?php esc_html_e('Modify','miraculous'); ?></a>
							<button class="hst_loader" style="display: none;">
							<i class="fa fa-circle-o-notch fa-spin"></i>
							<?php esc_html_e('Loading','miraculous'); ?>    
							</button>
						</div>
					</div>
                </div>
            </div>
        </div>
    </div>
</div> 

<div class="ms_share_music_modal">
    <div id="ms_share_music_modal_id" class="modal  centered-modal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <button type="button" class="close" data-dismiss="modal">
                    X
                </button>
                <div class="modal-body"> 
				<?php if(!empty($sharing)): ?>
					<div class="ms_share_img"> 
						<img src="<?php echo esc_url($sharing); ?>" class="img-fluid" alt="<?php echo esc_attr('Share', 'miraculous'); ?>">
					</div>
			   <?php endif; ?>
					<div class="ms_share_text">
						<h1><?php esc_html_e('Share With','miraculous'); ?></h1>
						<ul>
							<li><a href="javascript:void(0);" class="ms_share_facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
							<li><a href="javascript:void(0);" class="ms_share_linkedin"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
							<li><a href="javascript:void(0);" class="ms_share_twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
							<li><a href="javascript:void(0);" class="ms_share_whatsapp"><i class="fa fa-whatsapp" aria-hidden="true"></i></a></li>
						</ul>
					</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- start music stop alert model -->
<div class="ms_stop_music_modal ">
    <div id="ms_track_stopmodel_id" class="modal centered-modal small-modal" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content--> 
        <div class="modal-content">
		  <button type="button" class="close" data-dismiss="modal">
			  <i class="fa_icon form_close"></i>
		  </button>
          <?php 
          $miraculous_theme_data = '';
          if(function_exists('fw_get_db_settings_option')):	
          $miraculous_theme_data = fw_get_db_settings_option();     
          endif;
          $stripe_logo_image = '';
          if(!empty($miraculous_theme_data['stripe_logo_image']['url'])):
              $stripe_logo_image = $miraculous_theme_data['stripe_logo_image']['url'];
          endif;
          $listen_message = '';
          if(!empty($miraculous_theme_data['listen_message'])):
              $listen_message = $miraculous_theme_data['listen_message'];
          endif;
          ?> 
          <div class="modal-body">
			<?php if(!empty($stripe_logo_image)): ?>
			<div class="ms_donation_img">
				<img src="<?php echo esc_url($stripe_logo_image); ?>" class="img-fluid" alt="<?php echo esc_attr('donation', 'miraculous'); ?>">
			</div>
            <?php endif;
             if(!empty($listen_message)):
            ?>
		    <div class="ms_share_text">
              <h1><?php echo esc_html($listen_message); ?></h1>
			  <a href="#" id="ms_stop_music_url" class="btn btn-light">
			   <?php echo esc_html__('BUY TRACK NOW','miraculos'); ?>
			  </a> 
			</div>
            <?php endif; ?>
			
			
           </div>
         </div>
       </div>
    </div>
</div>

<?php
}	
public function miraculous_audio_jplayer(){
  $userid = get_current_user_id();
  $miraculous_theme_data = '';
  if (function_exists('fw_get_db_settings_option')):  
    $miraculous_theme_data = fw_get_db_settings_option();     
  endif; 
  
  $songduration_setting = '';
  if(!empty($miraculous_theme_data['player_switch']['on']['player_limit']['song_duration'])):
     $songduration_setting = $miraculous_theme_data['player_switch']['on']['player_limit']['song_duration'];
  endif;
  if($songduration_setting == 'on'){
      $songduration = '';
      if(!empty($miraculous_theme_data['player_switch']['on']['player_limit']['on']['player_song_duration'])):
         $songduration = $miraculous_theme_data['player_switch']['on']['player_limit']['on']['player_song_duration'];
      endif;
  }
  else{
    $songduration = "";
  }
  
  $player_style = '';
  if(!empty($miraculous_theme_data['player_switch']['on']['player_style'])):
    $player_style = $miraculous_theme_data['player_switch']['on']['player_style'];
endif;
if($player_style == 'style-two'){
    $exclass=" mira-thirddemo";
}else{
    $exclass="";
}
 $volume_icone ='';
 $volume_icone = get_template_directory_uri().'/assets/images/svg/volume.svg';
  if( !empty($miraculous_theme_data['player_switch']['player_switch_value']) && $miraculous_theme_data['player_switch']['player_switch_value'] == 'on' ){ 
  ?>
   <!-- Audio Player Section -->
    <div class="ms_player_wrapper ms_player-<?php echo esc_attr($player_style).esc_attr($exclass); ?> ">
        <div class="ms_player_close">
            <i class="fa fa-angle-up" aria-hidden="true"></i>
        </div>
        <div class="player_mid">
            <div class="audio-player">
                <div id="jquery_jplayer_1" class="jp-jplayer"></div>
                <div id="jp_container_1" class="jp-audio" role="application" aria-label="media player">
                    <div class="player_left">
                        <div class="ms_play_song">
                            <div class="play_song_name">
                                <a href="javascript:void(0);" id="playlist-text">
                                    <div class="jp-now-playing flex-item">
                                        <div class="jp-track-name"></div>
                                        <div class="jp-artist-name"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="play_song_options">
                            <ul>
                                <li>
									<a href="javascript:;" class="ms_download jp_cur_download" data-msmusic=""><span class="song_optn_icon"><i class="ms_icon icon_download"></i></span>
									<?php esc_html_e('download now', 'miraculous'); ?>
									</a>
								</li>
                                <li>
									<a href="javascript:;" class="favourite_music jp_cur_favourite" data-musicid=""><span class="song_optn_icon"><i class="ms_icon icon_fav"></i></span><?php esc_html_e('Favourites', 'miraculous'); ?>
									</a>
								</li>
                                <li>
								  <a href="javascript:;" class="ms_add_playlist jp_cur_playlist" data-msmusic=""><span class="song_optn_icon"><i class="ms_icon icon_playlist"></i></span><?php esc_html_e('Add To Playlist', 'miraculous'); ?>
								  </a>
								</li>
                                <li>
								  <a href="javascript:;" class="ms_share_music jp_cur_share" data-shareuri="" data-sharename=""><span class="song_optn_icon"><i class="ms_icon icon_share"></i></span><?php esc_html_e('Share', 'miraculous'); ?>
								  </a>
							   </li>
                            </ul>
                        </div>
                        <span class="play-left-arrow">
						  <i class="fa fa-angle-right" aria-hidden="true"></i>
						</span>
                    </div>
                    <!-- Right Queue -->
                    <div class="jp_queue_wrapper">
                        <span class="que_text" id="myPlaylistQueue">
						<i class="fa fa-angle-up" aria-hidden="true"></i> 
						<?php esc_html_e('queue', 'miraculous'); ?>
						</span>
                        <div id="playlist-wrap" class="jp-playlist">
                            <div class="jp_queue_cls">
							<i class="fa fa-times" aria-hidden="true"></i>
							</div>
                            <h2><?php echo esc_html_e('queue', 'miraculous'); ?></h2>
                            <div class="jp_queue_list_inner">
                                <div class="ms_empty_queue"></div>
                                <ul>
                                    <li><?php esc_html_e('&nbsp','miraculous'); ?></li>
                                </ul>
                            </div>
                            <div class="jp_queue_btn">
                                <a href="javascript:;" class="ms_clear" data-toggle="modal" data-target="#clear_modal">
								<?php esc_html_e('clear', 'miraculous'); ?>
								</a>
                                <?php if($userid): ?>
                                     <a href="javascript:;" class="ms_save save_queue_list"><?php esc_html_e('save', 'miraculous'); ?>
									 </a>
                                  <?php else: ?>
                                      <a href="clear_modal" class="ms_save" data-toggle="modal" data-target="#myModal1"><?php esc_html_e('save', 'miraculous'); ?>
									  </a>
                                  <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="jp-type-playlist">
                        <div class="jp-gui jp-interface flex-wrap">
                            <div class="jp-controls flex-item">
								<button class="jp-previous" tabindex="0">
								  <i class="ms_play_control"></i>
								</button>
								<button class="jp-play" tabindex="0">
								  <i class="ms_play_control"></i>
								</button>
								<button class="jp-next" tabindex="0">
								  <i class="ms_play_control"></i>
								</button>
                            </div>
                            <div class="jp-progress-container flex-item" data-dura="<?php echo esc_attr($songduration); ?>">
                                <div class="jp-time-holder">
                                    <span class="jp-current-time" role="timer" aria-label="time"><?php esc_html_e('&nbsp','miraculous'); ?></span>
                                    <span class="jp-duration" role="timer" aria-label="duration"><?php esc_html_e('&nbsp','miraculous'); ?></span>
                                </div>
                                <div class="jp-progress">
                                    <div class="jp-seek-bar">
                                        <div class="jp-play-bar">
                                            <div class="bullet">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="jp-volume-controls flex-item">
                                <div class="widgetvolume knob-container">
                                    <div class="knob-wrapper-outer">
                                        <div class="knob-wrapper">
                                            <div class="knob-mask">
                                                <div class="knob d3">
												 <span></span>
												</div>
                                                <div class="handle"></div>
												<?php if(!empty($volume_icone)): ?>
                                                <div class="round">
                                                </div>
												<?php endif; ?>
                                            </div>
                                        </div>
                                        <!-- <input></input> -->
                                    </div>
                                </div>
                            </div>
                            <div class="jp-toggles flex-item">
                                <button class="jp-shuffle" tabindex="0" title="Shuffle">
                                  <i class="ms_play_control"></i>
								</button>
                                <button class="jp-repeat" tabindex="0" title="Repeat">
								  <i class="ms_play_control"></i>
								</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php if($songduration_setting == 'on'){ ?>
            <div class="preview-song" style="TEXT-ALIGN: center;background: #3bc8e7;padding: 5px;">It's Preview of song- Download it to get full version.</div>
            <?php } ?>
        </div>
        <!--main div-->
    </div>
    <!-- Queue Clear Model -->
    <div class="ms_clear_modal">
        <div id="clear_modal" class="modal  centered-modal" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <button type="button" class="close" data-dismiss="modal">
                        <i class="fa_icon form_close"></i>
                    </button>
                    <div class="modal-body">
                        <h1><?php echo esc_html_e('Are you sure you want to clear your queue?', 'miraculous'); ?></h1>
                        <div class="clr_modal_btn">
                            <a href="javascript:;" class="ms_remove_all">
							<?php echo esc_html_e('clear all', 'miraculous'); ?></a>
                            <a href="javascript:;" class="ms_cancel">
							<?php echo esc_html_e('cancel', 'miraculous'); ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php }
 } 
public function miraculous_related_posts_data($post_id, $post_type) {
   $taxonomy = 'genre';
   $terms = get_the_terms($post_id, $taxonomy); // Get all terms of a genre taxonomy
   $genre_ids = array(); 

	if(!is_wp_error($terms) && !empty($terms)):
		foreach ($terms as $term):
			$genre_ids[] = $term->term_id;
		endforeach;
	endif;

    $user_id = get_current_user_id();
    $lang_data = get_option('language_filter_ids_'.$user_id);

    if( $user_id && $lang_data ){

        $related_args = array(
                'post_type' => $post_type,
                'posts_per_page' => 12,
                'post_status' => 'publish',
                'post__not_in' => array( $post_id ),
                'orderby' => 'rand',
                'tax_query' => array(
                array(
                    'taxonomy' => 'genre',
                    'field' => 'id',
                    'terms' => $genre_ids
                ),
                array(
                    'taxonomy' => 'language',
                    'terms' => $lang_data
                )
            )
        );

    }elseif ( isset($_COOKIE['lang_filter']) ) {
        $lang_data = explode(',', $_COOKIE['lang_filter']);
    
        $related_args = array(
                'post_type' => $post_type,
                'posts_per_page' => 12,
                'post_status' => 'publish',
                'post__not_in' => array( $post_id ),
                'orderby' => 'rand',
                'tax_query' => array(
                array(
                    'taxonomy' => 'genre',
                    'field' => 'id',
                    'terms' => $genre_ids
                ),
                array(
                    'taxonomy' => 'language',
                    'terms' => $lang_data
                )
            )
        );

    }else{
        $related_args = array(
                'post_type' => $post_type,
                'posts_per_page' => 12,
                'post_status' => 'publish',
                'post__not_in' => array( $post_id ),
                'orderby' => 'rand',
                'tax_query' => array(
                array(
                    'taxonomy' => 'genre',
                    'field' => 'id',
                    'terms' => $genre_ids
                )
            )
        );
    }
  // the query
  $related_posts = new WP_Query( $related_args );
  if($post_type == 'ms-artists'){
      $label = 'Similar Artists';
  } elseif($post_type == 'ms-albums'){
      $label = 'Similar Albums';
  } elseif($post_type == 'ms-radios'){
      $label = 'Similar Radio';
  } else{
      $label = 'Similar Podcasts';
  }
  
  if($post_type == 'ms-artists'){
      $favourite_class = 'favourite_artist';
  } elseif($post_type == 'ms-albums') {
      $favourite_class = 'favourite_albums';
  } elseif($post_type == 'ms-podcasts') {
      $favourite_class = 'favourite_podcasts';
  } elseif($post_type == 'ms-radios') {
      $favourite_class = 'favourite_radios';
  } else{
      $favourite_class = 'favourite_music';
  }
  $musictype = ($post_type == 'ms-artists') ? 'artist' : ( ($post_type == 'ms-albums') ? 'album' : ( ($post_type == 'ms-radios') ? 'radio' : 'music' ) );
  if( $related_posts->have_posts() ): 
  ?>
   <div class="ms_fea_album_slider">
      <div class="ms_heading">
          <h1><?php echo esc_html($label); ?></h1>
          <span class="veiw_all"></span>
	  </div> 
      <div class="ms_relative_inner">
          <div class="ms_feature_slider swiper-container swiper-container-horizontal">
              <div class="swiper-wrapper" style="transform: translate3d(-921.75px, 0px, 0px); transition-duration: 0ms;">
                  <?php
				  $i=0;
				  while ( $related_posts->have_posts() ) : $related_posts->the_post(); ?>
                  <div class="swiper-slide<?php echo ($i==0) ? ' swiper-slide-active' : ''; ?>" data-swiper-slide-index="<?php echo _e($i); ?>" style="width: 253.5px; margin-right: 30px;">
                          <div class="ms_rcnt_box">
                              <div class="ms_rcnt_box_img">
                                  <?php the_post_thumbnail( 'large' ); ?>
                                  <div class="ms_main_overlay">
                                      <div class="ms_box_overlay"></div>
                                      <div class="ms_more_icon">
                                      </div>
                                      <?php
                                        $fav_class = 'icon_fav';
                                        if(function_exists('miraculous_get_favourite_div_class')){
                                          $fav_class = miraculous_get_favourite_div_class(get_the_id(), $musictype);
                                        }
                                      ?>
                                      <ul class="more_option">
                                          <li>
										  <a href="javascript:;" class="<?php echo esc_attr($favourite_class); ?>" id="<?php echo esc_attr(get_the_id()); ?>">
										  <span class="opt_icon">
										    <span class="icon <?php echo esc_attr($fav_class); ?>">
												<svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 22 22"><g id="_08-5" data-name=" 08-5"><path id="_08-6" data-name=" 08-6" class="cls-1" d="M13.7,4.49a4.34,4.34,0,0,0-2,.48,3.83,3.83,0,0,0-.73.48A3.54,3.54,0,0,0,10.27,5,4.3,4.3,0,0,0,4,8.83a7.6,7.6,0,0,0,2.46,5.05,22.38,22.38,0,0,0,4,3.29l.51.34.52-.34a23.09,23.09,0,0,0,4-3.29A7.63,7.63,0,0,0,18,8.83,4.34,4.34,0,0,0,13.7,4.49ZM8.31,6.36a2.42,2.42,0,0,1,1.94,1l.75,1,.76-1a2.39,2.39,0,0,1,1.94-1,2.45,2.45,0,0,1,2.43,2.47,5.89,5.89,0,0,1-1.95,3.78A20.15,20.15,0,0,1,11,15.26a20.07,20.07,0,0,1-3.17-2.65A5.89,5.89,0,0,1,5.88,8.83,2.45,2.45,0,0,1,8.31,6.36Z"/></g></svg>
											</span>
										  </span>
										  <?php esc_html_e('','miraculous'); ?>
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
										   <?php esc_html_e('Add To Queue','miraculous'); ?></a>
										  </li>
                                          <li>
										  <a href="javascript:;" class="ms_share_music" data-shareuri="<?php esc_attr_e(get_the_permalink()); ?>" data-sharename="<?php the_title_attribute(); ?>">
										   <span class="opt_icon">
										     <span class="icon icon_share">
												<svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 22 22"><g id="_14-2" data-name=" 14-2"><path id="_13" data-name=" 13" class="cls-1" d="M8.68,13.18A2.78,2.78,0,0,1,4.77,13l-.07-.08a3,3,0,0,1,0-3.85,2.77,2.77,0,0,1,3.89-.36.52.52,0,0,1,.11.1l3-2.11.09-.06a1.09,1.09,0,0,0,.63-1.08A2.76,2.76,0,0,1,15.05,3,2.84,2.84,0,0,1,17.9,5.22a3,3,0,0,1-1.36,3.22,2.72,2.72,0,0,1-3.34-.5l-.27-.3C11.81,8.41,10.7,9.18,9.6,10a.37.37,0,0,0-.09.28q0,.75,0,1.5a.51.51,0,0,0,.13.34c1.08.77,2.18,1.52,3.3,2.3a2.89,2.89,0,0,1,1.76-1.15A2.83,2.83,0,0,1,18,15.56h0A2.92,2.92,0,0,1,15.72,19a2.82,2.82,0,0,1-3.28-2.28,3.33,3.33,0,0,1,0-.63.55.55,0,0,0-.16-.38ZM6.82,9.55a1.45,1.45,0,0,0,0,2.9,1.45,1.45,0,0,0,0-2.9ZM15.2,7.36a1.43,1.43,0,0,0,1.39-1.45h0A1.4,1.4,0,1,0,15.2,7.36Zm0,7.29a1.42,1.42,0,0,0-1.4,1.43h0a1.4,1.4,0,0,0,1.44,1.36,1.4,1.4,0,0,0,0-2.8Z"/></g></svg>
											 </span>
										   </span>
										  <?php esc_html_e('Share','miraculous'); ?></a>
										  </li>
                                      </ul>
                                      <div class="ms_play_icon play_btn play_music" data-musicid="<?php esc_html_e(get_the_id()); ?>" data-musictype="<?php printf($musictype); ?>">
                                          <img src="<?php echo esc_url(get_template_directory_uri().'/assets/images/svg/play.svg'); ?>" alt="<?php esc_attr_e('play icone','miraculous'); ?>">
                                      </div>
                                  </div>
                              </div>
                              <div class="ms_rcnt_box_text">
                                    <h3><a href="<?php echo esc_url(get_the_permalink(get_the_ID())); ?>"><?php the_title(); ?></a></h3>
                                    <?php 
                                        if($post_type == 'ms-albums'){
                                            $ms_artists = 'album_artists';
                                        } elseif($post_type == 'ms-podcasts'){
                                            $ms_artists = 'podcast_artists';
                                        }else{
                                            $ms_artists = 'music_artists';
                                        }
                                        $artists_name = array(); 
                                        $artists_ids = fw_get_db_post_option(get_the_id(), $ms_artists);
                                        if(!empty($artists_ids)):
                                        foreach ($artists_ids as $artists_id) {
                                            $artists_name[] = get_the_title($artists_id);
                                        }
                                        endif;
                                        ?>
                                        <p><?php echo implode(', ', $artists_name); ?></p>
                              </div>
                          </div>
                      </div>
                     <?php 
				     $i++; 
				     endwhile; 
                     wp_reset_postdata(); ?>
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
 <?php
  endif; 
}
/**
 *Miraculous Albums 
 */
public function miraculous_albums() {

    $miraculous_theme_data = '';
    if (function_exists('fw_get_db_settings_option')):  
        $miraculous_theme_data = fw_get_db_settings_option();     
    endif; 
    $currency = '';
    if(!empty($miraculous_theme_data['currency'])):
        $currency = $miraculous_theme_data['currency'];
    endif;
    $stripe_publishable_key = '';
    if(!empty($miraculous_theme_data['theme_stripe_switch']['on']['stripe_publishable_key'])):
        $stripe_publishable_key = $miraculous_theme_data['theme_stripe_switch']['on']['stripe_publishable_key'];
    endif;

	$stripe_secret_key = '';
    if(!empty($miraculous_theme_data['theme_stripe_switch']['on']['stripe_secret_key'])):
        $stripe_secret_key = $miraculous_theme_data['theme_stripe_switch']['on']['stripe_secret_key'];
    endif;

	$stripe_logo_image = '';
    if(!empty($miraculous_theme_data['theme_stripe_switch']['on']['stripe_logo_image']['url'])):
        $stripe_logo_image = $miraculous_theme_data['theme_stripe_switch']['on']['stripe_logo_image']['url'];
    endif;

	$stripe_store_name = '';
    if(!empty($miraculous_theme_data['theme_stripe_switch']['on']['stripe_store_name'])):
        $stripe_store_name = $miraculous_theme_data['theme_stripe_switch']['on']['stripe_store_name'];
    endif;

	$stripe_store_description = '';
    if(!empty($miraculous_theme_data['theme_stripe_switch']['on']['stripe_store_description'])):
        $stripe_store_description = $miraculous_theme_data['theme_stripe_switch']['on']['stripe_store_description'];
    endif;

    $stripe_submit_donations_url = plugins_url().'/miraculouscore/strippayment/donations.php';
    
    $current_user = wp_get_current_user();
    $play_all = get_template_directory_uri().'/assets/images/svg/play_all.svg';
    $pause_all = get_template_directory_uri().'/assets/images/svg/pause_all.svg';
    $add_to_queue = get_template_directory_uri().'/assets/images/svg/add_q.svg';
    $more_img = get_template_directory_uri().'/assets/images/svg/more.svg';
    $musictype = 'album';
    $list_type = 'music';
    $user_id = get_current_user_id();
    $miraculous_theme_data = '';
    if (function_exists('fw_get_db_settings_option')):  
        $miraculous_theme_data = fw_get_db_settings_option();     
    endif; 
    if(!empty($miraculous_theme_data['miraculous_layout']) && $miraculous_theme_data['miraculous_layout'] == '2'):
        $more_img = get_template_directory_uri().'/assets/images/svg/more1.svg';
    endif;
  $currency = '';
    if(!empty($miraculous_theme_data['currency']) && function_exists('miraculous_currency_symbol')):
        $currency = miraculous_currency_symbol( $miraculous_theme_data['currency'] );
    endif;
	$ms_album_post_meta_option = '';
	if( function_exists('fw_get_db_post_option') ):
	$ms_album_post_meta_option = fw_get_db_post_option(get_the_ID());
    endif;
    if($ms_album_post_meta_option['album_artists']):
		foreach ($ms_album_post_meta_option['album_artists'] as $artists_id):
			$artists_name[] = get_the_title($artists_id);
		endforeach; 
	endif; 
	$theme_paypal_switch = '';
	if(!empty($miraculous_theme_data['theme_paypal_switch']['Paypal_switch_value'])):
		$theme_paypal_switch = $miraculous_theme_data['theme_paypal_switch']['Paypal_switch_value'];
	endif;
	$theme_stripe_switch = '';
	if(!empty($miraculous_theme_data['theme_stripe_switch']['stripe_switch_value'])):
		$theme_stripe_switch = $miraculous_theme_data['theme_stripe_switch']['stripe_switch_value'];
	endif;
	$theme_paystack_switch = '';
	if(!empty($miraculous_theme_data['theme_paystack_switch']['paystack_switch_value'])):
		$theme_paystack_switch = $miraculous_theme_data['theme_paystack_switch']['paystack_switch_value'];
	endif;
?>	
<div class="album_single_data single_album">
    <div class="album_single_img">
    	<?php $image_uri = get_the_post_thumbnail_url ( get_the_id() ); ?>
        <img src="<?php echo esc_url( $image_uri ); ?>" alt="" class="img-fluid">
    </div>
    <div class="album_single_text">
        <?php 
        if(is_singular()){
          the_title( '<h2>', '</h2>' );
          if(function_exists('miraculous_album_view_set')):
        	 miraculous_album_view_set(get_the_id());
	      endif;
        }else{
          the_title( '<a href="'. esc_url( get_permalink() ) .'" class="album_single_title">', '</a>' );
        }
        if(function_exists('fw_get_db_post_option')): 
            $miraculous_post_data = fw_get_db_post_option(get_the_ID());   
        endif;

        $music_artists = '';
        if(!empty($miraculous_post_data['user_music_artist'])):
        $music_artists = $miraculous_post_data['user_music_artist'];
        else:
        $music_artists = get_post_meta(get_the_ID(),'fw_option:user_music_artist',true);
        endif;
        $product_price = '';
        if(!empty($miraculous_post_data['album_full_prices'])):
          $product_price = $miraculous_post_data['album_full_prices'];
        else:
          $product_price = get_post_meta(get_the_ID(),'fw_option:album_full_prices',true);
        endif;
        $album_type = get_post_meta(get_the_id(), 'fw_option:album_type', true);
        if($album_type == 'premium'):
        ?>
         <p><?php echo esc_html__('Album Price: ','miraculous'); ?><span>
         <?php echo esc_html($currency).' '.esc_html($product_price); ?></span></p>
        <?php 
        endif;
        ?>
        <!-- <p class="singer_name">
		<?php printf( __('By - %s', 'miraculous'), implode(', ', $artists_name) ) ?></p> -->

        <div class="album_feature">
            <a href="javascript:;" class="album_date">
			<?php echo 'Song | '. count($ms_album_post_meta_option['album_songs']);
			 ?></a>
            <a href="javascript:;" class="album_date"><?php printf( __('Released %s  | %s', 'miraculous'), date('F jS, Y', strtotime($ms_album_post_meta_option['album_release_date'])), $ms_album_post_meta_option['album_company_name'] ) ?></a>
        </div>
        <div class="album_btn">
            <a href="javascript:;" class="ms_btn play_btn play_music" data-musicid="<?php esc_html_e(get_the_id()); ?>" data-musictype="<?php printf($musictype); ?>">
			<span class="play_all">
			  <img src="<?php echo esc_url($play_all); ?>" alt="<?php echo esc_attr('Play all', 'miraculous'); ?>">
			  <?php esc_html_e('Play All', 'miraculous');  ?>
			</span>
			<span class="pause_all">
			  <img src="<?php echo esc_url($pause_all); ?>" alt="<?php echo esc_attr('Pause', 'miraculous'); ?>"><?php esc_html_e('Pause', 'miraculous'); ?>
			</span>
			</a>
            <a href="javascript:;" class="ms_btn add_to_queue" data-musicid="<?php esc_html_e(get_the_id()); ?>" data-musictype="<?php printf($musictype); ?>">
			  <span class="play_all">
			    <img src="<?php echo esc_url($add_to_queue); ?>" alt="<?php echo esc_attr('Add to Queue', 'miraculous'); ?>">
			    <?php esc_html_e('Add To Queue', 'miraculous'); ?>
			  </span>
			</a>
            <?php 
            $author_id = get_post_field ('post_author', get_the_id());
            if( !empty($current_user->ID) && $current_user->ID ){

            $product_price = (int)get_post_meta(get_the_id(), 'fw_option:album_full_prices', true)*100;
            
            if($current_user->ID == $author_id):
            ?>
            <a href="<?php echo esc_url(home_url('/albums-update/')); ?>?albums_id=<?php echo get_the_id() ?>" target ="_blank" class="ms_btn">
                <span class="album_edite"> 
			      <i class="fa fa-pencil-square-o"></i>
			      <?php esc_html_e('Edit', 'miraculous'); ?>
			    </span>  
            </a>
            <?php else: 
            if($album_type == 'premium'): 
            ?>
                <?php
                    if ( is_user_logged_in() ) { 
                        $user_id = get_current_user_id();
                        $music_ids = get_user_meta($user_id, 'premium_downloaded_album_by_user_'.$user_id, true);
                        if(!empty($music_ids)){
                            if(in_array(get_the_id(), $music_ids)){
                                ?>
                                <div class="mira_pur_tooltip">
            					<a href="javascript:;" class="ms_btn" ><?php esc_html_e('Purchased', 'miraculous'); ?></a>
            					<span class="mira_pur_tooltiptext">This Album is purchased by you previously, You can download this album's songs free.</span>
            					</div>
            					<?php 
                            }
                            else{
                                ?>
            					<a href="javascript:;" class="ms_btn bynow_btn ms-open-model" data-post="album" order_id="<?php echo esc_attr(get_the_id()); ?>"><?php esc_html_e('buy now', 'miraculous'); ?></a>
            					<?php 
                            }
                        }
                        else{
                            ?>
        					<a href="javascript:;" class="ms_btn bynow_btn ms-open-model" data-post="album" order_id="<?php echo esc_attr(get_the_id()); ?>"><?php esc_html_e('buy now', 'miraculous'); ?></a>
        					<?php 
                        }
					} else { ?>
					<a href="javascript:;" class="ms_btn bynow_btn" data-toggle="modal" data-target="#myModal" order_id="<?php echo esc_attr(get_the_id()); ?>"><?php esc_html_e('buy now', 'miraculous'); ?></a>
					 <?php }
					?>
                <?php endif; 
                endif;
                ?>
            <?php }else{ ?>
            <a href="javascript:;" class="ms_btn" data-toggle="modal" data-target="#myModal1"><?php esc_html_e('buy now', 'miraculous'); ?></a>
            <?php } ?>
         </div>
    </div>
    <div class="album_more_optn ms_more_icon">
         <span>
		   <img src="<?php echo esc_url($more_img); ?>" alt="<?php echo esc_attr('More', 'miraculous'); ?>">
		 </span>
    </div>
    <?php
    $fav_class = 'icon_fav';
      if(function_exists('miraculous_get_favourite_div_class')){ 
        $fav_class = miraculous_get_favourite_div_class(get_the_id(), $musictype);  
      } 
    ?>
    <ul class="more_option">
        <li>
			<a href="javascript:;" class="favourite_albums" data-albumid="<?php echo esc_attr(get_the_id()); ?>"><span class="opt_icon"><span class="icon <?php echo esc_attr($fav_class); ?>">
				<svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 22 22"><g id="_08-5" data-name=" 08-5"><path id="_08-6" data-name=" 08-6" class="cls-1" d="M13.7,4.49a4.34,4.34,0,0,0-2,.48,3.83,3.83,0,0,0-.73.48A3.54,3.54,0,0,0,10.27,5,4.3,4.3,0,0,0,4,8.83a7.6,7.6,0,0,0,2.46,5.05,22.38,22.38,0,0,0,4,3.29l.51.34.52-.34a23.09,23.09,0,0,0,4-3.29A7.63,7.63,0,0,0,18,8.83,4.34,4.34,0,0,0,13.7,4.49ZM8.31,6.36a2.42,2.42,0,0,1,1.94,1l.75,1,.76-1a2.39,2.39,0,0,1,1.94-1,2.45,2.45,0,0,1,2.43,2.47,5.89,5.89,0,0,1-1.95,3.78A20.15,20.15,0,0,1,11,15.26a20.07,20.07,0,0,1-3.17-2.65A5.89,5.89,0,0,1,5.88,8.83,2.45,2.45,0,0,1,8.31,6.36Z"/></g></svg>
			</span></span><?php echo esc_html_e('Favourites', 'miraculous'); ?>
			</a>
		</li>
        <li>
		  <a href="javascript:;" class="add_to_queue" data-musicid="<?php esc_html_e(get_the_id()); ?>" data-musictype="<?php printf($musictype); ?>"><span class="opt_icon"><span class="icon icon_queue">
			<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
													<path fill-rule="evenodd" d="M11.359,5.172 L6.847,5.172 L6.847,0.660 C6.847,0.455 6.568,0.009 6.010,0.009 C5.452,0.009 5.172,0.455 5.172,0.660 L5.172,5.172 L0.661,5.172 C0.455,5.172 0.010,5.451 0.010,6.009 C0.010,6.567 0.455,6.846 0.661,6.846 L5.173,6.846 L5.173,11.358 C5.173,11.563 5.452,12.009 6.010,12.009 C6.568,12.009 6.847,11.563 6.847,11.358 L6.847,6.846 L11.359,6.846 C11.564,6.846 12.010,6.567 12.010,6.009 C12.010,5.451 11.564,5.172 11.359,5.172 Z"/>
													</svg>
		  </span></span><?php echo esc_html_e('Add To Queue', 'miraculous'); ?>
		  </a>
		</li> 
        <li>
		  <a href="javascript:;" class="ms_share_music" data-shareuri="<?php esc_attr_e(get_the_permalink()); ?>" data-sharename="<?php esc_attr_e(get_the_title()); ?>"><span class="opt_icon"><span class="icon icon_share">
			<svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 22 22"><g id="_14-2" data-name=" 14-2"><path id="_13" data-name=" 13" class="cls-1" d="M8.68,13.18A2.78,2.78,0,0,1,4.77,13l-.07-.08a3,3,0,0,1,0-3.85,2.77,2.77,0,0,1,3.89-.36.52.52,0,0,1,.11.1l3-2.11.09-.06a1.09,1.09,0,0,0,.63-1.08A2.76,2.76,0,0,1,15.05,3,2.84,2.84,0,0,1,17.9,5.22a3,3,0,0,1-1.36,3.22,2.72,2.72,0,0,1-3.34-.5l-.27-.3C11.81,8.41,10.7,9.18,9.6,10a.37.37,0,0,0-.09.28q0,.75,0,1.5a.51.51,0,0,0,.13.34c1.08.77,2.18,1.52,3.3,2.3a2.89,2.89,0,0,1,1.76-1.15A2.83,2.83,0,0,1,18,15.56h0A2.92,2.92,0,0,1,15.72,19a2.82,2.82,0,0,1-3.28-2.28,3.33,3.33,0,0,1,0-.63.55.55,0,0,0-.16-.38ZM6.82,9.55a1.45,1.45,0,0,0,0,2.9,1.45,1.45,0,0,0,0-2.9ZM15.2,7.36a1.43,1.43,0,0,0,1.39-1.45h0A1.4,1.4,0,1,0,15.2,7.36Zm0,7.29a1.42,1.42,0,0,0-1.4,1.43h0a1.4,1.4,0,0,0,1.44,1.36,1.4,1.4,0,0,0,0-2.8Z"/></g></svg>
		  </span></span><?php esc_html_e('Share', 'miraculous'); ?>
		  </a>
		</li>
    </ul>
</div>
<?php if( is_singular() ){ ?>
    <!-- Song List -->
    <div class="album_inner_list">
    <div class="album_list_wrapper">
            <ul class="album_list_name">
              <li><?php esc_html_e('#', 'miraculous'); ?></li>
              <li><?php esc_html_e('Song Title', 'miraculous'); ?></li>
              <!-- <li><?php esc_html_e('Artist', 'miraculous'); ?></li> -->
              <li class="text-center"><?php esc_html_e('Duration', 'miraculous'); ?></li>
              <li class="text-center"><?php esc_html_e('Price', 'miraculous'); ?></li>
              <li class="text-center"><?php esc_html_e('More', 'miraculous'); ?></li>
            </ul>
        <?php 
        if($ms_album_post_meta_option['album_songs'] ):  
        $i = 1;
        foreach($ms_album_post_meta_option['album_songs'] as $mst_music_option): 
            $attach_meta = array();
                $mpurl = get_post_meta($mst_music_option, 'fw_option:mp3_full_songs', true);
              if($mpurl) {
                $attach_meta = wp_get_attachment_metadata( $mpurl['attachment_id'] );
              }
            $image_uri = get_the_post_thumbnail_url ( $mst_music_option );

            $music_post_data = '';
            if(function_exists('fw_get_db_post_option')){
                 $music_post_data = fw_get_db_post_option($mst_music_option);
            }
            $music_price = '';
            if(!empty($music_post_data['single_music_prices'])):
               $music_price = $music_post_data['single_music_prices'];
            else:
               $music_price = get_post_meta($mst_music_option,'single_music_prices',true);
            endif;
            ?>
              <ul class="ms_list_songs">
              <li>
              <a href="javascript:;">
              <span class="play_no">
              <?php echo ($i > 9) ? esc_html($i) : '0'.$i; ?>
              </span><span class="play_hover equlizer">
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
                            </span></a>
              </li>

              <li>
              <a href="javascript:;" data-musicid="<?php echo esc_attr($mst_music_option); ?>" class="play_single_music">
               <?php echo get_the_title( $mst_music_option ); ?>
              </a>
              </li>
              <li class="text-center">
			  <a href="javascript:;">
			        <?php $music_extranal_url = get_post_meta($mst_music_option, 'fw_option:music_extranal_url', true);
			            if(!empty($music_extranal_url)){ ?>
			                <audio id="audio-element" controls style="display: none;">
                                <source src="<?php echo $music_extranal_url; ?>" type="audio/mpeg">
                            </audio>
                            <p id="ml"></p>
			           <?php } else {
			             echo (isset($attach_meta['length_formatted'])) ? $attach_meta['length_formatted'] : "0.25"; 
			           }
			        ?>
              </a>
              </li>
              <?php if(empty($music_price)): ?>
               <li class="text-center">
			     <a href="javascript:;"><?php esc_html_e('Free', 'miraculous'); ?></a>
			   </li>
               <?php else: ?>
               <li class="text-center">
				  <a href="javascript:;"><?php printf( __('%s%s', 'miraculous'), $currency, $music_price ); ?>
				  </a>
			   </li>
               <?php endif; ?>
               <li class="text-center ms_more_icon">
                 <a href="javascript:;">
                  <span class="ms_icon1 ms_active_icon"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="15px" height="4px">
                    <path fill-rule="evenodd" d="M13.000,3.999 C11.897,3.999 11.000,3.102 11.000,1.999 C11.000,0.897 11.897,-0.001 13.000,-0.001 C14.103,-0.001 15.000,0.897 15.000,1.999 C15.000,3.102 14.103,3.999 13.000,3.999 ZM7.500,3.999 C6.397,3.999 5.500,3.102 5.500,1.999 C5.500,0.897 6.397,-0.001 7.500,-0.001 C8.603,-0.001 9.500,0.897 9.500,1.999 C9.500,3.102 8.603,3.999 7.500,3.999 ZM2.000,3.999 C0.897,3.999 -0.000,3.102 -0.000,1.999 C-0.000,0.897 0.897,-0.001 2.000,-0.001 C3.103,-0.001 4.000,0.897 4.000,1.999 C4.000,3.102 3.103,3.999 2.000,3.999 Z"/>
                  </svg></span>
                 </a>
                <?php
                $fav_class = 'icon_fav';
                if(function_exists('miraculous_get_favourite_div_class')){
                  $fav_class = miraculous_get_favourite_div_class($mst_music_option, $list_type);
                }
                ?>
                 <ul class="more_option">
                    <li>
                     <?php 
                     $author_id = get_post_field('post_author', $mst_music_option);
                     if($current_user->ID == $author_id):
                     ?>
                     <a href="<?php echo esc_url(home_url('/audio-update/')); ?>?track_id=<?php echo $mst_music_option ?>" target ="_blank" class="bs_audio_edite">
                        <p class="album_edite mira-more"> 
                            <span class="opt_icon text-center">
                                <i class="fa fa-pencil-square-o"></i>
                            </span>
                            <span>
                            <?php esc_html_e('Edit', 'miraculous'); ?>
                            </span>
                        </p>
                     </a>
                     <?php else: ?>
                    <?php 
                        if(!empty($music_price)){ ?>
                            <a href="<?php echo esc_url(get_the_permalink($mst_music_option)); ?>" class="ms_buy_download fdgf"> 
                              <p class="mira-more"> 
        					    <span class="opt_icon">
					                <span class="icon fa fa-shopping-cart"></span>
					            </span>
					            <span>
					            <?php esc_html_e('Buy Now', 'miraculous'); ?>
					            </span>
					          </p>
					        </a>
                        <?php } 
                    ?>
                     <?php endif; ?>
                    </li>
                    <li>
    				   <a href="javascript:;" class="favourite_music" data-musicid="<?php echo esc_attr($mst_music_option); ?>">
    				     <p class="mira-more"> 
    					   <span class="opt_icon">
        					  <span class="icon <?php echo esc_attr($fav_class); ?>">
        						<svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 22 22"><g id="_08-5" data-name=" 08-5"><path id="_08-6" data-name=" 08-6" class="cls-1" d="M13.7,4.49a4.34,4.34,0,0,0-2,.48,3.83,3.83,0,0,0-.73.48A3.54,3.54,0,0,0,10.27,5,4.3,4.3,0,0,0,4,8.83a7.6,7.6,0,0,0,2.46,5.05,22.38,22.38,0,0,0,4,3.29l.51.34.52-.34a23.09,23.09,0,0,0,4-3.29A7.63,7.63,0,0,0,18,8.83,4.34,4.34,0,0,0,13.7,4.49ZM8.31,6.36a2.42,2.42,0,0,1,1.94,1l.75,1,.76-1a2.39,2.39,0,0,1,1.94-1,2.45,2.45,0,0,1,2.43,2.47,5.89,5.89,0,0,1-1.95,3.78A20.15,20.15,0,0,1,11,15.26a20.07,20.07,0,0,1-3.17-2.65A5.89,5.89,0,0,1,5.88,8.83,2.45,2.45,0,0,1,8.31,6.36Z"/></g></svg>
        					  </span>
        					</span>
        					<span>
        					   <?php esc_html_e('Favourites', 'miraculous'); ?>
    					   </span>
    					 </p>
    				   </a>
                    </li>
                    <li>
					  <a href="javascript:;" class="add_to_queue" data-musicid="<?php esc_html_e($mst_music_option); ?>" data-musictype="<?php printf($list_type); ?>">
                         <p class="mira-more"> 
    					  <span class="opt_icon">
        					  <span class="icon icon_queue">
        						<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
									<path fill-rule="evenodd" d="M11.359,5.172 L6.847,5.172 L6.847,0.660 C6.847,0.455 6.568,0.009 6.010,0.009 C5.452,0.009 5.172,0.455 5.172,0.660 L5.172,5.172 L0.661,5.172 C0.455,5.172 0.010,5.451 0.010,6.009 C0.010,6.567 0.455,6.846 0.661,6.846 L5.173,6.846 L5.173,11.358 C5.173,11.563 5.452,12.009 6.010,12.009 C6.568,12.009 6.847,11.563 6.847,11.358 L6.847,6.846 L11.359,6.846 C11.564,6.846 12.010,6.567 12.010,6.009 C12.010,5.451 11.564,5.172 11.359,5.172 Z"/>
								</svg>
        					  </span>
        				  </span>
        				  <span>
					        <?php esc_html_e('Add To Queue', 'miraculous'); ?>
                          </span>   
                        </p>
					  </a>
                   </li>
                   <li>
					  <a href="javascript:;" class="ms_download" data-albumsid="<?php echo esc_attr(get_the_ID()); ?>" data-msmusic="<?php echo esc_attr($mst_music_option); ?>"> 
    					<p class="mira-more"> 
                          <span class="opt_icon">
    					    <span class="icon icon_dwn">
    							<svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 22 22"><g id="_06-4" data-name=" 06-4"><path id="_06-5" data-name=" 06-5" class="cls-1" d="M10.65,13.85a.48.48,0,0,0,.7,0l3.27-3.5a.41.41,0,0,0,.07-.47.48.48,0,0,0-.42-.26H12.4V4.94a.46.46,0,0,0-.47-.44H10.07a.46.46,0,0,0-.47.44V9.63H7.73a.44.44,0,0,0-.42.25.41.41,0,0,0,.07.47Zm5.48-.73v2.63H5.87V13.12H4v3.5a.9.9,0,0,0,.93.88H17.07a.9.9,0,0,0,.93-.88v-3.5Z"/></g></svg>
    						</span>
    					  </span>
    					  <span>
					        <?php esc_html_e('Download Now', 'miraculous'); ?>
					      </span>
					    </p>
					  </a>
                   </li>
                   <li>
					  <a href="javascript:;" class="ms_add_playlist" data-msmusic="<?php echo esc_attr($mst_music_option); ?>">
                        <p class="mira-more"> 
    					  <span class="opt_icon">
    						<span class="icon icon_playlst">
    							<svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 22 22"><g id="_03-2" data-name=" 03-2"><path id="_03-3" data-name=" 03-3" class="cls-1" d="M13,5.5H3.5V7.07H13V5.5Zm0,3.14H3.5v1.57H13V8.64ZM3.5,13.36H9.82V11.79H3.5ZM14.55,5.5v6.43a2.35,2.35,0,1,0,1.58,2.21V7.07H18.5V5.5Z"/></g></svg>
    						</span>
    					  </span>
    					  <span>
					        <?php esc_html_e('Add To Playlist', 'miraculous'); ?>
					      </span>
					    </p>
				    </a>
                    </li>
                    <li>
					<a href="javascript:;" class="ms_share_music" data-shareuri="<?php esc_attr_e(get_the_permalink($mst_music_option)); ?>" data-sharename="<?php the_title_attribute($mst_music_option); ?>">
						<p class="mira-more"> 
						<span class="opt_icon">
						  <span class="icon icon_share">
							<svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 22 22"><g id="_14-2" data-name=" 14-2"><path id="_13" data-name=" 13" class="cls-1" d="M8.68,13.18A2.78,2.78,0,0,1,4.77,13l-.07-.08a3,3,0,0,1,0-3.85,2.77,2.77,0,0,1,3.89-.36.52.52,0,0,1,.11.1l3-2.11.09-.06a1.09,1.09,0,0,0,.63-1.08A2.76,2.76,0,0,1,15.05,3,2.84,2.84,0,0,1,17.9,5.22a3,3,0,0,1-1.36,3.22,2.72,2.72,0,0,1-3.34-.5l-.27-.3C11.81,8.41,10.7,9.18,9.6,10a.37.37,0,0,0-.09.28q0,.75,0,1.5a.51.51,0,0,0,.13.34c1.08.77,2.18,1.52,3.3,2.3a2.89,2.89,0,0,1,1.76-1.15A2.83,2.83,0,0,1,18,15.56h0A2.92,2.92,0,0,1,15.72,19a2.82,2.82,0,0,1-3.28-2.28,3.33,3.33,0,0,1,0-.63.55.55,0,0,0-.16-.38ZM6.82,9.55a1.45,1.45,0,0,0,0,2.9,1.45,1.45,0,0,0,0-2.9ZM15.2,7.36a1.43,1.43,0,0,0,1.39-1.45h0A1.4,1.4,0,1,0,15.2,7.36Zm0,7.29a1.42,1.42,0,0,0-1.4,1.43h0a1.4,1.4,0,0,0,1.44,1.36,1.4,1.4,0,0,0,0-2.8Z"/></g></svg>
						  </span>
						</span>
						<span>
						    <?php esc_html_e('Share', 'miraculous'); ?>
						</span>
				        </p>
				    </a>
                    </li>
                   </ul>
                  </li>
               </ul>
             <?php 
              $i++; 
              endforeach; 
              endif;
             ?> 
          </div>
		</div>
  <?php }

}

/**
 *Miraculous Radios 
 */
public function miraculous_radios() {
  $play_all = get_template_directory_uri().'/assets/images/svg/play_all.svg';
  $pause_all = get_template_directory_uri().'/assets/images/svg/pause_all.svg';
  $add_to_queue = get_template_directory_uri().'/assets/images/svg/add_q.svg';
  $more_img = get_template_directory_uri().'/assets/images/svg/more.svg';
  $user_id = get_current_user_id();
  $miraculous_theme_data = '';
    if (function_exists('fw_get_db_settings_option')):  
        $miraculous_theme_data = fw_get_db_settings_option();     
    endif; 
    if(!empty($miraculous_theme_data['miraculous_layout']) && $miraculous_theme_data['miraculous_layout'] == '2'):
        $more_img = get_template_directory_uri().'/assets/images/svg/more1.svg';
    endif;
    
  $currency = '';
    if(!empty($miraculous_theme_data['currency']) && function_exists('miraculous_currency_symbol')):
        $currency = miraculous_currency_symbol( $miraculous_theme_data['currency'] );
    endif;

  $musictype = 'radio';
  $list_type = 'music';
  $ms_radio_post_meta_option = '';
  if( function_exists('fw_get_db_post_option') ):
  $ms_radio_post_meta_option = fw_get_db_post_option(get_the_ID());
    endif;
    if($ms_radio_post_meta_option['radio_artists']):
    foreach ($ms_radio_post_meta_option['radio_artists'] as $artists_id):
      $artists_name[] = get_the_title($artists_id);
    endforeach; 
  endif; 
?>  
<div class="album_single_data">
    <div class="album_single_img">
      <?php $image_uri = get_the_post_thumbnail_url ( get_the_id() ); ?>
        <img src="<?php echo esc_url( $image_uri ); ?>" alt="" class="img-fluid">
    </div>
    <div class="album_single_text">
        <?php 
        if(is_singular()){
          the_title( '<h2>', '</h2>' );
        }else{
          the_title( '<a href="'. esc_url( get_permalink() ) .'" class="album_single_title">', '</a>' );
        }
        ?>
        <p class="singer_name"><?php printf( __('By - %s', 'miraculous'), implode(', ', $artists_name) ) ?></p>
        <div class="album_feature">
            <a href="javascript:;" class="album_date">
			<?php echo __('Song', 'miraculous') . '|' . count($ms_radio_post_meta_option['radio_songs']); ?></a>
            <a href="javascript:;" class="album_date">
			<?php printf( __('%s', 'miraculous'), $ms_radio_post_meta_option['radio_company_name'] ) ?></a>
        </div>
        <div class="album_btn">
            <a href="javascript:;" class="ms_btn play_btn play_music" data-musicid="<?php esc_html_e(get_the_id()); ?>" data-musictype="<?php printf($musictype); ?>">   <span class="play_all">
			  <img src="<?php echo esc_url($play_all); ?>" alt="<?php echo esc_attr('Play all', 'miraculous'); ?>"><?php esc_html_e('Play All', 'miraculous');  ?>
			</span>
			<span class="pause_all">
				<img src="<?php echo esc_url($pause_all); ?>" alt="<?php echo esc_attr('Pause', 'miraculous'); ?>"><?php esc_html_e('Pause', 'miraculous'); ?>
			 </span>
			</a>
        </div>
    </div>
    <div class="album_more_optn ms_more_icon">
        <span>
		 <img src="<?php echo esc_url($more_img); ?>" alt="<?php echo esc_attr('More', 'miraculous'); ?>">
		</span>
    </div>
    <?php
    $fav_class = 'icon_fav';
    if(function_exists('miraculous_get_favourite_div_class')){
      $fav_class = miraculous_get_favourite_div_class(get_the_id(), $musictype);
    }
    ?>
    <ul class="more_option">
         <li>
			<a href="javascript:;" class="favourite_radios" data-radioid="<?php echo esc_attr(get_the_id()); ?>"><span class="opt_icon"><span class="icon <?php echo esc_attr($fav_class); ?>">
				<svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 22 22"><g id="_08-5" data-name=" 08-5"><path id="_08-6" data-name=" 08-6" class="cls-1" d="M13.7,4.49a4.34,4.34,0,0,0-2,.48,3.83,3.83,0,0,0-.73.48A3.54,3.54,0,0,0,10.27,5,4.3,4.3,0,0,0,4,8.83a7.6,7.6,0,0,0,2.46,5.05,22.38,22.38,0,0,0,4,3.29l.51.34.52-.34a23.09,23.09,0,0,0,4-3.29A7.63,7.63,0,0,0,18,8.83,4.34,4.34,0,0,0,13.7,4.49ZM8.31,6.36a2.42,2.42,0,0,1,1.94,1l.75,1,.76-1a2.39,2.39,0,0,1,1.94-1,2.45,2.45,0,0,1,2.43,2.47,5.89,5.89,0,0,1-1.95,3.78A20.15,20.15,0,0,1,11,15.26a20.07,20.07,0,0,1-3.17-2.65A5.89,5.89,0,0,1,5.88,8.83,2.45,2.45,0,0,1,8.31,6.36Z"/></g></svg>
			</span>
			</span><?php echo esc_html_e('Favourites', 'miraculous'); ?>
			</a>
		 </li>
        <li>
		  <a href="javascript:;" class="ms_share_music" data-shareuri="<?php esc_attr_e(get_the_permalink()); ?>" data-sharename="<?php esc_attr_e(get_the_title()); ?>"><span class="opt_icon"><span class="icon icon_share">
			<svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 22 22"><g id="_14-2" data-name=" 14-2"><path id="_13" data-name=" 13" class="cls-1" d="M8.68,13.18A2.78,2.78,0,0,1,4.77,13l-.07-.08a3,3,0,0,1,0-3.85,2.77,2.77,0,0,1,3.89-.36.52.52,0,0,1,.11.1l3-2.11.09-.06a1.09,1.09,0,0,0,.63-1.08A2.76,2.76,0,0,1,15.05,3,2.84,2.84,0,0,1,17.9,5.22a3,3,0,0,1-1.36,3.22,2.72,2.72,0,0,1-3.34-.5l-.27-.3C11.81,8.41,10.7,9.18,9.6,10a.37.37,0,0,0-.09.28q0,.75,0,1.5a.51.51,0,0,0,.13.34c1.08.77,2.18,1.52,3.3,2.3a2.89,2.89,0,0,1,1.76-1.15A2.83,2.83,0,0,1,18,15.56h0A2.92,2.92,0,0,1,15.72,19a2.82,2.82,0,0,1-3.28-2.28,3.33,3.33,0,0,1,0-.63.55.55,0,0,0-.16-.38ZM6.82,9.55a1.45,1.45,0,0,0,0,2.9,1.45,1.45,0,0,0,0-2.9ZM15.2,7.36a1.43,1.43,0,0,0,1.39-1.45h0A1.4,1.4,0,1,0,15.2,7.36Zm0,7.29a1.42,1.42,0,0,0-1.4,1.43h0a1.4,1.4,0,0,0,1.44,1.36,1.4,1.4,0,0,0,0-2.8Z"/></g></svg>
		  </span></span>
		  <?php esc_html_e('Share', 'miraculous'); ?>
		 </a>
		</li>
    </ul>
</div>
<?php
  if( is_singular() ){ ?>
      <!-- Song List -->
      <div class="album_inner_list">
      <div class="album_list_wrapper">
          <ul class="album_list_name">
              <li><?php esc_html_e('#', 'miraculous'); ?></li>
              <li><?php esc_html_e('Song Title', 'miraculous'); ?></li>
              <li><?php esc_html_e('Artist', 'miraculous'); ?></li>
              <li class="text-center"><?php esc_html_e('Duration', 'miraculous'); ?></li>
              <li class="text-center"><?php esc_html_e('Price', 'miraculous'); ?></li>
              <li class="text-center"><?php esc_html_e('More', 'miraculous'); ?></li>
          </ul>
          <?php 
          if( $ms_radio_post_meta_option['radio_songs'] ):  
            $i = 1;
            foreach($ms_radio_post_meta_option['radio_songs'] as $mst_music_option): 
              $attach_meta = array();
                  $mpurl = get_post_meta($mst_music_option, 'fw_option:mp3_full_songs', true);
              if($mpurl) {
                $attach_meta = wp_get_attachment_metadata( $mpurl['attachment_id'] );
              }
              $image_uri = get_the_post_thumbnail_url ( $mst_music_option );
              $music_price = '';
                if(function_exists('fw_get_db_post_option')){
                    $music_price_arr = fw_get_db_post_option($mst_music_option, 'single_music_prices');
                    if( !empty( $music_price_arr ) ){
                        $music_price = $music_price_arr;
                    }
                }
              ?>
              <ul class="ms_list_songs">
				  <li>
					  <a href="javascript:;">
					  <span class="play_no">
					  <?php echo ($i > 9) ? esc_html($i) : '0'.$i; ?>
					  </span><span class="play_hover equlizer">
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
                            </span></a>
				  </li>
				  <li>
					<a href="javascript:;" data-musicid="<?php echo esc_attr($mst_music_option); ?>" class="play_single_music">
					  <?php echo get_the_title( $mst_music_option ); ?>
					</a>
				  </li>
                  <li>
					<a href="javascript:;" class="play_single_music"><?php echo implode(', ', $artists_name); ?>
					</a>
                  </li>
				  <li class="text-center">
					  <a href="javascript:;">
			        <?php $music_extranal_url = get_post_meta($mst_music_option, 'fw_option:music_extranal_url', true);
			            if(!empty($music_extranal_url)){ ?>
			                <audio id="audio-element" controls style="display: none;">
                                <source src="<?php echo $music_extranal_url; ?>" type="audio/mpeg">
                            </audio>
                            <p id="ml"></p>
			           <?php } else {
			             echo (isset($attach_meta['length_formatted'])) ? $attach_meta['length_formatted'] : "0.25"; 
			           }
			        ?>
              </a>
				  </li>
                 <?php if(empty($music_price)): ?>
                 <li class="text-center">
				    <a href="javascript:;"><?php esc_html_e('Free', 'miraculous'); ?></a>
				 </li>
                 <?php else: ?>
                 <li class="text-center">
				   <a href="javascript:;"><?php printf( __('%s%s', 'miraculous'), $currency, $music_price ); ?></a>
				 </li>
                 <?php endif; ?>
                 <li class="text-center ms_more_icon">
                   <a href="javascript:;">
                    <span class="ms_icon1 ms_active_icon">
                        <span class="ms_icon1 ms_active_icon"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="15px" height="4px">
                        <path fill-rule="evenodd" d="M13.000,3.999 C11.897,3.999 11.000,3.102 11.000,1.999 C11.000,0.897 11.897,-0.001 13.000,-0.001 C14.103,-0.001 15.000,0.897 15.000,1.999 C15.000,3.102 14.103,3.999 13.000,3.999 ZM7.500,3.999 C6.397,3.999 5.500,3.102 5.500,1.999 C5.500,0.897 6.397,-0.001 7.500,-0.001 C8.603,-0.001 9.500,0.897 9.500,1.999 C9.500,3.102 8.603,3.999 7.500,3.999 ZM2.000,3.999 C0.897,3.999 -0.000,3.102 -0.000,1.999 C-0.000,0.897 0.897,-0.001 2.000,-0.001 C3.103,-0.001 4.000,0.897 4.000,1.999 C4.000,3.102 3.103,3.999 2.000,3.999 Z"/>
                        </svg></span>
                    </span>
                   </a>
                <?php
                $fav_class = 'icon_fav';
                if(function_exists('miraculous_get_favourite_div_class')){
                  $fav_class = miraculous_get_favourite_div_class($mst_music_option, $list_type);
                }
                ?>
				 <ul class="more_option">
					  <li>
						  <a href="javascript:;" class="favourite_music" data-musicid="<?php echo esc_attr($mst_music_option); ?>">
						     <p class="mira-more"> 
        						<span class="opt_icon">
        						  <span class="icon <?php echo esc_attr($fav_class); ?>">
        							<svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 22 22"><g id="_08-5" data-name=" 08-5"><path id="_08-6" data-name=" 08-6" class="cls-1" d="M13.7,4.49a4.34,4.34,0,0,0-2,.48,3.83,3.83,0,0,0-.73.48A3.54,3.54,0,0,0,10.27,5,4.3,4.3,0,0,0,4,8.83a7.6,7.6,0,0,0,2.46,5.05,22.38,22.38,0,0,0,4,3.29l.51.34.52-.34a23.09,23.09,0,0,0,4-3.29A7.63,7.63,0,0,0,18,8.83,4.34,4.34,0,0,0,13.7,4.49ZM8.31,6.36a2.42,2.42,0,0,1,1.94,1l.75,1,.76-1a2.39,2.39,0,0,1,1.94-1,2.45,2.45,0,0,1,2.43,2.47,5.89,5.89,0,0,1-1.95,3.78A20.15,20.15,0,0,1,11,15.26a20.07,20.07,0,0,1-3.17-2.65A5.89,5.89,0,0,1,5.88,8.83,2.45,2.45,0,0,1,8.31,6.36Z"/></g></svg>
        						  </span>
        						</span>
        						<span>
        						  <?php esc_html_e('Favourites', 'miraculous'); ?>
        						</span>
        					 </p>
						  </a>
					  </li>
					  <li>
						  <a href="javascript:;" class="add_to_queue" data-musicid="<?php esc_html_e($mst_music_option); ?>" data-musictype="<?php printf($list_type); ?>">
						    <p class="mira-more"> 
    						  <span class="opt_icon">
    						    <span class="icon icon_queue">
    								<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
    								<path fill-rule="evenodd" d="M11.359,5.172 L6.847,5.172 L6.847,0.660 C6.847,0.455 6.568,0.009 6.010,0.009 C5.452,0.009 5.172,0.455 5.172,0.660 L5.172,5.172 L0.661,5.172 C0.455,5.172 0.010,5.451 0.010,6.009 C0.010,6.567 0.455,6.846 0.661,6.846 L5.173,6.846 L5.173,11.358 C5.173,11.563 5.452,12.009 6.010,12.009 C6.568,12.009 6.847,11.563 6.847,11.358 L6.847,6.846 L11.359,6.846 C11.564,6.846 12.010,6.567 12.010,6.009 C12.010,5.451 11.564,5.172 11.359,5.172 Z"/>
    								</svg>
    							</span>
    						  </span>
    						  <span>
    						    <?php esc_html_e('Add To Queue', 'miraculous'); ?>
    						  </span>
						    </p>
						  </a>
					  </li>
					  <li>
						 <a href="javascript:;" class="ms_download" data-msmusic="<?php echo esc_attr($mst_music_option); ?>">
						    <p class="mira-more">  
    						  <span class="opt_icon">
        						  <span class="icon icon_dwn">
        							<svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 22 22"><g id="_06-4" data-name=" 06-4"><path id="_06-5" data-name=" 06-5" class="cls-1" d="M10.65,13.85a.48.48,0,0,0,.7,0l3.27-3.5a.41.41,0,0,0,.07-.47.48.48,0,0,0-.42-.26H12.4V4.94a.46.46,0,0,0-.47-.44H10.07a.46.46,0,0,0-.47.44V9.63H7.73a.44.44,0,0,0-.42.25.41.41,0,0,0,.07.47Zm5.48-.73v2.63H5.87V13.12H4v3.5a.9.9,0,0,0,.93.88H17.07a.9.9,0,0,0,.93-.88v-3.5Z"/></g></svg>
        						  </span>
    						  </span>
    						  <span>
    						    <?php esc_html_e('Download Now', 'miraculous'); ?>
    						  </span>
    						</p>
						 </a>
					  </li>
					  <li>
						  <a href="javascript:;" class="ms_add_playlist" data-msmusic="<?php echo esc_attr($mst_music_option); ?>">
						    <p class="mira-more">
    						  <span class="opt_icon">
    							<span class="icon icon_playlst">
    								<svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 22 22"><g id="_03-2" data-name=" 03-2"><path id="_03-3" data-name=" 03-3" class="cls-1" d="M13,5.5H3.5V7.07H13V5.5Zm0,3.14H3.5v1.57H13V8.64ZM3.5,13.36H9.82V11.79H3.5ZM14.55,5.5v6.43a2.35,2.35,0,1,0,1.58,2.21V7.07H18.5V5.5Z"/></g></svg>
    							</span>
    						  </span>
    						  <span>
    						    <?php esc_html_e('Add To Playlist', 'miraculous'); ?>
    						  </span>
    						</p>
						  </a>
					   </li>
					   <li>
						   <a href="javascript:;" class="ms_share_music" data-shareuri="<?php esc_attr_e(get_the_permalink($mst_music_option)); ?>" data-sharename="<?php the_title_attribute($mst_music_option); ?>">
    						 <p class="mira-more">  
    						   <span class="opt_icon">
    							<span class="icon icon_share">
    							  <svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 22 22"><g id="_14-2" data-name=" 14-2"><path id="_13" data-name=" 13" class="cls-1" d="M8.68,13.18A2.78,2.78,0,0,1,4.77,13l-.07-.08a3,3,0,0,1,0-3.85,2.77,2.77,0,0,1,3.89-.36.52.52,0,0,1,.11.1l3-2.11.09-.06a1.09,1.09,0,0,0,.63-1.08A2.76,2.76,0,0,1,15.05,3,2.84,2.84,0,0,1,17.9,5.22a3,3,0,0,1-1.36,3.22,2.72,2.72,0,0,1-3.34-.5l-.27-.3C11.81,8.41,10.7,9.18,9.6,10a.37.37,0,0,0-.09.28q0,.75,0,1.5a.51.51,0,0,0,.13.34c1.08.77,2.18,1.52,3.3,2.3a2.89,2.89,0,0,1,1.76-1.15A2.83,2.83,0,0,1,18,15.56h0A2.92,2.92,0,0,1,15.72,19a2.82,2.82,0,0,1-3.28-2.28,3.33,3.33,0,0,1,0-.63.55.55,0,0,0-.16-.38ZM6.82,9.55a1.45,1.45,0,0,0,0,2.9,1.45,1.45,0,0,0,0-2.9ZM15.2,7.36a1.43,1.43,0,0,0,1.39-1.45h0A1.4,1.4,0,1,0,15.2,7.36Zm0,7.29a1.42,1.42,0,0,0-1.4,1.43h0a1.4,1.4,0,0,0,1.44,1.36,1.4,1.4,0,0,0,0-2.8Z"/></g></svg>
    							</span>
    						   </span>
    						   <span>
    						      <?php esc_html_e('Share', 'miraculous'); ?>
    						   </span>
    						 </p>
						   </a>
					  </li>
                    </ul>
                   </li>
               </ul>
             <?php 
              $i++; 
              endforeach; 
              endif;
             ?> 
          </div>
	  </div>
  <?php }

}

/**
 *Miraculous Artists
 */
public function miraculous_artists() {
  $play_all = get_template_directory_uri().'/assets/images/svg/play_all.svg';
  $pause_all = get_template_directory_uri().'/assets/images/svg/pause_all.svg';
  $add_to_queue = get_template_directory_uri().'/assets/images/svg/add_q.svg';
  $more_img = get_template_directory_uri().'/assets/images/svg/more.svg';
  $user_id = get_current_user_id();
  $miraculous_theme_data = '';
    if (function_exists('fw_get_db_settings_option')):  
        $miraculous_theme_data = fw_get_db_settings_option();     
    endif; 
    if(!empty($miraculous_theme_data['miraculous_layout']) && $miraculous_theme_data['miraculous_layout'] == '2'):
        $more_img = get_template_directory_uri().'/assets/images/svg/more1.svg';
    endif;
  $currency = '';
    if(!empty($miraculous_theme_data['currency']) && function_exists('miraculous_currency_symbol')):
        $currency = miraculous_currency_symbol( $miraculous_theme_data['currency'] );
    endif;
  $musictype = 'artist';
  $list_type = 'music';
  $ms_artist_post_meta_option = '';
	if( function_exists('fw_get_db_post_option') ):
	   $ms_artist_post_meta_option = fw_get_db_post_option();
	endif;
  ?>
	<div class="album_single_data">
    <div class="album_single_img">
    	<?php $image_uri = get_the_post_thumbnail_url ( get_the_id() ); ?>
        <img src="<?php echo esc_url( $image_uri ); ?>" alt="" class="img-fluid">
    </div>
    <div class="album_single_text">
        <?php 
        if(is_singular()){
          the_title( '<h2>', '</h2>' );
          if(function_exists('miraculous_artist_view_set')):
        	 miraculous_artist_view_set(get_the_id());
	      endif;
        }else{
          the_title( '<a href="'. esc_url( get_permalink() ) .'" class="album_single_title">', '</a>' );
        }
        ?>
        <?php if(!empty($ms_artist_post_meta_option['artist_born_place'])): ?>
            <p class="singer_name">
			 <?php printf( __('Singer, %s', 'miraculous'), $ms_artist_post_meta_option['artist_born_place'] ) ?>
			</p>
        <?php endif; ?>
        <div class="about_artist truncate">
            <?php the_content(); ?>
        </div>
        <div class="album_btn">
             <a href="javascript:;" class="ms_btn play_btn play_music" data-musicid="<?php esc_html_e(get_the_id()); ?>" data-musictype="<?php printf($musictype); ?>">
			 <span class="play_all">
			  <img src="<?php echo esc_url($play_all); ?>" alt="<?php echo esc_attr('Play all', 'miraculous'); ?>">
			  <?php echo esc_html_e('Play All', 'miraculous'); ?>
			 </span>
			 <span class="pause_all">
			  <img src="<?php echo esc_url($pause_all); ?>" alt="<?php echo esc_attr('Pause all', 'miraculous'); ?>"><?php echo esc_html_e('Pause', 'miraculous'); ?>
			 </span>
			</a>
            <a href="javascript:;" class="ms_btn add_to_queue" data-musicid="<?php esc_html_e(get_the_id()); ?>" data-musictype="<?php printf($musictype); ?>">
			  <span class="play_all">
			    <img src="<?php echo esc_url($add_to_queue); ?>" alt="<?php echo esc_attr('Add To Queue', 'miraculous'); ?>">
			    <?php echo esc_html_e('Add To Queue', 'miraculous'); ?>
			  </span>
			</a>
        </div>
    </div>
    <div class="album_more_optn ms_more_icon">
        <span>
		<img src="<?php echo esc_url($more_img); ?>" alt="<?php echo esc_attr('More', 'miraculous'); ?>">
		</span>
    </div>
    <?php
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
			 <?php  esc_html_e('Favourites', 'miraculous'); ?>
			</a>
		</li>
        <li>
		  <a href="javascript:;" class="add_to_queue" data-musicid="<?php esc_html_e(get_the_id()); ?>" data-musictype="<?php printf($musictype); ?>">
			<span class="opt_icon">
			<span class="icon icon_queue">
				<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
													<path fill-rule="evenodd" d="M11.359,5.172 L6.847,5.172 L6.847,0.660 C6.847,0.455 6.568,0.009 6.010,0.009 C5.452,0.009 5.172,0.455 5.172,0.660 L5.172,5.172 L0.661,5.172 C0.455,5.172 0.010,5.451 0.010,6.009 C0.010,6.567 0.455,6.846 0.661,6.846 L5.173,6.846 L5.173,11.358 C5.173,11.563 5.452,12.009 6.010,12.009 C6.568,12.009 6.847,11.563 6.847,11.358 L6.847,6.846 L11.359,6.846 C11.564,6.846 12.010,6.567 12.010,6.009 C12.010,5.451 11.564,5.172 11.359,5.172 Z"/>
													</svg>
			</span></span>
			<?php  esc_html_e('Add To Queue', 'miraculous'); ?>
		  </a>
		</li>
        <li>
		  <a href="javascript:;" class="ms_share_music" data-shareuri="<?php esc_attr_e(get_the_permalink()); ?>" data-sharename="<?php esc_attr_e(get_the_title()); ?>">
		  <span class="opt_icon">
		    <span class="icon icon_share">
				<svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 22 22"><g id="_14-2" data-name=" 14-2"><path id="_13" data-name=" 13" class="cls-1" d="M8.68,13.18A2.78,2.78,0,0,1,4.77,13l-.07-.08a3,3,0,0,1,0-3.85,2.77,2.77,0,0,1,3.89-.36.52.52,0,0,1,.11.1l3-2.11.09-.06a1.09,1.09,0,0,0,.63-1.08A2.76,2.76,0,0,1,15.05,3,2.84,2.84,0,0,1,17.9,5.22a3,3,0,0,1-1.36,3.22,2.72,2.72,0,0,1-3.34-.5l-.27-.3C11.81,8.41,10.7,9.18,9.6,10a.37.37,0,0,0-.09.28q0,.75,0,1.5a.51.51,0,0,0,.13.34c1.08.77,2.18,1.52,3.3,2.3a2.89,2.89,0,0,1,1.76-1.15A2.83,2.83,0,0,1,18,15.56h0A2.92,2.92,0,0,1,15.72,19a2.82,2.82,0,0,1-3.28-2.28,3.33,3.33,0,0,1,0-.63.55.55,0,0,0-.16-.38ZM6.82,9.55a1.45,1.45,0,0,0,0,2.9,1.45,1.45,0,0,0,0-2.9ZM15.2,7.36a1.43,1.43,0,0,0,1.39-1.45h0A1.4,1.4,0,1,0,15.2,7.36Zm0,7.29a1.42,1.42,0,0,0-1.4,1.43h0a1.4,1.4,0,0,0,1.44,1.36,1.4,1.4,0,0,0,0-2.8Z"/></g></svg>
			</span>
		  </span>
		 <?php  esc_html_e('Share', 'miraculous'); ?>
		 </a>
	   </li>
    </ul>
</div>
<?php 
if(is_singular()){ ?>
    <div class="album_inner_list">
        <div class="album_list_wrapper">
            <ul class="album_list_name">
                <li><?php  esc_html_e('#', 'miraculous'); ?></li>
                <li><?php  esc_html_e('Song Title', 'miraculous'); ?></li>
                <li><?php  esc_html_e('Artist', 'miraculous'); ?></li>
                <li class="text-center"><?php  esc_html_e('Duration', 'miraculous'); ?></li>
                <li class="text-center"><?php  esc_html_e('Price', 'miraculous'); ?></li>
                <li class="text-center"><?php  esc_html_e('More', 'miraculous'); ?></li>
            </ul>
        <?php
        $m_args = array('post_type' => 'ms-music', 
                        'numberposts' => -1);
        $artists = get_the_id();
        $music_posts = get_posts($m_args);
        $art = false;
        $i = 1;
        foreach ($music_posts as $music_post) {
          $artists_ids = get_post_meta($music_post->ID, 'fw_option:music_artists', true);
          if( $artists_ids && in_array($artists, $artists_ids) ): $art = true;
                $attach_meta = array();

                $mpurl = get_post_meta($music_post->ID, 'fw_option:mp3_full_songs', true);
                if($mpurl) {
                    $attach_meta = wp_get_attachment_metadata( $mpurl['attachment_id'] );
                }
                   $image_uri = get_the_post_thumbnail_url ( $music_post->ID );
                   $music_price = '';
                if(function_exists('fw_get_db_post_option')){
                    $music_price_arr = fw_get_db_post_option($music_post->ID, 'single_music_prices');
                    if( !empty( $music_price_arr ) ){
                        $music_price = $music_price_arr;
                    }
                }
            ?>
             <ul class="ms_list_songs">
                <li>
				 <a href="javascript:;">
					 <span class="play_no">
					 <?php echo ($i > 9) ? esc_html($i) : '0'.$i; ?></span>
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
				  <a href="javascript:;" data-musicid="<?php echo esc_attr($music_post->ID); ?>" class="play_single_music">
				  <?php echo esc_html( $music_post->post_title ); ?>
				  </a>
				</li>
                <?php $artists_name = array(); foreach ($artists_ids as $artists_id) {
                        $artists_name[] = get_the_title($artists_id);
                     } ?>
                <li>
				  <a href="javascript:;" class="play_single_music">
                  <?php echo implode(', ', $artists_name); ?>
				  </a>
			   </li>
               <li class="text-center">
                  <a href="javascript:;">
			        <?php $music_extranal_url = get_post_meta($music_post->ID, 'fw_option:music_extranal_url', true);
			            if(!empty($music_extranal_url)){ ?>
			                <audio id="audio-element" controls style="display: none;">
                                <source src="<?php echo $music_extranal_url; ?>" type="audio/mpeg">
                            </audio>
                            <p id="ml"></p>
			           <?php } else {
			             echo (isset($attach_meta['length_formatted'])) ? $attach_meta['length_formatted'] : "0.25"; 
			           }
			        ?>
              </a>
               </li>
               <?php if(empty($music_price)): ?>
                    <li class="text-center"><a href="javascript:;"><?php esc_html_e('Free', 'miraculous'); ?></a></li>
               <?php else: ?>
                    <li class="text-center"><a href="javascript:;"><?php printf( __('%s%s', 'miraculous'), $currency, $music_price ); ?></a></li>
                <?php endif; ?>
                <li class="text-center ms_more_icon">
                <a href="javascript:;">
                 <span class="ms_icon1 ms_active_icon">
                     <span class="ms_icon1 ms_active_icon"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="15px" height="4px">
                        <path fill-rule="evenodd" d="M13.000,3.999 C11.897,3.999 11.000,3.102 11.000,1.999 C11.000,0.897 11.897,-0.001 13.000,-0.001 C14.103,-0.001 15.000,0.897 15.000,1.999 C15.000,3.102 14.103,3.999 13.000,3.999 ZM7.500,3.999 C6.397,3.999 5.500,3.102 5.500,1.999 C5.500,0.897 6.397,-0.001 7.500,-0.001 C8.603,-0.001 9.500,0.897 9.500,1.999 C9.500,3.102 8.603,3.999 7.500,3.999 ZM2.000,3.999 C0.897,3.999 -0.000,3.102 -0.000,1.999 C-0.000,0.897 0.897,-0.001 2.000,-0.001 C3.103,-0.001 4.000,0.897 4.000,1.999 C4.000,3.102 3.103,3.999 2.000,3.999 Z"/>
                        </svg>
                     </span>
                 </span></a>
                 <?php
                  $fav_class = 'icon_fav';
                  if(function_exists('miraculous_get_favourite_div_class')){
                    $fav_class = miraculous_get_favourite_div_class($music_post->ID, $list_type);
                  }
                  ?>
                  <ul class="more_option">
                    <li>
					  <a href="javascript:;" class="favourite_music" data-musicid="<?php echo esc_attr($music_post->ID); ?>">
					    <p class="mira-more">  
    					   <span class="opt_icon">
        					   <span class="icon <?php echo esc_attr($fav_class); ?>">
        						<svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 22 22"><g id="_08-5" data-name=" 08-5"><path id="_08-6" data-name=" 08-6" class="cls-1" d="M13.7,4.49a4.34,4.34,0,0,0-2,.48,3.83,3.83,0,0,0-.73.48A3.54,3.54,0,0,0,10.27,5,4.3,4.3,0,0,0,4,8.83a7.6,7.6,0,0,0,2.46,5.05,22.38,22.38,0,0,0,4,3.29l.51.34.52-.34a23.09,23.09,0,0,0,4-3.29A7.63,7.63,0,0,0,18,8.83,4.34,4.34,0,0,0,13.7,4.49ZM8.31,6.36a2.42,2.42,0,0,1,1.94,1l.75,1,.76-1a2.39,2.39,0,0,1,1.94-1,2.45,2.45,0,0,1,2.43,2.47,5.89,5.89,0,0,1-1.95,3.78A20.15,20.15,0,0,1,11,15.26a20.07,20.07,0,0,1-3.17-2.65A5.89,5.89,0,0,1,5.88,8.83,2.45,2.45,0,0,1,8.31,6.36Z"/></g></svg>
        					   </span>
    					    </span>
    					    <span>
					            <?php  esc_html_e('Favourites', 'miraculous'); ?>
					        </span>
					     </p>
					  </a>
                    </li>
                    <li>
					  <a href="javascript:;" class="add_to_queue" data-musicid="<?php esc_html_e($music_post->ID); ?>" data-musictype="<?php printf($list_type); ?>">
					     <p class="mira-more">  
        					  <span class="opt_icon">
        					     <span class="icon icon_queue">
            						<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
        								<path fill-rule="evenodd" d="M11.359,5.172 L6.847,5.172 L6.847,0.660 C6.847,0.455 6.568,0.009 6.010,0.009 C5.452,0.009 5.172,0.455 5.172,0.660 L5.172,5.172 L0.661,5.172 C0.455,5.172 0.010,5.451 0.010,6.009 C0.010,6.567 0.455,6.846 0.661,6.846 L5.173,6.846 L5.173,11.358 C5.173,11.563 5.452,12.009 6.010,12.009 C6.568,12.009 6.847,11.563 6.847,11.358 L6.847,6.846 L11.359,6.846 C11.564,6.846 12.010,6.567 12.010,6.009 C12.010,5.451 11.564,5.172 11.359,5.172 Z"/>
        							</svg>
        					     </span>
        					  </span>
        					  <span>
        					    <?php  esc_html_e('Add To Queue', 'miraculous'); ?>
        					  </span>
        				  </p>
					  </a>
                    </li>
                  <li>
                    <a href="javascript:;" class="ms_download" data-msmusic="<?php echo esc_attr($music_post->ID); ?>">
                       <p class="mira-more">  
    					  <span class="opt_icon">
    					    <span class="icon icon_dwn">
    						  <svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 22 22"><g id="_06-4" data-name=" 06-4"><path id="_06-5" data-name=" 06-5" class="cls-1" d="M10.65,13.85a.48.48,0,0,0,.7,0l3.27-3.5a.41.41,0,0,0,.07-.47.48.48,0,0,0-.42-.26H12.4V4.94a.46.46,0,0,0-.47-.44H10.07a.46.46,0,0,0-.47.44V9.63H7.73a.44.44,0,0,0-.42.25.41.41,0,0,0,.07.47Zm5.48-.73v2.63H5.87V13.12H4v3.5a.9.9,0,0,0,.93.88H17.07a.9.9,0,0,0,.93-.88v-3.5Z"/></g></svg>
    					    </span>
    					  </span>
    					  <span>
                              <?php  esc_html_e('Download Now', 'miraculous'); ?>
                          </span>
                        </p>
				    </a>
				   </li>
                   <li>
					  <a href="javascript:;" class="ms_add_playlist" data-msmusic="<?php echo esc_attr($music_post->ID); ?>">
					      <p class="mira-more">  
        					 <span class="opt_icon">
        						<span class="icon icon_playlst">
        							<svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 22 22"><g id="_03-2" data-name=" 03-2"><path id="_03-3" data-name=" 03-3" class="cls-1" d="M13,5.5H3.5V7.07H13V5.5Zm0,3.14H3.5v1.57H13V8.64ZM3.5,13.36H9.82V11.79H3.5ZM14.55,5.5v6.43a2.35,2.35,0,1,0,1.58,2.21V7.07H18.5V5.5Z"/></g></svg>
        						</span>
        					 </span>
        					 <span>
        						<?php  esc_html_e('Add To Playlist', 'miraculous'); ?>
        					 </span>
    					  </p>
					  </a>
                    </li>
                    <li>
					  <a href="javascript:;" class="ms_share_music" data-shareuri="<?php esc_attr_e(get_the_permalink($music_post->ID)); ?>" data-sharename="<?php esc_attr_e(get_the_title($music_post->ID)); ?>">
    					<p class="mira-more"> 
    					  <span class="opt_icon">
        					  <span class="icon icon_share">
        						<svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 22 22"><g id="_14-2" data-name=" 14-2"><path id="_13" data-name=" 13" class="cls-1" d="M8.68,13.18A2.78,2.78,0,0,1,4.77,13l-.07-.08a3,3,0,0,1,0-3.85,2.77,2.77,0,0,1,3.89-.36.52.52,0,0,1,.11.1l3-2.11.09-.06a1.09,1.09,0,0,0,.63-1.08A2.76,2.76,0,0,1,15.05,3,2.84,2.84,0,0,1,17.9,5.22a3,3,0,0,1-1.36,3.22,2.72,2.72,0,0,1-3.34-.5l-.27-.3C11.81,8.41,10.7,9.18,9.6,10a.37.37,0,0,0-.09.28q0,.75,0,1.5a.51.51,0,0,0,.13.34c1.08.77,2.18,1.52,3.3,2.3a2.89,2.89,0,0,1,1.76-1.15A2.83,2.83,0,0,1,18,15.56h0A2.92,2.92,0,0,1,15.72,19a2.82,2.82,0,0,1-3.28-2.28,3.33,3.33,0,0,1,0-.63.55.55,0,0,0-.16-.38ZM6.82,9.55a1.45,1.45,0,0,0,0,2.9,1.45,1.45,0,0,0,0-2.9ZM15.2,7.36a1.43,1.43,0,0,0,1.39-1.45h0A1.4,1.4,0,1,0,15.2,7.36Zm0,7.29a1.42,1.42,0,0,0-1.4,1.43h0a1.4,1.4,0,0,0,1.44,1.36,1.4,1.4,0,0,0,0-2.8Z"/></g></svg>
        					  </span>
    					  </span>
    					  <span>
    					    <?php  esc_html_e('Share', 'miraculous'); ?>
    					  </span>
    					</p>
					  </a>
                    </li>
                  </ul>
                </li>
            </ul>
            <?php 
			  $i++; 
              endif;
            } ?>
        </div>
	 </div>
    <?php }
}

/**
 *Miraculous Music
 */
public function miraculous_music() {

    $miraculous_theme_data = '';
    if (function_exists('fw_get_db_settings_option')):  
        $miraculous_theme_data = fw_get_db_settings_option();     
    endif; 
    $currency = '';
    if(!empty($miraculous_theme_data['currency']) && function_exists('miraculous_currency_symbol')):
        $currency = miraculous_currency_symbol( $miraculous_theme_data['currency'] );
    endif;
	 
    $stripe_publishable_key = '';
    if(!empty($miraculous_theme_data['theme_stripe_switch']['on']['stripe_publishable_key'])):
        $stripe_publishable_key = $miraculous_theme_data['theme_stripe_switch']['on']['stripe_publishable_key'];
    endif;

    $stripe_secret_key = '';
    if(!empty($miraculous_theme_data['theme_stripe_switch']['on']['stripe_secret_key'])):
        $stripe_secret_key = $miraculous_theme_data['theme_stripe_switch']['on']['stripe_secret_key'];
    endif;

    $stripe_logo_image = '';
    if(!empty($miraculous_theme_data['theme_stripe_switch']['on']['stripe_logo_image']['url'])):
        $stripe_logo_image = $miraculous_theme_data['theme_stripe_switch']['on']['stripe_logo_image']['url'];
    endif;

    $stripe_store_name = '';
    if(!empty($miraculous_theme_data['theme_stripe_switch']['on']['stripe_store_name'])):
        $stripe_store_name = $miraculous_theme_data['theme_stripe_switch']['on']['stripe_store_name'];
    endif;
    $stripe_store_description = '';
    if(!empty($miraculous_theme_data['theme_stripe_switch']['on']['stripe_store_description'])):
        $stripe_store_description = $miraculous_theme_data['theme_stripe_switch']['on']['stripe_store_description'];
    endif;
    $stripe_submit_orders_url = plugins_url().'/miraculouscore/strippayment/music_orders.php';
    $stripe_submit_donations_url = plugins_url().'/miraculouscore/strippayment/donations.php';

    $current_user = wp_get_current_user();
    $play_all = get_template_directory_uri().'/assets/images/svg/play_all.svg';
    $pause_all = get_template_directory_uri().'/assets/images/svg/pause_all.svg';
    $add_to_queue = get_template_directory_uri().'/assets/images/svg/add_q.svg';
    $more_img = get_template_directory_uri().'/assets/images/svg/more.svg';
    $list_type = 'music';
    $ms_music_post_meta_option = '';
    if (function_exists('fw_get_db_post_option')): 
        $ms_music_post_meta_option = fw_get_db_post_option(get_the_id());   
    endif;
	 $miraculous_theme_data = '';
     if (function_exists('fw_get_db_settings_option')):  
        $miraculous_theme_data = fw_get_db_settings_option();     
     endif; 
	 if(!empty($miraculous_theme_data['miraculous_layout']) && $miraculous_theme_data['miraculous_layout'] == '2'):
        $more_img = get_template_directory_uri().'/assets/images/svg/more1.svg';
     endif;
	 $artists_name = array();
	 if(!empty($ms_music_post_meta_option['music_artists'])):
		foreach ($ms_music_post_meta_option['music_artists'] as $artists_id):
			$artists_name[] = get_the_title($artists_id);
		endforeach; 
	endif; 
	$attach_meta = array();
	$mpurl = get_post_meta(get_the_id(), 'fw_option:mp3_full_songs', true);
	if($mpurl) {
		$attach_meta = wp_get_attachment_metadata( $mpurl['attachment_id'] );
	}
	$image_uri = get_the_post_thumbnail_url ( get_the_id() );
	
		$theme_paypal_switch = '';
	if(!empty($miraculous_theme_data['theme_paypal_switch']['Paypal_switch_value'])):
		$theme_paypal_switch = $miraculous_theme_data['theme_paypal_switch']['Paypal_switch_value'];
	endif;
	$theme_stripe_switch = '';
	if(!empty($miraculous_theme_data['theme_stripe_switch']['stripe_switch_value'])):
		$theme_stripe_switch = $miraculous_theme_data['theme_stripe_switch']['stripe_switch_value'];
	endif;
	$theme_paystack_switch = '';
	if(!empty($miraculous_theme_data['theme_paystack_switch']['paystack_switch_value'])):
		$theme_paystack_switch = $miraculous_theme_data['theme_paystack_switch']['paystack_switch_value'];
	endif;
?>
<div class="album_single_data single-tack">
    <div class="album_single_img">
    	<?php $image_uri = get_the_post_thumbnail_url ( get_the_id() ); ?>
        <img src="<?php echo esc_url( $image_uri ); ?>" alt="<?php esc_attr_e('Song image', 'miraculous'); ?>" class="img-fluid">
    </div>
    <div class="album_single_text">
        <?php 
        if(is_singular()){ 
          the_title( '<h2>', '</h2>' );
          if(function_exists('miraculous_song_view_set')):
        	 miraculous_song_view_set(get_the_id());
	      endif;
        }else{
          the_title( '<a href="'. esc_url( get_permalink() ) .'" class="album_single_title">', '</a>' );
        }
        $product_price = get_post_meta(get_the_id(), 'fw_option:single_music_prices', true);
			

        if(function_exists('fw_get_db_post_option')): 
            $miraculous_post_data = fw_get_db_post_option(get_the_ID());   
        endif;
        $music_artists = '';
        if(!empty($miraculous_post_data['user_music_artist'])):
        $music_artists = $miraculous_post_data['user_music_artist'];
        else:
        $music_artists = get_post_meta(get_the_ID(),'fw_option:user_music_artist',true);
        endif;
        if(!empty($product_price)):
        ?>
        <p><?php echo esc_html__('Music Price: ','miraculous'); ?><span>
         <?php echo esc_html($currency).' '.esc_html($product_price); ?></span></p>
        <?php endif; 
        if(!empty($music_artists)):
        ?>
        <p class="singer_name"><?php printf( esc_html__('By - %s', 'miraculous'),  $music_artists); ?></p>
        <?php 
        endif;
        ?>
        <div class="about_artist truncate">
            <?php the_content(); ?>
        </div>
        <div class="album_btn">
            <a href="javascript:;" class="ms_btn play_btn play_music" data-musicid="<?php esc_html_e(get_the_id()); ?>" data-musictype="<?php printf($list_type); ?>">
			<span class="play_all">
			  <img src="<?php echo esc_url($play_all); ?>" alt="<?php  esc_attr_e('Play', 'miraculous'); ?>">
			  <?php  esc_html_e('Play', 'miraculous'); ?>
			</span>
			<span class="pause_all">
			  <img src="<?php echo esc_url($pause_all); ?>" alt="<?php esc_attr_e('Pause', 'miraculous'); ?>"><?php esc_html_e('Pause', 'miraculous'); ?>
			</span>
			</a>
            <a href="javascript:;" class="ms_btn add_to_queue" data-musicid="<?php esc_html_e(get_the_id()); ?>" data-musictype="<?php printf($list_type); ?>">
			<span class="play_all">
			  <img src="<?php echo esc_url($add_to_queue); ?>" alt="<?php echo esc_attr('Add To Queue', 'miraculous'); ?>">
			  <?php esc_html_e('Add To Queue', 'miraculous'); ?>
			</span>
			</a>
            <?php 
            $music_type = get_post_meta(get_the_id(), 'fw_option:music_types', true);
            $author_id = get_post_field ('post_author', get_the_id());
            if( !empty($current_user) && $current_user->ID ){
                
            $product_price = (int)get_post_meta(get_the_id(), 'fw_option:single_music_prices', true)*100;
        
            if($current_user->ID == $author_id):
            ?>
            <a href="<?php echo esc_url(home_url('/audio-update/')); ?>?track_id=<?php echo get_the_id() ?>" target ="_blank" class="ms_btn">
                <span class="album_edite"> 
                    <i class="fa fa-pencil-square-o"></i>
                    <?php esc_html_e('Edit', 'miraculous'); ?>
                </span>
            </a>
            <?php 
            else:
            if($music_type == 'premium'):
				if ( is_user_logged_in() ) {
					$userid = get_current_user_id();
					$key = 'premium_downloaded_songs_by_user_'.$userid;
					$music_id = get_user_meta($userid, $key, true);
					if(!empty($music_id)){
					  if (in_array(get_the_id(), $music_id)){ ?>
						<a href="javascript:;" class="ms_btn" data-post="track" order_id="<?php echo esc_attr(get_the_id()); ?>"><?php esc_html_e('Purchased', 'miraculous'); ?></a>
					    <?php }
    				    else{ ?>
						<a href="javascript:;" class="ms_btn bynow_btn ms-open-model" data-post="track" order_id="<?php echo esc_attr(get_the_id()); ?>"><?php esc_html_e('buy now', 'miraculous'); ?></a>
						<?php
    				   }
					}
                    else{ ?>
						<a href="javascript:;" class="ms_btn bynow_btn ms-open-model" data-post="track" order_id="<?php echo esc_attr(get_the_id()); ?>"><?php esc_html_e('buy now', 'miraculous'); ?></a>
						<?php
    				   }
				} else { ?>
				<a href="javascript:;" class="ms_btn bynow_btn" data-toggle="modal" data-target="#myModal" order_id="<?php echo esc_attr(get_the_id()); ?>"><?php esc_html_e('buy now', 'miraculous'); ?></a>
				 <?php }
             endif; 
            endif;
                ?>
             <?php }else{ ?>
              <a href="javascript:;" class="ms_btn" data-toggle="modal" data-target="#myModal1"><?php esc_html_e('buy now', 'miraculous'); ?></a>
             <?php } ?>

         </div>
    </div>
    <div class="album_more_optn ms_more_icon">
        <span>
		  <img src="<?php echo esc_url($more_img); ?>" alt="<?php esc_attr_e('More', 'miraculous'); ?>">
		</span>
    </div> 
    <?php
    $fav_class = 'icon_fav';
      if(function_exists('miraculous_get_favourite_div_class')){
        $fav_class = miraculous_get_favourite_div_class(get_the_id(), $list_type);
      }
    ?>
    <ul class="more_option">
          <li>
			<a href="javascript:;" class="favourite_music" data-musicid="<?php echo esc_attr(get_the_id()); ?>">
			<span class="opt_icon"><span class="icon <?php echo esc_attr($fav_class); ?>">
				<svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 22 22"><g id="_08-5" data-name=" 08-5"><path id="_08-6" data-name=" 08-6" class="cls-1" d="M13.7,4.49a4.34,4.34,0,0,0-2,.48,3.83,3.83,0,0,0-.73.48A3.54,3.54,0,0,0,10.27,5,4.3,4.3,0,0,0,4,8.83a7.6,7.6,0,0,0,2.46,5.05,22.38,22.38,0,0,0,4,3.29l.51.34.52-.34a23.09,23.09,0,0,0,4-3.29A7.63,7.63,0,0,0,18,8.83,4.34,4.34,0,0,0,13.7,4.49ZM8.31,6.36a2.42,2.42,0,0,1,1.94,1l.75,1,.76-1a2.39,2.39,0,0,1,1.94-1,2.45,2.45,0,0,1,2.43,2.47,5.89,5.89,0,0,1-1.95,3.78A20.15,20.15,0,0,1,11,15.26a20.07,20.07,0,0,1-3.17-2.65A5.89,5.89,0,0,1,5.88,8.83,2.45,2.45,0,0,1,8.31,6.36Z"/></g></svg>
			</span>
			</span><?php esc_html_e('Favourites', 'miraculous'); ?>
			</a>
		  </li>
          <li>
			<a href="javascript:;" class="add_to_queue" data-musicid="<?php esc_html_e(get_the_id()); ?>" data-musictype="<?php printf($list_type); ?>">
			<span class="opt_icon"><span class="icon icon_queue">
				<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
													<path fill-rule="evenodd" d="M11.359,5.172 L6.847,5.172 L6.847,0.660 C6.847,0.455 6.568,0.009 6.010,0.009 C5.452,0.009 5.172,0.455 5.172,0.660 L5.172,5.172 L0.661,5.172 C0.455,5.172 0.010,5.451 0.010,6.009 C0.010,6.567 0.455,6.846 0.661,6.846 L5.173,6.846 L5.173,11.358 C5.173,11.563 5.452,12.009 6.010,12.009 C6.568,12.009 6.847,11.563 6.847,11.358 L6.847,6.846 L11.359,6.846 C11.564,6.846 12.010,6.567 12.010,6.009 C12.010,5.451 11.564,5.172 11.359,5.172 Z"/>
													</svg>
			</span>
			 </span><?php  esc_html_e('Add To Queue', 'miraculous'); ?>
			</a>
		  </li>
          <li>
			<a href="javascript:;" class="ms_download" data-msmusic="<?php echo esc_attr(get_the_id()); ?>"><span class="opt_icon"><span class="icon icon_dwn">
				<svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 22 22"><g id="_06-4" data-name=" 06-4"><path id="_06-5" data-name=" 06-5" class="cls-1" d="M10.65,13.85a.48.48,0,0,0,.7,0l3.27-3.5a.41.41,0,0,0,.07-.47.48.48,0,0,0-.42-.26H12.4V4.94a.46.46,0,0,0-.47-.44H10.07a.46.46,0,0,0-.47.44V9.63H7.73a.44.44,0,0,0-.42.25.41.41,0,0,0,.07.47Zm5.48-.73v2.63H5.87V13.12H4v3.5a.9.9,0,0,0,.93.88H17.07a.9.9,0,0,0,.93-.88v-3.5Z"/></g></svg>
			</span></span>
			<?php esc_html_e('Download Now', 'miraculous'); ?>
			</a>
		  </li>
          <li>
			<a href="javascript:;" class="ms_add_playlist" data-msmusic="<?php echo esc_attr(get_the_id()); ?>"><span class="opt_icon">
			<span class="icon icon_playlst">
				<svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 22 22"><g id="_03-2" data-name=" 03-2"><path id="_03-3" data-name=" 03-3" class="cls-1" d="M13,5.5H3.5V7.07H13V5.5Zm0,3.14H3.5v1.57H13V8.64ZM3.5,13.36H9.82V11.79H3.5ZM14.55,5.5v6.43a2.35,2.35,0,1,0,1.58,2.21V7.07H18.5V5.5Z"/></g></svg>
			</span></span>
			<?php esc_html_e('Add To Playlist', 'miraculous'); ?></a>
		  </li>
          <li>
			 <a href="javascript:;" class="ms_share_music" data-shareuri="<?php esc_attr_e(get_the_permalink()); ?>" data-sharename="<?php the_title_attribute(); ?>">
			   <span class="opt_icon"><span class="icon icon_share">
					<svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 22 22"><g id="_14-2" data-name=" 14-2"><path id="_13" data-name=" 13" class="cls-1" d="M8.68,13.18A2.78,2.78,0,0,1,4.77,13l-.07-.08a3,3,0,0,1,0-3.85,2.77,2.77,0,0,1,3.89-.36.52.52,0,0,1,.11.1l3-2.11.09-.06a1.09,1.09,0,0,0,.63-1.08A2.76,2.76,0,0,1,15.05,3,2.84,2.84,0,0,1,17.9,5.22a3,3,0,0,1-1.36,3.22,2.72,2.72,0,0,1-3.34-.5l-.27-.3C11.81,8.41,10.7,9.18,9.6,10a.37.37,0,0,0-.09.28q0,.75,0,1.5a.51.51,0,0,0,.13.34c1.08.77,2.18,1.52,3.3,2.3a2.89,2.89,0,0,1,1.76-1.15A2.83,2.83,0,0,1,18,15.56h0A2.92,2.92,0,0,1,15.72,19a2.82,2.82,0,0,1-3.28-2.28,3.33,3.33,0,0,1,0-.63.55.55,0,0,0-.16-.38ZM6.82,9.55a1.45,1.45,0,0,0,0,2.9,1.45,1.45,0,0,0,0-2.9ZM15.2,7.36a1.43,1.43,0,0,0,1.39-1.45h0A1.4,1.4,0,1,0,15.2,7.36Zm0,7.29a1.42,1.42,0,0,0-1.4,1.43h0a1.4,1.4,0,0,0,1.44,1.36,1.4,1.4,0,0,0,0-2.8Z"/></g></svg>
			   </span></span>
			   <?php  esc_html_e('Share', 'miraculous'); ?>
			 </a>
		  </li>
     </ul>
</div>
<?php
}


/**
 *Miraculous Podcast 
 */
public function miraculous_podcast() {

    $miraculous_theme_data = '';
    if (function_exists('fw_get_db_settings_option')):  
        $miraculous_theme_data = fw_get_db_settings_option();     
    endif; 
    $currency = '';
    if(!empty($miraculous_theme_data['currency']) && function_exists('miraculous_currency_symbol')):
        $currency = miraculous_currency_symbol( $miraculous_theme_data['currency'] );
    endif;
    $stripe_publishable_key = '';
    if(!empty($miraculous_theme_data['theme_stripe_switch']['on']['stripe_publishable_key'])):
        $stripe_publishable_key = $miraculous_theme_data['theme_stripe_switch']['on']['stripe_publishable_key'];
    endif;

	$stripe_secret_key = '';
    if(!empty($miraculous_theme_data['theme_stripe_switch']['on']['stripe_secret_key'])):
        $stripe_secret_key = $miraculous_theme_data['theme_stripe_switch']['on']['stripe_secret_key'];
    endif;

	$stripe_logo_image = '';
    if(!empty($miraculous_theme_data['theme_stripe_switch']['on']['stripe_logo_image']['url'])):
        $stripe_logo_image = $miraculous_theme_data['theme_stripe_switch']['on']['stripe_logo_image']['url'];
    endif;

	$stripe_store_name = '';
    if(!empty($miraculous_theme_data['theme_stripe_switch']['on']['stripe_store_name'])):
        $stripe_store_name = $miraculous_theme_data['theme_stripe_switch']['on']['stripe_store_name'];
    endif;

	$stripe_store_description = '';
    if(!empty($miraculous_theme_data['theme_stripe_switch']['on']['stripe_store_description'])):
        $stripe_store_description = $miraculous_theme_data['theme_stripe_switch']['on']['stripe_store_description'];
    endif;

    $stripe_submit_orders_url = plugins_url().'/miraculouscore/strippayment/music_orders.php';
    $stripe_submit_donations_url = plugins_url().'/miraculouscore/strippayment/donations.php';
    
    $current_user = wp_get_current_user();
    $play_all = get_template_directory_uri().'/assets/images/svg/play_all.svg';
    $pause_all = get_template_directory_uri().'/assets/images/svg/pause_all.svg';
    $add_to_queue = get_template_directory_uri().'/assets/images/svg/add_q.svg';
    $more_img = get_template_directory_uri().'/assets/images/svg/more.svg';
    $musictype = 'album';
    $list_type = 'music';
    $user_id = get_current_user_id();
    $miraculous_theme_data = '';
    if (function_exists('fw_get_db_settings_option')):  
        $miraculous_theme_data = fw_get_db_settings_option();     
    endif; 
    if(!empty($miraculous_theme_data['miraculous_layout']) && $miraculous_theme_data['miraculous_layout'] == '2'):
        $more_img = get_template_directory_uri().'/assets/images/svg/more1.svg';
    endif;
  $currency = '';
    if(!empty($miraculous_theme_data['currency']) && function_exists('miraculous_currency_symbol')):
        $currency = miraculous_currency_symbol( $miraculous_theme_data['currency'] );
    endif;
	$ms_podcast_post_meta_option = '';
	if( function_exists('fw_get_db_post_option') ):
	$ms_podcast_post_meta_option = fw_get_db_post_option(get_the_ID());
    endif;
    if($ms_podcast_post_meta_option['podcast_artists']):
		foreach ($ms_podcast_post_meta_option['podcast_artists'] as $artists_id):
			$artists_name[] = get_the_title($artists_id);
		endforeach; 
	endif; 
	$theme_paypal_switch = '';
	if(!empty($miraculous_theme_data['theme_paypal_switch']['Paypal_switch_value'])):
		$theme_paypal_switch = $miraculous_theme_data['theme_paypal_switch']['Paypal_switch_value'];
	endif;
	$theme_stripe_switch = '';
	if(!empty($miraculous_theme_data['theme_stripe_switch']['stripe_switch_value'])):
		$theme_stripe_switch = $miraculous_theme_data['theme_stripe_switch']['stripe_switch_value'];
	endif;
	$theme_paystack_switch = '';
	if(!empty($miraculous_theme_data['theme_paystack_switch']['paystack_switch_value'])):
		$theme_paystack_switch = $miraculous_theme_data['theme_paystack_switch']['paystack_switch_value'];
	endif;
	$musictype = 'podcast';
  $list_type = 'music';
?>	 
<div class="album_single_data single_podcast">
    <div class="album_single_img">
    	<?php $image_uri = get_the_post_thumbnail_url ( get_the_id() ); ?>
        <img src="<?php echo esc_url( $image_uri ); ?>" alt="" class="img-fluid">
    </div>
    <div class="album_single_text">
        <?php 
        if(is_singular()){
          the_title( '<h2>', '</h2>' );
        }else{
          the_title( '<a href="'. esc_url( get_permalink() ) .'" class="album_single_title">', '</a>' );
        }
        if(function_exists('fw_get_db_post_option')): 
            $miraculous_post_data = fw_get_db_post_option(get_the_ID());   
        endif;

        $music_artists = '';
        if(!empty($miraculous_post_data['user_music_artist'])):
        $music_artists = $miraculous_post_data['user_music_artist'];
        else:
        $music_artists = get_post_meta(get_the_ID(),'fw_option:user_music_artist',true);
        endif;
        $product_price = '';
        if(!empty($miraculous_post_data['podcast_full_prices'])):
          $product_price = $miraculous_post_data['podcast_full_prices'];
        else:
          $product_price = get_post_meta(get_the_ID(),'fw_option:podcast_full_prices',true);
        endif;
        $podcast_type = get_post_meta(get_the_id(), 'fw_option:podcast_type', true);
        if($podcast_type == 'premium'):
        ?>
         <p><?php echo esc_html__('Podcast Price: ','miraculous'); ?><span>
         <?php echo esc_html($currency).' '.esc_html($product_price); ?></span></p>
        <?php 
        endif;
        ?>
        <!-- <p class="singer_name">
		<?php printf( __('By - %s', 'miraculous'), implode(', ', $artists_name) ) ?></p> -->

        <div class="album_feature">
            <a href="javascript:;" class="album_date">
			<?php echo __('Podcast', 'miraculous'). '|'. count($ms_podcast_post_meta_option['podcast_songs']); ?></a>
            <a href="javascript:;" class="album_date"><?php printf( __('Released %s  | %s', 'miraculous'), date('F jS, Y', strtotime($ms_podcast_post_meta_option['podcast_release_date'])), $ms_podcast_post_meta_option['podcast_company_name'] ) ?></a>
        </div>
        <div class="album_btn">
            <a href="javascript:;" class="ms_btn play_btn play_music" data-musicid="<?php esc_html_e(get_the_id()); ?>" data-musictype="<?php printf($musictype); ?>">
			<span class="play_all">
			  <img src="<?php echo esc_url($play_all); ?>" alt="<?php echo esc_attr('Play all', 'miraculous'); ?>">
			  <?php esc_html_e('Play All', 'miraculous');  ?>
			</span>
			<span class="pause_all">
			  <img src="<?php echo esc_url($pause_all); ?>" alt="<?php echo esc_attr('Pause', 'miraculous'); ?>"><?php esc_html_e('Pause', 'miraculous'); ?>
			</span>
			</a>
            <a href="javascript:;" class="ms_btn add_to_queue" data-musicid="<?php esc_html_e(get_the_id()); ?>" data-musictype="<?php printf($musictype); ?>">
			  <span class="play_all">
			    <img src="<?php echo esc_url($add_to_queue); ?>" alt="<?php echo esc_attr('Add to Queue', 'miraculous'); ?>">
			    <?php esc_html_e('Add To Queue', 'miraculous'); ?>
			  </span>
			</a>
            <?php 
            $author_id = get_post_field ('post_author', get_the_id());
            if( !empty($current_user->ID) && $current_user->ID ){

            $product_price = (int)get_post_meta(get_the_id(), 'fw_option:podcast_full_prices', true)*100;
                ?>
            <?php }else{ ?>
            <a href="javascript:;" class="ms_btn" data-toggle="modal" data-target="#myModal1"><?php esc_html_e('buy now', 'miraculous'); ?></a>
            <?php } ?>
         </div>
    </div>
    <div class="album_more_optn ms_more_icon"> 
         <span>
		   <img src="<?php echo esc_url($more_img); ?>" alt="<?php echo esc_attr('More', 'miraculous'); ?>">
		 </span>
    </div>
    <?php
    $fav_class = 'icon_fav';
      if(function_exists('miraculous_get_favourite_div_class')){
        $fav_class = miraculous_get_favourite_div_class(get_the_id(), $musictype);
      }
    ?>
    <ul class="more_option">
        <li>
			<a href="javascript:;" class="favourite_albums" data-podcastid="<?php echo esc_attr(get_the_id()); ?>"><span class="opt_icon"><span class="icon <?php echo esc_attr($fav_class); ?>">
				<svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 22 22"><g id="_08-5" data-name=" 08-5"><path id="_08-6" data-name=" 08-6" class="cls-1" d="M13.7,4.49a4.34,4.34,0,0,0-2,.48,3.83,3.83,0,0,0-.73.48A3.54,3.54,0,0,0,10.27,5,4.3,4.3,0,0,0,4,8.83a7.6,7.6,0,0,0,2.46,5.05,22.38,22.38,0,0,0,4,3.29l.51.34.52-.34a23.09,23.09,0,0,0,4-3.29A7.63,7.63,0,0,0,18,8.83,4.34,4.34,0,0,0,13.7,4.49ZM8.31,6.36a2.42,2.42,0,0,1,1.94,1l.75,1,.76-1a2.39,2.39,0,0,1,1.94-1,2.45,2.45,0,0,1,2.43,2.47,5.89,5.89,0,0,1-1.95,3.78A20.15,20.15,0,0,1,11,15.26a20.07,20.07,0,0,1-3.17-2.65A5.89,5.89,0,0,1,5.88,8.83,2.45,2.45,0,0,1,8.31,6.36Z"/></g></svg>
			</span></span><?php echo esc_html_e('Favourites', 'miraculous'); ?>
			</a>
		</li>
        <li>
		  <a href="javascript:;" class="add_to_queue" data-musicid="<?php esc_html_e(get_the_id()); ?>" data-musictype="<?php printf($musictype); ?>"><span class="opt_icon"><span class="icon icon_queue">
			<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
				<path fill-rule="evenodd" d="M11.359,5.172 L6.847,5.172 L6.847,0.660 C6.847,0.455 6.568,0.009 6.010,0.009 C5.452,0.009 5.172,0.455 5.172,0.660 L5.172,5.172 L0.661,5.172 C0.455,5.172 0.010,5.451 0.010,6.009 C0.010,6.567 0.455,6.846 0.661,6.846 L5.173,6.846 L5.173,11.358 C5.173,11.563 5.452,12.009 6.010,12.009 C6.568,12.009 6.847,11.563 6.847,11.358 L6.847,6.846 L11.359,6.846 C11.564,6.846 12.010,6.567 12.010,6.009 C12.010,5.451 11.564,5.172 11.359,5.172 Z"/>
			</svg>
		  </span></span><?php echo esc_html_e('Add To Queue', 'miraculous'); ?>
		  </a>
		</li> 
        <li>
		  <a href="javascript:;" class="ms_share_music" data-shareuri="<?php esc_attr_e(get_the_permalink()); ?>" data-sharename="<?php esc_attr_e(get_the_title()); ?>"><span class="opt_icon"><span class="icon icon_share">
			<svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 22 22"><g id="_14-2" data-name=" 14-2"><path id="_13" data-name=" 13" class="cls-1" d="M8.68,13.18A2.78,2.78,0,0,1,4.77,13l-.07-.08a3,3,0,0,1,0-3.85,2.77,2.77,0,0,1,3.89-.36.52.52,0,0,1,.11.1l3-2.11.09-.06a1.09,1.09,0,0,0,.63-1.08A2.76,2.76,0,0,1,15.05,3,2.84,2.84,0,0,1,17.9,5.22a3,3,0,0,1-1.36,3.22,2.72,2.72,0,0,1-3.34-.5l-.27-.3C11.81,8.41,10.7,9.18,9.6,10a.37.37,0,0,0-.09.28q0,.75,0,1.5a.51.51,0,0,0,.13.34c1.08.77,2.18,1.52,3.3,2.3a2.89,2.89,0,0,1,1.76-1.15A2.83,2.83,0,0,1,18,15.56h0A2.92,2.92,0,0,1,15.72,19a2.82,2.82,0,0,1-3.28-2.28,3.33,3.33,0,0,1,0-.63.55.55,0,0,0-.16-.38ZM6.82,9.55a1.45,1.45,0,0,0,0,2.9,1.45,1.45,0,0,0,0-2.9ZM15.2,7.36a1.43,1.43,0,0,0,1.39-1.45h0A1.4,1.4,0,1,0,15.2,7.36Zm0,7.29a1.42,1.42,0,0,0-1.4,1.43h0a1.4,1.4,0,0,0,1.44,1.36,1.4,1.4,0,0,0,0-2.8Z"/></g></svg>
		  </span></span><?php esc_html_e('Share', 'miraculous'); ?>
		  </a>
		</li>
    </ul>
</div>
<?php if( is_singular() ){ ?>
    <!-- Song List -->
    <div class="album_inner_list">
    <div class="album_list_wrapper">
            <ul class="album_list_name">
              <li><?php esc_html_e('#', 'miraculous'); ?></li>
              <li><?php esc_html_e('Podcast Title', 'miraculous'); ?></li>
              <!-- <li><?php esc_html_e('Artist', 'miraculous'); ?></li> -->
              <li class="text-center"><?php esc_html_e('Duration', 'miraculous'); ?></li>
              <li class="text-center"><?php esc_html_e('Price', 'miraculous'); ?></li>
              <li class="text-center"><?php esc_html_e('More', 'miraculous'); ?></li>
            </ul>
        <?php 
        if($ms_podcast_post_meta_option['podcast_songs'] ):  
        $i = 1;
        foreach($ms_podcast_post_meta_option['podcast_songs'] as $mst_music_option): 
            $attach_meta = array();
                $mpurl = get_post_meta($mst_music_option, 'fw_option:mp3_full_songs', true);
              if($mpurl) {
                $attach_meta = wp_get_attachment_metadata( $mpurl['attachment_id'] );
              }
            $image_uri = get_the_post_thumbnail_url ( $mst_music_option );

            $music_post_data = '';
            if(function_exists('fw_get_db_post_option')){
                 $music_post_data = fw_get_db_post_option($mst_music_option);
            }
            $music_price = '';
            if(!empty($music_post_data['single_music_prices'])):
               $music_price = $music_post_data['single_music_prices'];
            else:
               $music_price = get_post_meta($mst_music_option,'single_music_prices',true);
            endif;
            ?>
              <ul class="ms_list_songs">
              <li>
              <a href="javascript:;">
              <span class="play_no">
              <?php echo ($i > 9) ? esc_html($i) : '0'.$i; ?>
              </span><span class="play_hover equlizer">
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
                            </span></a>
              </li>

              <li>
              <a href="javascript:;" data-musicid="<?php echo esc_attr($mst_music_option); ?>" class="play_single_music">
               <?php echo get_the_title( $mst_music_option ); ?>
              </a>
              </li>
              <li class="text-center">
			  <a href="javascript:;">
			        <?php $music_extranal_url = get_post_meta($mst_music_option, 'fw_option:music_extranal_url', true);
			            if(!empty($music_extranal_url)){ ?>
			                <audio id="audio-element" controls style="display: none;">
                                <source src="<?php echo $music_extranal_url; ?>" type="audio/mpeg">
                            </audio>
                            <p id="ml"></p>
			           <?php } else {
			             echo (isset($attach_meta['length_formatted'])) ? $attach_meta['length_formatted'] : "0.25"; 
			           }
			        ?>
              </a>
              </li>
              <?php if(empty($music_price)): ?>
               <li class="text-center">
			     <a href="javascript:;"><?php esc_html_e('Free', 'miraculous'); ?></a>
			   </li>
               <?php else: ?>
               <li class="text-center">
				  <a href="javascript:;"><?php printf( __('%s%s', 'miraculous'), $currency, $music_price ); ?>
				  </a>
			   </li>
               <?php endif; ?>
               <li class="text-center ms_more_icon">
                 <a href="javascript:;">
                  <span class="ms_icon1 ms_active_icon">
                      <span class="ms_icon1 ms_active_icon"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="15px" height="4px">
                        <path fill-rule="evenodd" d="M13.000,3.999 C11.897,3.999 11.000,3.102 11.000,1.999 C11.000,0.897 11.897,-0.001 13.000,-0.001 C14.103,-0.001 15.000,0.897 15.000,1.999 C15.000,3.102 14.103,3.999 13.000,3.999 ZM7.500,3.999 C6.397,3.999 5.500,3.102 5.500,1.999 C5.500,0.897 6.397,-0.001 7.500,-0.001 C8.603,-0.001 9.500,0.897 9.500,1.999 C9.500,3.102 8.603,3.999 7.500,3.999 ZM2.000,3.999 C0.897,3.999 -0.000,3.102 -0.000,1.999 C-0.000,0.897 0.897,-0.001 2.000,-0.001 C3.103,-0.001 4.000,0.897 4.000,1.999 C4.000,3.102 3.103,3.999 2.000,3.999 Z"/>
                        </svg>
                      </span>
                  </span>
                 </a>
                <?php
                $fav_class = 'icon_fav';
                if(function_exists('miraculous_get_favourite_div_class')){
                  $fav_class = miraculous_get_favourite_div_class($mst_music_option, $list_type);
                }
                ?>
                 <ul class="more_option">
                    <li>
                     <?php 
                     $author_id = get_post_field('post_author', $mst_music_option);
                     if($current_user->ID == $author_id):
                     ?>
                     <a href="<?php echo esc_url(home_url('/audio-update/')); ?>?track_id=<?php echo $mst_music_option ?>" target ="_blank" class="bs_audio_edite">
                        <p class="mira-more"> 
                          <span class="album_edite"> 
                            <i class="fa fa-pencil-square-o"></i>
                            <span>
                            <?php esc_html_e('Edit', 'miraculous'); ?>
                            </span>
                          </span>
                        </p>
                      </a>
                     <?php else: ?> 
					  <?php 
                        if(!empty($music_price)){ ?>
                            <a href="<?php echo esc_url(get_the_permalink($mst_music_option)); ?>" class="ms_buy_download fdgf"> 
                              <p class="mira-more"> 
        					    <span class="opt_icon">
					                <span class="icon fa fa-shopping-cart"></span>
					            </span>
					            <span>
					                <?php esc_html_e('Buy Now', 'miraculous'); ?>
					            </span>
					          </p> 
					        </a>
                        <?php } 
                    ?>
                     <?php endif; ?>
                    </li>
                    <li>
					   <a href="javascript:;" class="favourite_music" data-musicid="<?php echo esc_attr($mst_music_option); ?>">
					     <p class="mira-more"> 
    					   <span class="opt_icon">
        					 <span class="icon <?php echo esc_attr($fav_class); ?>">
        						<svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 22 22"><g id="_08-5" data-name=" 08-5"><path id="_08-6" data-name=" 08-6" class="cls-1" d="M13.7,4.49a4.34,4.34,0,0,0-2,.48,3.83,3.83,0,0,0-.73.48A3.54,3.54,0,0,0,10.27,5,4.3,4.3,0,0,0,4,8.83a7.6,7.6,0,0,0,2.46,5.05,22.38,22.38,0,0,0,4,3.29l.51.34.52-.34a23.09,23.09,0,0,0,4-3.29A7.63,7.63,0,0,0,18,8.83,4.34,4.34,0,0,0,13.7,4.49ZM8.31,6.36a2.42,2.42,0,0,1,1.94,1l.75,1,.76-1a2.39,2.39,0,0,1,1.94-1,2.45,2.45,0,0,1,2.43,2.47,5.89,5.89,0,0,1-1.95,3.78A20.15,20.15,0,0,1,11,15.26a20.07,20.07,0,0,1-3.17-2.65A5.89,5.89,0,0,1,5.88,8.83,2.45,2.45,0,0,1,8.31,6.36Z"/></g></svg>
        					 </span>
    					   </span>
    					   <span>
    					     <?php esc_html_e('Favourites', 'miraculous'); ?>
    					   </span>
    					 </p>
					   </a>
                    </li>
                    <li>
					  <a href="javascript:;" class="add_to_queue" data-musicid="<?php esc_html_e($mst_music_option); ?>" data-musictype="<?php printf($list_type); ?>">
					    <p class="mira-more"> 
    					  <span class="opt_icon">
        					<span class="icon icon_queue">
        					  <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
    							<path fill-rule="evenodd" d="M11.359,5.172 L6.847,5.172 L6.847,0.660 C6.847,0.455 6.568,0.009 6.010,0.009 C5.452,0.009 5.172,0.455 5.172,0.660 L5.172,5.172 L0.661,5.172 C0.455,5.172 0.010,5.451 0.010,6.009 C0.010,6.567 0.455,6.846 0.661,6.846 L5.173,6.846 L5.173,11.358 C5.173,11.563 5.452,12.009 6.010,12.009 C6.568,12.009 6.847,11.563 6.847,11.358 L6.847,6.846 L11.359,6.846 C11.564,6.846 12.010,6.567 12.010,6.009 C12.010,5.451 11.564,5.172 11.359,5.172 Z"/>
    						  </svg>
        					</span>
    					  </span>
    					  <span>
    					    <?php esc_html_e('Add To Queue', 'miraculous'); ?>
    					  </span>
    					</p>
					  </a>
                   </li>
                   <li>
					  <a href="javascript:;" class="ms_download" data-podcastid="<?php echo esc_attr(get_the_ID()); ?>" data-msmusic="<?php echo esc_attr($mst_music_option); ?>"> 
					    <p class="mira-more"> 
    					  <span class="opt_icon">
    					    <span class="icon icon_dwn">
    							<svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 22 22"><g id="_06-4" data-name=" 06-4"><path id="_06-5" data-name=" 06-5" class="cls-1" d="M10.65,13.85a.48.48,0,0,0,.7,0l3.27-3.5a.41.41,0,0,0,.07-.47.48.48,0,0,0-.42-.26H12.4V4.94a.46.46,0,0,0-.47-.44H10.07a.46.46,0,0,0-.47.44V9.63H7.73a.44.44,0,0,0-.42.25.41.41,0,0,0,.07.47Zm5.48-.73v2.63H5.87V13.12H4v3.5a.9.9,0,0,0,.93.88H17.07a.9.9,0,0,0,.93-.88v-3.5Z"/></g></svg>
    						</span>
    					  </span>
    					  <span>
    					    <?php esc_html_e('Download Now', 'miraculous'); ?>
    					  </span>
    					</p>
					  </a>
                   </li>
                   <li>
					  <a href="javascript:;" class="ms_add_playlist" data-msmusic="<?php echo esc_attr($mst_music_option); ?>">
					    <p class="mira-more"> 
    					  <span class="opt_icon">
    						  <span class="icon icon_playlst">
    							<svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 22 22"><g id="_03-2" data-name=" 03-2"><path id="_03-3" data-name=" 03-3" class="cls-1" d="M13,5.5H3.5V7.07H13V5.5Zm0,3.14H3.5v1.57H13V8.64ZM3.5,13.36H9.82V11.79H3.5ZM14.55,5.5v6.43a2.35,2.35,0,1,0,1.58,2.21V7.07H18.5V5.5Z"/></g></svg>
    						  </span>
    					   </span>
    					   <span>
    					      <?php esc_html_e('Add To Playlist', 'miraculous'); ?>
    					   </span>
    					 </p> 
					  </a>
                    </li>
                    <li>
					  <a href="javascript:;" class="ms_share_music" data-shareuri="<?php esc_attr_e(get_the_permalink($mst_music_option)); ?>" data-sharename="<?php the_title_attribute($mst_music_option); ?>">
    					 <p class="mira-more"> 
    						<span class="opt_icon">
    						  <span class="icon icon_share">
    							<svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" data-name="Layer 1" viewBox="0 0 22 22"><g id="_14-2" data-name=" 14-2"><path id="_13" data-name=" 13" class="cls-1" d="M8.68,13.18A2.78,2.78,0,0,1,4.77,13l-.07-.08a3,3,0,0,1,0-3.85,2.77,2.77,0,0,1,3.89-.36.52.52,0,0,1,.11.1l3-2.11.09-.06a1.09,1.09,0,0,0,.63-1.08A2.76,2.76,0,0,1,15.05,3,2.84,2.84,0,0,1,17.9,5.22a3,3,0,0,1-1.36,3.22,2.72,2.72,0,0,1-3.34-.5l-.27-.3C11.81,8.41,10.7,9.18,9.6,10a.37.37,0,0,0-.09.28q0,.75,0,1.5a.51.51,0,0,0,.13.34c1.08.77,2.18,1.52,3.3,2.3a2.89,2.89,0,0,1,1.76-1.15A2.83,2.83,0,0,1,18,15.56h0A2.92,2.92,0,0,1,15.72,19a2.82,2.82,0,0,1-3.28-2.28,3.33,3.33,0,0,1,0-.63.55.55,0,0,0-.16-.38ZM6.82,9.55a1.45,1.45,0,0,0,0,2.9,1.45,1.45,0,0,0,0-2.9ZM15.2,7.36a1.43,1.43,0,0,0,1.39-1.45h0A1.4,1.4,0,1,0,15.2,7.36Zm0,7.29a1.42,1.42,0,0,0-1.4,1.43h0a1.4,1.4,0,0,0,1.44,1.36,1.4,1.4,0,0,0,0-2.8Z"/></g></svg>
    						  </span>
    						</span>
    						<span>
    						    <?php esc_html_e('Share', 'miraculous'); ?>
    						</span>
    					 </p>	
					  </a>
                    </li>
                   </ul>
                  </li>
               </ul>
             <?php 
              $i++; 
              endforeach; 
              endif;
             ?> 
          </div>
		</div>
  <?php }

}
  
}
/**
 * Miraculous Demo Content Important
 */
function  miraculous_filter_fw_ext_backups_demos($demos){
	$demos_array = array(
	    'darkversion' => array(
			'title' => esc_html__('Darkversion', 'miraculous'),
			'screenshot' => esc_url(get_template_directory_uri().'/screenshot.png'),
			'preview_link' => 'https://kamleshyadav.com/wp/miraculous/darkversion/',
		), 
		'lightversion' => array(
			'title' => esc_html__('Lightversion', 'miraculous'),
			'screenshot' => esc_url(get_template_directory_uri().'/assets/images/Light_screen.png'),
			'preview_link' => 'https://kamleshyadav.com/wp/miraculous/lightversion/',
		), 
		'miraverion3' => array( 
			'title' => esc_html__('Miraculous Verion3', 'miraculous'), 
			'screenshot' => esc_url(get_template_directory_uri().'/assets/images/miraculous-version3.jpg'),
			'preview_link' => 'https://kamleshyadav.com/wp/miraculous/miraculous-version3/',
		),
		'eldarkversion' => array(
			'title' => esc_html__('Elementor Darkversion', 'miraculous'),
			'screenshot' => esc_url(get_template_directory_uri().'/screenshot.png'),
			'preview_link' => 'https://kamleshyadav.com/wp/miraculous/darkversion/',
		), 
		'ellightversion' => array(
			'title' => esc_html__('Elementor Lightversion', 'miraculous'),
			'screenshot' => esc_url(get_template_directory_uri().'/assets/images/Light_screen.png'),
			'preview_link' => 'https://kamleshyadav.com/wp/miraculous/lightversion/',
		), 
		'elmiraverion3' => array( 
			'title' => esc_html__('Elementor Miraculous Verion3', 'miraculous'), 
			'screenshot' => esc_url(get_template_directory_uri().'/assets/images/miraculous-version3.jpg'),
			'preview_link' => 'https://kamleshyadav.com/wp/miraculous/miraculous-version3/',
		),
	);
    foreach ($demos_array as $id => $data) {
		$demo = new FW_Ext_Backups_Demo($id, 'piecemeal', array(
			'url' => 'https://kamleshyadav.com/wp/miraculous/themedemo/',
			'file_id' => $id,
		)); 
		$demo->set_title($data['title']);
		$demo->set_screenshot($data['screenshot']);
		$demo->set_preview_link($data['preview_link']);
        $demos[$demo->get_id()] = $demo;
        unset($demo);
	}
   return $demos;  
}
$dir = get_template_directory().'/demo-content';
if(!is_dir($dir)):
add_filter('fw:ext:backups-demo:demos','miraculous_filter_fw_ext_backups_demos');  
endif;

add_filter('wp_list_categories', 'miraculous_cat_count_span');
function miraculous_cat_count_span($links) {
  $links = str_replace('</a> (', '</a> <span class="ms_cat_count">(', $links);
  $links = str_replace(')', ')</span>', $links);
  return $links;
}
/**
 * Miraculous Add Classes
 */ 
function miraculous_addcustom_classes( $classes ) {
    $miraculous_theme_data = '';
    if (function_exists('fw_get_db_settings_option')):	
        $miraculous_theme_data = fw_get_db_settings_option();     
    endif; 
    $menuopen_switch_value = '';
    if(!empty($miraculous_theme_data['menuopen_switch_value'])):
      $menuopen_switch_value = $miraculous_theme_data['menuopen_switch_value'];
    endif;
    $menuopen_class = '';
    if($menuopen_switch_value == 'on'):
     $menuopen_class = esc_html__('ms_menuopen_style','miraculous');  
    else:
      $menuopen_class = '';    
    endif;
    $classes[] = (is_user_logged_in()) ? 'ms_logged_in '.$menuopen_class : 'ms_public_user  '.$menuopen_class;;
    return $classes;
}
add_filter('body_class','miraculous_addcustom_classes' );

/**
 * Delete plan Code
 
global $wpdb;
$tbl_pay = $wpdb->prefix. 'ms_payments';
$time = date('Y-m-d H:i:s');
$data = $wpdb->get_row("SELECT * FROM `$tbl_pay` WHERE expiretime < '$time'");
if(!empty($data)){
$wpdb->delete( $tbl_pay, array( 'id' => $data->id ) );
}
*/

/**
 *Custom Font Option
 */ 
function miraculous_font_style(){
$miraculous_theme_data = '';
if (function_exists('fw_get_db_settings_option')):	
	$miraculous_theme_data = fw_get_db_settings_option();     
endif;

$miraculous_font_on = '';
if(!empty($miraculous_theme_data['fonts_style']['color_fonts_value'])):
     $miraculous_font_on = $miraculous_theme_data['fonts_style']['color_fonts_value'];
endif;

$miraculous_font_size = '';
if(!empty($miraculous_theme_data['fonts_style']['on']['font_style_google']['size'])):
	$miraculous_font_size = $miraculous_theme_data['fonts_style']['on']['font_style_google']['size'];
endif;

$miraculous_family = '';
if(!empty($miraculous_theme_data['fonts_style']['on']['font_style_google']['family'])):
	$miraculous_family = $miraculous_theme_data['fonts_style']['on']['font_style_google']['family']; 
endif;

$miraculous_font_style = '';
if(!empty($miraculous_theme_data['fonts_style']['on']['font_style_google']['style'])):
	$miraculous_font_style = $miraculous_theme_data['fonts_style']['on']['font_style_google']['style'];
endif;

$miraculous_font_color = '';
if(!empty($miraculous_theme_data['fonts_style']['on']['font_style_google']['color'])):
	$miraculous_font_color = $miraculous_theme_data['fonts_style']['on']['font_style_google']['color'];
endif;
if($miraculous_font_on == 'on'){
?>
<style>
body { 
	font-family: '<?php echo esc_attr($miraculous_family); ?>', sans-serif;
	font-size: <?php echo esc_attr($miraculous_font_size); ?>px;
	font-weight: <?php echo esc_attr($miraculous_font_style); ?>;
	color: <?php echo esc_attr($miraculous_font_color); ?>;
} 
.ms_songslist_nav > li > a {
    color: <?php echo esc_attr($miraculous_font_color); ?>;
}
</style>
<?php
}
}

/**
 *Multi Color Option
 */ 
function miraculous_multi_color(){
    
$miraculous_theme_data = '';
if (function_exists('fw_get_db_settings_option')):	
	$miraculous_theme_data = fw_get_db_settings_option();     
endif;

$color_multi_switch_value = '';
if(!empty($miraculous_theme_data['theme_multi_color_switch']['color_switch_value'])):
	$color_multi_switch_value = $miraculous_theme_data['theme_multi_color_switch']['color_switch_value'];
endif;

$colormulticode = '';
if(!empty($miraculous_theme_data['theme_multi_color_switch']['on']['theme_multi_color'])):
     $colormulticode = $miraculous_theme_data['theme_multi_color_switch']['on']['theme_multi_color'];
endif;
if($color_multi_switch_value == 'on'):
?>
<style>
/*my earnings start*/

div#myearning_paginate .paginate_button {
    background-color: <?php echo esc_attr($colormulticode); ?>;
}
/*my earnings end*/
.style-two .ms_nav_wrapper ul li a:hover, .ms_nav_wrapper ul li.current_page_item a {
    color: <?php echo esc_attr($colormulticode); ?>;
}
h1,h2,h3,h4,h5,h6,.h1,.h2,.h3,.h4,.h5,.h6 {
	color: <?php echo esc_attr($colormulticode); ?>;
}
.popup_forgot a {
    color: <?php echo esc_attr($colormulticode); ?>;
}
.save_modal_btn a:hover {
    background-color: <?php echo esc_attr($colormulticode); ?>;
}
span.play_hover svg {
    fill: <?php echo esc_attr($colormulticode); ?>;
}
.ms_active_icon svg {
     fill: <?php echo esc_attr($colormulticode); ?>;
}
.save_modal_btn a {
    border-color: <?php echo esc_attr($colormulticode); ?>;
}
ul.more_option li a span svg path {
    fill: <?php echo esc_attr($colormulticode); ?>;
}
.ms_register_form a {
    color: <?php echo esc_attr($colormulticode); ?>!important;
}
a {
	color: <?php echo esc_attr($colormulticode); ?>;
}
.bs_audio_edite .opt_icon i, a.bs_audio_deletes .opt_icon i {
   color: <?php echo esc_attr($colormulticode); ?>;
}
.ms_songslist_nav > li > a.active {
   	color: <?php echo esc_attr($colormulticode); ?>;
}
ul.ms_common_dropdown li a span svg path {
    fill: <?php echo esc_attr($colormulticode); ?>;
}
.icon_fav_add svg path {
    fill: <?php echo esc_attr($colormulticode); ?>!important;
}
.create_playlist {
    background: <?php echo esc_attr($colormulticode); ?>;
}
input#login_btn, input#register_btn {
    border-color: <?php echo esc_attr($colormulticode); ?>;
    color: <?php echo esc_attr($colormulticode); ?>;
}
.ms_register_form h2 {
    color: <?php echo esc_attr($colormulticode); ?>;
}
.ms_register_form h2:after, .ms_lang_popup .modal-content h1:after {
    background: -webkit-radial-gradient(50% 50%, ellipse closest-side, <?php echo esc_attr($colormulticode); ?>, rgb(255 85 62 / 0%) 60%);
    background: -moz-radial-gradient(50% 50%, ellipse closest-side, <?php echo esc_attr($colormulticode); ?>, rgba(255, 42, 112, 0) 60%);
    background: -ms-radial-gradient(50% 50%, ellipse closest-side, <?php echo esc_attr($colormulticode); ?>, rgba(255, 42, 112, 0) 60%);
    background: -o-radial-gradient(50% 50%, ellipse closest-side, <?php echo esc_attr($colormulticode); ?>, rgba(255, 42, 112, 0) 60%);
}
form#upload_album_forms label {
    color: <?php echo esc_attr($colormulticode); ?>;
}
h4.cheading_title {
    color: <?php echo esc_attr($colormulticode); ?>;
}
.cheading_title:after {
    border-color: <?php echo esc_attr($colormulticode); ?>;
}
h2.music_listwrap_tttl {
    color: <?php echo esc_attr($colormulticode); ?>;
}
.ms_color {
	color: <?php echo esc_attr($colormulticode); ?>    !important;
}
.ms_songslist_inner:hover {
	background: <?php echo esc_attr($colormulticode); ?>;
}
.div-wrapper-style-two .noti_icon.notify_ad {
    background-color: <?php echo esc_attr($colormulticode); ?>;
}
::-webkit-scrollbar-thumb {
    background: <?php echo esc_attr($colormulticode); ?>;
}
span.play_hover svg g rect {
    fill: <?php echo esc_attr($colormulticode); ?>;
}
ul.ms_list_songs .icon_fav_add svg path


.form-control:focus {
	border: 1px solid <?php echo esc_attr($colormulticode); ?>   ;
}
.ms_nav_wrapper ul li a:hover:after,
.ms_nav_wrapper ul li a.active:after {
	background-color: <?php echo esc_attr($colormulticode); ?>   ;
}
.ms_basic_menu ul li a:after{
	background-color:<?php echo esc_attr($colormulticode); ?>   ;	
}
.search_icon {
	background-color: <?php echo esc_attr($colormulticode); ?>   ;
}
.ms_top_search .form-control {
	border: 1px solid <?php echo esc_attr($colormulticode); ?>   ;
}
.ms_top_right .ms_top_lang {
	color: <?php echo esc_attr($colormulticode); ?>   ;
}
.ms_top_right .ms_top_lang:hover {
	color: <?php echo esc_attr($colormulticode); ?>   ;
}
.register_dialog button.close i, .login_dialog button.close i {
    color: <?php echo esc_attr($colormulticode); ?> ;
}
ul.ms_lang_box {
	background-color: <?php echo esc_attr($colormulticode); ?>   ;
}
.veiw_all a:hover {
	color: <?php echo esc_attr($colormulticode); ?>   ;
}
.ms_heading h1:after {
	background: -webkit-radial-gradient(50% 50%, ellipse closest-side, <?php echo esc_attr($colormulticode); ?>   , rgba(255, 42, 112, 0) 60%);
	background: -moz-radial-gradient(50% 50%, ellipse closest-side, <?php echo esc_attr($colormulticode); ?>   , rgba(255, 42, 112, 0) 60%);
	background: -ms-radial-gradient(50% 50%, ellipse closest-side, <?php echo esc_attr($colormulticode); ?>   , rgba(255, 42, 112, 0) 60%);
	background: -o-radial-gradient(50% 50%, ellipse closest-side, <?php echo esc_attr($colormulticode); ?>   , rgba(255, 42, 112, 0) 60%);
}
.ms_rcnt_box_text h3 a:hover,
.w_top_song .w_tp_song_name h3 a:hover {
	color: <?php echo esc_attr($colormulticode); ?>   ;
}
.ms_box_overlay {
	background-image: -moz-linear-gradient( 90deg, rgb(22, 26, 46) 0%, rgb(52, 218, 200) 0%, <?php echo esc_attr($colormulticode); ?>    0%, rgba(32, 167, 196, 0) 100%);
	background-image: -webkit-linear-gradient( 90deg, rgb(22, 26, 46) 0%, rgb(52, 218, 200) 0%, <?php echo esc_attr($colormulticode); ?>    0%, rgba(32, 167, 196, 0) 100%);
	background-image: -ms-linear-gradient( 90deg, rgb(22, 26, 46) 0%, rgb(52, 218, 200) 0%, <?php echo esc_attr($colormulticode); ?>    0%, rgba(32, 167, 196, 0) 100%);
}
ul.more_option li a:hover,
.ms_rcnt_box:hover .ms_rcnt_box_text h3 a {
	color: <?php echo esc_attr($colormulticode); ?>   ;
}
.w_song_time {
	color: <?php echo esc_attr($colormulticode); ?>   ;
}
.ms_weekly_box:hover .w_tp_song_name h3 a,
.ms_weekly_box.ms_active_play .w_tp_song_name h3 a,
.ms_release_box:hover .w_tp_song_name h3 a,
.ms_release_box.ms_active_play .w_tp_song_name h3 a {
	color: <?php echo esc_attr($colormulticode); ?>   ;
}
.ms_weekly_box:hover .weekly_left span.w_top_no,
.ms_weekly_box.ms_active_play .weekly_left span.w_top_no {
	color: <?php echo esc_attr($colormulticode); ?>   ;
}
.ms_releases_wrapper .ms_divider {
	-moz-box-shadow: 0 0 10px rgba(0, 0, 0, 0.4);
	box-shadow: 0 0 0px rgba(22, 26, 45, 0.27);
	background: #dadada;
	background: #dadada;
	background-image: -webkit-linear-gradient(left, #dadada, #dadada, #ffffff);
	background-image: -moz-linear-gradient(left, #252b4d, #252b4d, #161a2d);
	background-image: -ms-linear-gradient(left, #252b4d, #252b4d, #161a2d);
	background-image: -o-linear-gradient(left, #252b4d, #252b4d, #161a2d);
}
.slider_dot {
	background-color: <?php echo esc_attr($colormulticode); ?>   ;
}
.swiper-slide.swiper-slide-active .slider_dot,
.ms_release_box:hover .slider_dot {
	box-shadow: 0px 0px 10px rgba(255, 72, 101, 0.91);
}
.ms_releases_wrapper .swiper-slide.swiper-slide-active .w_top_song .w_tp_song_name h3 a {
	color: <?php echo esc_attr($colormulticode); ?>   ;
}
.ms_genres_box .ms_box_overlay_on {
	background-image: -moz-linear-gradient( 90deg, rgb(20, 24, 42) 0%, rgb(237, 63, 179) 0%, rgb(52, 62, 105) 0%, rgba(32, 167, 196, 0) 100%);
	background-image: -webkit-linear-gradient( 90deg, rgb(20, 24, 42) 0%, rgb(237, 63, 179) 0%, rgb(52, 62, 105) 0%, rgba(32, 167, 196, 0) 100%);
	background-image: -ms-linear-gradient( 90deg, rgb(20, 24, 42) 0%, rgb(237, 63, 179) 0%, rgb(52, 62, 105) 0%, rgba(32, 167, 196, 0) 100%);
}
h1.footer_title:after {
	background: -webkit-radial-gradient(50% 50%, ellipse closest-side, <?php echo esc_attr($colormulticode); ?>   , rgba(255, 42, 112, 0) 60%);
	background: -moz-radial-gradient(50% 50%, ellipse closest-side, <?php echo esc_attr($colormulticode); ?>   , rgba(255, 42, 112, 0) 60%);
	background: -ms-radial-gradient(50% 50%, ellipse closest-side, <?php echo esc_attr($colormulticode); ?>   , rgba(255, 42, 112, 0) 60%);
	background: -o-radial-gradient(50% 50%, ellipse closest-side, <?php echo esc_attr($colormulticode); ?>   , rgba(255, 42, 112, 0) 60%);
}
.footer_box.footer_contacts ul.foo_con_info li .foo_con_icon {
	background-image: -ms-linear-gradient( 90deg, <?php echo esc_attr($colormulticode); ?> 0%, <?php echo esc_attr($colormulticode); ?> 0%, <?php echo esc_attr($colormulticode); ?> 100%);
	background-image: -moz-linear-gradient( 90deg, <?php echo esc_attr($colormulticode); ?> 0%, <?php echo esc_attr($colormulticode); ?> 0%, <?php echo esc_attr($colormulticode); ?> 100%);
	background-image: -webkit-linear-gradient( 90deg, <?php echo esc_attr($colormulticode); ?> 0%, <?php echo esc_attr($colormulticode); ?> 0%, <?php echo esc_attr($colormulticode); ?> 100%);
	background-image: -o-radial-gradient( 90deg, <?php echo esc_attr($colormulticode); ?> 0%, <?php echo esc_attr($colormulticode); ?> 0%, <?php echo esc_attr($colormulticode); ?> 100%);
}
.footer_box.footer_contacts ul.foo_con_info li .foo_con_data span a:hover {
	color: <?php echo esc_attr($colormulticode); ?>   ;
}
.foo_sharing ul li a {
	background-image: -ms-linear-gradient( 90deg, <?php echo esc_attr($colormulticode); ?> 0%, <?php echo esc_attr($colormulticode); ?> 0%, <?php echo esc_attr($colormulticode); ?> 100%);
	background-image: -moz-linear-gradient( 90deg, <?php echo esc_attr($colormulticode); ?> 0%, <?php echo esc_attr($colormulticode); ?> 0%, <?php echo esc_attr($colormulticode); ?> 100%);
	background-image: -webkit-linear-gradient( 90deg, <?php echo esc_attr($colormulticode); ?> 0%, <?php echo esc_attr($colormulticode); ?> 0%, <?php echo esc_attr($colormulticode); ?> 100%);
	background-image: -o-radial-gradient( 90deg, <?php echo esc_attr($colormulticode); ?> 0%, <?php echo esc_attr($colormulticode); ?> 0%, <?php echo esc_attr($colormulticode); ?> 100%);
}
.foo_sharing ul li a:hover {
	box-shadow: 0 0 18px 0 <?php echo esc_attr($colormulticode); ?>   ;
}
.footer_box.footer_subscribe input.form-control:focus {
	border: 1px solid <?php echo esc_attr($colormulticode); ?>   ;
}
.ms_copyright p a {
	color: <?php echo esc_attr($colormulticode); ?>   ;
}
.footer_border {
	background: -webkit-radial-gradient(50% 50%, ellipse closest-side, <?php echo esc_attr($colormulticode); ?>   , rgba(255, 42, 112, 0) 60%);
	background: -moz-radial-gradient(50% 50%, ellipse closest-side, <?php echo esc_attr($colormulticode); ?>   , rgba(255, 42, 112, 0) 60%);
	background: -ms-radial-gradient(50% 50%, ellipse closest-side, <?php echo esc_attr($colormulticode); ?>   , rgba(255, 42, 112, 0) 60%);
	background: -o-radial-gradient(50% 50%, ellipse closest-side, <?php echo esc_attr($colormulticode); ?>   , rgba(255, 42, 112, 0) 60%);
}

.player_left {
	background-image: -moz-linear-gradient( 180deg, <?php echo esc_attr($colormulticode); ?> 0%, <?php echo esc_attr($colormulticode); ?> 0%, <?php echo esc_attr($colormulticode); ?> 0%, <?php echo esc_attr($colormulticode); ?> 100%);
	background-image: -webkit-linear-gradient( 180deg, <?php echo esc_attr($colormulticode); ?> 0%, <?php echo esc_attr($colormulticode); ?> 0%, <?php echo esc_attr($colormulticode); ?> 0%, <?php echo esc_attr($colormulticode); ?> 100%);
	background-image: -ms-linear-gradient( 180deg, <?php echo esc_attr($colormulticode); ?> 0%, <?php echo esc_attr($colormulticode); ?> 0%, <?php echo esc_attr($colormulticode); ?> 0%, <?php echo esc_attr($colormulticode); ?> 100%);
}
.jp-play-bar {
	background-color: <?php echo esc_attr($colormulticode); ?>   ;
}
.jp-progress .bullet,
.jp-volume-bar .bullet {
	background: <?php echo esc_attr($colormulticode); ?>   ;
}
.jp-playlist li:hover {
	background-color: <?php echo esc_attr($colormulticode); ?>   ;
}
.jp_queue_wrapper span.que_text i {
	color: <?php echo esc_attr($colormulticode); ?>   ;
}
.que_close {
	background-color: <?php echo esc_attr($colormulticode); ?>   ;
}
.jp_queue_btn a {
	background-color: <?php echo esc_attr($colormulticode); ?>   ;
}
li.option.selected.focus:after {
	background-color: <?php echo esc_attr($colormulticode); ?>   ;
}
.album_list_wrapper>ul:hover>li>a {
	color: <?php echo esc_attr($colormulticode); ?>   ;
}
ul.play_active_song>li>a {
	color: <?php echo esc_attr($colormulticode); ?>   ;
}
.ms_cmnt_wrapper .form-control:focus {
	border: 1px solid #ff5471;
}

.ms_free_download .album_list_wrapper .ms_close {
	background-color: <?php echo esc_attr($colormulticode); ?>   ;
}
.ms_register_form a.ms_btn:hover,
.ms_lang_popup .modal-content.add_lang .ms_lang_btn a.ms_btn:hover {
	color: <?php echo esc_attr($colormulticode); ?>   ;
}
button.save_btn:hover {
	color: <?php echo esc_attr($colormulticode); ?>   ;
}
.ms_admin_name {
	color: <?php echo esc_attr($colormulticode); ?>   ;
}
.ms_admin_name:hover {
	color: <?php echo esc_attr($colormulticode); ?>   ;
}
.ms_admin_name:hover:after {
	border-top: 4px solid <?php echo esc_attr($colormulticode); ?>   ;
}
.ms_pro_form .form-group label {
	color: <?php echo esc_attr($colormulticode); ?>   ;
}
ul.pro_dropdown_menu li a:hover {
    color: <?php echo esc_attr($colormulticode); ?>   ;
}
.ms_plan_box .ms_plan_header:after {
	background-color: <?php echo esc_attr($colormulticode); ?>   ;
}
.ms_plan_box h3.plan_heading:after {
	background: -webkit-radial-gradient(50% 50%, ellipse closest-side, #202020, <?php echo esc_attr($colormulticode); ?> 60%);
	background: -moz-radial-gradient(50% 50%, ellipse closest-side, #202020, <?php echo esc_attr($colormulticode); ?> 60%);
	background: -ms-radial-gradient(50% 50%, ellipse closest-side, #202020, <?php echo esc_attr($colormulticode); ?> 60%);
	background: -o-radial-gradient(50% 50%, ellipse closest-side, #202020, <?php echo esc_attr($colormulticode); ?> 60%);
}
.ms_admin_name span.ms_pro_name {
    background-image: -moz-linear-gradient(180deg, <?php echo esc_attr($colormulticode); ?> 0%, <?php echo esc_attr($colormulticode); ?> 0%, <?php echo esc_attr($colormulticode); ?> 0%, <?php echo esc_attr($colormulticode); ?> 100%);
    background-image: -webkit-linear-gradient(180deg, <?php echo esc_attr($colormulticode); ?> 0%, <?php echo esc_attr($colormulticode); ?> 0%, <?php echo esc_attr($colormulticode); ?> 0%, <?php echo esc_attr($colormulticode); ?> 100%);
    background-image: -ms-linear-gradient(180deg, <?php echo esc_attr($colormulticode); ?> 0%, <?php echo esc_attr($colormulticode); ?> 0%, <?php echo esc_attr($colormulticode); ?> 0%, <?php echo esc_attr($colormulticode); ?> 100%);
}
.plan_dolar {
	border: 2px solid <?php echo esc_attr($colormulticode); ?>   ;
	color: <?php echo esc_attr($colormulticode); ?>   ;
}
.form-control {
    border: 1px solid #cccccc;
}
.plan_price:before,
.plan_price:after {
	background-image: -webkit-linear-gradient(left, <?php echo esc_attr($colormulticode); ?>   , <?php echo esc_attr($colormulticode); ?>   , #fff);
	background-image: -moz-linear-gradient(left, <?php echo esc_attr($colormulticode); ?>   , <?php echo esc_attr($colormulticode); ?>   , #fff);
	background-image: -ms-linear-gradient(left, <?php echo esc_attr($colormulticode); ?>   , <?php echo esc_attr($colormulticode); ?>   , #fff);
	background-image: -o-linear-gradient(left, <?php echo esc_attr($colormulticode); ?>   , <?php echo esc_attr($colormulticode); ?>   , #fff);
}
.plan_price:before {
	background-image: -webkit-linear-gradient(right, <?php echo esc_attr($colormulticode); ?>   , <?php echo esc_attr($colormulticode); ?>   , #fff);
	background-image: -moz-linear-gradient(right, <?php echo esc_attr($colormulticode); ?>   , <?php echo esc_attr($colormulticode); ?>   , #fff);
	background-image: -ms-linear-gradient(right, <?php echo esc_attr($colormulticode); ?>   , <?php echo esc_attr($colormulticode); ?>   , #fff);
	background-image: -o-linear-gradient(right, <?php echo esc_attr($colormulticode); ?>   , <?php echo esc_attr($colormulticode); ?>   , #fff);
}
.ms_add_cart a.button.product_type_simple.add_to_cart_button.ajax_add_to_cart i, .ms_add_cart_link a.ms_button_link_single i {
    color: <?php echo esc_attr($colormulticode); ?>;
}
.ms_add_cart a.button.product_type_simple.add_to_cart_button.ajax_add_to_cart i, .ms_add_cart_link a.ms_button_link_single i {
     color: <?php echo esc_attr($colormulticode); ?>;
}
.ms_acc_ovrview_list ul li span {
	color: #ffffff  ;
}
.ms_profile_box button.hst_loader {
    background-color: <?php echo esc_attr($colormulticode); ?>   ;
}
.ms_add_cart_main {
    background-image: -moz-linear-gradient(90deg, rgb(22, 26, 46) 0%, rgb(237, 63, 179) 0%, <?php echo esc_attr($colormulticode); ?> 0%, rgba(32, 167, 196, 0) 100%);;
    background-image: -webkit-linear-gradient(90deg, rgb(22, 26, 46) 0%, rgb(237, 63, 179) 0%, <?php echo esc_attr($colormulticode); ?> 0%, rgba(32, 167, 196, 0) 100%);
    background-image: -ms-linear-gradient(90deg, rgb(22, 26, 46) 0%, rgb(237, 63, 179) 0%, <?php echo esc_attr($colormulticode); ?> 0%, rgba(32, 167, 196, 0) 100%);
}
.rtl .ms_nav_wrapper ul li ul.sub-menu:before {
    border-left: 10px solid <?php echo esc_attr($colormulticode); ?>;
}
.ms_comment_section .comment_info .comment_reply:hover {
	color: <?php echo esc_attr($colormulticode); ?>   ;
}
.comment-reply-link{
    color: <?php echo esc_attr($colormulticode); ?>    !important;
}
h2.widget-title:after {
    background: <?php echo esc_attr($colormulticode); ?>   ;
    background-image: -webkit-linear-gradient(left, <?php echo esc_attr($colormulticode); ?>   , <?php echo esc_attr($colormulticode); ?>   , #161a2d);
    background-image: -moz-linear-gradient(left, <?php echo esc_attr($colormulticode); ?>   , <?php echo esc_attr($colormulticode); ?>   , #161a2d);
    background-image: -ms-linear-gradient(left, <?php echo esc_attr($colormulticode); ?>   , <?php echo esc_attr($colormulticode); ?>   , #161a2d);
    background-image: -o-linear-gradient(left, <?php echo esc_attr($colormulticode); ?>   , <?php echo esc_attr($colormulticode); ?>   , #161a2d);
}
.widget.widget_categories ul li a:after {
	background-color: <?php echo esc_attr($colormulticode); ?>   ;
}
.widget.widget_categories ul li a:hover {
	color: <?php echo esc_attr($colormulticode); ?>   ;
}
.widget.widget_recent_entries ul li .recent_cmnt_data h4 a:hover {
	color: <?php echo esc_attr($colormulticode); ?>   ;
}
.widget.widget_tag_cloud ul li a {
	background-color: <?php echo esc_attr($colormulticode); ?>   ;
	border: 1px solid <?php echo esc_attr($colormulticode); ?>   ;
}
.widget.widget_tag_cloud ul li a:hover {
	box-shadow: 0px 0px 20px 0px <?php echo esc_attr($colormulticode); ?>   ;
}
.widget.widget_search form.search-form input.search-submit,
input.search-submit {
	background-color: <?php echo esc_attr($colormulticode); ?>   ;
	border-color: <?php echo esc_attr($colormulticode); ?>   ;
}
.ms_nav_wrapper ul li a:hover,
.ms_nav_wrapper ul li.current_page_item a {
	background-color: <?php echo esc_attr($colormulticode); ?>   ;
}
input[type="submit"],
input[type="reset"] {
	background: <?php echo esc_attr($colormulticode); ?>   ;
    border: 1px solid <?php echo esc_attr($colormulticode); ?>   ;
}
.ms_admin_name:hover span.ms_pro_name:after {
	border-top: 4px solid <?php echo esc_attr($colormulticode); ?>   ;
}
.ms_nav_wrapper ul li a:hover:after,
.ms_nav_wrapper ul li.current_page_item a:after {
	background-color: <?php echo esc_attr($colormulticode); ?>   ;
}
.breadcrumbs_wrapper {
	background-color: <?php echo esc_attr($colormulticode); ?>   ;
}
input#login_btn:hover,
input#register_btn:hover {
	color: <?php echo esc_attr($colormulticode); ?>   ;
	background-color:fff;
}
input#login_btn:focus,
input#register_btn:focus, input#login_btn:visited,
input#register_btn:visited {
	color: <?php echo esc_attr($colormulticode); ?>    !important;
}
.ms_nav_close i:hover {
	color: <?php echo esc_attr($colormulticode); ?>   ;
}
.album_inner_list::-webkit-scrollbar-track {
	-webkit-box-shadow: inset 0 0 3px <?php echo esc_attr($colormulticode); ?>   ;
}
.album_inner_list::-webkit-scrollbar-thumb {
	background-color: <?php echo esc_attr($colormulticode); ?>   ;
	outline: 2px solid <?php echo esc_attr($colormulticode); ?>   ;
}
.widget.widget_categories ul li a:hover, .widget.widget_archive ul li a:hover, .widget.widget_categories ul li ul.children li a:hover:before, .widget.widget_pages ul li ul.children li a:hover:before, .widget.widget_nav_menu ul.sub-menu li a:hover:before {
    color: <?php echo esc_attr($colormulticode); ?>   ;
}
.hentry .entry-title,
.no-results .page-title {
	color: <?php echo esc_attr($colormulticode); ?>   ;
}
.format-gallery .page-links a:visited{
	color:<?php echo esc_attr($colormulticode); ?>   ;
}
	ul.tabs li.current {
            background: <?php echo esc_attr($colormulticode); ?>   ;
        }
        .woocommerce div.product .woocommerce-tabs .panel h2 {
   color:<?php echo esc_attr($colormulticode); ?>   ;
}
.woocommerce div.product .woocommerce-tabs ul.tabs li.active {
    background: <?php echo esc_attr($colormulticode); ?>   ;
    border-bottom-color: <?php echo esc_attr($colormulticode); ?>   ;
}
.widget.widget_recent_entries ul li a:hover {
	color: <?php echo esc_attr($colormulticode); ?>   ;
}
.widget.widget_pages ul li a:hover,
.widget.widget_recent_comments #recentcomments li.recentcomments a:hover,
.widget.widget_nav_menu ul li a:hover {
	color: <?php echo esc_attr($colormulticode); ?>   ;
}
#artist-list th {
   	background-color: <?php echo esc_attr($colormulticode); ?>   ;
}
.widget.widget_categories ul li a:after,
.widget.widget_archive ul li a:after {
	background-color: <?php echo esc_attr($colormulticode); ?>   ;
}
.widget.widget_meta ul li a:hover {
	color: <?php echo esc_attr($colormulticode); ?>   ;
}
.ms_basic_menu ul li a:hover {
	color: <?php echo esc_attr($colormulticode); ?>   ;
}
.ms_nav_wrapper ul li ul.sub-menu {
	background-color: <?php echo esc_attr($colormulticode); ?>   ;
}
.widget.widget_categories ul li a:hover,
.widget.widget_archive ul li a:hover {
	color: <?php echo esc_attr($colormulticode); ?>   ;
}
.truncate::-webkit-scrollbar-thumb {
    background-color: <?php echo esc_attr($colormulticode); ?>   ;
}
.fd_error p {
	color: <?php echo esc_attr($colormulticode); ?>   ;
}
.fd_error_btn a {
	background-color: <?php echo esc_attr($colormulticode); ?>   ;
}
.fd_error_btn a:hover {
	box-shadow: 0px 0px 20px 0px <?php echo esc_attr($colormulticode); ?>   ;
}
table#wp-calendar caption {
    color: <?php echo esc_attr($colormulticode); ?>   ;
}
.widget.widget_tag_cloud .tagcloud a:hover {   
	background-color: <?php echo esc_attr($colormulticode); ?>   ;
	 border: 1px solid <?php echo esc_attr($colormulticode); ?>   ;
}
.footer_box button.hst_loader {
    background-color: <?php echo esc_attr($colormulticode); ?>   ;
}
.ms_basic_menu ul li ul.sub-menu li a:hover {
	background-color:<?php echo esc_attr($colormulticode); ?>   ;
}
.ms_basic_menu ul li.current-menu-item a {
    color: <?php echo esc_attr($colormulticode); ?>   ;
}
.post_format-post-format-quote blockquote:before {
    color: <?php echo esc_attr($colormulticode); ?>   ;
}
.ms_profile_box.ms_view_profile .pro-form-btn a.ms_btn:hover{
	color:<?php echo esc_attr($colormulticode); ?>    !important;
}
li.pingback a:hover {
    color: <?php echo esc_attr($colormulticode); ?>   ;
}
td#today {
    color: <?php echo esc_attr($colormulticode); ?>    !important;
}
.widget.widget_archive ul li, .widget.widget_categories ul li, .widget.widget_recent_comments ul li.recentcomments{
    color: <?php echo esc_attr($colormulticode); ?>   ;
}
.entry-meta a:hover {
    color: <?php echo esc_attr($colormulticode); ?>    !important;
}
blockquote {
    border-left: 3px solid <?php echo esc_attr($colormulticode); ?>   ;
    background-color: <?php echo esc_attr($colormulticode); ?>   ;
}
table#wp-calendar thead {
    background-color: <?php echo esc_attr($colormulticode); ?>   ;
}
/*h1.comments-title:after, .blog_comments_forms h1:after, .comment-respond h1:after {*/
/*    background: <?php echo esc_attr($colormulticode); ?>   ;*/
/*    background-image: -webkit-linear-gradient(left, <?php echo esc_attr($colormulticode); ?>   , <?php echo esc_attr($colormulticode); ?>   , #fff);*/
/*    background-image: -moz-linear-gradient(left, #3bc8e7, #3bc8e7, #161a2d);*/
/*    background-image: -ms-linear-gradient(left, #3bc8e7, #3bc8e7, #161a2d);*/
/*    background-image: -o-linear-gradient(left, #3bc8e7, #3bc8e7, #161a2d);*/
/*}*/
h2.widget-title:after {
    background: #ff5165;
    background-image: -webkit-linear-gradient(left, <?php echo esc_attr($colormulticode); ?>   , <?php echo esc_attr($colormulticode); ?>   , #1b2039);
    background-image: -moz-linear-gradient(left, <?php echo esc_attr($colormulticode); ?>   , <?php echo esc_attr($colormulticode); ?>   , #1b2039);
    background-image: -ms-linear-gradient(left, <?php echo esc_attr($colormulticode); ?>   , <?php echo esc_attr($colormulticode); ?>   , #1b2039);
    background-image: -o-linear-gradient(left, <?php echo esc_attr($colormulticode); ?>   , <?php echo esc_attr($colormulticode); ?>   , #1b2039);     
}
header.entry-header h3.entry-title a:hover {
    color: <?php echo esc_attr($colormulticode); ?>   ;
}
.entry-meta span.byline i, .entry-meta span.byline a {
    color: <?php echo esc_attr($colormulticode); ?>    !important;
}
header.entry-header span.posted-on:hover i {
    color: <?php echo esc_attr($colormulticode); ?>   ;
}
.ms_count_ordering {
    background-color: <?php echo esc_attr($colormulticode); ?>   ;
}
.ms_blog_temp_readmore:after{
    background-color: <?php echo esc_attr($colormulticode); ?>   ;
}
.ms_blog_temp_readmore:hover {
    color: <?php echo esc_attr($colormulticode); ?>;
}
a:hover{
    color: <?php echo esc_attr($colormulticode); ?>;
}

.ms_blog_date {
	top: -14px;
    border: 5px solid #fff;
	background-image: -ms-linear-gradient( 90deg, rgb(52, 218, 200) 0%, rgb(52, 218, 200) 0%, rgb(52, 218, 200) 100%);
    background-image: -moz-linear-gradient( 90deg, rgb(52, 218, 200) 0%, rgb(52, 218, 200) 0%, rgb(52, 218, 200) 100%);
    background-image: -webkit-linear-gradient( 90deg, rgb(52, 218, 200) 0%, rgb(52, 218, 200) 0%, rgb(52, 218, 200) 100%);
    background-image: -ms-linear-gradient( 90deg, rgb(52, 218, 200) 0%, rgb(52, 218, 200) 0%, rgb(52, 218, 200) 100%);
}
.ms_footershdow_widget h1.footer_title:after{
	background: #ff5165;
    background-image: -webkit-linear-gradient(left, <?php echo esc_attr($colormulticode); ?>   , <?php echo esc_attr($colormulticode); ?>   , #fff);
    background-image: -moz-linear-gradient(left, <?php echo esc_attr($colormulticode); ?>   , <?php echo esc_attr($colormulticode); ?>   , #fff);
    background-image: -ms-linear-gradient(left, <?php echo esc_attr($colormulticode); ?>   , <?php echo esc_attr($colormulticode); ?>   , #fff);
    background-image: -o-linear-gradient(left, <?php echo esc_attr($colormulticode); ?>   , <?php echo esc_attr($colormulticode); ?>   , #fff);
}
.ms_nav_wrapper ul li ul.sub-menu:before{
    border-right: 10px solid <?php echo esc_attr($colormulticode); ?>   ;
}
.ms_nav_wrapper ul li ul.sub-menu li a:after {
    height: 1px;
    background-color: #ffffff;
}
.ms_breadcrumb .breadcrumbs a {
    text-decoration: none;
    color: <?php echo esc_attr($colormulticode); ?>   ;
}
.page-links a span.page-number:hover{
	background-color:<?php echo esc_attr($colormulticode); ?>   ;
}

nav.navigation.pagination .nav-links .page-numbers:hover{
    background-color: <?php echo esc_attr($colormulticode); ?>   ;
} 
.page-links span.page-number {
    background-color: <?php echo esc_attr($colormulticode); ?>   ;
}
.ms_fea_album_slider.ms_product_slider a.ms_pro_button {
    background: <?php echo esc_attr($colormulticode); ?>   ;
}
.woocommerce ul.product_list_widget del, span.ms_pro_price del {
    color: <?php echo esc_attr($colormulticode); ?>   ;
}
.ms_weekly_wrapper.ms_free_music.ms_product_grid a.ms_pro_button {
    background: <?php echo esc_attr($colormulticode); ?>   ;
}
.ms_weekly_wrapper.ms_free_music.ms_product_grid a.ms_pro_button:hover, .ms_fea_album_slider.ms_product_slider a.ms_pro_button:hover{
	background-color: <?php echo esc_attr($colormulticode); ?>   ;
    box-shadow: 0px 0px 20px 0px <?php echo esc_attr($colormulticode); ?>   ;
}
.woocommerce span.onsale {
    background: <?php echo esc_attr($colormulticode); ?>   ;
}
.woocommerce div.product p.price, .woocommerce div.product span.price {
    color: <?php echo esc_attr($colormulticode); ?>   ;
}
.woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover,.woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt {
    background-color: <?php echo esc_attr($colormulticode); ?>   ;
}

.woocommerce a.remove {
    background: <?php echo esc_attr($colormulticode); ?>   ;
}

.album_list_wrapper>ul>li {
    color: <?php echo esc_attr($colormulticode); ?>   ;
}
ul.product-categories li a:hover {
    color: <?php echo esc_attr($colormulticode); ?>   ;
}
ul.product-categories li a:after {
    background: <?php echo esc_attr($colormulticode); ?>   ;
}
ul.album_list_name:after {
    background: rgb(52, 218, 200);
    background-image: -webkit-linear-gradient(left, rgb(52, 218, 200), <?php echo esc_attr($colormulticode); ?>   , rgba(22, 26, 45, 0.8));
    background-image: -moz-linear-gradient(left, rgb(52, 218, 200), <?php echo esc_attr($colormulticode); ?>   , rgba(22, 26, 45, 0.8));
    background-image: -ms-linear-gradient(left, rgb(52, 218, 200), <?php echo esc_attr($colormulticode); ?>   , rgba(22, 26, 45, 0.8));
    background-image: -o-linear-gradient(left, rgb(52, 218, 200), <?php echo esc_attr($colormulticode); ?>   , rgba(22, 26, 45, 0.8));
}
.widget.widget_tag_cloud .tagcloud a:hover, .widget.woocommerce.widget_product_tag_cloud .tagcloud a:hover {
    background-color: <?php echo esc_attr($colormulticode); ?>   ;
    border: 1px solid <?php echo esc_attr($colormulticode); ?>   ;
    box-shadow: 0px 0px 20px 0px <?php echo esc_attr($colormulticode); ?>   ;
}
.widget.widget_search form.search-form input.search-submit, input.search-submit, .widget.woocommerce.widget_product_search button {
    background-color: <?php echo esc_attr($colormulticode); ?>   ;
    border-color: <?php echo esc_attr($colormulticode); ?>   ;
}
.ms_heading h1:after, .cart_totals h2:after {
    background: -webkit-radial-gradient(50% 50%, ellipse closest-side, <?php echo esc_attr($colormulticode); ?>   , rgba(255, 42, 112, 0) 60%);
    background: -moz-radial-gradient(50% 50%, ellipse closest-side, <?php echo esc_attr($colormulticode); ?>   , rgba(255, 42, 112, 0) 60%);
    background: -ms-radial-gradient(50% 50%, ellipse closest-side, <?php echo esc_attr($colormulticode); ?>   , rgba(255, 42, 112, 0) 60%);
    background: -o-radial-gradient(50% 50%, ellipse closest-side, <?php echo esc_attr($colormulticode); ?>   , rgba(255, 42, 112, 0) 60%);
}
.woocommerce .coupon button.button {
    color: <?php echo esc_attr($colormulticode); ?>   ;
}
.woocommerce .coupon button.button:hover {
    color: #fff;
}
button.button:disabled[disabled]:hover {
    background-color: <?php echo esc_attr($colormulticode); ?>    !important;
}
h3#ship-to-different-address, .woocommerce-billing-fields h3, h3#order_review_heading {
    color: <?php echo esc_attr($colormulticode); ?>   ;
}
.woocommerce-MyAccount-navigation ul li.is-active a, .woocommerce-MyAccount-navigation ul li a:hover {
    background: <?php echo esc_attr($colormulticode); ?>   ;
}
.woocommerce .widget_price_filter .ui-slider .ui-slider-range {
    background: <?php echo esc_attr($colormulticode); ?>   ;
}
.woocommerce .widget_price_filter .ui-slider .ui-slider-handle {
    background: <?php echo esc_attr($colormulticode); ?>   ;
}

a.button.add_to_cart_button, .ms_add_cart_link a {
    color: <?php echo esc_attr($colormulticode); ?>   ;
}
a.button.add_to_cart_button:hover, .ms_add_cart_link a:hover{
	color:<?php echo esc_attr($colormulticode); ?>   ;
	background-color:#fff;
}

.woocommerce nav.woocommerce-pagination ul li a:focus, .woocommerce nav.woocommerce-pagination ul li a:hover, .woocommerce nav.woocommerce-pagination ul li span.current {
    background: <?php echo esc_attr($colormulticode); ?>   ;
}

.woocommerce #respond input#submit.alt.disabled, .woocommerce #respond input#submit.alt.disabled:hover, .woocommerce #respond input#submit.alt:disabled, .woocommerce #respond input#submit.alt:disabled:hover, .woocommerce #respond input#submit.alt:disabled[disabled], .woocommerce #respond input#submit.alt:disabled[disabled]:hover, .woocommerce a.button.alt.disabled, .woocommerce a.button.alt.disabled:hover, .woocommerce a.button.alt:disabled, .woocommerce a.button.alt:disabled:hover, .woocommerce a.button.alt:disabled[disabled], .woocommerce a.button.alt:disabled[disabled]:hover, .woocommerce button.button.alt.disabled, .woocommerce button.button.alt.disabled:hover, .woocommerce button.button.alt:disabled, .woocommerce button.button.alt:disabled:hover, .woocommerce button.button.alt:disabled[disabled], .woocommerce button.button.alt:disabled[disabled]:hover, .woocommerce input.button.alt.disabled, .woocommerce input.button.alt.disabled:hover, .woocommerce input.button.alt:disabled, .woocommerce input.button.alt:disabled:hover, .woocommerce input.button.alt:disabled[disabled], .woocommerce input.button.alt:disabled[disabled]:hover {
    background: <?php echo esc_attr($colormulticode); ?>   ;
}
.ms_blog_date {
    background: <?php echo esc_attr($colormulticode); ?>   ;
}
.audio-player a, .audio-player a:hover {
    color: #fff;
}
button.button:disabled[disabled] {
    background: <?php echo esc_attr($colormulticode); ?>   !important;
    border: <?php echo esc_attr($colormulticode); ?>   ;
    color: #fff!important;
}
.media-router>a.media-menu-item {
    color: <?php echo esc_attr($colormulticode); ?>   ;
}
.ms-entry-footer span.comments-link:after {
    background-color: <?php echo esc_attr($colormulticode); ?>   ;
}
.ms_nav_wrapper ul li ul.sub-menu li a:hover:after {
    background-color: #ffffff;
}


.jp-playlist li.jp-playlist-current:hover {
    background-color: #252b4d;
}
.ms_player-style-two .jp_queue_wrapper span.que_text i {
    color: <?php echo esc_attr($colormulticode); ?>   ;
}
.knob-container .knob-wrapper-outer .knob-wrapper .knob:after {
    border-bottom-color: <?php echo esc_attr($colormulticode); ?>!important   ;
}
.knob-container .knob-wrapper-outer .knob-wrapper .handle:before {
    background: <?php echo esc_attr($colormulticode); ?>   ;
}
.knob-container .knob-wrapper-outer .knob-wrapper .knob.d3:after {
    border-top-color: <?php echo esc_attr($colormulticode); ?>   ;
    border-right-color: <?php echo esc_attr($colormulticode); ?>   ;
}
div#lang_modal .modal-content i { 
    color: <?php echo esc_attr($colormulticode); ?>   ;
}
.dataTables_wrapper .dataTables_length select {
    color: <?php echo esc_attr($colormulticode); ?>   ;
}
.ms_add_cart a .fa-shopping-cart {
    color: <?php echo esc_attr($colormulticode); ?>!important;
}
 .close span {
     color: <?php echo esc_attr($colormulticode); ?>!important;
}
button.close {
    font-size: 14px;
    color: <?php echo esc_attr($colormulticode); ?>!important;
}

a.paginate_button {
    background: <?php echo esc_attr($colormulticode); ?>!important;
    color:  <?php echo esc_attr($colormulticode); ?>!important;
}
.ms_add_cart_main > div a {
    background: #ffffff!important;
}
.woocommerce-message {
    border-top-color: <?php echo esc_attr($colormulticode); ?>!important;
    background-color: <?php echo esc_attr($colormulticode); ?>!important;
}
.woocommerce-message .button, .woocommerce-Message .button {
    color: <?php echo esc_attr($colormulticode); ?>!important;
}
.woocommerce-error, .woocommerce-info, .woocommerce-message {
    background-color: <?php echo esc_attr($colormulticode); ?>!important;
}
.woocommerce form .form-row .required {
    color: <?php echo esc_attr($colormulticode); ?>!important;
}
.mv_profile_view ul li span {
    color: <?php echo esc_attr($colormulticode); ?>!important;
}
.mv_profile_view ul li p {
    color: <?php echo esc_attr($colormulticode); ?>!important;
}
.ms_btn {
    background-color: <?php echo esc_attr($colormulticode); ?>;
}
.ms_top_right .ms_top_lang:after {
    background-color: <?php echo esc_attr($colormulticode); ?>;
}

.jp_queue_wrapper span.que_text {
	background-color: <?php echo esc_attr($colormulticode); ?>;
}
.modal-content {
   background-color: <?php echo esc_attr($colormulticode); ?>;
}
.ms_profile_wrapper.beatswipe_profile_wrapper .form-control, .mv_profile_content .ms_upload_box .form-control {
        border: 1px solid #cccccc;
}

.mv_user_dash li {
    border: 1px solid #cccccc;
}

.ms_fea_album_slider.mv_videos_slider .ms_rcnt_box_text h3 a {
    color:  <?php echo esc_attr($colormulticode); ?>;
}

.ms_top_search button.search-submit{
    background-color: <?php echo esc_attr($colormulticode); ?>;
}
.footer_box.footer_subscribe input.form-control {
    border: 1px solid #cccccc;
}
nav.navigation.pagination .nav-links .page-numbers.current {
  background-color: <?php echo esc_attr($colormulticode); ?>;
}
.widget.widget_search form.search-form input.search-field, .woocommerce-product-search input#woocommerce-product-search-field-0 {
    border: 1px solid #cccccc;
}
.woocommerce .woocommerce-ordering select {
    border: 1px solid #cccccc;
}
.woocommerce ul.products li.product .price {
   color:  <?php echo esc_attr($colormulticode); ?>;
}
.ms_needlogin h2 {
     color:  <?php echo esc_attr($colormulticode); ?>;
}
.footer_box.footer_subscribe input.form-control {
    color:  <?php echo esc_attr($colormulticode); ?>;
}
input[type="text"]:focus, input[type="email"]:focus, input[type="url"]:focus, input[type="password"]:focus, input[type="search"]:focus, input[type="number"]:focus, input[type="tel"]:focus, input[type="range"]:focus, input[type="date"]:focus, input[type="month"]:focus, input[type="week"]:focus, input[type="time"]:focus, input[type="datetime"]:focus, input[type="datetime-local"]:focus, input[type="color"]:focus, textarea:focus {
   color:#cccccc;
}
.ms_acc_overview {
  background-color: <?php echo esc_attr($colormulticode); ?>;
      color:  #ffffff;
}
.mv_user_dash li a{
    color:  <?php echo esc_attr($colormulticode); ?>;
}
.mv_user_dash li a:hover, .mv_user_dash li.current_page_item a {
    background-color: <?php echo esc_attr($colormulticode); ?>;
   
}
.ms_upload_wrapper.mv_video_wrap {
   background-color: #1b2039;
}
.ms_top_search .form-control {
   color:  <?php echo esc_attr($colormulticode); ?>;
}

.ms_player-style-two .jp-interface .jp-controls .jp-play {
     background-color: <?php echo esc_attr($colormulticode); ?>;
}
.dataTables_wrapper .dataTables_paginate .paginate_button.current, .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
    border: 1px solid <?php echo esc_attr($colormulticode); ?>!important;
}
.navigation ul li a, .page-links a {
     background-color: #cccccc;
}
.navigation ul li a:hover, .navigation ul li.active a{
    background-color: <?php echo esc_attr($colormulticode); ?>;
}














/*====Media Css Start====*/
@media (max-width: 991px){

.ms_basic_menu ul li a:hover {
    color: <?php echo esc_attr($colormulticode); ?>   ; 
}
.ms_menu_bar i {
    background-color: <?php echo esc_attr($colormulticode); ?>   ;
}
.ms_basic_menu ul li ul.sub-menu li a:hover {
    color: <?php echo esc_attr($colormulticode); ?>   ;
}
.div-wrapper-style-two .player_left.open_list .play_song_options {
    background: <?php echo esc_attr($colormulticode); ?>   ; 
    border-radius: 10px;
}
} 
@media(max-width:767px){
    .jp-now-playing.flex-item {
    background-color: <?php echo esc_attr($colormulticode); ?>!important   ;
}
    .player_left.open_list .play_song_options {
    background-color: <?php echo esc_attr($colormulticode); ?>!important   ;
    background-image:none;
}
}
.ms_nav_wrapper ul li a:hover, .ms_nav_wrapper ul li.current_page_item a {
    background-color: <?php echo esc_attr($colormulticode); ?>;
}
</style>

<?php
 endif;
}  