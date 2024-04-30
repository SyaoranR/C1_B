<?php

// Responsible for database communication
// It is conventional having the same name 'like' an entity

class Category
{
    private $db;
    private $table = 'categories';

    public function __construct()
    {
        // db connection's class instance 
        $this->db = new Db();
    }

    public function readCategories()
    {

        $this->db->query("SELECT * FROM {$this->table} ORDER BY title ASC");
        return $this->db->results();
    }
    
    public function readPostsByCategory($id)    
    {       
        $this->db->query("SELECT 
            p.id as postId,             
            p.cover as postCover,
            p.title as postTitle,
            p.txt as postTxt,
            p.created_at as postRegisterDate, 
            c.title as categTitle,
            c.descr as categDescr,
            u.username as postAuthor

            FROM posts AS p
            INNER JOIN categories AS c
            ON p.category_id = c.id
            INNER JOIN users AS u
            ON p.user_id = u.id
            WHERE p.category_id = :id
            ORDER BY p.id DESC
        ");

        $this->db->bind('id', $id);
        
        return $this->db->results();
    }

   
    // saving category at db
    public function save($data)
    {
                
        $this->db->query("INSERT INTO {$this->table}(title, descr) VALUES (:title, :descr)");
        
        $this->db->bind("title", $data['title']);
        $this->db->bind("descr", $data['descr']);

        if ($this->db->exec()) :
            return true;
        else :
            return false;
        endif;
    }

    public function update($data)
    {
                
        $this->db->query("UPDATE {$this->table} SET title = :title, descr = :descr WHERE id = :id");

        $this->db->bind("id", $data['id']);
        $this->db->bind("title", $data['title']);
        $this->db->bind("descr", $data['descr']);


        if ($this->db->exec()) :
            return true;
        else :
            return false;
        endif;
    }

    public function readCategoryById($id)
    {
        $this->db->query("SELECT * FROM {$this->table} WHERE id = :id");
        $this->db->bind('id', $id);

        return $this->db->result();
    }   

    public function delete($id)
    {
        // var_dump($id);

        $this->db->query("DELETE FROM {$this->table} WHERE id = :id");

        $this->db->bind("id", $id);

        if ($this->db->exec()) :
            return true;
        else :
            return false;
        endif;
    }


    // does category has posts
    public function postsCheck($id)
    {
        $this->db->query("SELECT * FROM posts WHERE category_id = :id");
        $this->db->bind("id", $id);

        if ($this->db->result()) :
            return true;
        else :
            return false;
        endif;
    }
    
}
