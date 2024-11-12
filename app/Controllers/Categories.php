<?php

/**
 * Data and Communication Control with Category model
 * It is conventional having the same name 'like' a table, example "Categories"
 * in plural, with entity being in singular as "Category"
 * 
 * @author Alessandro Fraga Gomes
 * @copyright 2021-2024 Php7 Alex
 * @version 1.1.1
 */


class Categories extends Controller
{

    public function __construct()
    {
        $this->postModel = $this->model('Post');
        $this->userModel = $this->model('User');
        $this->categoryModel = $this->model('Category');
    }


    // extra method to correct working of program
    // public function index($url_categories)    
    public function adminCateg($id)    
    {
        // $post = $this->categoryModel->readPostsByCategory($id);
        // $post = $this->categoryModel->readPostsByCategory($url_categories);
        $post = $this->categoryModel->readPostsByCategId($id);
        // var_dump($post);
        
        if ($post == null) {
            Session::msg('category', 'No post to show in this category');
        }

        $admin = $this->userModel->readAdmin();
        $categories = $this->categoryModel->readCategories();
        $category = $this->categoryModel->readCategoryById($id);
        // $category = $this->categoryModel->readCategoryByUrl($url_categories);
        
        $data = [
            'posts' => $post,
            'categories' => $categories,
            'category' => $category,
            'admin' => $admin
        ];

        $this->view('categories/index', $data);
    }
    // extra method ENDS HERE    

    // public function index($id)    
    public function index($url_categories)    
    {
        // $post = $this->categoryModel->readPostsByCategory($id);
        $post = $this->categoryModel->readPostsByCategoryUrl($url_categories);
        // var_dump($post);
        
        if ($post == null) {
            Session::msg('category', 'No post to show in this category');
        }

        $admin = $this->userModel->readAdmin();
        $categories = $this->categoryModel->readCategories();
        $category = $this->categoryModel->readCategoryByUrl($url_categories);
        
        $data = [
            'posts' => $post,
            'categories' => $categories,
            'category' => $category,
            'admin' => $admin
        ];

        $this->view('categories/index', $data);
    }
}
