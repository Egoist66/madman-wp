<article id="post-<?= the_ID() ?>" <?php post_class('post-card') ?>>
    <img class="post-image" src="<?= the_post_thumbnail_url() ?>" alt="">
    <h2><?= the_title() ?></h2>
    <p><?= the_excerpt() ?></p>
    <p><a href="<?= the_permalink() ?>">Read more</a></p>
    <p>ID: <?= the_ID() ?></p>
    <p>Author: <?= the_author() ?></p>
    <p>Date: <?= the_date() ?></p>
    <p>Format: <?= get_post_format(); ?></p>
</article>