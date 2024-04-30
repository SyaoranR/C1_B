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

    /* checa e cadastra posts */
    public function register()
    {

        // receiving form's data and filtering it
        // https://stackoverflow.com/questions/69207368/constant-filter-sanitize-string-is-deprecated
        // $form = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $form = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (isset($form)) :
            $data = [
                'title' => trim($form['title']),
                'txt' => trim($form['txt']),
                'user_id' => $_SESSION['user_id']
            ];

            // null fields check
            if (in_array("", $form)) :

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
                    Url::redirect('posts');
                else :
                    die("Error saving post at database");
                endif;

            endif;
        else :
            $data = [
                'title' => '',
                'txt' => '',
                'title_err' => '',
                'txt_err' => ''
            ];

        endif;

        // defines form's view for posts' register
        $this->view('posts/register', $data);
    }

    // check and post's data edit by Id
    public function edit($id)
    {

        // receiving form's data and filtering it
        // https://stackoverflow.com/questions/69207368/constant-filter-sanitize-string-is-deprecated
        // $form = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $form = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (isset($form)) :
            $data = [
                'id' => $id,
                'title' => trim($form['title']),
                'txt' => trim($form['txt'])
            ];

            if (in_array("", $form)) :

                if (empty($form['title'])) :
                    $data['title_err'] = 'Fill the title field';
                endif;

                if (empty($form['txt'])) :
                    $data['txt_err'] = 'Fill the campo text field';
                endif;

            else :
                if ($this->postModel->update($data)) :
                    // echo 'Post successfully edited<hr>';
                    Session::msg('post', 'Post successfully edited');
                    // header('Location: '.Url.'');
                    Url::redirect('posts');
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
                'title' => $post->title,
                'txt' => $post->txt,
                'title_err' => '',
                'txt_err' => ''
            ];

        endif;

        $this->view('posts/edit', $data);
    }


    // showing post with writer's data 
    public function show($id)
    {
        // calling method to read posts by Id at postModel
        $post = $this->postModel->readPostById($id);

        if($post == null){
            Url::redirect('pages/error');
        }

        // calling method to read user by Id at userModel
        $author = $this->userModel->readUserById($post->user_id);
        $admin = $this->userModel->readAdmin();

        // defining data view
        $data = [
            'post' => $post,
            'author' => $author,
            'admin' => $admin
        ];

        // defining view to show post
        $this->view('posts/show', $data);
    }

    public function delete($id)
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
                    Url::redirect('posts');
                endif;
            else :
                Session::msg('post', "You're not allowed to delete this Post", 'alert alert-danger');
                Url::redirect('posts');
            endif;

        else :
            Session::msg('post', "You're not allowed to delete this Post", 'alert alert-danger');
            Url::redirect('posts');
        endif;
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
