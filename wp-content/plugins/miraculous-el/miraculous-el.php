<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://themeforest.net/user/kamleshyadav
 * @since             1.0.0
 * @package           Miraculous_El
 *
 * @wordpress-plugin
 * Plugin Name:       Miraculous Elementor
 * Plugin URI:        https://kamleshyadav.com/wp/miraculous/darkversion/
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Kamleshyadav
 * Author URI:        https://themeforest.net/user/kamleshyadav
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       miraculous-el
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'MIRACULOUS_EL_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-miraculous-el-activator.php
 */
function activate_miraculous_el() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-miraculous-el-activator.php';
	Miraculous_El_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-miraculous-el-deactivator.php
 */
function deactivate_miraculous_el() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-miraculous-el-deactivator.php';
	Miraculous_El_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_miraculous_el' );
register_deactivation_hook( __FILE__, 'deactivate_miraculous_el' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-miraculous-el.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_miraculous_el() {

	$plugin = new Miraculous_El();
	$plugin->run();

}
run_miraculous_el();

/**
 * Class-elementor-mira
 */
require plugin_dir_path( __FILE__ ) . 'class-mira-elementor.php';
