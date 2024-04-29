<?php
/*
 * Controller loads models and views
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