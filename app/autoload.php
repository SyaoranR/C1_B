<?php

// Classes Autoload

// register any number of autoloaders
spl_autoload_register(function ($classe) {

    // directories list
    $diretorios = ['Library', 'Helper'];

    // iterates directories in classes' search
    foreach ($diretorios as $diretorio) :
        // __DIR__ const returns file's directory
        // SEPARATOR = '/'
        $arq = (__DIR__ . DIRECTORY_SEPARATOR . $diretorio . DIRECTORY_SEPARATOR . $classe . '.php');
        if (file_exists($arq)) :
            // 'includes' class file if it exists
            require_once $arq;
        endif;
    endforeach;
});
