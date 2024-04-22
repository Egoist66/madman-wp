<div class="posts-wrapper">
    <h1><?= get_queried_object()->name ?></h1>
    <article class="post">
        <h2><a href="<?= the_permalink() ?>"><?= the_title() ?></a></h2>
        <?= term_description() ?>
        <img width="400" src="<?= get_the_post_thumbnail_url() ?>" alt="">
        <p><?= wp_trim_words(get_the_content(), 30) ?></p>
        
    </article>
</div>