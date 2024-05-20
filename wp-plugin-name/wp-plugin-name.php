<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @wordpress-plugin
 * Plugin Name:       WordPress Plugin Boilerplate
 * Description:       This is a short description of what the plugin does.
 * Version:           1.0.0
 * Author:            Your Name or Your Company
 * Requires at least: 6.5
 * Requires PHP:      8.1
 * Author URI:        http://example.com
 * Text Domain:       wp-plugin-name
 * Domain Path:       /languages
 */

namespace WPPluginName;

use WPPluginName\Core\Init;

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Define Constants
 */

define('WP_PLUGIN_NAME', 'wp-plugin-name');

define('WP_PLUGIN_PREFIX', 'wp_plugin_name_');

define('WP_PLUGIN_VERSION', '1.0.0');

define('WP_PLUGIN_DIR_PATH', plugin_dir_path(__FILE__));

define('WP_PLUGIN_DIR_URL', plugin_dir_url(__FILE__));

define('WP_PLUGIN_BASENAME', plugin_basename(__FILE__));


/**
 * Autoloading, via Composer.
 *
 * @link https://getcomposer.org/doc/01-basic-usage.md#autoloading
 */
if (file_exists(dirname(__FILE__) . '/vendor/autoload.php')) {
    require_once dirname(__FILE__) . '/vendor/autoload.php';
}

/**
 * Register Activation and Deactivation Hooks
 * This action is documented in src/core/class-activator.php
 */

register_activation_hook(__FILE__, array(__NAMESPACE__ . '\Core\Activator', 'activate'));

/**
 * The code that runs during plugin deactivation.
 * This action is documented src/core/class-deactivator.php
 */

register_deactivation_hook(__FILE__, array(__NAMESPACE__ . '\Core\Deactivator', 'deactivate'));


/**
 * Plugin Singleton Container
 *
 * Maintains a single copy of the plugin app object
 *
 * @since    1.0.0
 */
class WP_Plugin_Name
{


    private static $init;

    /**
     * Loads the plugin
     *
     * @access    public
     */
    public static function init(): ?Init {

        if ( null === self::$init ) {
            self::$init = new Init();
            self::$init->run();
        }

        return self::$init;
    }

}


/**
 * Initialize all the core classes of the plugin
 */
WP_Plugin_Name::init();
