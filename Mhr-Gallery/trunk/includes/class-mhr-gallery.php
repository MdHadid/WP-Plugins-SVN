<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://mhrthemes.com
 * @since      1.0.0
 *
 * @package    Mhr_Gallery
 * @subpackage Mhr_Gallery/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Mhr_Gallery
 * @subpackage Mhr_Gallery/includes
 * @author     MhrThemes <md.hadidrahman@gmail.com>
 */
class Mhr_Gallery {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Mhr_Gallery_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'MHR_GALLERY_VERSION' ) ) {
			$this->version = MHR_GALLERY_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'mhr-gallery';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Mhr_Gallery_Loader. Orchestrates the hooks of the plugin.
	 * - Mhr_Gallery_i18n. Defines internationalization functionality.
	 * - Mhr_Gallery_Admin. Defines all hooks for the admin area.
	 * - Mhr_Gallery_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-mhr-gallery-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-mhr-gallery-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-mhr-gallery-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-mhr-gallery-public.php';

		$this->loader = new Mhr_Gallery_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Mhr_Gallery_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Mhr_Gallery_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Mhr_Gallery_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Mhr_Gallery_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Mhr_Gallery_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}

function mhrthemes_gallery() {

    register_post_type('photogallery', array(

    'labels'       => array( 
    'name'         => 'PhotoGallery',
    'add_new_item' => __('Add New Item', 'mhr-gallery')
    
    ),
      
    'public'   =>  true,
    'supports' => array('title', 'editor', 'thumbnail'),
    'menu_position' => 8    
        
    ));

    register_post_type('videogallery', array(
	
    'labels'       => array( 
    'name'         => 'VideoGallery',
	'add_new_item' => __('Pro Version Only', 'mhr-gallery')

	),
	  
	'public'   =>  true,
	'supports' => array(''),
	'menu_position' => 9
		
	));
} 

add_action('init', 'mhrthemes_gallery');

function mhr_photo_gallery_shortcode() {

    $photo_gallery_list = '<div class="uk-child-width-1-5@m" uk-grid uk-lightbox="animation: slide">';

        $photo_items = new WP_Query(array(
            'post_type' => 'photogallery'
        ));

    while( $photo_items->have_posts() ) : $photo_items->the_post();

    $photo_gallery_list  .= '<div>'.'<a class="uk-inline" href="'.get_the_post_thumbnail_url().'">'.get_the_post_thumbnail().
    '<div class="uk-position-center uk-panel">'.'<h4 style="color:#fff;font-size:30px;">'.get_the_title().'</h4>'.'</div>'.'</a>'.'</div>';

    endwhile; 
                        
    $photo_gallery_list .= '</div>';

    return $photo_gallery_list;
    
}

add_shortcode('mhr_photo_gallery', 'mhr_photo_gallery_shortcode');

function mhr_video_gallery_shortcode() {

    $video_gallery_list = '<div class="uk-child-width-1-3@m" uk-grid>';

        $video_items = new WP_Query(array(
            'post_type' => 'videogallery'
        ));

    while( $video_items->have_posts() ) : $video_items->the_post();

    $video_gallery_list  .= '<div>'.'<iframe width="729" height="410" src="https://www.youtube.com/embed/'.get_post_meta( get_the_ID(), "yid", true ).'" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope;" allowfullscreen uk-responsive>'.'</iframe>'.'</div>';

    endwhile; 
                        
    $video_gallery_list .= '</div>';

    return $video_gallery_list;
    
}

add_shortcode('mhr_video_gallery', 'mhr_video_gallery_shortcode');
