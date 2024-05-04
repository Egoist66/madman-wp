<?php

namespace App\Config;

use App\Functions\ES_Module;
use App\Functions\WP_MetaBoxes;
use App\Widgets\AboutWidget;

/**
 * WP_MadMan_Theme_Config
 * 
 * Theme config
 */
class WP_Theme_Config
{
    /**
     * wp_setup_theme
     * 
     * Set up theme defaults and registers support for various WordPress features.
     * @return void
     */
    final public static function wp_setup_theme(): void
    {

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support('title-tag');

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support('post-thumbnails');
        add_image_size('car-cover', 300, 200, true);

        update_option('thumbnail_size_w', 170);
        update_option('thumbnail_size_h', 170);
        update_option('thumbnail_crop', 1);

        add_theme_support(
            'post-formats',
            ['aside', 'gallery', 'link', 'image', 'quote', 'video', 'audio']
        );
        add_post_type_support('car', 'post-formats');

        // This theme uses wp_nav_menu() in one location.

        register_nav_menus(
            [
                'header_nav' => esc_html__('header-navigation', 'madman'),
                'footer_nav' => esc_html__('footer-navigation', 'madman'),
            ],

        );

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support(
            'html5',
            array(
                'search-form',
                'comment-form',
                'comment-list',
                'gallery',
                'caption',
                'style',
                'script',
            )
        );

        // Set up the WordPress core custom background feature.
        add_theme_support(
            'custom-background',
            apply_filters(
                'madman_custom_background_args',
                array(
                    'default-color' => 'ffffff',
                    'default-image' => '',
                )
            )
        );

        // Add theme support for selective refresh for widgets.
        add_theme_support('customize-selective-refresh-widgets');

        /**
         * Add support for core custom logo.
         *
         * @link https://codex.wordpress.org/Theme_Logo
         */
        add_theme_support(
            'custom-logo',
            array(
                'height' => 250,
                'width' => 250,
                'flex-width' => true,
                'flex-height' => true,
            )
        );



    }

    /**
     * wp_content_width
     * 
     * Set the content width in pixels, based on the theme's design and stylesheet.
     * @return void
     */
    final public static function wp_content_width(): void
    {
        $GLOBALS['content_width'] = apply_filters('madman_content_width', 640);

    }

    /**
     * wp_widgets_add
     * 
     * Register widget area. 
     * @return void
     */
    final public static function wp_widgets_add(): void
    {
        register_sidebar(
            array(
                'name' => esc_html__('Sidebar', 'madman'),
                'id' => 'sidebar-1',
                'description' => esc_html__('Add widgets here.', 'madman'),
                'before_widget' => '<section id="%1$s" class="widget %2$s">',
                'after_widget' => '</section>',
                'before_title' => '<h2 class="widget-title">',
                'after_title' => '</h2>',
            )
        );

        register_sidebar(
            array(
                'name' => esc_html__('Sidebar for Cars', 'madman'),
                'id' => 'cars-sidebar',
                'description' => esc_html__('Add widgets here.', 'madman'),
                'before_widget' => '<section id="%1$s" class="widget %2$s">',
                'after_widget' => '</section>',
                'before_title' => '<h2 class="widget-title">',
                'after_title' => '</h2>',
            )
        );

        register_widget(AboutWidget::class);
    }

    /**
     * wp_maintenance_mode
     * Display maintenance mode
     * @return void
     */
    final public static function wp_maintenance_mode(): void
    {
        if (!current_user_can('edit_themes') || !is_user_logged_in()) {
            wp_die('<h1 style="text-align: center;">Сайт находится на техническом обслуживании 🖥️</h1><p style="text-align: center;">Приносим извинения за временные неудобства. Мы скоро вернемся!</p>');
            
        }
    }

