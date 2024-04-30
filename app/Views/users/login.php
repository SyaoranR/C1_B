<div class="col-xl-4 col-md-6 mx-auto p-5">
    <div class="card">
        <div class="card-header primaryBg text-white">
            Login
        </div>
        <div class="card-body">
            <?=Session::msg('user')?>
            <p class="card-text"><small class="text-muted">Inform your login</small></p>

            <form name="login" method="POST" action="<?= URL ?>/users/login" class="mt-4">

                <div class="form-group">
                    <label for="email">E-mail: <sup class="text-danger">*</sup></label>
                    <input type="text" name="email" id="email" value="<?=$data['email']?>" class="form-control <?= $data['email_err'] ? 'is-invalid' : '' ?>">
                    <div class="invalid-feedback">
                        <?= $data['email_err'] ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="pass">Password: <sup class="text-danger">*</sup></label>
                    <input type="password" name="pass" id="pass" value="<?=$data['pass']?>" class="form-control  <?= $data['pass_err'] ? 'is-invalid' : '' ?>">
                    <div class="invalid-feedback">
                        <?= $data['pass_err'] ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <input type="submit" value="Login" class="btn secondaryBg btn-block">
                    </div>
                    <div class="col-md-6">
                        <a href="<?=URL?>/users/register">Don't have an account? Register</a>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>