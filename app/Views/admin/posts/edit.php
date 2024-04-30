<div class="container py-5">
    <div class="row">
        <div class="col-lg-3">
            <?php include ''.APP.'/Views/admin/sideBar.php' ?>
        </div>
        <div class="col-lg-9">

            <!-- Diferente do curso, lá aparece dentro de uma barra cinza -->
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= URL ?>/posts">Posts</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit</li>
                </ol>
            </nav>

            <div class="card">
                <div class="card-header primaryBg text-white">
                    Edit Post
                </div>
                <div class="card-body bg-light">

                    <form name="login" method="POST" action="<?= URL ?>/post/edit/<?= $data['id'] ?>" class="mt-4">

                        <div class="form-group">
                            <label for="title">Title: <sup class="text-danger">*</sup></label>
                            <input type="text" name="title" id="title" value="<?= $data['title'] ?>" class="form-control <?= $data['title_err'] ? 'is-invalid' : '' ?>">
                            <div class="invalid-feedback">
                                <?= $data['title_err'] ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="texto">Text: <sup class="text-danger">*</sup></label>
                            <textarea name="txt" id="txt" class="form-control  <?= $data['txt_err'] ? 'is-invalid' : '' ?>" rows="5"><?= $data['txt'] ?></textarea>
                            <div class="invalid-feedback">
                                <?= $data['txt_err'] ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="category">Category</label>
                            <select class="form-control <?= $data['category_err'] ? 'is-invalid' : '' ?>" name="category" id="category">
                                <option value="">Select</option>

                                <?php foreach ($data['categories'] as $category) : ?>
                                    <option value="<?= $category->id ?>"> <?= $data['category_id'] == $category->id ? "selected" : "" ?> <?= $category->title ?></option>
                                <?php endforeach ?>

                            </select>
                        </div>

                        <div class="row m-2">
                            <div class="d-grid gap-2">
                                <input type="submit" value="Edit Post" class="btn btn-info text-white">
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>