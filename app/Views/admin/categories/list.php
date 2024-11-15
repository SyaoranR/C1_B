<div class="container py-5">
    <div class="row">
        <div class="col-lg-3">
            <?php include '' . APP . '/Views/admin/sideBar.php' ?>
        </div>
        <div class="col-lg-9">
            <?= Session::msg('category') ?>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent">
                    <li class="breadcrumb-item"><a href="<?= URL ?>/admin" data-toggle="tooltip" title="Posts">Admin</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Categories</li>
                </ol>
            </nav>

            <div class="card">
                <div class="card-header primaryBg text-white">
                    Categories List
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
                            <?php foreach ($data['categories'] as $category) : ?>
                                <tr>

                                    <td class="align-middle">
                                        <h6><?= $category->title ?></h6>
                                    </td>
                                    <td class="text-center align-middle">
                                        <ul class="list-inline">
                                            <li class="list-inline-item">
                                                <!-- This '/controller/' may be the exact same name/string to work  HERE WAS ID before, didn't worked -->
                                                <a class="font-weight-bold" href="<?= URL . '/categories/adminCateg/' . $category->id ?>" data-toggle="tooltip" title="Show Category <?= $category->title ?>">
                                                    <i class="btn btn-outline-success border-0 fas fa-eye"></i>
                                                </a>
                                            </li>
                                            <li class="list-inline-item">
                                                <a class="font-weight-bold text-primary" href="<?= URL . '/admin/edit/category/' . $category->id ?>" data-toggle="tooltip" title="Edit <?= $category->title ?>">
                                                    <i class="btn btn-outline-primary border-0 fas fa-pen mr-2"></i>
                                                </a>
                                            </li>
                                            <li class="list-inline-item">
                                                <form action="<?= URL . '/admin/delete/category/' . $category->id ?>" method="post">
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