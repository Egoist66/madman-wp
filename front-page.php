<?php
use App\Functions\WP_Posts;


get_header();


?>

<main class="<?= implode(' ', get_post_class()); ?> main-front">
    <h1>Home</h1>
    
</main>
    <?php if (have_posts()):
        while (have_posts()):
            the_post();
            ?>

                <div style="border: 1px solid black; padding: 10px; max-width: 300px; margin: 0 auto 20px auto">
                    <h2><a href="<?= the_permalink() ?>"><?= the_title() ?></a></h2>
                    <p><?= the_content(); ?></p>
                    <span><?= get_the_date() ?></span>
                </div>

            <?php

        endwhile;

        ?>
            <div class="pagination">
                <!-- <div class="prev">
                    <?php // previous_posts_link('&laquo; Previous Page') ?> -->
                <!-- </div> -->

                <!-- <div class="next"> -->
                    <!-- <?php // next_posts_link('Next Page &raquo;') ?> 
                </div> -->

                <?php
                
                
                  the_posts_pagination([
                    'mid_size'  => 2,
                    'prev_text' => 'Previous Page',
                    'next_text' => 'Next Page',
                    
                  ]);
                
                ?>

            </div>

        <?php
        // paginate_links();
        // posts_nav_link('&laquo;', 'Previous Page', 'Next Page');
    endif; ?>



<?php get_footer(); ?>
<?php get_sidebar() ?>