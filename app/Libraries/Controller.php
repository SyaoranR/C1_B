<?php
/*
 * Controller loads models and views
 * 
 * @author Alessandro Fraga Gomes
 * @copyright 2021-2024 Php7 Alex
 * @version 1.1.1
 */

class Controller {

    // load models
    public function model($model) {
        require_once '../app/Models/'.$model.'.php';
        // model instance
        return new $model;
    }

    // load views
    public function view($view, $data = []) {
        $file = ('../app/Views/'.$view.'.php');
        if (file_exists($file)):
            require_once $file;
        else:
            // finish script's execution
            die('This page does not exist...');
        endif;        
    }

}