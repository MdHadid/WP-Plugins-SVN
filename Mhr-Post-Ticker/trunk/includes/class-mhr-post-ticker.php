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
 * @package    Mhr_Post_Ticker
 * @subpackage Mhr_Post_Ticker/includes
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
 * @package    Mhr_Post_Ticker
 * @subpackage Mhr_Post_Ticker/includes
 * @author     MhrThemes <md.hadidrahman@gmail.com>
 */
class Mhr_Post_Ticker {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Mhr_Post_Ticker_Loader    $loader    Maintains and registers all hooks for the plugin.
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
		if ( defined( 'MHR_POST_TICKER_VERSION' ) ) {
			$this->version = MHR_POST_TICKER_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'mhr-post-ticker';

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
	 * - Mhr_Post_Ticker_Loader. Orchestrates the hooks of the plugin.
	 * - Mhr_Post_Ticker_i18n. Defines internationalization functionality.
	 * - Mhr_Post_Ticker_Admin. Defines all hooks for the admin area.
	 * - Mhr_Post_Ticker_Public. Defines all hooks for the public side of the site.
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
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-mhr-post-ticker-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-mhr-post-ticker-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-mhr-post-ticker-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-mhr-post-ticker-public.php';

		$this->loader = new Mhr_Post_Ticker_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Mhr_Post_Ticker_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Mhr_Post_Ticker_i18n();

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

		$plugin_admin = new Mhr_Post_Ticker_Admin( $this->get_plugin_name(), $this->get_version() );

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

		$plugin_public = new Mhr_Post_Ticker_Public( $this->get_plugin_name(), $this->get_version() );

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
	 * @return    Mhr_Post_Ticker_Loader    Orchestrates the hooks of the plugin.
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

function mhr_post_ticker() {
    
    // General Section
    add_settings_section('general_sections', 'General Options', 'general_function', 'ticker_options');  

    add_settings_field('heading_text', 'Header Title', 'heading_function', 'ticker_options', 'general_sections'); 

    add_settings_field('posts_number', 'Number of Posts', 'count_function', 'ticker_options', 'general_sections'); 

    add_settings_field('category_name', 'Filter by Category', 'category_function', 'ticker_options', 'general_sections');

    add_settings_field('tag_name', 'Filter by Tag', 'tag_function', 'ticker_options', 'general_sections');

    register_setting('general_sections', 'new_settings');

    // Color Section
    add_settings_section('color_sections', 'Color Options', 'color_function', 'ticker_options'); 

    add_settings_field('content_background_color', 'Write Content Background Color Code', 'content_bg_color_function', 'ticker_options', 'color_sections'); 

    add_settings_field('heading_color', 'Write Heading Color Code', 'heading_color_function', 'ticker_options', 'color_sections');

    add_settings_field('heading_background_color', 'Write Heading Background Color Code', 'heading_bg_color_function', 'ticker_options', 'color_sections');
    
    add_settings_field('item_color', 'Write Item Color Code', 'item_color_function', 'ticker_options', 'color_sections');

    add_settings_field('item_background_color', 'Write Item Background Color Code', 'item_bg_color_function', 'ticker_options', 'color_sections');

    register_setting('color_sections', 'new_settings');

}

add_action('admin_init', 'mhr_post_ticker');

function general_function() {
	echo "<p>You may add or changes all your ticker options from here...</p>";
    echo "<h2><a href='https://www.templatemonster.com/wordpress-plugins/mhr-post-ticker-ticker-wordpress-plugin-98860.html' target='_blank'>Buy Premium Version</a></h2>";
}

function heading_function() {

    $var_heading     = (array)get_option('new_settings');
    $var_heading_new = $var_heading['heading_text'];

    echo '<input type="text" name="new_settings[heading_text]" value="'.$var_heading_new.'" class="regular-text">';
}

function count_function() {

    $var_posts       = (array)get_option('new_settings');
    $var_posts_new   = $var_posts['posts_number'];
  
    echo '<input type="number" name="new_settings[posts_number]" value="'.$var_posts_new.'" placeholder="Pro Version Only" class="regular-text" disabled>';
}

function category_function() {

    $category_posts       = (array)get_option('new_settings');
    $category_posts_new   = $category_posts['category_name'];
  
    echo '<input type="text" name="new_settings[category_name]" value="'.$category_posts_new.'" placeholder="Pro Version Only" class="regular-text" disabled>';
}

function tag_function() {

    $tag_posts       = (array)get_option('new_settings');
    $tag_posts_new   = $tag_posts['tag_name'];
  
    echo '<input type="text" name="new_settings[tag_name]" value="'.$tag_posts_new.'" placeholder="Pro Version Only" class="regular-text" disabled>';
}

function color_function() {
    echo "<p>You may add or changes all your color options from here...</p>";
    echo "<h2><a href='https://www.templatemonster.com/wordpress-plugins/mhr-post-ticker-ticker-wordpress-plugin-98860.html' target='_blank'>Buy Premium Version</a></h2>";
}

function content_bg_color_function() {

    $content_bg_color      = (array)get_option('new_settings');
    $content_bg_color_new  = $content_bg_color['content-bg-color'];

    echo '<input type="text" name="new_settings[content-bg-color]" value="'.esc_url($content_bg_color_new).'" placeholder="Pro Version Only" class="regular-text" disabled>';

}

function heading_color_function() {

    $heading_color      = (array)get_option('new_settings');
    $heading_color_new  = $heading_color['heading-color'];

    echo '<input type="text" name="new_settings[heading-color]" value="'.esc_url($heading_color_new).'" placeholder="Pro Version Only" class="regular-text" disabled>';
}

function heading_bg_color_function() {

    $heading_bg_color      = (array)get_option('new_settings');
    $heading_bg_color_new  = $heading_bg_color['heading-bg-color'];

    echo '<input type="text" name="new_settings[heading-bg-color]" value="'.esc_url($heading_bg_color_new).'" placeholder="Pro Version Only" class="regular-text" disabled>';
}

function item_color_function() {

    $item_color      = (array)get_option('new_settings');
    $item_color_new  = $item_color['item-color'];

    echo '<input type="text" name="new_settings[item-color]" value="'.esc_url($item_color_new).'" placeholder="Pro Version Only" class="regular-text" disabled>';
}

function item_bg_color_function() {

    $item_bg_color      = (array)get_option('new_settings');
    $item_bg_color_new  = $item_bg_color['item-bg-color'];

    echo '<input type="text" name="new_settings[item-bg-color]" value="'.esc_url($item_bg_color_new).'" placeholder="Pro Version Only" class="regular-text" disabled>';
}

function new_menu() {
    add_menu_page('Mhr Post Setting', 'Mhr Ticker', 'manage_options', 'ticker_options', 'menu_function', 'dashicons-move', '58');
}
   
add_action('admin_menu', 'new_menu');

function menu_function() { ?>

    <div class="wrap">
        <?php settings_errors(); ?>
        <form action="options.php" method="POST"> 
            <?php do_settings_sections('ticker_options'); ?> 
            <?php settings_fields('general_sections'); ?> 
            <?php settings_fields('color_sections'); ?>
            <?php submit_button(); ?> 
        </form>
    </div>

<?php }

function mhr_ticker_list($atts) { 
      
    $var_heading = (array)get_option('new_settings');
    
    $list = '<div class="content"><div class="simple-marquee-container"><div class="marquee-sibling">'.$var_heading['heading_text'].

    $list .= '</div><div class="marquee"><ul class="marquee-content-items">'; 
    
    $var_posts            = (array)get_option('new_settings');
    $category_posts       = (array)get_option('new_settings');
    $tag_posts            = (array)get_option('new_settings');

    $ticker_post = new Wp_Query(array(
        'post_type'      => 'post'
    ));

    while( $ticker_post->have_posts() ) : $ticker_post->the_post();
		$list .='<li>'.'<a href="'.get_the_permalink().'">'.get_the_title().'</a>'.'</li>';
	endwhile;
   
    $list .= '</ul></div></div></div>';

    return $list;

}

add_shortcode('mhr_post_ticker', 'mhr_ticker_list'); 

function mhr_post_ticker_custom_js() { ?>

    <script>
		jQuery( function () {

			jQuery('.simple-marquee-container').SimpleMarquee();
			
		} );
	</script>

<?php }

add_action( 'wp_footer', 'mhr_post_ticker_custom_js' );
