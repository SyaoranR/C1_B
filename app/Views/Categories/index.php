<div class="container py-5">
    <div class="row">
        
        <div class="col-lg-8">            

            <?= Session::msg('category') ?>
            <article class="posts">
                <?php foreach ($data['posts'] as $post) : ?>
                    <?php if (!empty($post->postCover)) : ?>
                        <div class="postImg zoom">
                            <!-- This '/controller/' may be the exact same name/string to work  -->
                            <a href="<?= URL . '/posts/' . $post->postId ?>">
                                <img class="img-fluid" src="<?= $post->postCover ?>" alt="<?= $post->postTitle ?>" title="<?= $post->postTitle ?>">
                            </a>
                        </div>
                        <div class="postSummary">
                            <div class="postText">
                                <!-- This '/controller/' may be the exact same name/string to work  -->
                                <a href="<?= URL . '/posts/' . $post->postId ?>" title="<?= $post->postTitle ?>" data-toggle="tooltip">
                                    <h2><?= $post->postTitle ?></h2>
                                </a>
                                <p><?= $post->postTxt ?></p>
                                <small>
                                Written by: <b><?= $post->postAuthor ?></b> at <?= Check::brDate($post->postRegisterDate) ?>
                                </small>
                            </div>
                        </div>
                    <?php else : ?>

                        <div class="postSemCapa">
                            <!-- This '/controller/' may be the exact same name/string to work  -->
                            <a href="<?= URL . '/posts/' . $post->postId ?>" title="<?= $post->postTitle ?>" data-toggle="tooltip">
                                <h2><?= $post->postTitle ?></h2>
                            </a>
                            <p><?= $post->postTxt ?></p>
                            <small>
                                Written by: <b><?= $post->postAuthor ?></b> at <?= Check::brDate($post->postRegisterDate) ?>
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