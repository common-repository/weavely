<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

add_shortcode('weavely_form', 'weavely_form_shortcode');

function weavely_form_shortcode($atts)
{
    // extract the attributes
    $atts = shortcode_atts(
        array(
            'id' => '', // default value for the id
            'width' => '100%', // default value for the width
            'height' => '100%' // default value for the height

        ),
        $atts,
        'weavely_form' // your shortcode tag
    );

    // get the form URL using the id, you'll need to replace this with actual code to get the form URL
    $form_url = 'https://app.weavely.ai/forms/' . $atts['id'];

    if ($form_url) {
        // Output
        $output = '<iframe src="' . esc_url($form_url) . '" style="max-width: 100% !important;width:' . esc_attr($atts['width']) . '; height:' . esc_attr($atts['height']) . ';" frameborder="0"></iframe>';
        return $output;
    } else {
        return 'Invalid form ID.';
    }
}


?>