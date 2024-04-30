<div class="container my-3">

    <div class="card bg-light">
        <?= Session::msg('user') ?>
        <div class="row">
            <div class="col-md-4">
                <div class="zoom">
                    <div class="zoom">
                        <img class="avatar" src="<?= $data['avatar'] ?>">                        
                    </div>
                    <h4 class="text-center"><?= $data['username'] ?></h4>                    
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header primaryBg">
                        Personal Data 
                    </div>
                    <div class="card-body">

                        <form name="update" method="POST" action="<?= URL ?>/users/profile/<?= $data['id'] ?>">
                            <div class="form-group">
                                <label for="avatar">Avatar:</label>
                                <input type="text" name="avatar" id="avatar" value="<?= $data['avatar'] ?>" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="username">Name: <sup class="text-danger">*</sup></label>
                                <input type="text" name="username" id="username" value="<?= $data['username'] ?>" class="form-control <?= $data['username_err'] ? 'is-invalid' : '' ?>">
                                <div class="invalid-feedback">
                                    <?= $data['username_err'] ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="email">E-mail: <sup class="text-danger">*</sup></label>
                                <input type="text" name="email" id="email" value="<?= $data['email'] ?>" class="form-control <?= $data['email_err'] ? 'is-invalid' : '' ?>">
                                <div class="invalid-feedback">
                                    <?= $data['email_err'] ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="pass">Password:</label>
                                <input type="password" name="pass" id="pass" class="form-control  <?= $data['pass_err'] ? 'is-invalid' : '' ?>">
                                <div class="invalid-feedback">
                                    <?= $data['pass_err'] ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="bio">Biography:</label>
                                <textarea name="bio" id="bio" class="form-control" rows="5"><?= $data['bio'] ?></textarea>
                            </div>
                            
                            <div class="form-group">
                                <label for="youtube">YouTube:</label>
                                <input type="text" name="youtube" id="youtube" value="<?= $dados['youtube'] ?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="instagram">Instagram:</label>
                                <input type="text" name="instagram" id="instagram" value="<?= $dados['instagram'] ?>" class="form-control">
                            </div>

                            <div class="d-grid gap-2">
                                <input type="submit" value="Update" data-toggle="tooltip" title="Update Profile Data" class="btn secondaryBg btn-block">
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>