<?php

global $actions;


$actions = [
    "do_custom_hook_action" => fn($name) => do_action('custom_hook_function', $name)
    
];
return $actions;


