<div class="container py-5">
    
    <div class="row">
        <div class="col-lg-3">

            <div class="sideBar admin">
                <h4>Menu</h4>
                <ul>
                    <li>
                        <a href="<?=URL?>/admin/register/post" data-toggle="tooltip" title="Posts Register">
                            <i class="far fa-edit"></i> Posts Register
                        </a>
                    </li>
                    <li>
                        <a href="<?=URL?>/admin/list/posts" data-toggle="tooltip" title="List Posts">
                            <i class="fas fa-list"></i> List Posts
                        </a>
                    </li>
                    <li>
                        <a href="<?=URL?>/admin/register/category" data-toggle="tooltip" title="Categories Register">
                            <i class="far fa-edit"></i> Categories Register
                        </a>
                    </li>
                    <li>
                        <a href="<?=URL?>/admin/list/categories" data-toggle="tooltip" title="List Categories">
                            <i class="fas fa-list"></i> List Categories
                        </a>
                    </li>
                </ul>
            </div>

        </div>
        <div class="col-lg-9">
            <?= Session::msg('post') ?>
            <?= Session::msg('category') ?>
            <h1>ADMINISTRATION</h1>
        </div>
    </div>
</div>