<?php

// Data and Communication Control with Category model
// It is conventional having the same name 'like' a table

class Categories extends Controller
{

    public function __construct()
    {
        $this->postModel = $this->model('Post');
        $this->userModel = $this->model('User');
        $this->categoryModel = $this->model('Category');
    }

    public function index($id)    
    {
        $post = $this->categoryModel->readPostsByCategory($id);
        
        if ($post == null) {
            Session::msg('category', 'No post to show in this category');
        }

        $admin = $this->userModel->readAdmin();
        $categories = $this->categoryModel->readCategories();
        
        $data = [
            'posts' => $post,
            'categories' => $categories,
            'admin' => $admin
        ];

        $this->view('categories/index', $data);
    }
}
