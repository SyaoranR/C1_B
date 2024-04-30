<header>
<div class="container">
        <nav class="navbar navbar-expand-sm">
            <a class="navbar-brand" href="<?= URL ?>">
                <div class="zoom">
                    <img class="img-fluid logo" src="<?= URL ?>/public/imgs/icon.png" alt="<?= APP_NAME ?>" title="<?= APP_NAME ?>">
                </div>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?=URL?>" data-tooltip="tooltip" title="Initial Page">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?=URL?>/pages/about" data-tooltip="tooltip" title="About Us">About Us</a>
                    </li>
                </ul>

                
                <?php if (isset($_SESSION['user_id'])) : ?>
                    <span class="navbar-text">
                        <p class="text-white">Hello, <?= $_SESSION['user_name'] ?>, Welcome</p>
                        <a class="btn btn-sm btn-danger" href="<?= URL ?>/users/logout" data-toggle="tooltip" title="Logout">Logout</a>

                        <a class="btn btn-sm btn-primary" href="<?= URL ?>/users/profile/<?= $_SESSION['user_id'] ?>" data-toggle="tooltip" title="User Panel">Profile</a>
                        <?php if ($_SESSION['user_level'] == 3) : ?>
                            <a class="btn btn-sm btn-dark" href="<?= URL ?>/admin/index" data-toggle="tooltip" title="Administrator Panel">Admin</a>
                        <?php endif; ?>
                    </span>                   
                <?php endif; ?>       
                                
            </div>
        </nav>
    </div>
</header>
<div class="clearfix"></div>