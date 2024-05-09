<?php

function wp_add_meta_box(): void
{
    add_meta_box(
        'car_metabox',
        esc_html__('Cars Settings', 'madman'),
        'render',
        'car',
        'normal',
        'high'
    );
}

// add_action('add_meta_boxes', 'wp_add_meta_box');


function render(object $post)
{

    $car_price = get_post_meta($post->ID, 'car_price', true);
    $car_gear = get_post_meta($post->ID, 'car_gear', true);

    wp_nonce_field('car_metabox_madman', 'car_metabox_nonce');

    view(
        'templates/metaboxes/->car-meta',
        ['car_price' => $car_price, 'car_gear' => $car_gear]
    );

}

function save_meta_box(int $post_id, object $post): int
{


    if (!isset($_POST['car_metabox_nonce']) || !wp_verify_nonce($_POST['car_metabox_nonce'], 'car_metabox_madman')) {

        return $post_id;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {

        return $post_id;
    }

    if ($post->post_type !== 'car') {

        return $post_id;
    }

    $post_type = get_post_type_object($post->post_type);
    if (!current_user_can($post_type->cap->edit_post, $post_id)) {

        return $post_id;
    }



    // Save data

    if (isset($_POST['car_price'])) {

        update_post_meta($post_id, 'car_price', sanitize_text_field($_POST['car_price']));
    } else {
        delete_post_meta($post_id, 'car_price');
    }


    if (isset($_POST['car_gear'])) {

        update_post_meta($post_id, 'car_gear', sanitize_text_field($_POST['car_gear']));
    } else {
        delete_post_meta($post_id, 'car_gear');
    }

    return $post_id;
}

add_action('save_post', 'save_meta_box', 10, 2);
