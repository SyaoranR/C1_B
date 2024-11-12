<?php

/**
 * Data, Communication and views Control
 * It is conventional having the same name 'like' a table, example "Pages"
 * in plural
 * 
 * 
 * @author Alessandro Fraga Gomes
 * @copyright 2021-2024 Php7 Alex
 * @version 1.1.1
 */

class Pages extends Controller {

    public function __construct()
    {  
         // Calling database communication models 
         $this->postModel = $this->model('Post');
         $this->userModel = $this->model('User');
         $this->categoryModel = $this->model('Category');
    }

    public function index() {    
        
        // $title = "FriendlyUrl with <b>no</b> special chars ~~``";
        // echo Url::friendlyUrl($title);
        
        $posts = $this->postModel->readPosts();
        $admin = $this->userModel->readAdmin();
        $categories = $this->categoryModel->readCategories();
        
        if ($posts == null) :
            Session::msg('post', 'No post registered.', 'alert alert-info');
        endif;

        // defines data for posts
        $data = [
            'posts' => $posts,
            'admin' => $admin,
            'categories' => $categories
        ];

        // defines view to show posts
        $this->view('posts/index', $data);
        
    }
    

    public function about() {
        $data = [
            'title' => APP_NAME
            //'descricao' => 'Curso PHP7'
        ];

        // calling route
        $this->view('pages/about', $data);

    }
    
    public function error() {
        $data = [
            'title' => 'Not Found'
            //'descricao' => 'Curso PHP7'
        ];

        // calling route
        $this->view('pages/error', $data);

    }
    
}


/*
 *
 * public function about($id, $city) {
 *     echo $id.'<hr>';
 *     echo $city.'<hr>';
 * } 
 * 
 * public function index() {  
 *     $this->view('pages/home');     
 * } 
 * 
 */