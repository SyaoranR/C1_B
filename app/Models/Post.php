<?php

// Data and Communication Control with post model
// Responsible for database communication
// It is conventional having the same name 'like' an entity

class Post {

    private $db;
    private $table = 'posts';

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
         FROM {$this->table}
         INNER JOIN users ON 
         posts.user_id = users.id
         ORDER BY posts.id DESC");
        return $this->db->results();
    }

    // saving post at db
    public function save($data) {
        
        $this->db->query("INSERT INTO {$this->table} (user_id, category_id, title, txt) VALUES (:user_id, :category_id, :title, :txt)");

        $this->db->bind("user_id", $data['user_id']);
        $this->db->bind("category_id", $data['category_id']);
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
        $this->db->query("UPDATE {$this->table} SET category_id = :category_id, title = :title, txt = :txt WHERE id = :id");
        
        $this->db->bind("id", $data['id']);
        $this->db->bind("category_id", $data['category_id']);
        $this->db->bind("title", $data['title']);
        $this->db->bind("txt", $data['txt']);
        

        if($this->db->exec()):
            return true;
        else:
            return false;        
        endif;
    }

    public function readPostById($id){
        $this->db->query("SELECT * FROM {$this->table} WHERE id = :id");
        $this->db->bind('id', $id);
        
        return $this->db->result();
    }

    public function delete($id) {
        // var_dump($id);

        $this->db->query("DELETE FROM {$this->table} WHERE id = :id");

        $this->db->bind("id", $id);                

        if($this->db->exec()):
            return true;
        else:
            return false;        
        endif;
    }    

}