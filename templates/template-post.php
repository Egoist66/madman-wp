<article id="post-<?= $data['id'] ?>" <?php post_class('post-card') ?>>

    <?php if (has_post_thumbnail(get_the_ID())): ?>
        <?= the_post_thumbnail('car-cover') ?>
    <?php endif; ?>

    <h2><?= $data['title'] ?></h2>
    <p><?= the_excerpt() ?></p>
    <p><a href="<?= $data['permalink'] ?>">Read more</a></p>
    <p>ID: <?= $data['id'] ?></p>
    <p>Author: <?= $data['author'] ?></p>
    <p>Date: <?= $data['date'] ?></p>
    <p>Format: <?php echo get_post_format(); ?></p>
</article>

<!-- has_post_thumbnail() -->
<!-- the_post_thumbnail_url() -->
<!-- get_post_thumbnail() -->
<!-- the_post_thumbnail() -->
<!-- get_post_thumbnail_id() -->
<!-- set_post_thumbnail_size() -->