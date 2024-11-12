<?php

// Classes Autoload

// register any number of autoloaders
spl_autoload_register(function ($class) {

    // directories list
    $directories = ['Libraries', 'Helpers'];

    // iterates directories in classes' search
    foreach ($directories as $diretory) :
        // __DIR__ const returns file's directory
        // SEPARATOR = '/'
        $arch = (__DIR__ . DIRECTORY_SEPARATOR . $diretory . DIRECTORY_SEPARATOR . $class . '.php');
        if (file_exists($arch)) :
            // 'includes' class file if it exists
            require_once $arch;
        endif;
    endforeach;
});
