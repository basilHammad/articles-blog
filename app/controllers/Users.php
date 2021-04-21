<?php
class Users extends Controller
{
    public function __construct()
    {
        $this->userModel = $this->model('User');
    }

    public function register()
    {
        $_SESSION['page'] = 'users/register';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'name' => trim($_POST['name']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirm_password' => trim($_POST['confirm_password']),
                'name_error' => '',
                'email_error' => '',
                'pass_error' => '',
                'confirm_pass_error' => ''
            ];

            if (empty($data['email'])) {
                $data['email_error'] = 'email is required!';
            } else {
                if ($this->userModel->findUserByEmail($data['email'])) $data['email_error'] = 'email is already taken!';
            }

            if (empty($data['name'])) $data['name_error'] = 'name is required!';
            if (empty($data['password'])) {
                $data['pass_error'] = 'password is required!';
            } elseif (strlen($data['password']) < 6) $data['pass_error'] = 'password must be at least 6 characters';
            if (empty($data['confirm_password'])) {
                $data['confirm_pass_error'] = 'please confirm password';
            } else {
                if ($data['password'] != $data['confirm_password'])
                    $data['confirm_pass_error'] = 'passwords do not match';
            }

            if (
                empty($data['email_error']) &&
                empty($data['name_error']) &&
                empty($data['pass_error']) &&
                empty($data['confirm_pass_error'])
            ) {
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                if ($this->userModel->register($data)) {
                    flash('register_success', 'you are registerd and can log in');
                    redirect('users/login');
                } else {
                    die('Something went wrong!!!');
                }
            } else {
                $this->view('users/register', $data);
            }
        } else {
            $data = [
                'name' => '',
                'email' => '',
                'password' => '',
                'confirm_password' => '',
                'name_error' => '',
                'email_error' => '',
                'pass_error' => '',
                'confirm_pass_error' => ''
            ];

            $this->view('users/register', $data);
        }
    }

    public function login()
    {
        $_SESSION['page'] = 'users/login';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'email_error' => '',
                'pass_error' => '',
            ];
            if (empty($data['email'])) $data['email_error'] = 'email is required!';

            if (empty($data['password']))  $data['pass_error'] = 'password is required!';

            if ($this->userModel->findUserByEmail($data['email'])) {
            } else {
                $data['email_error'] = 'email dose not exist';
            }

            if (
                empty($data['email_error']) &&
                empty($data['pass_error'])
            ) {
                $loggedInUser = $this->userModel->login($data['email'], $data['password']);
                if ($loggedInUser) {
                    $this->createUserSession($loggedInUser);
                } {
                    $data['pass_error'] = 'password incorrect';
                    $this->view('users/login', $data);
                }
            } else {
                $this->view('users/login', $data);
            }
        } else {
            $data = [
                'email' => '',
                'password' => '',
                'email_error' => '',
                'pass_error' => '',
            ];

            $this->view('users/login', $data);
        }
    }


    public function createUserSession($user)
    {
        $_SESSION['user_name'] = $user->name;
        $_SESSION['user_id'] = $user->id;
        redirect('articles/manage');
    }

    public function logout()
    {
        unset($_SESSION['user_name']);
        unset($_SESSION['user_id']);
        session_destroy();
        redirect('pages');
    }
}
