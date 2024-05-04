<?php
use App\Functions\WP_Setup;

$modules = [
    "/vendor/autoload.php",
    '/utils/view.php',
   
];

foreach ($modules as $module) {
    require_once get_template_directory() . $module;
}


WP_Setup::init(false);