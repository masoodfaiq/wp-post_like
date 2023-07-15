<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://www.augustinfotech.com
 * @since      1.0.0
 *
 * @package    Wp_Post_Like
 * @subpackage Wp_Post_Like/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Wp_Post_Like
 * @subpackage Wp_Post_Like/public
 * @author     August Infotech <hr@augustinfotech.com>
 */
class Wp_Post_Like_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wp_Post_Like_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wp_Post_Like_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wp-post-like-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {
		wp_enqueue_script( 'post-like-public-script', plugin_dir_url( __FILE__ ) . 'js/wp-post-like-public.js', array( 'jquery' ), $this->version, false );
		wp_localize_script( 'post-like-public-script', 'ai_ajax_obj', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
	}

	/**
	 * Function for showing the like button below the title of the posts.
	 *
	 * @since    1.0.0
	 */
	public function ai_show_title_callback( $title ) {
		if( is_single() ) {
			global $post;
			$like_btn = '<br><a href="#" class="ai_like_btn" data-postid="'. $post->ID .'">Like</a>';
			return $title . $like_btn;
		} else {
			return $title;
		}
		
	}

	// Process the like functionality
	public function ai_process_like_callback( ) { 
		$post_id    = isset( $_POST['post_id'] ) ? sanitize_text_field( wp_unslash(  $_POST['post_id'] ) ) : '';
		$like_count = get_post_meta( $post_id, 'ai_total_likes', true );
		$like_count = ! empty( $like_count ) ? $like_count : 0;
		$new_like_count = $like_count + 1;
		update_post_meta( $post_id, 'ai_total_likes', $new_like_count );
		echo json_encode(
			array(
				'code' => '200',
				'message' => 'Successfully Liked',
			)
		);
		wp_die();
	}

	// Function is work in case of no login
	public function ai_process_like_nologin_callback() {
		echo json_encode(
			array(
				'code' => '400',
				'message' => 'Sorry you cannot like the post because You are not Login',
			)
		);
		wp_die();
	}
}
