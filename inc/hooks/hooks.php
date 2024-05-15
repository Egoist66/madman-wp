<?php


function custom_hook($name): void {
    echo 'Hello from ' . $name;
}

add_action('custom_hook_function', 'custom_hook', 10, 1);


function custom_hook_filter_fn($name): string {
    return ucwords('hello from ' . $name) . '!';
}

add_filter('custom_hook_filter', 'custom_hook_filter_fn', 10, 1);

// remove_filter('custom_hook_filter', 'custom_hook_filter_fn');
// remove_action('custom_hook_function', 'custom_hook');