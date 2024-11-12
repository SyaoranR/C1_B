<?php

/* 
 * Data and Communication Control with post model
 * Responsible for database communication
 * It is conventional having the same name 'like' an entity (SQL language)
 * 
 * @author Alessandro Fraga Gomes
 * @copyright 2021-2024 Php7 Alex
 * @version 1.1.1 
 */

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
        posts.url_posts as postUrl,
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

        // $data['url_posts'] = Url::friendlyUrl($data["title"]);
        $data['url_posts'] = $this->titleCheck($data['title']);

        
        $this->db->query("INSERT INTO {$this->table} (user_id, category_id, url_posts, cover, title, txt) VALUES (:user_id, :category_id, :url_posts, :cover, :title, :txt)");

        $this->db->bind("user_id", $data['user_id']);
        $this->db->bind("category_id", $data['category_id']);
        $this->db->bind("url_posts", $data['url_posts']);
        $this->db->bind("cover", $data['cover']);
        $this->db->bind("title", $data['title']);
        $this->db->bind("txt", $data['txt']);        

        if($this->db->exec()):
            return true;
        else:
            return false;        
        endif;
    }

    public function update($data) {

        // $data['url_posts'] = Url::friendlyUrl($data["title"]);
        $data['url_posts'] = $this->titleCheck($data['title'], $data['id']);

        $this->db->query("UPDATE {$this->table} SET category_id = :category_id, 
        url_posts = :url_posts, title = :title, txt = :txt, updated_at = NOW() WHERE id = :id");
        
        $this->db->bind("id", $data['id']);
        $this->db->bind("category_id", $data['category_id']);
        $this->db->bind("url_posts", $data['url_posts']);
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

    public function readPostByUrl($url_posts){

        $this->visitCount($url_posts);

        $this->db->query("SELECT * FROM {$this->table} WHERE url_posts = :url_posts");
        $this->db->bind('url_posts', $url_posts);
        
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

    public function findPost($search)
    {
        $this->db->query("SELECT * FROM {$this->table} WHERE (title LIKE '%' :search '%' OR txt LIKE '%' :search '%') ORDER BY id DESC");
        $this->db->bind('search', $search);

        return $this->db->results();
    }

    public function count(){
        return $this->db->totalResults();
    }

    public function titleCheck($title, $id = null){
        
        $sql = (!empty($id) ? "id != {$id} AND" : "");
        
        $this->db->query("SELECT * FROM {$this->table} WHERE {$sql} title = :t");
        $this->db->bind('t', $title);
        
        if($this->db->result()) :
            // return Url::friendlyUrl($title).'-'.uniqid();
            return Url::friendlyUrl($title).'-'.date('d-m-Y-h_i-s',  time());
        else:
            return Url::friendlyUrl($title);
        endif;
    }

    private function visitCount($url_posts)
    {
        $this->db->query("UPDATE {$this->table} SET visits = visits + 1, last_visit = NOW() WHERE url_posts = :u_posts");

        $this->db->bind("u_posts", $url_posts);

        if ($this->db->exec()) :
            return true;
        else :
            return false;
        endif;
    }

}