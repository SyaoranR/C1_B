<?php

// Data and Communication Control with user model

class Posts extends Controller {

    public function __construct()
    {       
         // Calling database communication models 
         $this->postModel = $this->model('Post');
         $this->userModel = $this->model('User');
    }

    public function index() {
        Url::redirect('./');
    }

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
                    $data['title_err'] = 'Inform Title';
                endif;

                if (empty($form['txt'])) :
                    $data['txt_err'] = 'Type text';
                endif;

            else :

                // saving posts on database
                if ($this->postModel->save($data)) :
                    // echo 'Post Registered Successfully<hr>';
                    Session::msg('post', 'Post successfully sent');
                    // header('Location: '.Url.'');
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
                'txt_err' => '',
            ];
        endif;

        // var_dump($form);

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
                     $data['title_err'] = 'Informe titleo';
                 endif;
 
                 if (empty($form['txt'])) :
                     $data['txt_err'] = 'Type text';
                 endif;
 
             else :
 
                 if ($this->postModel->update($data)) :
                     // echo 'Cadastro realizado com sucesso<hr>';
                     Session::msg('post', 'Post successfully edited');
                     // header('Location: '.Url.'');
                     Url::redirect('posts');
                 else :
                     die("Error editing post");
                 endif;
 
             endif;
 
         else :
 
             $post = $this->postModel->readPostById($id);
 
             // if user id not equal to session user id (logged user)
             if ($post->user_id != $_SESSION['user_id']) :
                 Session::msg('post', 'This user cannot edit the post', 'alert alert-danger');
                 Url::redirect('posts');
             endif;
 
             $data = [
                 'id' => $post->id,
                 'title' => $post->title,
                 'txt' => $post->txt,
 
                 'title_err' => '',
                 'txt_err' => '',
             ];
 
         endif;
 
        //  var_dump($form);
 
         $this->view('posts/edit', $data);
     }


    public function show($id)
    {
        // calling method to read posts by Id at postModel
        $post = $this->postModel->readPostById($id);

        if($post == null) {
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

    public function exclude($id)
    {
        // var_dump($id);

        
        // checking user auth to delete post
        if (!$this->checkAuth($id)) :

            $id = filter_var($id, FILTER_VALIDATE_INT);
            // REQUEST_METHOD - access to page, 
            // generally GET, HEAD, POST OR PUT
            // SANITIZE_STRING - removes HTML tags from string
            // https://stackoverflow.com/questions/69207368/constant-filter-sanitize-string-is-deprecated
            // $method = filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_SANITIZE_STRING);
            $method = filter_input(INPUT_SERVER, 'REQUEST_METHOD',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
           
            
            // echo '<hr>';
            // var_dump($id);
            // echo '<hr>';
            // var_dump($method);
            
            // it just verifies if id exists, but don't filter as int
            // IF (isset($id)) : endif;

            // id check, passed through filter and method == POST, this means it only executes through form, not by a 'forced' delete like putting id at browser after '/', 
            if ($id && $method == 'POST') :
                if($this->postModel->delete($id)):
                    Session::msg('post', 'Post successfully excluded');
                    Url::redirect('posts');
                endif;    
            else:
                Session::msg('post', 'This user cannot delete this post', 'alert alert-danger');
                Url::redirect('posts');                              
            endif;

        else :
            Session::msg('post', 'This user cannot delete this post', 'alert alert-danger');
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