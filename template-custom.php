<?php

use App\Classes\WP_ShortCodes;

/*
    Template name: Template Custom
    Template Post Type: page, post, car

*/

get_header();



?>

<main class="<?= implode(' ', get_post_class('custom-page')); ?>">
    <h1><?= ucfirst(get_post_type()) ?></h1>


    <div>

        <?php if(get_the_ID()) : ?>
            <h2><?= get_term_link(16, 'brand') ?></h2>
        <?php endif; ?>
        
        <h2><?= get_the_title() ?></h2>
        <div>
            <?= the_post_thumbnail('car-cover') ?>
        </div>
        <p><?= get_the_content() ?></p>


        <h3>Car price: <span><?= get_post_meta(get_the_ID(), 'custom_price', true) ?>$</span></h3>
        <h3>Car gear: <span><?= the_field('custom_gear') ?></span></h3>

        <?php echo get_post_format(); ?>

        <p>Shortcode:</p>
        <?php 
            WP_ShortCodes::exec('[foobar name="Farid" age="25"]');
        
        ?>

        


    </div>
</main>




<?php get_footer(); ?>