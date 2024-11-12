<?php

/* 
 * Data and Communication Control with user model
 * Responsible for database communication
 * It is conventional having the same name 'like' an entity (SQL language)
 * 
 * @author Alessandro Fraga Gomes
 * @copyright 2021-2024 Php7 Alex
 * @version 1.1.1 
 */

class User {

    private $db;
    private $table = 'users';

    public function __construct()
    {
        $this->db = new Db();
    }
        
    public function emailChecking($email) {
        $this->db->query("SELECT email FROM {$this->table} WHERE email = :e");
        $this->db->bind(":e", $email);
        
        if($this->db->result()):
            return true;
        else:
            return false;
        endif;

    }

    public function save($data) {
        $this->db->query("INSERT INTO {$this->table}(username, email, pass) VALUES (:username, :email, :pass)");

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

        $data['url_users'] = $this->nameCheck($data['username'], $data['id']);

        $this->db->query("UPDATE {$this->table} SET avatar = :avatar, url_users = :url_users, username = :username, email = :email, pass = :pass, bio = :bio, facebook = :facebook, youtube = :youtube, instagram = :instagram WHERE id = :id");

        $this->db->bind("id", $data['id']);
        $this->db->bind("avatar", $data['avatar']);
        $this->db->bind("url_users", $data['url_users']);
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
        $this->db->query("SELECT * FROM {$this->table} WHERE email = :e");
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
        $this->db->query("SELECT * FROM {$this->table} WHERE id = :id");
        $this->db->bind('id', $id);
        
        return $this->db->result();
    }   

    public function readUserByUrl($url_users){

        $this->db->query("SELECT * FROM {$this->table} WHERE url_users = :url_users");
        $this->db->bind('url_users', $url_users);
        
        return $this->db->result();
    }

    public function readAdmin(){
        $this->db->query("SELECT * FROM {$this->table} WHERE lv = 3");      
        return $this->db->result();
    }

    public function nameCheck($username, $id = null){
        
        $sql = (!empty($id) ? "id != {$id} AND" : "");
        
        $this->db->query("SELECT * FROM {$this->table} WHERE {$sql} username = :usrn");
        $this->db->bind('usrn', $username);
        
        if($this->db->result()) :
            // return Url::friendlyUrl($title).'-'.uniqid();
            return Url::friendlyUrl($username).'-'.date('d-m-Y-h_i-s',  time());
        else:
            return Url::friendlyUrl($username);
        endif;
        
    }
}