<?php

namespace App\Config;

use App\Classes\ES_Module;
use App\Classes\WP_MetaBoxes;
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

        wp_enqueue_script('thickbox');
        wp_enqueue_script('pipe-app', get_template_directory_uri() . '/assets/js/libs/pipe.js', array('jquery'), true, true);
        wp_enqueue_script('madman-app-ajax', get_template_directory_uri() . '/assets/js/setup/ajax/ajax.js', array('jquery'), true, true);
        
        wp_localize_script('madman-app-ajax', 'madman_ajax_object', array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('madman-ajax-nonce'),
            'home_url' => get_home_url(),
           
        ));

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

    final public static function wp_admin_enqueue_scripts()
    {
        wp_enqueue_style('custom-admin-styles', get_template_directory_uri() . '/assets/admin/admin.css');
    }

  

    final public static function wp_unregister_theme_post_type(): void
    {
        unregister_post_type('car');
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

    final public static function wp_register_required_plugins(): void
    {

        /*
         * Array of plugin arrays. Required keys are name and slug.
         * If the source is NOT from the .org repo, then source is also required.
         */
        $plugins = array(

            // This is an example of how to include a plugin bundled with a theme.
            array(
                'name' => 'Madman Core', // The plugin name.
                'slug' => 'madman-core', // The plugin slug (typically the folder name).
                'source' => get_template_directory() . '/plugins/madman-core.zip', // The plugin source.
                'required' => true, // If false, the plugin is only 'recommended' instead of required.
                'version' => '1.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
                'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
                'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
                'external_url' => '', // If set, overrides default API URL and points to an external URL.
                'is_callable' => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
            ),

         
            array(
                'name' => 'Advanced Custom Fields',
                'slug' => 'advanced-custom-fields',
                'required' => true,
            ),

            array(
                'name' => 'Gutenberg Template Library & Redux Framework',
                'slug' => 'redux-framework',
                'required' => true,
            )

           

        );

        /*
         * Array of configuration settings. Amend each line as needed.
         *
         * TGMPA will start providing localized text strings soon. If you already have translations of our standard
         * strings available, please help us make TGMPA even better by giving us access to these translations or by
         * sending in a pull-request with .po file(s) with the translations.
         *
         * Only uncomment the strings in the config array if you want to customize the strings.
         */
        $config = array(
            'id' => 'madman',                 // Unique ID for hashing notices for multiple instances of TGMPA.
            'default_path' => '',                      // Default absolute path to bundled plugins.
            'menu' => 'tgmpa-install-plugins', // Menu slug.
            'has_notices' => true,                    // Show admin notices or not.
            'dismissable' => true,                    // If false, a user cannot dismiss the nag message.
            'dismiss_msg' => '',                      // If 'dismissable' is false, this message will be output at top of nag.
            'is_automatic' => false,                   // Automatically activate plugins after installation or not.
            'message' => '',                      // Message to output right before the plugins table.

        );

        tgmpa($plugins, $config);


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

        // add_action('init', [self::class, 'wp_unregister_theme_post_type'], 0);



        add_action('after_setup_theme', [self::class, 'wp_setup_theme'], 10);
        add_action('after_setup_theme', [self::class, 'wp_content_width'], 10);
        add_action('widgets_init', [self::class, 'wp_widgets_add']);
        add_action('wp_enqueue_scripts', [self::class, 'wp_equeue_theme_scripts']);
        add_action('wp_footer', static fn() => ES_Module::add('app->app', 'app-script'), 20);
        add_action('wp_head', [self::class, 'wp_generate_theme_meta']);
        add_action('admin_enqueue_scripts', [self::class, 'wp_admin_enqueue_scripts']);

        // Meta boxes

        // add_action('add_meta_boxes', [WP_MetaBoxes::class, 'wp_add_meta_box']);
        // add_action('save_post', [WP_MetaBoxes::class, 'save_meta_box'], 10, 2);
 
        if (isset($options['maintenance_mode']) && $options['maintenance_mode'] === true) {
            add_action('wp_head', [self::class, 'wp_maintenance_mode']);

        }

        add_action('tgmpa_register', [self::class, 'wp_register_required_plugins']);



        /* Filters registrations  */

        add_filter('body_class', [self::class, 'wp_theme_body_class']);
        add_filter('comment_text', [self::class, 'wp_sanitize_comments'], 10, 1);


    }


}