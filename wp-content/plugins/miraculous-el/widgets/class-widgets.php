<?php
/**
 * Widgets class.
 */

namespace ElementorMiraculous;

// Security Note: Blocks direct access to the plugin PHP files.
defined( 'ABSPATH' ) || die();

/**
 * Class Plugin
 *
 * Main Plugin class
 *
 * @since 1.0.0
 */
class Widgets {

	/**
	 * Instance
	 *
	 * @since 1.0.0
	 * @access private
	 * @static
	 *
	 * @var Plugin The single instance of the class.
	 */
	private static $instance = null;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return Plugin An instance of the class.
	 */
	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Include Widgets files
	 *
	 * Load widgets files
	 *
	 * @since 1.0.0
	 * @access private
	 */
	private function include_widgets_files() {
		require_once 'miraculous-el-banner.php';
		require_once 'miraculous-el-album.php';
		require_once 'miraculous-el-track.php';
		require_once 'miraculous-el-artist.php';
		require_once 'miraculous-el-genre.php';
		require_once 'miraculous-el-radio.php';
		require_once 'miraculous-el-product.php';
		require_once 'miraculous-el-downloadedtrack.php';
	    require_once 'miraculous-el-purchasedtrack.php';
		require_once 'miraculous-el-recentplaytrack.php';
		require_once 'miraculous-el-needlogin.php';
		require_once 'miraculous-el-favmusic.php';
		require_once 'miraculous-el-history.php';
		require_once 'miraculous-el-playlist.php';
	    require_once 'miraculous-el-trackupload.php';
		require_once 'miraculous-el-freetrackupload.php';
		require_once 'miraculous-el-pricingplan.php';
		require_once 'miraculous-el-subscription.php';
	    require_once 'miraculous-el-aboutsettings.php';
		require_once 'miraculous-el-albumupload.php';
		require_once 'miraculous-el-bulkupload.php';
		require_once 'miraculous-el-productupload.php';
		require_once 'miraculous-el-useruploadedtrack.php';
		require_once 'miraculous-el-useralbum.php';
	    require_once 'miraculous-el-userproduct.php';
		require_once 'miraculous-el-updatealbum.php';
		require_once 'miraculous-el-updateaudio.php';
		require_once 'miraculous-el-updateproducts.php';
		require_once 'miraculous-el-followartist.php';
		require_once 'miraculous-el-usersearning.php';
	    require_once 'miraculous-el-logout.php';
		require_once 'miraculous-el-podcast.php';
		require_once 'miraculous-el-musictab.php';
		//require_once 'miraculous-el-subscription.php';
	    //require_once 'miraculous-el-aboutsettings.php';
		//require_once 'miraculous-el-albumupload.php';
		//require_once 'miraculous-el-bulkupload.php';
		//require_once 'miraculous-el-productupload.php';
		
	}

	/**
	 * Register Widgets
	 *
	 * Register new Elementor widgets.
	 *  
	 * @since 1.0.0
	 * @access public 
	 */
	public function register_widgets() {
		// It's now safe to include Widgets files.
		$this->include_widgets_files();

		// Register the plugin widget classes.
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Miraculous_banner() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Miraculous_album() );	
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Miraculous_track() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Miraculous_artist() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Miraculous_genre() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Miraculous_radio() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Miraculous_product() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Miraculous_downloadedtrack() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Miraculous_purchasedtrack() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Miraculous_recentplaytrack() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Miraculous_needlogin() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Miraculous_favmusic() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Miraculous_history() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Miraculous_playlist() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Miraculous_trackupload() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Miraculous_freetrackupload() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Miraculous_pricingplan() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Miraculous_subscription() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Miraculous_aboutsettings() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Miraculous_albumupload() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Miraculous_bulkupload() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Miraculous_productupload() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Miraculous_useruploadedtrack() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Miraculous_useralbum() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Miraculous_userproduct() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Miraculous_updatealbum() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Miraculous_updateaudio() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Miraculous_updateproducts() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Miraculous_followartist() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Miraculous_usersearning() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Miraculous_logout() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Miraculous_podcast() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Miraculous_musictab() );
		//\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Miraculous_subscription() );
		//\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Miraculous_aboutsettings() );
		//\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Miraculous_albumupload() );
		//\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Miraculous_bulkupload() );
		//\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Miraculous_productupload() );
		
		
		
	}

	/**
	 *  Plugin class constructor
	 *
	 * Register plugin action hooks and filters
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function __construct() {
		// Register the widgets.
		add_action( 'elementor/widgets/widgets_registered', array( $this, 'register_widgets' ) );
	}
}

// Instantiate the Widgets class.
Widgets::instance();
