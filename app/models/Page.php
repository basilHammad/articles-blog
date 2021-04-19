<?php
class Page
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getArticles()
    {
        $this->db->query('SELECT * FROM articles');

        $result = $this->db->resultSet();
        return $result;
    }
}
