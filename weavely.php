<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/*
Plugin Name:  Weavely - Build Forms in Figma
Description:  Turn Figma designs into custom forms, effortlessly embed in WordPress. Elevate user experience with unique designs.
Version:      1.0.1
Author:       Weavely
Author URI:   https://www.weavely.ai
License:      GPL2
License URI:  https://www.gnu.org/licenses/gpl-2.0.html
*/

define('WEAVELY_PLUGIN_DIR', plugin_dir_path(__FILE__) );
require_once WEAVELY_PLUGIN_DIR . 'includes/functions.php';
require_once WEAVELY_PLUGIN_DIR . 'includes/actions.php';
require_once WEAVELY_PLUGIN_DIR . 'includes/shortcodes.php';


function weavely_forms_page()
{
    $logo_url = plugins_url('assets/img/logo.svg', __FILE__);
    $table_icon_url = plugins_url('assets/img/table-solid.svg', __FILE__);
    $api_key = get_option('weavely_forms_api_key');
    $memberships = get_option('weavely_memberships', array());
    $current_team = get_option('weavely_current_team');

    $teams = array_column($memberships, 'team');
    $teamKeys = array_column($teams, 'id');
    $key = array_search($current_team, $teamKeys);
    if ($key !== false) {
        $current_team_data = $teams[$key];
    } else if(!empty($teams)){
        $current_team_data = $teams[0]; // Default to the first team if no matching id is found
    }
    ?>

    <div class='weavely'>
        <?php if ($api_key) { ?>
            <?php  include 'templates/header.php'; ?>
            <?php  include 'templates/dashboard.php'; ?>
        <?php } else { ?>
            <?php  include 'templates/setup.php'; ?>
        <?php } ?>
    </div>
<?php } ?>
