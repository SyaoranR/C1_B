<div class="container py-5">
    <div class="row">
        <div class="col-lg-3">
            <?php include '' . APP . '/Views/admin/sideBar.php' ?>
        </div>
        <div class="col-lg-9">

            <!-- Diferente do curso, lá aparece dentro de uma barra cinza -->
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= URL ?>/admin" data-toggle="tooltip" title="Posts">Admin</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit</li>
                </ol>
            </nav>

            <div class="card">
                <div class="card-header primaryBg text-white">
                    Category Edit
                </div>
                <div class="card-body bg-light">

                    <form name="Edit" method="POST" action="<?= URL ?>/admin/edit/category/<?= $data['id'] ?>" class="mt-4">

                        <div class="form-group">
                            <label for="title">Title: <sup class="text-danger">*</sup></label>
                            <input type="text" name="title" id="title" value="<?= $data['title'] ?>" class="form-control <?= $data['title_err'] ? 'is-invalid' : '' ?>">
                            <div class="invalid-feedback">
                                <?= $data['title_err'] ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="descr">Description: <sup class="text-danger">*</sup></label>
                            <textarea name="descr" id="descr" class="form-control  <?= $data['descr_err'] ? 'is-invalid' : '' ?>" rows="5"><?= $data['descr'] ?></textarea>
                            <div class="invalid-feedback">
                                <?= $data['descr_err'] ?>
                            </div>
                        </div>

                        <div class="row m-2">
                            <div class="d-grid gap-2">
                                <input type="submit" value="Category Edit" class="btn btn-info text-white" data-toggle="tooltip" title="Category Edit">
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>