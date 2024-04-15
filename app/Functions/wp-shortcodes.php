<?php

namespace App\Functions;

class WP_ShortCodes
{


    /**
     * wp_shortcodes
     * 
     * Helper function for WP shortcodes
     * 
     * @param  mixed $shortcode
     * @return void
     */
    final public static function init()
    {
       
        add_shortcode('foobar', self::select()['foobar']);

    }

    final public static function exec(string $shortcode){

        foreach(self::select() as $key => $value){
            
            if(shortcode_exists($key)){
                echo do_shortcode($shortcode);
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
            }
        ];

    }

    final public static function dropShortcode(string $name): void {

        remove_shortcode($name);
    }
}