    /**
     * wp_equeue_theme_scripts
     *
     * Enqueue theme scripts and styles
     *
     * @return void
     */
    final public static function wp_equeue_theme_scripts(): void
    {

        wp_enqueue_style('madman-style', get_template_directory_uri() . '/assets/css/main.css', array(), 'all');
        // wp_enqueue_script(
        //     'madman-app',
        //     get_template_directory_uri() . '/assets/js/app.js',
        //     array('jquery'),
        //     true,
        //     true
        // );

        wp_enqueue_script('thickbox');

        // Enqueue comment reply script
        if (is_singular() && comments_open() && get_option('thread_comments')) {
            wp_enqueue_script('comment-reply');
        }
    }

    /**
     * wp_generate_theme_meta
     * 
     * Generate theme meta
     *
     * @return void
     */
    final public static function wp_generate_theme_meta(): void
    {
        echo trim(<<<EOT
            <meta name="author" content="Makhmudov">
        EOT);
    }

    /**
     * wp_theme_body_class
     *
     * Adds a class to body
     * @param  mixed $classes
     * @return array
     */
    final public static function wp_theme_body_class(array $classes): array
    {
        if (is_front_page()) {
            $classes[] = 'main-page';
        } else if (is_singular()) {
            $classes[] = 'single-page';
        }


        return $classes;
    }

    final public static function wp_admin_enqueue_scripts() {
        wp_enqueue_style( 'custom-admin-styles', get_template_directory_uri() . '/assets/admin/admin.css' );
    }

    /**
     * wp_register_theme_post_type
     *
     * Registers theme post type
     * @return void
     */
    final public static function wp_register_theme_post_type(): void
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

    final public static function wp_unregister_theme_post_type(): void
    {
        unregister_post_type('car');
    }

    final public static function wp_register_theme_taxonomy(): void
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
    final public static function wp_flash_rewrite_rules(): void
    {
        self::wp_register_theme_post_type();
        flush_rewrite_rules();
    }
    
    /**
     * wp_sanitize_comments
     *
     * 
     * Sanitizes comment data.
     * @param  mixed $comment_content
     * @return string
     */
    final public static function wp_sanitize_comments($comment_content): string
    {
        // Функция для очистки содержимого комментариев от скриптов
        
        $allowed_tags = '<a><strong><em>'; // Разрешенные теги
        $comment_content = wp_kses($comment_content, $allowed_tags);
        return $comment_content;
        

    }

    /**
     * wp_setup_init
     *
     * Set up theme defaults and registers support for various WordPress features.
     * @return void
     */
    final public static function wp_setup_init(?array $options = []): void
    {
        /* Hooks registrations  */
        add_action('init', [self::class, 'wp_register_theme_taxonomy'], 0);
        add_action('init', [self::class, 'wp_register_theme_post_type'], 0);
        // add_action('init', [self::class, 'wp_unregister_theme_post_type'], 0);



        add_action('after_switch_theme', [self::class, 'wp_flash_rewrite_rules'], 10);
        add_action('after_setup_theme', [self::class, 'wp_setup_theme'], 10);
        add_action('after_setup_theme', [self::class, 'wp_content_width'], 10);
        add_action('widgets_init', [self::class, 'wp_widgets_add']);
        add_action('wp_enqueue_scripts', [self::class, 'wp_equeue_theme_scripts']);
        add_action('wp_footer', static fn() => ES_Module::add('app->app', 'app-script'), 20);
        add_action('wp_head', [self::class, 'wp_generate_theme_meta']);
        add_action('admin_enqueue_scripts', [self::class, 'wp_admin_enqueue_scripts']);

        // Meta boxes
        
        add_action('add_meta_boxes', [WP_MetaBoxes::class, 'wp_add_meta_box']);
        add_action('save_post', [WP_MetaBoxes::class, 'save_meta_box'], 10, 2);

        if (isset($options['maintenance_mode']) && $options['maintenance_mode'] === true) {
            add_action('wp_head', [self::class, 'wp_maintenance_mode']);

        }


        /* Filters registrations  */

        add_filter('body_class', [self::class, 'wp_theme_body_class']);
        add_filter('comment_text', [self::class, 'wp_sanitize_comments'], 10, 1);


    }


}