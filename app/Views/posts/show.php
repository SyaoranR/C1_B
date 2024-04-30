<div class="container">
    <div class='p-5 m-5 bg-light rounded border shadow'>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= URL ?>/posts" data-toggle="tooltip" title="Posts">Posts</a></li>                
                <li class="breadcrumb-item active" aria-current="page"><?= $data['post']->title ?></li>
            </ol>
        </nav>
        <div class="row">
            <div class="col-lg-8">
                <article class="posts">
                    <?php if (!empty($data['post']->cover)) : ?>
                        <div class="postImg zoom">
                            <img class="img-fluid" src="<?= $data['post']->cover ?>" alt="<?= $data['post']->title ?>" title="<?= $data['post']->title ?>">
                        </div>
                        <div class="postSummary">
                            <div class="postText">
                                <h2><?= $data['post']->title ?></h2>
                                <p><?= $data['post']->txt ?></p>
                                <small>
                                Written by: <b><?= $data['author']->username ?></b> at <?= Check::brDate($data['post']->created_at) ?>                    
                            </small>
                            </div>
                        </div>
                    <?php else : ?>
                        <div class="noCover">
                            <h2><?= $data['post']->title ?></h2>
                            <p><?= $data['post']->txt ?></p>
                            <small>
                                Written by: <b><?= $data['author']->username ?></b> at <?= Check::brDate($data['post']->created_at) ?>                    
                            </small>
                        </div>
                    <?php endif ?>
                </article>           

            </div>
            <div class="col-lg-4">
                <?php include 'sideBar.php' ?>
            </div>
        </div>

    </div>
</div>