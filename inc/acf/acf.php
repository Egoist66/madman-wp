<?php

function acf_metaboxes(): void
{

    acf_add_local_field_group([
        'key' => 'acf_car_setings',
        'title' => 'Car Settings for ACF from Code',
        'fields' => [
            [
                'key' => 'custom_price',
                'label' => 'Car Price',
                'name' => 'custom_price',
                'type' => 'text',
                'placeholder' => 'Enter a price',
                'required' => true
            ],
            [
                'key' => 'custom_gear',
                'label' => 'Car Gear',
                'name' => 'custom_gear',
                'type' => 'select',
                'choices' => [
                    'auto' => esc_html('Auto'),
                    'manual' => esc_html('Manual'),
                ],
                'allow_null' => 1,
            ]
        ],
        'location' => [
            [
                [
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'car',
                ]
            ]
        ],
        'menu_order' => 0,
        'position' => 'normal', //side | acf_after_title
        'style' => 'default', //seamless
        'label_placement' => 'top',
        'instruction_placement' => 'label', //field
        'hide_on_screen' => [],
             
    ]);
}

add_action('acf/init', 'acf_metaboxes');