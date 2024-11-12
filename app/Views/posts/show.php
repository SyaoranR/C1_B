<div class="container my-5">

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb bg-transparent border-bottom text-uppercase font-weight-bold">
            <li class="breadcrumb-item">
                <a href="<?= URL ?>" data-toggle="tooltip" title="Posts">
                    Home
                </a>
            </li>          
                <li class="breadcrumb-item active" aria-current="page">
                    <a href="<?= URL ?>/categories/<?= $data['category']->url_categories ?>" data-toggle="tooltip" title="Posts">
                        <?= $data['category']->title ?></li> 
                    </a>
            </ol>
        </nav>
        <div class="row">
            <div class="col-lg-8">

                <div class="postHeader my-3">
                    <div class="row">
                        <div class="col-md-6">
                            <small><i class="fas fa-user"></i> <b><?= $data['author']->username ?></b> <i class="far fa-calendar-alt"></i> <?= date('d/m/Y', strtotime($data['post']->created_at)) ?> <i class="far fa-clock"></i> <?= date('h:s', strtotime($data['post']->created_at)) ?></small>
                        </div>
                        <div class="col-md-6">
                            <!-- Sharing itens space -->
                        </div>
                    </div>
                </div>

                <article class="posts">
                    <?php if (!empty($data['post']->cover)) : ?>
                        <div class="postImg zoom">
                            <img class="img-fluid" src="<?= URL. '/uploads/images/'. $data['post']->cover ?>" alt="<?= $data['post']->title ?>" title="<?= $data['post']->title ?>">
                        </div>
                        <div class="postSummary">
                            <div class="postText">
                                <h2><?= $data['post']->title ?></h2>
                                <p><?= $data['post']->txt ?></p>                            
                            </div>
                        </div>
                    <?php else : ?>
                        <div class="noCover">
                            <h2><?= $data['post']->title ?></h2>
                            <p><?= $data['post']->txt ?></p>                           
                        </div>
                    <?php endif ?>
                </article>           

            </div>
            <div class="col-lg-4">
                <?php include '' . APP . '/Views/sideBar.php' ?>
            </div>
        </div>

    </div>
</div>