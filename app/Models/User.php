<?php

class User {

    private $db;

    public function __construct()
    {
        $this->db = new Db();
    }

    public function emailChecking($email) {
        $this->db->query("SELECT email FROM users WHERE email = :e");
        $this->db->bind(":e", $email);
        
        if($this->db->result()):
            return true;
        else:
            return false;
        endif;

    }

    public function save($data) {
        $this->db->query("INSERT INTO users(username, email, pass) VALUES (:username, :email, :pass)");

        $this->db->bind("username", $data['username']);
        $this->db->bind("email", $data['email']);
        $this->db->bind("pass", $data['pass']);

        if($this->db->exec()):
            return true;
        else:
            return false;        
        endif;
    }

    public function update($data) {
        $this->db->query("UPDATE users SET avatar = :avatar, username = :username, email = :email, pass = :pass, bio = :bio, facebook = :facebook, youtube = :youtube, instagram = :instagram WHERE id = :id");

        $this->db->bind("id", $data['id']);
        $this->db->bind("avatar", $data['avatar']);
        $this->db->bind("username", $data['username']);
        $this->db->bind("email", $data['email']);
        $this->db->bind("pass", $data['pass']);
        $this->db->bind("bio", $data['bio']);
        $this->db->bind("facebook", $data['facebook']);
        $this->db->bind("youtube", $data['youtube']);
        $this->db->bind("instagram", $data['instagram']);


        if($this->db->exec()):
            return true;
        else:
            return false;        
        endif;
    }


    public function loginChecking($email, $pass) {
        $this->db->query("SELECT * FROM users WHERE email = :e");
        $this->db->bind(":e", $email);
                
        if($this->db->result()):
            $result = $this->db->result();
            if(password_verify($pass, $result->pass)):
                return $result;
            else:
                return false;
            endif;
        else:
            return false;
        endif;        
    }

    public function readUserById($id){
        $this->db->query("SELECT * FROM users WHERE id = :id");
        $this->db->bind('id', $id);
        
        return $this->db->result();
    }

    public function readAdmin(){
        $this->db->query("SELECT * FROM users WHERE level = 3");      
        return $this->db->result();
    }

}