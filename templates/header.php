<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>

<div class='header'>
    <img src="<?php echo esc_url(@$logo_url) ?>" class="logo"/>
    <div class="header-menu">
        <form id="weavely_team_form" method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
            <input type="hidden" name="action" value="weavely_update_team">
            <?php wp_nonce_field( 'weavely_save_team', 'weavely_team_nonce' ); ?>
            <select name="weavely_team" onchange="this.form.submit()">
                <?php foreach ($memberships as $membership): ?>
                    <option value="<?php echo esc_attr($membership['team']['id']); ?>"
                        <?php selected($current_team, $membership['team']['id']); ?>>
                        <?php echo esc_html($membership['team']['name']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </form>
        <form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
            <input type="hidden" name="action" value="weavely_logout">
            <?php submit_button('Logout', 'delete'); ?>
        </form>
    </div>
</div>
