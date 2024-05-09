<?php

function wp_register_brands_taxonomy(): void
{
    $args = [
        'hierarchical' => false,
        'labels' => [
            'name' => esc_html__('Brands', 'madman'),
            'singular_name' => esc_html__('Brand', 'madman'),
            'search_items' => esc_html__('Search brands', 'madman'),
            'all_items' => esc_html__('All brands', 'madman'),
            'parent_item' => esc_html__('Parent brand', 'madman'),
            'parent_item_colon' => esc_html__('Parent brand:', 'madman'),
            'edit_item' => esc_html__('Edit brand', 'madman'),
            'update_item' => esc_html__('Update brand', 'madman'),
            'add_new_item' => esc_html__('Add new brand', 'madman'),
            'new_item_name' => esc_html__('New brand name', 'madman'),
            'menu_name' => esc_html__('Brands', 'madman'),

        ],

        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => true,
        'show_admin_column' => true,
        'rewrite' => ['slug' => 'brands'],
        'query_var' => true,
        'show_in_rest' => true,

    ];

    if (!taxonomy_exists('brand')) {
        register_taxonomy('brand', ['car'], $args);
    }

}

add_action('init', 'wp_register_brands_taxonomy');