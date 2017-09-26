<?php

class LoginController extends Controller {

    const CREDENTIALS_ERROR = 'Wrong credentials';

    public function index()
    {
        $this->view('authentication/login');
    }

    public function postLogin()
    {
        if (
            $_SERVER["REQUEST_METHOD"] == "POST" &&
            isset($_POST['username'], $_POST['password']) &&
            !empty($_POST['username']) &&
            !empty($_POST['password'])
        ) {
            $user = $this->loadModel('User')->findByColumn('username', $_POST['username']);
          } else {
            $this->jsonErrorResponse('Please fill all fields');
        }

        if (!$user) {
            $this->jsonErrorResponse(self::CREDENTIALS_ERROR);
        }

        $password = $_POST['password'];

        if (!Auth::login($user, $password)) {
            $this->jsonErrorResponse(self::CREDENTIALS_ERROR);
        } else {
            $this->jsonSuccessResponse(URL);
        }
    }

    public function logout()
    {
        session_destroy();
        header('Location: '. URL. 'login');
        exit;
    }

}