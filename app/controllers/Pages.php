<?php

class Pages extends Controller
{
    public function __construct()
    {
        $this->pagesModel = $this->model('Page');
    }

    public function index()
    {
        $_SESSION['page'] = 'pages/index';
        $loadMore = false;
        $lastId = $this->pagesModel->getLastId()->id;
        if (!empty($_POST['search'])) {
            $articles = $this->pagesModel->search($_POST['search']);
            $data = [
                'articles' => $articles
            ];
            $this->view('pages/index', $data);
        } elseif (!empty($_POST['id'])) {
            $loadMore = true;
            $articles = $this->pagesModel->getArticles($_POST['id'], $loadMore);
            $data = [
                'articles' => $articles,
                'URLROOT' => URLROOT,
                'page' => $_SESSION['page'],
                'last_id' => $lastId
            ];
            die(json_encode($data));
        } else {
            $articles = $this->pagesModel->getArticles($_POST['id'], $loadMore);
            $data = [
                'articles' => $articles,
                'last_id' => $lastId
            ];
            // var_dump(count($data['articles']));
            $this->view('pages/index', $data);
        }
    }
}
