<?php

/*
    Template name: Template Home
    Template Post Type: page

*/

get_header();


?>

<main class="<?= implode(' ', get_post_class()); ?>">
    <h1>Template Home</h1>


    <div>
        <?php if (have_posts()):
            while (have_posts()):
                the_post();
                the_content();
                
                
            endwhile; 
        endif; ?>
    </div>
</main>




<?php get_footer(); ?>