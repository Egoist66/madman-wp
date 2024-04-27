<?php get_header() ?>



<h2><?php echo get_the_author() ?></h2>
<p> Author link: <?php echo get_the_author_posts_link() ?></p>
<p>Author ID: <?= the_author_ID() ?></p>
<p> Author email: <?= the_author_email() ?></p>
<p>Author description: <?= the_author_description() ?></p>
<p>Author URL: <?= the_author_url() ?></p>
<p>Author login: <?= the_author_login() ?></p>



<?php get_footer() ?>