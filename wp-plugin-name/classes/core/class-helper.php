<?php

namespace WPPluginName\Core;

if (!defined('ABSPATH')) {
    exit;
}

class Helper
{
    /**
     * Check if the form action is valid and secure.
     *
     * @param string $action_name The name of the action being checked.
     * @param string $capability (Optional) The capability required to perform the action. Default is 'manage_options'.
     *
     * @return void
     */
    public static function post_form_action_check(string $action_name, string $capability = 'manage_options'): void
    {

        if (!isset($_POST['action']) || !isset($_POST['_wpnonce'])) {
            return;
        }

        if ($_POST['action'] != $action_name) {
            die('Security check');
        }

        if (!wp_verify_nonce($_POST['_wpnonce'], $action_name) || !current_user_can($capability)) {
            die('Security check');
        }

        check_admin_referer($action_name);
    }
}
