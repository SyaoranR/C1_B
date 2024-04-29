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
                
                <div class="card text-center">
                    <div class="card-header bg-secondary text-white font-weight-bold">
                        <?= $data['post']->title ?>
                    </div>
                    <div class="card-body">
                        <p class="card-text"><?= $data['post']->txt ?></p>
                    </div>
                    <div class="card-footer text-muted">
                        <small>
                            Written by: <b><?= $data['author']->username ?></b> em <?= Check::brDate($data['post']->created_at) ?>                    
                        </small>
                    </div>           
                </div>

            </div>
            <div class="col-lg-4">
                <?php include 'sideBar.php' ?>
            </div>
        </div>

    </div>
</div>