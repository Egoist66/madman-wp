<?php

use App\Functions\WP_ShortCodes;

/*
    Template name: Template Custom
    Template Post Type: page, post, car

*/

get_header();


?>

<main class="<?= implode(' ', get_post_class()); ?>">
    <h1><?= ucfirst(get_post_type()) ?></h1>


    <div>

        <?php if(get_the_ID()) : ?>
            <h2><?= get_term_link(20, 'brand') ?></h2>
        <?php endif; ?>
        
        <h2><?= get_the_title() ?></h2>
        <div>
            <img width="300" src="<?= get_the_post_thumbnail_url() ?>" alt="">
        </div>
        <p><?= get_the_content() ?></p>

        <?php echo get_post_format(); ?>

        <?php 
            WP_ShortCodes::exec('[foobar name="Farid" age="25"]');
        
        ?>


    </div>
</main>




<?php get_footer(); ?>