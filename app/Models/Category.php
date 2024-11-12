<?php

/* 
 * Data and Communication Control with category model
 * Responsible for database communication
 * It is conventional having the same name 'like' an entity (SQL language)
 * 
 * @author Alessandro Fraga Gomes
 * @copyright 2021-2024 Php7 Alex
 * @version 1.1.1 
 */

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

    // extra method to correct working of program
    // public function readPostsByCategory($url_categories)
    public function readPostsByCategId($id)
    {

        $this->db->query("SELECT 
            p.id as postId, 
            p.url_posts as postUrl,
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
        // $this->db->bind('url_categories', $url_categories);

        return $this->db->results();
    }
    // extra method ENDS HERE


    // public function readPostsByCategory($id)
    public function readPostsByCategoryUrl($url_categories)
    {

        $catId = $this->categId($url_categories);

        $this->db->query("SELECT 
            p.id as postId, 
            p.url_posts as postUrl,
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
            WHERE p.category_id = :catId
            ORDER BY p.id DESC
        ");

        // $this->db->bind('id', $id);
        // $this->db->bind('url_categories', $url_categories);
        $this->db->bind('catId', $catId);

        return $this->db->results();
    }

    private function categId($url_categories)
    {
        $this->db->query("SELECT id FROM {$this->table} WHERE url_categories = :url_categories");
        $this->db->bind('url_categories', $url_categories);

        return $this->db->result()->id;
    }


    // saving category at db
    public function save($data)
    {        
        $data['url_categories'] = $this->titleCheck($data['title']);
        
        $this->db->query("INSERT INTO {$this->table}(title, url_categories, descr) VALUES (:title, :url_categories, :descr)");
        $this->db->bind("title", $data['title']);
        $this->db->bind("url_categories", $data['url_categories']); 
        $this->db->bind("descr", $data['descr']);

        if ($this->db->exec()) :
            return true;
        else :
            return false;
        endif;
    }

    public function update($data)
    {        
        $data['url_categories'] = $this->titleCheck($data['title'], $data['id']);
        
        $this->db->query("UPDATE {$this->table} SET title = :title, url_categories = :url_categories, descr = :descr, updated_at = NOW() WHERE id = :id");

        $this->db->bind("id", $data['id']);
        $this->db->bind("title", $data['title']);
        $this->db->bind("url_categories", $data['url_categories']); 
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

    public function readCategoryByUrl($url_categories)
    {
        $this->visitCount($url_categories);

        $this->db->query("SELECT * FROM {$this->table} WHERE url_categories = :url_categories");
        $this->db->bind('url_categories', $url_categories);

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

    public function titleCheck($title, $id = null)
    {       
        $sql = (!empty($id) ? "id != {$id} AND" : "");

        $this->db->query("SELECT * FROM {$this->table} WHERE {$sql} title = :t");
        $this->db->bind('t', $title);
        
        if ($this->db->result()):      
            // return Url::friendlyUrl($title).'-'.uniqid();      
            return Url::friendlyUrl($title).'-'.date('d-m-Y-h_i-s',  time());
        else:
            return Url::friendlyUrl($title);
        endif;
        
    }

    private function visitCount($url_categories)
    {
        $this->db->query("UPDATE {$this->table} SET visits = visits + 1, last_visit = NOW() WHERE url_categories = :u_categ");

        $this->db->bind("u_categ", $url_categories);

        if ($this->db->exec()) :
            return true;
        else :
            return false;
        endif;

    }

}
