<?php
use App\Functions\WP_Setup;

$modules = [
    "/vendor/autoload.php",
    "/app/Functions/wp-shortcodes.php",
    "/app/Config/wp-theme-config.php",
    "/app/Functions/es-module.php",
    "/app/Functions/setup.php",
    "/app/Functions/wp-posts.php",
];

foreach ($modules as $module) {
    require_once get_template_directory() . $module;
}


WP_Setup::init();