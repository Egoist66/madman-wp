<?php
use App\Functions\WP_Posts;


get_header();


?>

<main class="<?= implode(' ', get_post_class()); ?> main-front">
    <h1>Home</h1>


    <h2 style="text-align: center;">Recent posts</h2>
    <div>

        <?php
           
            WP_Posts::getByQuery([
                'args' => [
                    'post_type' => ['post', 'car'], // Тип записи - посты
                    'posts_per_page' => -1, // Все посты
                    'post_status' => 'publish'
                ],
                'template' => 'templates/template-post',

            ])

        ?>
    </div>
</main>




<?php get_footer(); ?>