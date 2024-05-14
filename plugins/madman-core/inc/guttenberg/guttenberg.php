<?php

/*
 * Registers Custom "About" Guttenberg block 
*/
function guttenberg_about_block(): void {


    if (!function_exists('register_block_type')) {
        echo "Enable Gutenberg before using this feature";
        return;
    }

    wp_register_script(
        'gb-about-script', 
        plugins_url('blocks/js/gb-about.js', __FILE__),
        ['wp-blocks', 'wp-element', 'wp-editor'],
        '1.0',
    );

    wp_register_style(
        'gb-about-style', 
        plugins_url('blocks/css/gb-about.css', __FILE__),
        [],
        '1.0',
    );

    register_block_type('my-gb-block/custom-block-type', [
        'style' => 'gb-about-style',
        'editor_script' => 'gb-about-script',
        
    ]);
}

add_action('init', 'guttenberg_about_block');