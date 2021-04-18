<?php
class Articles  extends Controller
{

    public function __construct()
    {
        $this->articleModel = $this->model('Article');
    }


    public function manage()
    {
        if (!isLoggedIn()) {
            redirect('users/login');
        };
        $articles = $this->articleModel->getUserArticles();
        $data = ['articles' => $articles];
        $this->view('articles/manage', $data);
    }

    public function add()
    {
        if (!isLoggedIn()) {
            redirect('users/login');
        };

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $target_dir =  '/var/www/html/blog/public/img/article-imgs/';
            $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
            $uploadOk = true;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            var_dump($_FILES);
            // var_dump('tewst', strtolower(pathinfo($target_file, PATHINFO_EXTENSION)));
            // die;

            if (!$check !== false) {
                $data['img_error'] =  "File is not an image.";
                $uploadOk = false;
            }

            if (
                $imageFileType != "jpg" && $imageFileType != "png" &&
                $imageFileType != "jpeg" && $imageFileType != "gif"
            ) {
                $data['img_error'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = false;
            }

            if ($uploadOk) {
                if (!move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) die('failed');
            } else {
                die('failed to store ');
            }

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
        if (!isLoggedIn()) {
            redirect('users/login');
        };

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'user_id' => $_SESSION['user_id'],
                'title' => trim($_POST['title']),
                'category' => $_POST['category'],
                'description' => trim($_POST['description']),
                'body' => trim($_POST['body']),
                'img' => $_POST['img'],
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
            if (empty($data['img'])) $data['img_error']                 = 'please chose an image for the article';

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
}