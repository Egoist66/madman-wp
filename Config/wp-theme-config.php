<?php

namespace App\Config;
use App\Functions\ES_Module;

/**
 * WP_MadMan_Theme_Config
 * 
 * Theme config
 */
class WP_MadMan_Theme_Config
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
    }

    /**
     * wp_maintenance_mode
     * Display maintenance mode
     * @return void
     */
    final public static function wp_maintenance_mode(): void
    {
        if (!current_user_can('edit_themes') || !is_user_logged_in()) {
            wp_die('<h1>Сайт находится на техническом обслуживании</h1><br />Приносим извинения за временные неудобства. Мы скоро вернемся!');
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
    final public static function wp_theme_body_class($classes): array
    {

        if (is_front_page()) {
            $classes[] = 'main-page';
        } else if (is_singular()) {
            $classes[] = 'single-page';
        }


        return $classes;
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


        add_action('after_setup_theme', [self::class, 'wp_setup_theme'], 0);
        add_action('after_setup_theme', [self::class, 'wp_content_width'], 0);
        add_action('widgets_init', [self::class, 'wp_widgets_add']);
        add_action('wp_enqueue_scripts', [self::class, 'wp_equeue_theme_scripts']);
        add_action('wp_footer', static fn() => ES_Module::add('app->app', 'app-script'), 20);

        add_action('wp_head', [self::class, 'wp_generate_theme_meta']);


        if (isset($options['maintenance_mode']) && $options['maintenance_mode'] === true) {
            add_action('wp_enqueue_scripts', [self::class, 'wp_maintenance_mode']);

        }


        /* Filters registrations  */

        add_filter('body_class', [self::class, 'wp_theme_body_class']);


    }


}