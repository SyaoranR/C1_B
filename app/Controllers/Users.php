<?php

// Data and Communication Control with user model

class Users extends Controller {

    public function __construct()
    {
        // $this is a pseudo-var, calls User Model for database communication
        $this->userModel = $this->model('User');
    }

    // user data checking and edition by Id
    public function profile($id)
    {
        // search user at model by Id
        $user = $this->userModel->readUserById($id);

        // receiving form's data and filtering it
        // receiving form's data and filtering it
        // https://stackoverflow.com/questions/69207368/constant-filter-sanitize-string-is-deprecated
        // $form = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $form = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        
        if (isset($form)) :
            
            // defining data
            $data = [
                'id' => $id,
                'username' => trim($form['username']),
                'email' => trim($form['email']),
                'pass' => trim($form['pass']),
                'bio' => trim($form['bio']),
                'bio' => trim($form['bio']),
                'facebook' => trim($form['facebook']),
                'youtube' => trim($form['youtube']),
                'instagram' => trim($form['instagram']),
                'name_err' => '',
                'email_err' => '',
                'pass_err' => ''
            ];

            // empty field checking
            if (empty($form['pass'])) :
                // defining password as user's password at database
                $data['pass'] = $user->pass;
            else :
                // if not empty field, encodes password
                $data['pass'] = password_hash($form['pass'], PASSWORD_DEFAULT);
            endif;

            // if empty, receives the one at db
            if (empty($form['bio'])) :
                $data['bio'] = $user->bio;
            endif;

             // if empty
             if (empty($form['username']) || empty($form['email'])) :

                if (empty($form['username'])) :
                    $dados['username_err'] = 'Fill the name field';
                endif;

                if (empty($form['email'])) :
                    $dados['email_err'] = 'Fill the e-mail field ';
                endif;

            else :
                // is email equal to db's
                if ($form['email'] == $user->email) :
                    $this->userModel->update($data);
                    Session::msg('user', 'Profile updated successfully');
                // is email already in database
                elseif (!$this->userModel->emailCheck($form['email'])) :
                    $this->userModel->update($data);
                    Session::msg('user', 'Profile updated successfully');
                else :
                    $data['email_err'] = 'Informed e-mail already exist';
                endif;

            endif;
        else :
            // is user authorized to edit profile
            if ($user->id != $_SESSION['user_id']) :
                Session::msg('post', "You're not allowed to edit this profile", 'alert alert-danger');
                Url::redirect('posts');
            endif;

            //defining view data
            $data = [
                'id' => $user->id,
                'avatar' => $user->avatar,
                'username' => $user->username,
                'email' => $user->email,
                'bio' => $user->bio,
                'facebook' => $user->facebook,
                'youtube' => $user->youtube,
                'instagram' => $user->instagram,
                'username_err' => '',
                'email_err' => '',
                'pass_err' => ''
            ];

        endif;

        //defining view file 
        $this->view('users/profile', $data);
    }

    public function register(){

        // receiving form's data and filtering it
        // https://stackoverflow.com/questions/69207368/constant-filter-sanitize-string-is-deprecated
        // $form = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $form = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (isset($form)) :
            $data = [
                'username' => trim($form['username']),
                'email' => trim($form['email']),
                'pass' => trim($form['pass']),
                'pass_confirm' => trim($form['pass_confirm']),
            ];

            // empty field checking
            if (in_array("", $form)) :

                if (empty($form['username'])) :
                    $data['username_err'] = 'Fill name field';
                endif;

                if (empty($form['email'])) :
                    $data['email_err'] = 'Fill e-mail field';
                endif;

                if (empty($form['pass'])) :
                    $data['pass_err'] = 'Fill pass field';
                endif;

                if (empty($form['pass_confirm'])) :
                    $data['pass_confirm_err'] = 'Confirm password';
                endif;
            else :

                // checking format
                if (Check::nameCheck($form['username'])) :
                    $data['username_err'] = 'Invalid name';

                // checking format
                elseif (Check::emailCheck($form['email'])) :
                    $data['email_err'] = 'Invalid e-mail';
                
                elseif ($this->userModel->emailChecking($form['email'])) :
                    $data['email_err'] = 'E-mail is already registered';

                elseif (strlen($form['pass']) < 8) :
                    $data['pass_err'] = 'Password must have a minimum of 8 characters';

                elseif ($form['pass_confirm'] != $form['pass']) :
                    $data['pass_confirm_err'] = "Passwords don't mach";
                else :
                    $data['pass'] = password_hash($form['pass'], PASSWORD_DEFAULT);
                    if ($this->userModel->save($data)) :
                        // echo 'Registered sucessfully<hr>';
                        Session::msg('user', 'Registered sucessfully');
                        // header('Location: '.URL.'');
                        Url::redirect('users/login');
                    else :
                        die("Error registering user at database");
                    endif;
                endif;
            endif;

            // var_dump($form);

            else :
                $data = [
    
                    'username' => '',
                    'email' => '',
                    'pass' => '',
                    'pass_confirm' => '',
    
                    'username_err' => '',
                    'email_err' => '',
                    'pass_err' => '',
                    'pass_confirm_err' => '',
    
                ];
            endif;
        
    
        $this->view('users/register', $data);
    }

    public function login()
    {

        // receiving form's data and filtering it
        // https://stackoverflow.com/questions/69207368/constant-filter-sanitize-string-is-deprecated
        // $form = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $form = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (isset($form)) :
            $data = [
                'email' => trim($form['email']),
                'pass' => trim($form['pass']),
            ];

            if (in_array("", $form)) :

                if (empty($form['email'])) :
                    $data['email_err'] = 'Fill e-mail field';
                endif;

                if (empty($form['pass'])) :
                    $data['pass_err'] = 'Fill pass field';
                endif;

            else :
                if (Check::emailCheck($form['email'])) :
                    $data['email_err'] = 'Invalid E-mail';
                else :

                    // login's data check from db
                    $user = $this->userModel->loginChecking($form['email'], $form['pass']);

                    if($user):
                        // var_dump($user);
	                    // echo "<hr> User logged, session successfully created <hr>";

                        // initialize/creates session
                        $this->sessionInit($user);
                    else:
                        // echo "Invalid User or Password <hr>";
                        Session::msg('user', 'Invalid User or Password', 'alert alert-danger');
                    endif;


                endif;

            endif;

            // var_dump($form);

        else :
            $data = [

                'email' => '',
                'pass' => '',

                'email_err' => '',
                'pass_err' => ''

            ];

        endif;
        $this->view('users/login', $data);
    }

    // creating session with user's info
    private function sessionInit($user) {
        /* Sessions uses a simple way for data registering from individual users using unique session ID. Sessions can be used for info persistance between pages' requests */

        // defining sessions variables
        $_SESSION['user_id'] = $user->id;
        $_SESSION['user_name'] = $user->username;
        $_SESSION['user_email'] = $user->email;
        $_SESSION['user_level'] = $user->level;

        // header('Location: '.URL.'');               
        // UNCOMMENT WHEN NOT IN DEVELOPMENT
        Url::redirect('posts');
    }

    public function logout() {
        // unset - it destroys specific var
        unset($_SESSION['user_id']);
        unset($_SESSION['user_name']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_level']);

        // destroys all registered session data
        session_destroy();

        // header('Location: '.URL.'');
        // UNCOMMENT WHEN NOT IN DEVELOPMENT
        Url::redirect('users/login');
    }

}