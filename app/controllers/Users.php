<?php
class Users extends Controller
{
    public function __construct()
    {
        $this->userModel = $this->model('User');
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // handle the submision
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

            //validation
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
                // hash the password
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                // register a user 
                if ($this->userModel->register($data)) {
                    flash('register_success', 'you are registerd and can log in');
                    redirect('users/login');
                } else {
                    die('Something went wrong!!!');
                }
            } else {
                // load view with errors
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

            // load the view
            $this->view('users/register', $data);
        }
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'email_error' => '',
                'pass_error' => '',
            ];
            //validation
            if (empty($data['email'])) $data['email_error'] = 'email is required!';

            if (empty($data['password']))  $data['pass_error'] = 'password is required!';

            if ($this->userModel->findUserByEmail($data['email'])) {
                // email found check for pass 
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
                // load view with errors
                $this->view('users/login', $data);
            }
        } else {
            $data = [
                'email' => '',
                'password' => '',
                'email_error' => '',
                'pass_error' => '',
            ];

            // load the view
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
        redirect('pages/index');
    }
}
