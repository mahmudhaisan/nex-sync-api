<?php

/**
 * Plugin Name: Nex Auto Sync
 * Plugin URI: https://github.com/mahmudhaisan/team-members
 * Description: This plugin allows to create a new team member custom post type where user will be able to add their members data.
 * Version: 1.0
 * Author: Mahmud haisan
 * Author URI: https://github.com/mahmudhaisan
 * Developer: Mahmud Haisan
 * Developer URI: https://github.com/mahmudhaisan
 * Text Domain: nexautosync
 * Domain Path: /languages
 * License: GNU General Public License v3.0
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 */

if (!defined('ABSPATH')) {
    exit;
}

require_once __DIR__ . '/vendor/autoload.php';





/**
 * The Main Plugin Class
 */

final class Nex_Auto_Sync_Solutions {



    /**
     *  * plugin version
     * @var string
     */
    const VERSION = '1.0';

    /**
     * Class Constructor
     */
    private function __construct() {
        $this->define_Plugin_comstants();
        register_activation_hook(__FILE__, [$this, 'activate']); // activation hook
        add_action('plugins_loaded', [$this, 'init_plugin']); //plugin init
        add_action('wp_enqueue_scripts', [$this, 'enqueue_files']);
    }

    /**
     * Initialize Singleton Instance
     */
    public static function init() {
        static $instance = false;

        if (!$instance) {
            $instance = new self();
        }

        return $instance;
    }

    /**
     * Define Plugin Constants
     */
    public function define_Plugin_comstants() {
        define('NEX_SYNC_PLUGIN_VERSION', self::VERSION);
        define('NEX_SYNC_FILE_PATH', __FILE__);
        define('NEX_SYNC_DIR_PATH', __DIR__);
        define('NEX_SYNC_PLUGIN_URL', plugins_url('', NEX_SYNC_FILE_PATH));
        define('NEX_SYNC_PLUGIN_ASSETS', NEX_SYNC_PLUGIN_URL . '/assets');
    }


    /**
     * plugin activation callback function
     *
     * @return void
     */
    public function activate() {

        update_option('nex_sync_plugin_version', NEX_SYNC_PLUGIN_VERSION);
    }

    /**
     * plugins activity after activating the plugin
     *
     * @return plugins basic things
     */
    public function init_plugin() {
        // works for backend
        if (is_admin()) {
            new Sync\Api\Admin();
            // new  Sync\Api\Admin(); // admin menu class initialize
        } else { // for elsewhere
            new  Sync\Api\Frontend(); // Frontend class initialize
        }
    }

    //enqueue files
    public  function enqueue_files() {
        // style
        wp_enqueue_style('bootstrap-file', NEX_SYNC_PLUGIN_ASSETS . '/css/bootstrap.min.css');
        wp_enqueue_style('style-file', NEX_SYNC_PLUGIN_ASSETS . '/css/style.css');

        //scripts
        wp_enqueue_script('bootstrap-file', NEX_SYNC_PLUGIN_ASSETS . '/js/bootstrap.min.js', array(), false, true);
        wp_enqueue_script('script_file', NEX_SYNC_PLUGIN_ASSETS . '/js/script.js', array('jquery'), false, true);
    }
}


/**
 * Initialize Main Plugin
 *
 * @return \Nex_Auto_Sync_Solutions
 */

function sync_solutions() {
    return Nex_Auto_Sync_Solutions::init();
}

// calling the main class instance
sync_solutions();
