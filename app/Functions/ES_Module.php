<?php

namespace App\Functions;

use Exception;

class ES_Module
{
    /**
     * es_module
     * 
     * Helper function for ES modules
     *
     * @param  mixed $script_name
     * @return void
     */
    final public static function add(string $script_location, ?string $id = ''): void
    {

        $template_directory = get_template_directory_uri();
        [$folder, $script_name] = explode('->', $script_location);

        try {


            $script_path = $template_directory . "/assets/js/$folder/$script_name.js";
            echo '<script id="' . $id . '" type="module" src="' . $script_path . '"></script>';
            


        } catch (Exception $e) {
            echo "<script>{$e->getMessage()}</script>";
        }
    }
}