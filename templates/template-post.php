<article id="post-<?= $data['id'] ?>" <?php post_class('post-card') ?>>
    <img class="post-image" src="<?= $data['image'] ?>" alt="">
    <h2><?= $data['title'] ?></h2>
    <p><?= $data['content'] ?></p>
    <p><a href="<?= $data['permalink'] ?>">Read more</a></p>
    <p>ID: <?= $data['id'] ?></p>
    <p>Author: <?= $data['author'] ?></p>
    <p>Date: <?= $data['date'] ?></p>
</article>