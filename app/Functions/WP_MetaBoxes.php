<?php


namespace App\Functions;
use stdClass;


/**
 * WP_MetaBoxes
 * 
 * Helper class for WP meta boxes
 */

class WP_MetaBoxes {

    final public static function wp_add_meta_box(): void {
        add_meta_box(
            'car_metabox', 
            esc_html__('Cars Settings', 'madman'),
            [self::class, 'render'],
            'car',
            'normal',
            'high'
        );
    }

    final public static function save_meta_box(int $post_id, object $post): int {
        if(isset($_POST['car_price'])){

            update_post_meta($post_id, 'car_price', sanitize_text_field($_POST['car_price']));
        }
        else {
            delete_post_meta($post_id, 'car_price');
        }


        if(isset($_POST['car_gear'])){

            update_post_meta($post_id, 'car_gear', sanitize_text_field($_POST['car_gear']));
        }
        else {
            delete_post_meta($post_id, 'car_gear');
        }

        return $post_id;
    }

    final public static function render(object $post){
        
        $car_price = get_post_meta($post->ID, 'car_price', true);
        $car_gear = get_post_meta($post->ID, 'car_gear', true);

        wp_nonce_field('car_metabox_madman', 'car_metabox_nonce');

        view('templates/metaboxes/->car-meta', 
            ['car_price' => $car_price, 'car_gear' => $car_gear]
        );
        
    }
}

