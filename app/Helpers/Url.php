<?php

class Url {

    public static function redirect($url){
        // sends header HTTP, separator = '/'
        header("Location:".URL.DIRECTORY_SEPARATOR.$url);
    }
}