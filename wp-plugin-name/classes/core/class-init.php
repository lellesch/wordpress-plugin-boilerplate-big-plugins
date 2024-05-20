<?php

namespace WPPluginName\Core;

if (!defined('ABSPATH')) {
    exit;
}


use WPPluginName\Admin;
use WPPluginName\Frontend;
use WPPluginName\Core\I18n;

/**
 * Class Init
 *
 * The Init class is responsible for initializing and defining the core functionality of the plugin.
 *
 * @package     MyPlugin
 */
class Init
{


    /**
     * The loader that's responsible for maintaining and registering all hooks that power
     * the plugin.
     *
     * @var      Loader $loader Maintains and registers all hooks for the plugin.
     */
    protected Loader $loader;

    /**
     * The unique identifier of this plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      string $plugin_base_name The string used to uniquely identify this plugin.
     */
    protected string $plugin_basename;

    /**
     * The current version of the plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      string $version The current version of the plugin.
     */
    protected string $version;


    /**
     * The plugin_name slug of the Plugin
     * @var string
     */
    protected string $plugin_name;

    /**
     * The plugin_prefix_name slug of the Plugin
     * @var string
     */
    protected string $plugin_prefix_name;

    /**
     * Initialize and define the core functionality of the plugin.
     */
    public function __construct()
    {

        $this->plugin_name = WP_PLUGIN_NAME;
        $this->plugin_prefix_name = WP_PLUGIN_PREFIX;
        $this->version = WP_PLUGIN_VERSION;
        $this->plugin_basename = WP_PLUGIN_BASENAME;

        $this->load_dependencies();
        $this->set_locale();
        $this->define_admin_hooks();
        $this->define_public_hooks();
    }

    /**
     * Loads the following required dependencies for this plugin.
     *
     * - Loader - Orchestrates the hooks of the plugin.
     * - Internationalization_I18n - Defines internationalization functionality.
     * - Admin - Defines all hooks for the admin area.
     * - Frontend - Defines all hooks for the public side of the site.
     *
     * @access    private
     */
    private function load_dependencies(): void
    {
        $this->loader = new Loader();
    }

    /**
     * Define the locale for this plugin for internationalization.
     *
     * Uses the Internationalization_I18n class in order to set the domain and to register the hook
     * with WordPress.
     *
     * @access    private
     */
    private function set_locale(): void
    {

        $plugin_i18n = new I18n($this->plugin_name);

        $this->loader->add_action('plugins_loaded', $plugin_i18n, 'load_plugin_textdomain');
    }

    /**
     * Register all of the hooks related to the admin area functionality
     * of the plugin.
     *
     * @access    private
     */
    private function define_admin_hooks(): void
    {

        $plugin_admin = new Admin\Admin($this->get_plugin_name(), $this->get_plugin_prefix_name(), $this->get_version());

        $this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_styles');
        $this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts');

        //admin menu pages
        $this->loader->add_action('admin_menu', $plugin_admin, 'add_plugin_admin_menu');

        /*
         * Additional Hooks go here
         *
         * e.g.
         *
         * //admin menu pages
         * $this->loader->add_action('admin_menu', $plugin_admin, 'add_plugin_admin_menu');
         *
         *  //plugin action links
         * $this->loader->add_filter( 'plugin_action_links_' . $this->plugin_basename, $plugin_admin, 'add_additional_action_link' );
         *
         * //Cronjobs
         * $plugin_cronjob = Cronjob::get_instance(); and in Activator Cronjob::get_instance()->activate_cron();
         */
    }

    /**
     * Register all of the hooks related to the public-facing functionality
     * of the plugin.
     *
     * @access    private
     */
    private function define_public_hooks(): void
    {

        $plugin_public = new Frontend\Frontend($this->get_plugin_name(), $this->get_plugin_prefix_name(), $this->get_version());

        $this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_styles');
        $this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_scripts');

    }

    /**
     * Run the loader to execute all of the hooks with WordPress.
     */
    public function run(): void
    {
        $this->loader->run();
    }

    /**
     * The name of the plugin used to uniquely identify it within the context of
     * WordPress and to define internationalization functionality.
     */
    public function get_plugin_name(): string
    {
        return $this->plugin_name;
    }

    /**
     * The Prefix name of the plugin used to uniquely identify it within the context of
     * WordPress and to define internationalization functionality.
     */
    public function get_plugin_prefix_name(): string
    {
        return $this->plugin_prefix_name;
    }

    /**
     * The reference to the class that orchestrates the hooks with the plugin.
     *
     * @return    Loader    Orchestrates the hooks of the plugin.
     */
    public function get_loader(): Loader
    {
        return $this->loader;
    }

    /**
     * Retrieve the version number of the plugin.
     *
     * @return    string    The version number of the plugin.
     * @since     1.0.0
     */
    public function get_version(): string
    {
        return $this->version;
    }
}
