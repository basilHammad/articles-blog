<?php
class Page
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getArticles($id, $loadMore)
    {
        $page = !empty($_GET['page']) ? $_GET['page'] : 1;

        if ($loadMore) {
            $this->db->query("SELECT * FROM articles WHERE id > $id ORDER BY id LIMIT 3");
        } else {
            $this->db->query("SELECT * FROM articles ORDER BY id LIMIT 3");
        }

        $result = $this->db->resultSet();
        return $result;
    }

    public function getLastId()
    {
        $this->db->query('SELECT * FROM articles ORDER BY id DESC LIMIT 1');
        $result = $this->db->single();
        return $result;
    }

    public function search($searchTerm)
    {
        $this->db->query("SELECT * FROM articles WHERE title  LIKE '%" . $searchTerm . "%' ");

        $result = $this->db->resultSet();
        return $result;
    }

    public function getPopularArticles()
    {
        $this->db->query('SELECT * FROM  articles ORDER BY popularity DESC LIMIT 3');
        $row = $this->db->resultSet();
        return $row;
    }

    public function getCategoryCount()
    {
        $this->db->query('SELECT COUNT(id) AS count, category FROM articles GROUP BY category');
        $row = $this->db->resultSet();
        return $row;
    }
}
