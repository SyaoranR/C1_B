<?php

// Data and Communication Control with Post model
// It is conventional having the same name 'like' a table

class Posts extends Controller {

    public function __construct()
    {       
         // Calling database communication models 
         $this->postModel = $this->model('Post');
         $this->userModel = $this->model('User');
         $this->categoryModel = $this->model('Category');
    }

    public function index($id) {
        // calling method to read posts by Id at postModel
        $post = $this->postModel->readPostById($id);

        if($post == null) {
            Url::redirect('pages/error');
        }

        // calling method to read user by Id at userModel
        $author = $this->userModel->readUserById($post->user_id);
        $admin = $this->userModel->readAdmin();
        $categories = $this->categoryModel->readCategories();

        // defining data view
        $data = [
            'post' => $post,
            'author' => $author,
            'categories' => $categories,
            'admin' => $admin
        ];

        // defining view to show post
        $this->view('posts/show', $data);
    }
    
   

}