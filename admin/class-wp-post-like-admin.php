<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://www.augustinfotech.com
 * @since      1.0.0
 *
 * @package    Wp_Post_Like
 * @subpackage Wp_Post_Like/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wp_Post_Like
 * @subpackage Wp_Post_Like/admin
 * @author     August Infotech <hr@augustinfotech.com>
 */
class Wp_Post_Like_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wp-post-like-admin.css', array(), $this->version, 'all' );
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wp-post-like-admin.js', array( 'jquery' ), $this->version, false );
	}

	// Display a column Like in the default admin post table
	public function ai_show_custom_column_like( $columns ) {
		$columns['ai_like'] = 'Like';
		return $columns;
	}

	// Show total like counts in column
	public function ai_display_count_like_column( $column_key, $post_id ) {
		if ( 'ai_like' == $column_key ) {
			$like_count = get_post_meta( $post_id, 'ai_total_likes', true );
			if( $like_count ) {
				echo $like_count;
			} else {
				echo '0';
			}
		}
	}

}
