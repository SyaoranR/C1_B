<?php

/**
 * Data and Communication Control with Post model
 * It is conventional having the same name 'like' a table, example "Posts"
 * in plural, with entity being in singular as "Post" * 
 * 
 * @author Alessandro Fraga Gomes
 * @copyright 2021-2024 Php7 Alex
 * @version 1.1.1
 */

class Posts extends Controller {

    public function __construct()
    {       
         // Calling database communication models 
         $this->postModel = $this->model('Post');
         $this->userModel = $this->model('User');
         $this->categoryModel = $this->model('Category');
    }

    // public function index($id) {
    public function index($url_posts) {
        // calling method to read posts by Id at postModel
        // $post = $this->postModel->readPostById($id);
        $post = $this->postModel->readPostByUrl($url_posts);

        if($post == null) {
            Url::redirect('pages/error');
        }

        // calling method to read user by Id at userModel
        $author = $this->userModel->readUserById($post->user_id);
        $admin = $this->userModel->readAdmin();        
        $categories = $this->categoryModel->readCategories();
        $category = $this->categoryModel->readCategoryById($post->category_id);

        // defining data view
        $data = [
            'post' => $post,
            'author' => $author,
            'categories' => $categories,
            'category' => $category,
            'admin' => $admin
        ];

        // defining view to show post
        $this->view('posts/show', $data);
    }
    
    public function search()
    {

        // https://stackoverflow.com/questions/69207368/constant-filter-sanitize-string-is-deprecated
        // $form = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);         
        $search = filter_input(INPUT_POST, 'search', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (!empty($search)) {

            // echo $search;
            $posts = $this->postModel->findPost($search);
            // $user = $this->userModel->readUserById(1);
            $admin = $this->userModel->readAdmin();
            $categories = $this->categoryModel->readCategories();
            $count = $this->postModel->count();
            $result = $count > 1 ? 'results' : 'result';


            if ($posts == null) :
                Session::msg('post', 'Your search for <b>'.$search.'</b> returned none results.', 'alert alert-warning');
            else:

                Session::msg('post', 'Your search for <b style="color:green">'.$search.'</b> returned <b style="color:green">'.$count.'</b>'.$result.' ', 'alert alert-info');      

            endif;

            // defines data for posts
            $data = [
                'posts' => $posts,
                'admin' => $admin,
                'textSearch' => $search,
                'categories' => $categories
            ];

            // defines view to show posts
            $this->view('posts/search', $data);

        } else {
            Session::msg('post', 'To make a search, fill the search field with at least one word', 'alert alert-info');
            Url::redirect('./');
        }
    }

}