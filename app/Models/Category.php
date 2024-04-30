<?php

// Responsible for database communication
// It is conventional having the same name 'like' an entity

class Categoria
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
    
   
    // saving categoria at db
    public function save($data)
    {
                
        $this->db->query("INSERT INTO {$this->table}(title, txt) VALUES (:title, :txt)");
        
        $this->db->bind("title", $data['title']);
        $this->db->bind("txt", $data['txt']);

        if ($this->db->exec()) :
            return true;
        else :
            return false;
        endif;
    }

    public function update($data)
    {
                
        $this->db->query("UPDATE {$this->table} SET title = :title, txt = :txt WHERE id = :id");

        $this->db->bind("id", $data['id']);
        $this->db->bind("title", $data['title']);
        $this->db->bind("txt", $data['txt']);


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
}
