<?php

namespace WPPluginName\Core;

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @author     Your Name or Your Company
 */
class I18n
{

    /**
     * The text domain of the plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      string $text_domain The text domain of the plugin.
     */
    private string $text_domain;

    /**
     * Initialize the class and set its properties.
     *
     * @param string $plugin_text_domain The text domain of this plugin.
     *
     * @since    1.0.0
     */
    public function __construct(string $plugin_text_domain)
    {

        $this->text_domain = $plugin_text_domain;
    }

    /**
     * Load the plugin text domain for translation.
     *
     * @since    1.0.0
     */
    public function load_plugin_textdomain(): void
    {


        load_plugin_textdomain($this->text_domain,
            false,
            str_replace('src/core/', '', dirname(plugin_basename(__FILE__)) . '/languages'));


    }
}
