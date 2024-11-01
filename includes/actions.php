<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

add_action('admin_menu', 'weavely_add_plugin_menu_page');
add_action('admin_init', 'weavely_api_key_settings');
add_action('admin_post_weavely_logout', 'weavely_reset_api_key');
add_action('admin_post_weavely_update_team', 'weavely_handle_update_team');
add_action('admin_enqueue_scripts', 'weavely_enqueue_styles');

?>