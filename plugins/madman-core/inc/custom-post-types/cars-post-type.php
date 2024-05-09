<?php

function wp_register_cars_post_type(): void
{

    if (!post_type_exists('car')) {
        register_post_type('car', [
            'label' => esc_html__('Cars', 'madman'),
            'labels' => [
                'name' => esc_html__('Cars', 'madman'),
                'singular_name' => esc_html__('Car', 'madman'),
                'menu_name' => 'Cars',
                'all_items' => 'All Cars',
                'add_new' => 'Add car',
                'add_new_item' => 'Add new car',
                'edit_item' => 'Edit cars',
                'new_item' => 'New car',
                'view_item' => 'View cars',
                'items_list' => 'Cars list',
                'items_list_navigation' => 'Cars list navigation',
                'search_items' => 'Search cars',
                'not_found' => 'No cars found',
                'not_found_in_trash' => 'No cars found in trash',
                'parent_item_colon' => 'Parent car:',
                'featured_image' => 'Car image',
                'set_featured_image' => 'Set car image',
                'remove_featured_image' => 'Remove car image',
                'use_featured_image' => 'Use as car image',
                'archives' => 'Car archives',
                'insert_into_item' => 'Insert into car',
                'uploaded_to_this_item' => 'Uploaded to this car',
            ],
            'supports' => [
                'title',
                'editor',
                'author',
                'thumbnail',
                'revisions',
                'custom-fields',
                'comments',
                'trackbacks',
                'hierarchical',
                'page-attributes',
                'post-formats',
                'excerpt',
            ],
            'public' => true,
            'description' => 'Car post type',
            'menu_icon' => 'dashicons-car',
            'show_in_rest' => true,
            'exclude_from_search' => false,
            'show_in_nav_menus' => true,
            'show_in_admin_bar' => true,
            'show_in_menu' => true,
            'show_ui' => true,
            'rewrite' => [
                'slug' => 'cars',
            ],
            'taxonomies' => ['category'],
            'has_archive' => true,

            'publicly_queryable' => true,



        ]);
    }
}

function wp_flash_rewrite_rules(): void
{
    wp_register_cars_post_type();    
    flush_rewrite_rules();
}



add_action('init', 'wp_register_cars_post_type');
//add_action('after_switch_theme', 'wp_flash_rewrite_rules', 10);
