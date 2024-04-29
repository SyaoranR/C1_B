<?php

// Classes Autoload

// register any number of autoloaders
spl_autoload_register(function ($class){

    // directories list
    $directories = ['Libraries', 'Helpers'];

    // iterates directories in class' search
    foreach($directories as $directory):
        // __DIR__ const returns file's directory
        // SEPARATOR = '/'
        $file = (__DIR__.DIRECTORY_SEPARATOR.$directory.DIRECTORY_SEPARATOR.$class.'.php');    
        if (file_exists($file)):
            // 'includes' class file if it exists
            require_once $file;
        endif;
    endforeach;        

});