<?php

function madman_ajax_handle(): void {
    
    if(!wp_verify_nonce($_REQUEST['nonce'], 'madman-ajax-nonce')) {
      
        wp_die();
    }

    $name = $_REQUEST['name'] ?? '';


    $cars = new WP_Query(array(
        'post_type' => 'car',
        'per_page' => -1,
        
    ));

    if($cars->have_posts()) {
        echo wp_json_encode(array(
            'posts' => $cars->posts
        ));  
    
    }

    wp_reset_postdata();
   

    wp_die();
}

add_action('wp_ajax_madman_ajax_handle', 'madman_ajax_handle');
add_action('wp_ajax_nopriv_madman_ajax_handle', 'madman_ajax_handle');