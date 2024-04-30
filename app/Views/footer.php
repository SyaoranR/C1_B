<footer class="p-5 text-light">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <h5>PHP Alex</h5>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item bg-transparent">
                        <a href="<?= URL ?>" data-toggle="tooltip" title="Página Inicial">Home</a>
                    </li>
                    <li class="list-group-item bg-transparent">
                        <a href="<?= URL ?>/pages/about" data-toggle="tooltip" title="About Us">About Us</a>
                    </li>
                </ul>
            </div>
            <div class="col-md-3">
                <h5>Contact</h5>
                <small>
                    Contacting us
                </small>
                <p class="mt-3"><i class="fas fa-phone mr-2"></i> <small> (00) </small>0000-0000</p>
                <p><i class="fab fa-whatsapp mr-2"></i> <small> (00) </small><a href="http://api.whatsapp.com/send?1=pt_BR&phone=55DD900000000" data-toggle="tooltip" title="Click to talk in Whatsapp">90000-0000</a></p>
                <p>
                    <i class="fas fa-envelope"></i>
                    <a href="mailto:email@alex.com.br">email@alex.com.br</a>
                </p>
            </div>
            <div class="col-md-3">
                <h5>Location</h5>
                <div class="text-center">
                    <i class="fas fa-map-marker-alt"></i>
                    <address>
                        Avenue PHP, Nº 7, Devs for Web. City, UF CEP: 70.400-800
                    </address>
                </div>

            </div>
            <div class="col-md-3 d-flex align-items-center">
                <h2 class="animatedText">PHP Alex</h2>
            </div>
        </div>

        <small>
            <div class="row border-top py-2 mt-3">
                <div class="col-md-9">
                    &COPY; Copyright 2020 - <?= date('Y') ?> All Rights Reserved. <?= APP_NAME ?> <a href="https://www.alex.com.br" title="<?= APP_NAME ?>">www.alex.com.br</a>
                </div>
                <div class="col-md-3 text-right">
                    UnSet Version: <?= APP_VER ?>
                </div>
            </div>
        </small>
    </div>
</footer>