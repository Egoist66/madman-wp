<?php

use App\Functions\WP_Posts;

/*
    Template name: Template Home
    Template Post Type: page, post, car

*/

get_header();


?>

<main class="<?= implode(' ', get_post_class()); ?>">
    <h1><?= ucfirst(get_post_type()) ?></h1>


    <div>
        
        <h2><?= get_the_title() ?></h2>
        <div>
            <img width="300" src="<?= get_the_post_thumbnail_url() ?>" alt="">
        </div>
        <p><?= get_the_content() ?></p>

        <?php echo get_post_format(); ?>

        <?php 
            echo do_shortcode('[foobar name="Farid" age="25"]');
        
        ?>


    </div>
</main>




<?php get_footer(); ?>