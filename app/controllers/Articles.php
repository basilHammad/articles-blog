<?php
class Articles extends Controller
{
    public function __construct()
    {
        $this->articleModel = $this->model('Article');
    }

    public function manage()
    {
        if (!isLoggedIn()) redirect('users/login');
        $_SESSION['page'] = 'articles/manage';

        $articles = $this->articleModel->getUserArticles();
        $data = ['articles' => $articles];
        $this->view('articles/manage', $data);
    }

    public function add()
    {
        if (!isLoggedIn()) redirect('users/login');

        $_SESSION['page'] = 'articles/add';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            handelUpload($data);

            $data = [
                'user_id' => $_SESSION['user_id'],
                'title' => trim($_POST['title']),
                'category' => $_POST['category'],
                'description' => trim($_POST['description']),
                'body' => trim($_POST['body']),
                'img' => basename($_FILES["fileToUpload"]["name"]),
                'title_error' => '',
                'category_error' => '',
                'description_error' => '',
                'body_error' => '',
                'img_error' => '',
            ];

            if (empty($data['title']))       $data['title_error']       = 'please enter a title';
            if (empty($data['category']))    $data['category_error']    = 'please chose a category';
            if (empty($data['description'])) $data['description_error'] = 'please enter a description';
            if (empty($data['body']))        $data['body_error']        = 'please enter the article body';

            if (
                empty($data['title_error']) &&
                empty($data['category_error']) &&
                empty($data['description_error']) &&
                empty($data['body_error']) &&
                empty($data['img_error'])
            ) {
                if ($this->articleModel->addArticle($data)) {
                    flash('article_message', 'Article added');
                    redirect('articles/manage');
                } else die('Someting went wrong');
            } else {
                $this->view('articles/add', $data);
            }
        } else {
            $data = [
                'title' => '',
                'category' => '',
                'description' => '',
                'body' => '',
                'img' => '',
            ];
            $this->view('articles/add', $data);
        }
    }

    public function edit($id)
    {
        if (!isLoggedIn()) redirect('users/login');

        $_SESSION['page'] = 'articles/edit';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            handelUpload($data);

            $data = [
                'user_id' => $_SESSION['user_id'],
                'title' => trim($_POST['title']),
                'category' => $_POST['category'],
                'description' => trim($_POST['description']),
                'body' => trim($_POST['body']),
                'img' => basename($_FILES["fileToUpload"]["name"]),
                'title_error' => '',
                'category_error' => '',
                'description_error' => '',
                'body_error' => '',
                'img_error' => '',
            ];

            if (empty($data['title'])) $data['title_error']             = 'please enter a title';
            if (empty($data['category'])) $data['category_error']       = 'please chose a category';
            if (empty($data['description'])) $data['description_error'] = 'please enter a description';
            if (empty($data['body'])) $data['body_error']               = 'please enter the article body';

            if (
                empty($data['title_error']) &&
                empty($data['category_error']) &&
                empty($data['description_error']) &&
                empty($data['body_error']) &&
                empty($data['img_error'])
            ) {
                if ($this->articleModel->updateArticle($data)) {
                    flash('article_message', 'Article updated');
                    redirect('articles/manage');
                } else die('Someting went wrong');
            } else {
                $this->view('articles/edit', $data);
            }
        } else {
            $article = $this->articleModel->getArticleById($id);

            $data = [
                'id' => $id,
                'title' => $article->title,
                'category' => $article->category,
                'description' => $article->description,
                'body' => $article->body,
                'img' => $article->img,
            ];
            $this->view('articles/edit', $data);
        }
    }

    public function delete($id)
    {
        if ($this->articleModel->deleteArticle($id)) {
            flash('article_message', 'Article Removed');
            redirect('articles/manage');
        } else {
            die('Some Thing Went Wrong');
        }
    }

    public function category($category = '')
    {
        $_SESSION['page'] = 'articles/category';
        $loadMore = false;
        if (!empty($_POST['search'])) {
            $articles = $this->articleModel->search($_POST['search']);
            $data = [
                'articles' => $articles
            ];
            $this->view('articles/category', $data);
        }
        // todo: check where the post go
        elseif (!empty($_POST['id'])) {
            $loadMore = true;
            $articles = $this->articleModel->getArticlesByCategory($category, $_POST['id'], $loadMore);
            $data = [
                'articles' => $articles,
                'URLROOT' => URLROOT,
                'page' => $_SESSION['page']
            ];
            die(json_encode($data));
        } else {
            $pupularArticles = $this->articleModel->getPupularArticles();
            $articles = $this->articleModel->getArticlesByCategory($category, $_POST['id'], $loadMore);
            $data = [
                'articles' => $articles,
                'pupularArticles' => $pupularArticles
            ];
            $this->view('articles/category', $data);
        }
    }

    public function show($id)
    {
        $_SESSION['page'] = 'articles/show';
        $article = $this->articleModel->getArticleById($id);
        $comments = $this->articleModel->getCommentsByArticleId($id);
        $data = [
            'article' => $article,
            'id' => $id,
            'comments' => $comments,
            'comment' => '',
            'name' => '',
            'email' => '',
        ];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'article' => $article,
                'id' => $id,
                'user_id' => $_SESSION['user_id'],
                'comment' => trim($_POST['comment']),
                'name' => $_POST['name'],
                'email' => trim($_POST['email']),
                'comment_error' => '',
                'name_error' => '',
                'email_error' => '',
            ];

            if (empty($data['email'])) $data['email_error'] = 'email is required!';
            if (empty($data['name'])) $data['name_error'] = 'name is required!';
            if (empty($data['comment'])) $data['name_error'] = 'comment is required!';

            if (
                empty($data['title_error']) &&
                empty($data['category_error']) &&
                empty($data['description_error']) &&
                empty($data['body_error']) &&
                empty($data['img_error'])
            ) {
                $this->articleModel->addComment($data);
                $data = [
                    'article' => $article,
                    'id' => $id,
                    'comments' => $comments,
                    'comment' => '',
                    'name' => '',
                    'email' => '',
                ];
                $this->view('articles/show', $data);
            } else {
                $this->view('articles/show/', $data);
            }
        } else {
            $this->view('articles/show', $data);
        }
    }
}
