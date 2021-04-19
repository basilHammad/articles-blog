<?php

class Pages extends Controller
{
    public function __construct()
    {
        $this->pagesModel = $this->model('Page');
    }

    public function index()
    {
        $articles = $this->pagesModel->getArticles();
        $data = [
            'articles' => $articles,
        ];
        $this->view('pages/index', $data);
    }
}
