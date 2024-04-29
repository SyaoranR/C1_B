<header class="bg-dark">
    <div class="container">
        <nav class="navbar navbar-expand-sm navbar-dark">        
            <a class="navbar-brand" href="<?=URL?>"><img class="sqr-img" src="<?=URL?>/public/imgs/logo.png"></a>
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

                <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                    
                    <?php if (isset($_SESSION['user_id'])) : ?>
                        <span class="navbar-text">
                            <p>Hello, <?= $_SESSION['user_name'] ?>, Welcome</p>
                            <a class="btn btn-sm btn-danger" href="<?= URL ?>/users/logout" data-toggle="tooltip" title="Logout">Logout</a>

                            <a class="btn btn-sm btn-primary" href="<?= URL ?>/users/profile/<?= $_SESSION['user_id'] ?>" data-toggle="tooltip" title="User Panel">Profile</a>
                        </span>

                    <?php else : ?>
                        <span class="navbar-text">
                            <a class="btn btn-info" href="<?= URL ?>/users/register" data-tooltip="tooltip" title="Don't have an account? Sign Up">Sign Up</a>
                            <a class="btn btn-info" href="<?= URL ?>/users/login" data-tooltip="tooltip" title="Already have an account? Login">Sign In</a>         
                        </span>
                    <?php endif; ?>
                    
                </div>
                                
            </div>
        </nav>
    </div>
</header>