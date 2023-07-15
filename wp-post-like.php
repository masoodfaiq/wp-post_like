<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://www.augustinfotech.com
 * @since             1.0.0
 * @package           Wp_Post_Like
 *
 * @wordpress-plugin
 * Plugin Name:       WP Post Like by AI
 * Plugin URI:        https://www.augustinfotech.com
 * Description:       WP Post Like by AI
 * Version:           1.0.0
 * Author:            August Infotech
 * Author URI:        https://www.augustinfotech.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wp-post-like
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
define( 'WP_POST_LIKE_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wp-post-like-activator.php
 */
function activate_wp_post_like() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-post-like-activator.php';
	Wp_Post_Like_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wp-post-like-deactivator.php
 */
function deactivate_wp_post_like() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-post-like-deactivator.php';
	Wp_Post_Like_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_wp_post_like' );
register_deactivation_hook( __FILE__, 'deactivate_wp_post_like' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wp-post-like.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_wp_post_like() {

	$plugin = new Wp_Post_Like();
	$plugin->run();

}
run_wp_post_like();
