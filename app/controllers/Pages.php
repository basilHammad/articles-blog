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
            $pupularArticles = $this->pagesModel->getPopularArticles();
            $categorysCount = $this->pagesModel->getCategoryCount();
            $articles = $this->pagesModel->getArticles($_POST['id'], $loadMore);

            $data = [
                'articles' => $articles,
                'last_id' => $lastId,
                'pupularArticles' => $pupularArticles,
            ];
            foreach ($categorysCount as $categoryCount) {
                if ($categoryCount->category === 'development') $data['development_count'] = $categoryCount->count;
                if ($categoryCount->category === 'architecture') $data['architecture_count'] = $categoryCount->count;
                if ($categoryCount->category === 'art-illustration') $data['art-illustration_count'] = $categoryCount->count;
                if ($categoryCount->category === 'business-corporate') $data['business-corporate_count'] = $categoryCount->count;
                if ($categoryCount->category === 'culture-Education') $data['culture-Education_count'] = $categoryCount->count;
                if ($categoryCount->category === 'e-commerce') $data['e-commerce_count'] = $categoryCount->count;
                if ($categoryCount->category === 'design_agency') $data['design_agency_count'] = $categoryCount->count;
            };
            $this->view('pages/index', $data);
        }
    }
}
