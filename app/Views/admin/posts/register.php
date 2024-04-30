<div class="col-md-8 mx-auto p-5">

    <!-- Diferente do curso, lá aparece dentro de uma barra cinza -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= URL ?>/posts" data-toggle="tooltip" title="Posts">Posts</a></li>
            <li class="breadcrumb-item active" aria-current="page">Write</li>
        </ol>
    </nav>

    <div class="card">
        <div class="card-header secondaryBg text-white">
            Write Post
        </div>
        <div class="card-body bg-light">

            <form name="login" method="POST" action="<?= URL ?>/posts/register" class="mt-4">

                <div class="form-group">
                    <label for="title">Title: <sup class="text-danger">*</sup></label>
                    <input type="text" name="title" id="title" value="<?= $data['title'] ?>" class="form-control <?= $data['title_err'] ? 'is-invalid' : '' ?>">
                    <div class="invalid-feedback">
                        <?= $data['title_err'] ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="txt">Text: <sup class="text-danger">*</sup></label>
                    <textarea name="txt" id="txt" class="form-control  <?= $data['txt_err'] ? 'is-invalid' : '' ?>" rows="5"><?= $data['txt'] ?></textarea>
                    <div class="invalid-feedback">
                        <?= $data['txt_err'] ?>
                    </div>
                </div>

                <div class="row m-2">
                    <div class="d-grid gap-2">
                        <input type="submit" value="Send/Post" class="btn btn-info text-white" data-toggle="tooltip" title="Post">
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>