<div class="container py-5"> 
    <?= Session::msg('post') ?>   

    <div class="row">
        <div class="col-lg-8">
        <article class="posts">
                <?php foreach ($data['posts'] as $post) : ?>
                    <?php if (!empty($post->cover)) : ?>
                        <div class="postImg zoom">
                            <a href="<?= URL . '/posts/' . $post->postUrl ?>">
                                <img class="img-fluid" src="<?= URL. '/uploads/images/'. $post->cover ?>" alt="<?= $post->title ?>" title="<?= $post->title ?>">
                            </a>
                        </div>
                        <div class="postSummary">
                            <div class="postText">
                                <a href="<?= URL . '/posts/' . $post->postUrl ?>" title="<?= $post->title ?>" data-toggle="tooltip">
                                    <h2><?= $post->title ?></h2>
                                </a>
                                <p><?= Url::textSummerize($post->txt, 28, '<a href='.URL . '/posts/' . $post->postUrl.' class="btn btn-danger">continue</a>') ?></p>
                                <small>
                                    Written by: <b><?= $post->username ?></b> at <?= Check::brDate($post->postRegisterDate) ?>
                                </small>
                            </div>
                        </div>
                    <?php else : ?>

                        <div class="noCover">
                            <a href="<?= URL . '/posts/' . $post->postUrl ?>" title="<?= $post->title ?>" data-toggle="tooltip">
                                <h2><?= $post->title ?></h2>
                            </a>
                            <p><?= Url::textSummerize($post->txt, 28) ?></p>
                            <small>
                                Written by: <b><?= $post->username ?></b> at <?= Check::brDate($post->postRegisterDate) ?>
                            </small>
                        </div>

                    <?php endif ?>


                <?php endforeach ?>
            </article>
        </div>
        <div class="col-lg-4">
            <?php include '' . APP . '/Views/sideBar.php' ?>
        </div>
    </div>
</div>