<?php

namespace WPPluginName\Traits;

if (!defined('ABSPATH')) {
    exit;
}

trait forms
{
    private function is_form_action_valid(): bool {
        $required_action = $this->form_action_name;

        return isset( $_POST['action'] ) && $_POST['action'] == $required_action;
    }

    private function is_security_check_valid(): bool {
        if ( empty( $_POST ) || ! wp_verify_nonce( $_POST['_wpnonce'], $this->form_action_name ) || ! current_user_can( 'manage_options' ) ) {
            return false;
        }

        if ( ! check_admin_referer( $this->form_action_name ) ) {
            return false;
        }

        return true;
    }
}
