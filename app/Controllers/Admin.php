<?php
 
// Data and Communication Control with user model

class Admin extends Controller
{

    public function __construct()
    {
        // Calling database communication models 
        $this->postModel = $this->model('Post');
        $this->userModel = $this->model('User');
        $this->categoryModel = $this->model('Category');

        // add methods from model to vars 
        $this->posts = $this->postModel->readPosts();
        $this->categories = $this->categoryModel->readCategories();

        $admin = $this->userModel->readAdmin();
        if(!$admin->level == $_SESSION['user_level']){
            session_destroy();
            Url::redirect('./');
        }

    }

    // show admin view
    public function index() {
       $this->view('admin/index');
    }

    public function register($type)
    {
        if ($type == 'post') {
            // call post register method
            $this->postRegister();
        } elseif ($type == 'category') {
            // call category register method
            $this->categoryRegister();
        } else {
            Url::redirect("pages/error");
        }
    }

    public function edit($type, $id)
    {
        if ($type == 'post') {
            // call post edit method
            $this->postEdit($id);
        } elseif ($type == 'category') {
            // call category edit method
            $this->categoryEdit($id);
        } else {
            Url::redirect("pages/error");
        }
    }

    public function delete($type, $id)
    {
        if ($type == 'post') {
            // call post delete method
            $this->postDelete($id);
        } elseif ($type == 'category') {
            // call category delete method
            $this->categoryDelete($id);
        } else {
            Url::redirect('pages/error');
        }
    }

    public function list($type)
    {
        if ($type == 'posts') {
            // call post list method
            $this->postsList();
        } elseif ($type == 'categories') {
            // call categories list method
            $this->categoriesList();
        } else {
            Url::redirect('pages/error');
        }
    }


    /* check and register posts */
    public function postRegister()
    {

        // receiving form's data and filtering it
        // https://stackoverflow.com/questions/69207368/constant-filter-sanitize-string-is-deprecated
        // $form = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $form = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if (isset($form)) :
            $data = [
                'category_id' => trim($form['category']),
                'title' => trim($form['title']),
                'txt' => trim($form['txt']),
                'user_id' => $_SESSION['user_id'],
                'category_err',
                'title_err' => '',
                'txt_err' => '',
                'categories' => $this->categories,
            ];

            // null fields check
            if (in_array("", $form)) :

                if (empty($form['category'])) :
                    $data['category_err'] = 'Select a Category';
                endif;

                if (empty($form['title'])) :
                    $data['title_err'] = 'Fill the title field';
                endif;

                if (empty($form['txt'])) :
                    $data['txt_err'] = 'Fill the text field';
                endif;

            else :
                // saving posts in database
                if ($this->postModel->save($data)) :
                    // echo 'Post Registered Successfully<hr>';
                    Session::msg('post', 'Post Registered Successfully');
                    Url::redirect('admin/list/posts');
                else :
                    die("Error saving post at database");
                endif;

            endif;
        else :
            $data = [
                'categories' => $this->categories,
                'title' => '',
                'txt' => '',

                'category_err' => '',
                'title_err' => '',
                'txt_err' => ''
            ];

        endif;

        // defines form's view for posts' register
        $this->view('admin/posts/register', $data);
    }

    private function categoryRegister()
    {

        // receiving form's data and filtering it
        // https://stackoverflow.com/questions/69207368/constant-filter-sanitize-string-is-deprecated
        // $form = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $form = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (isset($form)) :
            $data = [
                'title' => trim($form['title']),
                'descr' => trim($form['descr']),
                'title_err' => '',
                'descr_err' => ''
            ];

            // null fields check
            if (in_array("", $form)) :

                if (empty($form['title'])) :
                    $data['title_err'] = 'Type title';
                endif;

                if (empty($form['descr'])) :
                    $data['descr_err'] = 'Type a text';
                endif;

            else :

                // saving categories on database
                if ($this->categoryModel->save($data)) :
                    // echo 'Category successfully created<hr>';
                    Session::msg('category', 'Category successfully created');
                    // header('Location: '.Url.'');
                    Url::redirect('admin/list/categories');
                else :
                    die("Error saving category at database");
                endif;

            endif;

        else :
            $data = [
                'title' => '',
                'descr' => '',

                'title_err' => '',
                'descr_err' => '',
            ];
        endif;

        //var_dump($form);

        // defines form's view for categories' register
        $this->view('admin/categories/register', $data);
    }

