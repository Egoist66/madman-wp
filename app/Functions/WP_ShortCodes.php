<?php

namespace App\Functions;

/**
 * WP_ShortCodes
 * 
 * Helper class for WP shortcodes
 */
class WP_ShortCodes
{


    /**
     * wp_shortcodes
     * 
     * 
     * @param  mixed $shortcode
     * @return void
     */
    final public static function init()
    {
        // register shortcodes
       
        foreach(self::select() as $key => $value){
            
            if(!shortcode_exists($key)){
                add_shortcode($key, $value);
            }
            
        }

    }

    final public static function exec(string $shortcode){

        foreach(self::select() as $key => $value){
            
            if(shortcode_exists($key)){
                echo do_shortcode($shortcode);
                break;
            }
        }
        
    }

    
    /**
     * select
     * 
     * Helper function for shortcodes selection
     *
     * @return array
     */
    final public static function select(): array
    {
        return [
            
            'foobar' => function ($atts): string {

                $atts = shortcode_atts([
                    'name' => 'Noname',
                    'age' => 18,
                ], $atts);

                return "Меня зовут {$atts['name']} мне {$atts['age']} лет";
            },
            "greet" => function ($atts): string {

                return "Hello";
            }
        ];

    }

    final public static function dropShortcode(string $name): void {

        remove_shortcode($name);
    }
}

