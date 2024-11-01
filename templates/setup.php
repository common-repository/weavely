<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>

<div class="setup">
    <div class="banner">
        <img src="<?php echo esc_url(@$logo_url) ?>" class="logo"/>
        <span>Build Forms in Figma</span>
    </div>



    <div class="columns">
        <div class="column">
            <span class="step">1</span>
            <h2>Create Your Weavely Account</h2>
            <p><a href="https://app.weavely.ai" target="_blank">Sign up</a> for a free Weavely account and grab your API key. It's quick and free forever.</p>
        </div>
        <div class="column">
            <span class="step">2</span>
            <h2>Design Your Form in Figma</h2>
            <p>Use the <a href="https://www.figma.com/community/plugin/1255122665773297640/weavely-figma-to-web-forms" target="_blank">Weavely plugin</a> in Figma to design a form that fits your needs and matches your style.</p>
        </div>
        <div class="column">
            <span class="step">3</span>
            <h2>Embed Form in WordPress</h2>
            <p>Embed your custom form into your WordPress site using a simple shortcode. Easy, effective, done.</p>
        </div>
    </div>

    <div class="api-key">
        <form method="post" action="options.php">
            <?php settings_fields('weavely_forms'); ?>
            <input type="text"
                   placeholder="Enter API key"
                   name="weavely_forms_api_key"
                   required="true"
                   pattern="^[0-9a-fA-F]{8}-[0-9a-fA-F]{4}-4[0-9a-fA-F]{3}-[89aAbB][0-9a-fA-F]{3}-[0-9a-fA-F]{12}$"
                   value="<?php echo esc_attr($api_key); ?>"/></td>
            <?php submit_button('Submit'); ?>
        </form>
    </div>
</div>

