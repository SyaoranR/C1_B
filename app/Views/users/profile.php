<div class="container my-3">

    <div class="card bg-light">
        <?= Session::msg('user') ?>
        <div class="row">
            <div class="col-md-4">

                <div class="sideBar">
                    <div class="zoom">
                        <?php if (!empty($data['admin']->avatar)) : ?>
                            <img class="avatar" src="<?= URL.'/uploads/images/'.$data['admin']->avatar ?>">
                        <?php else: ?>
                            <img class="avatar" src="https://via.placeholder.com/150">
                        <?php endif ?>
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

                        <form name="update" enctype="multipart/form-data" method="POST" action="<?= URL ?>/users/profile/<?= $data['id'] ?>">
                            <!-- <div class="form-group">
                                <label for="avatar">Avatar:</label>
                                <input type="text" name="avatar" id="avatar" value="<//?= code //$data['avatar'] ?>" class="form-control">
                            </div> -->

                            <div class="form-group">
                                <label>Avatar</label>
                                <!-- <div class="input-group mb-3 <//?= $data['upload_err'] ? 'is-invalid' : '' ?>"> -->
                                <div class="input-group mb-3 <?= $data['upload_err'] ? 'is-invalid' : '' ?>">
                                    <input type="file" name="avatar" class="form-control" id="inputGroupFile02" />
                                    <label class="input-group-text" for="inputGroupFile02">Send File</label>
                                </div>
                                <div class="invalid-feedback">
                                    <?= $data['upload_err'] ?>
                                </div>
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
                                <input type="password" name="pass" id="pass" class="form-control  </?= $data['pass_err'] ? 'is-invalid' : '' ?>">
                                <div class="invalid-feedback">
                                    <?= $data['pass_err'] ?>
                                </div>
                            </div>
                           
                            <div class="form-group">
                                <label for="bio">Biography:</label>
                                <textarea name="bio" id="bio" class="form-control" rows="5"><?= $data['bio'] ?></textarea>
                            </div>
                            
                            <div class="form-group">
                                <label for="facebook">Facebook:</label>
                                <input type="text" name="facebook" id="facebook" value="<?= $data['facebook'] ?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="youtube">YouTube:</label>
                                <input type="text" name="youtube" id="youtube" value="<?= $data['youtube'] ?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="instagram">Instagram:</label>
                                <input type="text" name="instagram" id="instagram" value="<?= $data['instagram'] ?>" class="form-control">
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