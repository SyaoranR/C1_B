<div class="container py-5">
    <div class="row">
        <div class="col-lg-3">
            <?php include '' . APP . '/Views/admin/sideBar.php' ?>
        </div>
        <div class="col-lg-9">
            <?= Session::msg('post') ?>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent">
                    <li class="breadcrumb-item"><a href="<?= URL ?>/admin" data-toggle="tooltip" title="Posts">Admin</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Posts</li>
                </ol>
            </nav>

            <div class="card">
                <div class="card-header primaryBg text-white">
                    Posts List
                </div>
                <div class="card-body">

                    <table class="table table-striped">
                        <thead>
                            <tr class="text-center">
                                <th style="width:60%">Title</th>
                                <th style="width:40%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data['posts'] as $post) : ?>
                                <tr>

                                    <td class="align-middle">
                                        <h6><?= $post->title ?></h6>
                                    </td>
                                    <td class="text-center align-middle">
                                        <ul class="list-inline">
                                            <li class="list-inline-item">
                                                <!-- This '/controller/' may be the exact same name/string to work  -->
                                                <a class="font-weight-bold" href="<?= URL . '/posts/' . $post->postId ?>" data-toggle="tooltip" title="Show Post <?= $post->title ?>">
                                                    <i class="btn btn-outline-success border-0 fas fa-eye"></i>
                                                </a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a class="font-weight-bold" href="<?= URL . '/admin/edit/post/' . $post->postId ?>" data-toggle="tooltip" title="Edit <?= $post->title ?>">
                                                    <i class="btn btn-outline-primary border-0 fas fa-pen"></i>
                                                </a>
                                            </li>
                                            <li class="list-inline-item">
                                                <form action="<?= URL . '/admin/delete/post/' . $post->postId ?>" method="post">
                                                    <button class="btn btn-sm btn-outline-danger border-0"><i class="fas fa-trash"></i></button>
                                                </form>
                                            </li>
                                        </ul>

                                    </td>

                                </tr>
                            <?php endforeach ?>

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>