<?php
/*
Plugin Name: Custom Ele Addon
Plugin URI: https://github.com/tastycrayon/custom-addon-elementor
Description: This elementor addons helps you to create before and after image comparison slider. It comes with scrolling and touch support to slide the vertical slider over the image to see the before and after difference.
Version: 1.0.0
Author: Mosiur
Author URI: https://github.com/tastycrayon
License: http://www.gnu.org/licenses/gpl-2.0.txt
*/

// don't call the file directly
if (!defined('ABSPATH'))
    exit;

/**
 * CUSTOMELEADDON class
 *
 * @class CUSTOMELEADDON The class that holds the entire CUSTOMELEADDON plugin
 */
class CUSTOMELEADDON
{

    /**
     * Plugin version
     *
     * @var string
     */
    public $version = '1.0.0';

    /**
     * Constructor for the CUSTOMELEADDON class
     *
     * Sets up all the appropriate hooks and actions
     * within our plugin.
     *
     * @uses register_activation_hook()
     * @uses register_deactivation_hook()
     * @uses is_admin()
     * @uses add_action()
     */
    public function __construct()
    {

        // Define all constant
        $this->define_constant();

        //includes file
        $this->includes();

        // init actions and filter
        $this->init_filters();
        $this->init_actions();

        // initialize classes
        $this->init_classes();

        do_action('CUSTOMELEADDON_loaded', $this);
    }

    /**
     * Initializes the CUSTOMELEADDON() class
     *
     * Checks for an existing CUSTOMELEADDON() instance
     * and if it doesn't find one, creates it.
     */
    public static function init()
    {
        static $instance = false;

        if (!$instance) {
            $instance = new CUSTOMELEADDON();
        }

        return $instance;
    }

    /**
     * Placeholder for activation function
     *
     * Nothing being called here yet.
     */
    public static function activate()
    {

    }

    /**
     * Placeholder for deactivation function
     *
     * Nothing being called here yet.
     */
    public static function deactivate()
    {

    }

    /**
     * Defined constant
     *
     * @since 1.0.0
     *
     * @return void
     **/
    private function define_constant()
    {
        define('CUSTOMELEADDON_VERSION', $this->version);
        define('CUSTOMELEADDON_FILE', __FILE__);
        define('CUSTOMELEADDON_PATH', dirname(CUSTOMELEADDON_FILE));
        define('CUSTOMELEADDON_ASSETS', plugins_url('/assets', CUSTOMELEADDON_FILE));
    }

    /**
     * Includes all files
     *
     * @since 1.0.0
     *
     * @return void
     **/
    private function includes()
    {
        // Includes all files in your plugins
    }

    /**
     * Init all filters
     *
     * @since 1.0.0
     *
     * @return void
     **/
    private function init_filters()
    {
        // Load all filters
    }

    /**
     * Init all actions
     *
     * @since 1.0.0
     *
     * @return void
     **/
    private function init_actions()
    {
        // Localize our plugin
        add_action('init', array($this, 'localization_setup'));

        // Loads frontend scripts and styles
        add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));
        add_action('admin_enqueue_scripts', array($this, 'admin_enqueue_scripts'));
    }

    /**
     * Inistantiate all classes
     *
     * @since 1.0.0
     *
     * @return void
     **/
    private function init_classes()
    {
        function register_new_widgets($widgets_manager)
        {

            require_once(__DIR__ . '/widgets/image_comparison.php');

            $widgets_manager->register(new \CustomEleImageComparisonWidget());

        }
        add_action('elementor/widgets/register', 'register_new_widgets');

    }

    /**
     * Initialize plugin for localization
     *
     * @since 1.0.0
     *
     * @uses load_plugin_textdomain()
     */
    public function localization_setup()
    {
        load_plugin_textdomain('customeleaddon', false, dirname(plugin_basename(__FILE__)) . '/languages/');
    }

    /**
     * Enqueue admin scripts
     *
     * @since 1.0.0
     *
     * Allows plugin assets to be loaded.
     *
     * @return void
     */
    public function enqueue_scripts()
    {
        wp_register_style('customeleaddon-styles', CUSTOMELEADDON_ASSETS . '/build/style.css', array(), date('Ymd'));
        wp_register_script('customeleaddon-scripts', CUSTOMELEADDON_ASSETS . '/build/script.js', array(), false, true);
    }

    /**
     * Load admin scripts
     *
     * @since 1.0.0
     *
     * @return void
     **/
    public function admin_enqueue_scripts($hooks)
    {
        // Load your admin scripts.. 
        // not needed for now
    }

} // CUSTOMELEADDON

$CUSTOMELEADDON = CUSTOMELEADDON::init();

register_activation_hook(__FILE__, array('CUSTOMELEADDON', 'activate'));
register_deactivation_hook(__FILE__, array('CUSTOMELEADDON', 'deactivate'));