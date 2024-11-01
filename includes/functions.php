<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

function weavely_add_plugin_menu_page()
{
    $icon_url = plugins_url('../assets/img/menu-icon.svg', __FILE__);
    add_menu_page(
        'Weavely', // Page Title
        'Weavely', // Menu Title
        'manage_options', // Capability
        'weavely_forms', // Menu Slug
        'weavely_forms_page', // Function
        $icon_url, // Icon URL
        6 // Position
    );
}

function weavely_api_key_settings()
{
    register_setting('weavely_forms', 'weavely_forms_api_key', 'weavely_validate_api_key');
}

function weavely_validate_api_key($api_key)
{
    // Make a GET request to your API endpoint
    $response = wp_remote_get('https://api.weavely.ai/users', array(
        'headers' => array(
            'weavely-api-key' => $api_key
        )
    ));

    // Check if the request is successful
    if (is_wp_error($response)) {
        // If there's an error, add an error message to the settings page
        add_settings_error('weavely_forms_api_key', 'weavely_api_key_error', 'Invalid API Key. Please try again.');
        return false;
    } else {
        // If the request is successful, retrieve the body and decode the JSON
        $body = wp_remote_retrieve_body($response);
        $data = json_decode($body, true);

        // Store the user's name in a WordPress option
        update_option('weavely_user_name', $data['name']);
        update_option('weavely_memberships', $data['memberships']);
        update_option('weavely_current_team', $data['memberships'][0]['team']['id']);

        return $api_key;
    }
}

function weavely_reset_api_key()
{
    $referer = wp_get_referer();
    if (false !== $referer) {
        delete_option('weavely_forms_api_key');
        wp_redirect(esc_url_raw($referer));
        exit;
    }
}

function weavely_get_forms($team_id, $api_key)
{
    $response = wp_remote_get('https://api.weavely.ai/forms?team=' . $team_id, array(
        'headers' => array(
            'weavely-api-key' => $api_key
        )
    ));

    if (is_wp_error($response)) {
        $error_message = $response->get_error_message();
        echo "Something went wrong:" . esc_html($error_message);
    } else {
        return json_decode(wp_remote_retrieve_body($response), true);
    }
}

function weavely_handle_update_team()
{
    // Check if our nonce is set and verify it.
    if ( ! isset( $_POST['weavely_team_nonce'] ) || ! wp_verify_nonce(  sanitize_text_field( wp_unslash ( $_POST['weavely_team_nonce'])), 'weavely_save_team' ) ) {
        return;
    }

    // Update the current team option with the submitted team ID
    update_option('weavely_current_team', isset($_POST['weavely_team']) ? sanitize_text_field($_POST['weavely_team']) : '');

    // Redirect back to the form page
    wp_redirect(admin_url('admin.php?page=weavely_forms'));
    exit;
}

function weavely_enqueue_styles()
{
    wp_enqueue_style('weavely-forms-styles', plugins_url('../style.css', __FILE__), array(), '1.0.0');
}

?>