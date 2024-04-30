<div class="container py-5"> 
    <?= Session::msg('post') ?>   

    <div class="row">
        <div class="col-lg-8">
        <article class="posts">
                <?php foreach ($data['posts'] as $post) : ?>
                    <?php if (!empty($post->cover)) : ?>
                        <div class="postImg zoom">
                            <a href="<?= URL . '/posts/show/' . $post->postId ?>">
                                <img class="img-fluid" src="<?= $post->cover ?>" alt="<?= $post->title ?>" title="<?= $post->title ?>">
                            </a>
                        </div>
                        <div class="postResumo">
                            <div class="postText">
                                <a href="<?= URL . '/posts/show/' . $post->postId ?>" title="<?= $post->title ?>" data-toggle="tooltip">
                                    <h2><?= $post->title ?></h2>
                                </a>
                                <p><?= $post->txt ?></p>
                                <small>
                                    Written by: <b><?= $post->username ?></b> at <?= Check::brDate($post->postRegisterDate) ?>
                                </small>
                            </div>
                        </div>
                    <?php else : ?>

                        <div class="noCover">
                            <a href="<?= URL . '/posts/show/' . $post->postId ?>" title="<?= $post->title ?>" data-toggle="tooltip">
                                <h2><?= $post->title ?></h2>
                            </a>
                            <p><?= $post->txt ?></p>
                            <small>
                                Written by: <b><?= $post->username ?></b> at <?= Check::brDate($post->postRegisterDate) ?>
                            </small>
                        </div>

                    <?php endif ?>


                <?php endforeach ?>
            </article>
        </div>
        <div class="col-lg-4">
            <?php include 'sideBar.php' ?>
        </div>
    </div>
</div>