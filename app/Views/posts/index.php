<div class="container py-5"> 
    <?= Session::msg('post') ?>   

    <div class="row">
        <div class="col-lg-8">

            <div class="card">
            <div class="card-header bg-info text-white">
                POSTS
                <div style="float: right">
                    <a href="<?= URL ?>/posts/register" class="btn btn-light" data-toggle="tooltip" title="Write Post">Write</a>
                </div>
            </div>
            <div class="card-body">
            <?php foreach ($data['posts'] as $post) : ?>
                    <div class="card m-4 shadow">
                        <div class="card-header bg-secondary text-white font-weight-bold">
                            <?= $post->title ?>
                        </div>

                        <div class="card-body">
                            <p class="card-text"><?= $post->txt ?></p>
                            <div style="float: right">
                                <a href="<?= URL . '/posts/show/' . $post->postId ?>" class="btn btn-sm btn-outline-info">Read more</a>
                            </div>
                        </div>

                        <div class="card-footer text-muted">
                            <small>
                                Written by: <b><?= $post->username ?></b> em <?= Check::brDate($post->postRegisterDate) ?>
                            </small>
                        </div>
                    </div>

                <?php endforeach ?>  
            </div>
        </div> 
    </div>

        <div class="col-lg-4">
            <?php include 'sideBar.php' ?>
        </div>
    </div>
    
</div>