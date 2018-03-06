<?php

/*
  Plugin Name: Rentify Theme Helper
  Plugin URI: https://uouapps.com
  Description: Basic theme functionality for sb like custom post type , custom taxonomy , shortcodes etc.
  Version: 1.0.0
  Author: Uouapps
  Author URI: http://www.uouapps.com
  
 */


if ( apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) )  {


	class Rentify_Theme_Helper {
		private static $instance = null;
		private $plugin_path;
		private $plugin_url;
	    private $text_domain = '';

		/**
		 * Creates or returns an instance of this class.
		 */
		public static function get_instance() {
			// If an instance hasn't been created and set to $instance create an instance and set it to $instance.
			if ( null == self::$instance ) {
				self::$instance = new self;
			}

			return self::$instance;
		}

		/**
		 * Initializes the plugin by setting localization, hooks, filters, and administrative functions.
		 */
		private function __construct() {
			
			$this->plugin_path = plugin_dir_path( __FILE__ );
			$this->plugin_url  = plugin_dir_url( __FILE__ );

			load_plugin_textdomain( $this->text_domain, false, $this->plugin_path . '/language' );

			add_action( 'admin_enqueue_scripts', array( $this, 'register_sb_scripts' ) );
			add_action( 'admin_enqueue_scripts', array( $this, 'register_sb_styles' ) );

			add_action( 'wp_enqueue_scripts', array( $this, 'register_sb_scripts' ) );
			add_action( 'wp_enqueue_scripts', array( $this, 'register_sb_styles' ) );

			register_activation_hook( __FILE__, array( $this, 'activation' ) );
			register_deactivation_hook( __FILE__, array( $this, 'deactivation' ) );

			$this->sb_run_plugin();
		}

		public function get_plugin_url() {
			return $this->plugin_url;
		}

		public function get_plugin_path() {
			return $this->plugin_path;
		}

	    /**
	     * Place code that runs at plugin activation here.
	     */
	    public function activation() {

		}

	    /**
	     * Place code that runs at plugin deactivation here.
	     */
	    public function deactivation() {

		}

	    /**
	     * Enqueue and register JavaScript files here.
	     */
	    public function register_sb_scripts() {

		}

	    /**
	     * Enqueue and register CSS files here.
	     */
	    public function register_sb_styles() {

		}



	    /**
	     * Place code for your plugin's functionality here.
	     */
	    private function sb_run_plugin() {


	    	include( 'cuztom/cuztom.php' );
	    	include( 'shortcodes/shortcodes.php' );
	    	include( 'cpt-taxonomy-metabox/cpt-tax-metabox.php' );

	    	

		}


	}

	Rentify_Theme_Helper::get_instance();

}else{
    function rentify_basic_theme_functionality_admin_notice() {
        ?>
        <div class="error">
            <p><?php _e( 'Please Install WooCommerce First before activating rentify theme helper Plugin. You can download WooCommerce from <a href="http://wordpress.org/plugins/woocommerce/">here</a>.', 'sb_Basic_Theme_Functionality' ); ?></p>
        </div>
        <?php
    }
    add_action( 'admin_notices', 'rentify_basic_theme_functionality_admin_notice' );
}



