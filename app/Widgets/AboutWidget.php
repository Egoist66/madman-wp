<?php
namespace App\Widgets;

use WP_Widget;

class AboutWidget extends WP_Widget
{

    public function __construct()
    {
        parent::__construct(
            'about_widget',
            esc_html__('About Widget', 'madman'),
            [
                'description' => 'Our first Widget',
            ]
        );
    }

    public function widget($args, $instance): void
    {
        //front
        extract($args);

        $title = apply_filters('widget_title', $instance['title']);
        $text = apply_filters('the_content', $instance['text']);

        echo $before_widget;

        if ($title) {
            echo $before_title . esc_html($title) . $after_title;
        }

        if ($text) {
            echo wp_kses_post($text);
        }
        echo $after_widget;
    }

    public function form($instance): void
    {

        //back 

        if (isset($instance['title'])) {
            $title = $instance['title'];
        } else {
            $title = 'Some default title';
        }

        if (isset($instance['text'])) {
            $text = $instance['text'];
        } else {
            $text = 'Some default text';
        }

        $html = "

            <p>

                <input 
                    class='widefat'
                    placeholder='" . esc_html__('Enter title', 'madman') . "' 
                    id={$this->get_field_id('title')} 
                    name={$this->get_field_name('title')} 
                    type='text' 
                    value=\"" . esc_attr($title) . "\"
                >

            </p>

            <p>
            
                <textarea
                    class='widefat'
                    placeholder='" . esc_html__('Enter text', 'madman') . "'
                    id={$this->get_field_id('text')}
                    name={$this->get_field_name('text')}
                >" . esc_attr($text) . "</textarea>


            </p>

          


        ";

        echo trim($html);


    }

    public function update($new_instance, $old_instance): array
    {

        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['text'] = strip_tags($new_instance['text']);
        return $instance;
    }
}