<?php

global $filters;

$filters = [
    "apply_custom_hook_filter" => fn($name) => apply_filters('custom_hook_filter', $name)
    
];
return $filters;


