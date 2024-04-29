<?php

// Data and Communication Control with post model

class Post {
    private $db;

    public function __construct()
    {
        // db connection's class instance 
        $this->db = new Db();
    }

    public function readPosts() {       
         // INNER JOIN association queries
        // Selects by user's Id
        $this->db->query("SELECT *,
        posts.id as postId,
        posts.created_at as postRegisterDate,
        users.id as userId,
        users.created_at as userRegisterDate
         FROM posts
         INNER JOIN users ON 
         posts.user_id = users.id
         ORDER BY posts.id DESC");
        return $this->db->results();
    }

    // saving post at db
    public function save($data) {
        $this->db->query("INSERT INTO posts(title, txt, user_id) VALUES (:title, :txt, :user_id)");
        $this->db->bind("title", $data['title']);
        $this->db->bind("txt", $data['txt']);
        $this->db->bind("user_id", $data['user_id']);

        if($this->db->exec()):
            return true;
        else:
            return false;        
        endif;
    }

    public function update($data) {
        $this->db->query("UPDATE posts SET title = :title, txt = :txt WHERE id = :id");
        $this->db->bind("id", $data['id']);
        $this->db->bind("title", $data['title']);
        $this->db->bind("txt", $data['txt']);
        

        if($this->db->exec()):
            return true;
        else:
            return false;        
        endif;
    }

    public function readPostById($id){
        $this->db->query("SELECT * FROM posts WHERE id = :id");
        $this->db->bind('id', $id);
        
        return $this->db->result();
    }

    public function delete($id) {
        // var_dump($id);

        $this->db->query("DELETE FROM posts WHERE id = :id");

        $this->db->bind("id", $id);                

        if($this->db->exec()):
            return true;
        else:
            return false;        
        endif;
    }    

}