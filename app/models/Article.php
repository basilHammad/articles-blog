<?php
class Article
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getUserArticles()
    { // todo: select article where the user id  === session id.


        // this code needed where i have to fetch all articles.
        // $this->db->query('SELECT *,
        // articles.id AS articleId,
        // users.id AS userId ,
        // articles.created_at AS articleCreated, 
        // users.created_at AS userCreated 
        // FROM articles
        // INNER JOIN users
        // ON articles.user_id = users.id
        // ORDER BY articles.created_at DESC
        // ');

        $this->db->query('SELECT * FROM articles WHERE user_id = :user_id');
        $this->db->bind(':user_id', $_SESSION['user_id']);


        $result = $this->db->resultSet();
        return $result;
    }

    public function addArticle($data)
    {
        $this->db->query('INSERT INTO articles(title, description, img, category, body, user_id)
                                        VALUES(:title, :description, :img, :category, :body, :user_id)');

        $this->db->bind(':title', $data['title']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':img', $data['img']);
        $this->db->bind(':category', $data['category']);
        $this->db->bind(':body', $data['body']);
        $this->db->bind(':user_id', $data['user_id']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getArticleById($id)
    {
        $this->db->query('SELECT * FROM articles WHERE id = :id');
        $this->db->bind(':id', $id);

        $row = $this->db->single();

        return $row;
    }

    public function updateArticle($data)
    {
        $this->db->query('UPDATE articles SET title = :title, body = :body, description = :description,
         category = :category, img = :img WHERE id = :id');

        $this->db->bind(':title', $data['title']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':img', $data['img']);
        $this->db->bind(':category', $data['category']);
        $this->db->bind(':body', $data['body']);
        $this->db->bind(':id', $data['id']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteArticle($id)
    {
        $this->db->query('DELETE FROM articles WHERE id = :id');

        $this->db->bind(':id', $id);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
