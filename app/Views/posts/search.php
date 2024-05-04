<div class="container py-5">
    <div class="row">
        <div class="col-lg-8">
            <?= Session::msg('post') ?>

            <article class="posts">
                <ul class="list-group list-group-flush">
                    <?php foreach ($data['posts'] as $post) : ?>
                        <li class="list-group-item py-3">
                            <a href="<?= URL . '/posts/' . $post->id ?>" title="<?= $post->title ?>" data-toggle="tooltip">
                                <h2><?= $post->title ?></h2>
                            </a>
                            <p><?= $post->txt ?></p>
                        </li>
                    <?php endforeach ?>
                </ul>
            </article>
        </div>
        
        <div class="col-lg-4">
            <?php include 'sideBar.php' ?> 
        </div>
    </div>
</div>