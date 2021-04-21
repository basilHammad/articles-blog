<?php
class Article
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getUserArticles()
    {

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


    public function getArticlesByCategory($category, $id, $loadMore)
    {
        if ($loadMore) {
            $this->db->query("SELECT * FROM articles WHERE category = :category AND id > $id  ORDER BY id LIMIT 8");
        } else {
            $this->db->query('SELECT * FROM articles WHERE category = :category  ORDER BY id LIMIT 8');
        }
        $this->db->bind(':category', $category);

        $row = $this->db->resultSet();

        return $row;
    }


    public function addComment($data)
    {
        $this->db->query('INSERT INTO comments(body, name, email, article_id)
                                        VALUES(:comment, :name, :email, :article_id)');

        $this->db->bind(':comment', $data['comment']);
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':article_id', $data['id']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function getCommentsByArticleId($id)
    {
        $this->db->query('SELECT * FROM comments WHERE article_id = :id');
        $this->db->bind(':id', $id);

        $result = $this->db->resultSet();
        return $result;
    }

    public function search($searchTerm)
    {
        $this->db->query("SELECT * FROM articles WHERE title  LIKE '%" . $searchTerm . "%' ");

        $result = $this->db->resultSet();
        return $result;
    }

    public function getPupularArticles()
    {
        $this->db->query('SELECT * FROM articles ORDER BY RAND() LIMIT 3');

        $result = $this->db->resultSet();
        return $result;
    }
}