    // check and post's data edit by Id
    public function postEdit($id)
    {

        // receiving form's data and filtering it
        // https://stackoverflow.com/questions/69207368/constant-filter-sanitize-string-is-deprecated
        // $form = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $form = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (isset($form)) :
            $data = [
                'id' => $id,
                'category_id' => trim($form['category']),
                'title' => trim($form['title']),
                'txt' => trim($form['txt']),
                'title_err' => '',
                'txt_err' => ''
            ];

            if (in_array("", $form)) :

                if (empty($form['title'])) :
                    $data['title_err'] = 'Fill the title field';
                endif;

                if (empty($form['txt'])) :
                    $data['txt_err'] = 'Fill the text field';
                endif;

            else :
                if ($this->postModel->update($data)) :
                    // echo 'Post successfully edited<hr>';
                    Session::msg('post', 'Post successfully edited');
                    // header('Location: '.Url.'');
                    Url::redirect('admin/list/posts');
                else :
                    die("Error editing post");
                endif;

            endif;
        else :

            $post = $this->postModel->readPostById($id);

            if ($post->user_id != $_SESSION['user_id']) :
                Session::msg('post', "You're not allowed to edit this Post", 'alert alert-danger');
                Url::redirect('posts');
            endif;

            $data = [
                'id' => $post->id,
                'categories' => $this->categories,
                'category_id' => $post->category_id,
                'title' => $post->title,
                'txt' => $post->txt,
                'title_err' => '',
                'txt_err' => ''
            ];

        endif;

        $this->view('admin/posts/edit', $data);
    }

    public function categoryEdit($id)
    {

        // receiving form's data and filtering it
        // https://stackoverflow.com/questions/69207368/constant-filter-sanitize-string-is-deprecated
        // $form = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $form = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (isset($form)) :
            $data = [
                'id' => $id,
                'title' => trim($form['title']),
                'descr' => trim($form['descr']),
                'title_err' => '',
                'descr_err' => ''
            ];

            if (in_array("", $form)) :

                if (empty($form['title'])) :
                    $data['title_err'] = 'Fill the title field';
                endif;

                if (empty($form['descr'])) :
                    $data['descr_err'] = 'Fill the text field';
                endif;

            else :
                if ($this->categoryModel->update($data)) :
                    // echo 'Post successfully edited<hr>';
                    Session::msg('category', 'Post successfully edited');
                    // header('Location: '.Url.'');
                    Url::redirect('admin/list/categories');
                else :
                    die("Error editing category");
                endif;

            endif;
        else :

            $category = $this->categoryModel->readCategoryById($id);           

            $data = [
                'id' => $category->id,
                'title' => $category->title,
                'descr' => $category->descr,
                
                'title_err' => '',
                'descr_err' => ''
            ];

        endif;

        $this->view('admin/categories/edit', $data);
    }

    public function postDelete($id)
    {
        // checking user auth to delete post
        if (!$this->checkAuth($id)) :
            
            $id = filter_var($id, FILTER_VALIDATE_INT);
            /* filter_input — Obtains specific external var by name and opcionally filters it
            INPUT_SERVER - Constant
            REQUEST_METHOD - Contains methods. Generally 'GET', 'HEAD', 'POST' or 'PUT'            
             */
            // $method = filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_SANITIZE_STRING); SANITIZE_STRING DEPRECATED
            $method = filter_input(INPUT_SERVER, 'REQUEST_METHOD',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
           
            // id check, passed through filter and method == POST, this means it only executes through form, not by a 'forced' delete like putting id at browser after '/',
            if ($id && $method == 'POST') :
                // destroy post model by ID
                if ($this->postModel->delete($id)) :
                    Session::msg('post', 'Post successfully excluded');
                    Url::redirect('admin/list/posts');
                endif;
            else :
                Session::msg('post', "You're not allowed to delete this Post", 'alert alert-danger');
                Url::redirect('admin/list/posts');
            endif;

        else :
            Session::msg('post', "You're not allowed to delete this Post", 'alert alert-danger');
            Url::redirect('admin/list/posts');
        endif;
    }


    public function categoryDelete($id)
    {
        // checking user auth to delete post
        if (!$this->checkAuth($id)) :
            
            $id = filter_var($id, FILTER_VALIDATE_INT);
            /* filter_input — Obtains specific external var by name and opcionally filters it
            INPUT_SERVER - Constant
            REQUEST_METHOD - Contains methods. Generally 'GET', 'HEAD', 'POST' or 'PUT'            
             */
            // $method = filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_SANITIZE_STRING); SANITIZE_STRING DEPRECATED
            $method = filter_input(INPUT_SERVER, 'REQUEST_METHOD',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
           
            // id check, passed through filter and method == POST, this means it only executes through form, not by a 'forced' delete like putting id at browser after '/',
            if ($id && $method == 'POST') :
                if ($this->categoryModel->postsCheck($id)) :
                    Session::msg('category', 'This category cannot be deleted, as there are post(s) registered in it, delete or change the post category', 'alert alert-warning');
                    Url::redirect('admin/list/categories');
                else :
                    if ($this->categoryModel->delete($id)) :
                        Session::msg(
                            'category',
                            'Category successfully excluded'
                        );
                        Url::redirect('admin/list/categories');
                    endif;
                endif;
            endif;
        endif;
    }    

    private function postsList()
    {
        $data = [
            'posts' => $this->posts,
        ];
        $this->view('admin/posts/list', $data);
    }

    private function categoriesList()
    {

        $data = [
            'categories' => $this->categories
        ];
        $this->view('admin/categories/list', $data);
    }

    
    // is logged user == to userId who made post
    private function checkAuth($id)
    {
        $post = $this->postModel->readPostById($id);
        if ($post->user_id != $_SESSION['user_id']) :
            return true;
        else :
            return false;
        endif;
    }
}
