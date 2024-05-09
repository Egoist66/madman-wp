<?php

/*
 * Core Theme Plugin
 * Plugin Name:         Madman Core
 * Plugin URI:          https://portfolio-six-gamma-33.vercel.app/all
 * GitHub URI:          https://portfolio-six-gamma-33.vercel.github.io
 * Description:         Core plugin implementing the theme functionality
 * Version:             1.0
 * Author:              Farid Makhmudov
 * Author URI:          https://github.com/Razormad666
 * License:             GNU General Public License, version 3
 * Text Domain:         madman-core


*/


 
$modules = [
    '/inc/metaboxes/metaboxes',
    '/inc/acf/acf',
    '/inc/custom-taxonomy/brands-taxonomy',
    '/inc/custom-post-types/cars-post-type',
];


foreach ($modules as $module) {
    require plugin_dir_path(__FILE__) . $module . '.php';
}



