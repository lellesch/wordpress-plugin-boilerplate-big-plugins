<?php

namespace WPPluginName\Admin;

if (!defined('ABSPATH')) {
    exit;
}

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @author    Your Name or Your Company
 */
class Admin
{

    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string $plugin_name The ID of this plugin.
     */
    private string $plugin_name;

    /**
     * The Prefix ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string $plugin_prefix_name The ID of this plugin.
     */
    private string $plugin_prefix_name;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string $version The current version of this plugin.
     */
    private string $version;

    /**
     * Initialize the class and set its properties.
     *
     * @param string $plugin_name The name of this plugin.
     * @param string $plugin_prefix_name
     * @param string $version The version of this plugin.
     * @since       1.0.0
     */
    public function __construct(string $plugin_name, string $plugin_prefix_name, string $version)
    {

        $this->plugin_name = $plugin_name;
        $this->plugin_prefix_name = $plugin_prefix_name;
        $this->version = $version;
    }

    /**
     * Register the stylesheets for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_styles(): void
    {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        wp_enqueue_style($this->plugin_name, WP_PLUGIN_DIR_URL . 'assets/css/admin.css', array(), $this->version, 'all');
    }

    /**
     * Register the JavaScript for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts(): void
    {
        /*
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        wp_enqueue_script($this->plugin_name, WP_PLUGIN_DIR_URL . 'assets/js/admin.js', array('jquery'), $this->version, false);
    }

    public function add_plugin_admin_menu(): void
    {

        add_menu_page(__('Test Menu', $this->plugin_name), __('Test Menu', $this->plugin_name), 'manage_options', 'test', [$this,
            'render_test_page'
        ], '');
    }

    public function render_test_page(): void
    {

    }
}
