<?php

class Controller {

    protected $db;
    protected $model;

    public function __construct()
    {
        $this->openDatabaseConnection();
    }

    protected function openDatabaseConnection()
    {
        $options = array(
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING
        );

        $this->db = new PDO(
            DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET,
            DB_LOGIN,
            DB_PASSWORD,
            $options
        );
    }

    protected function loadModel($modelName)
    {
        return new $modelName($this->db);
    }

    protected function view($view, $data = null)
    {
        require_once ROOT. '/app/views/includes/header.php';
        require_once ROOT. '/app/views/'. $view. '.php';
        require_once ROOT. '/app/views/includes/footer.php';
    }

    protected function filterText($str)
    {
        $str = trim($str);
        $str = strip_tags($str);
        $str = htmlspecialchars($str);

        return $str;
    }

    protected function filterEmail($email)
    {
        $email = trim($email);
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);

        if (!$email = filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }

        return $email;
    }

    protected function filterUrl($url)
    {
        $url = trim($url);
        $url = filter_var($url, FILTER_SANITIZE_URL);

        if (!$url = filter_var($url, FILTER_VALIDATE_URL)) {
            return false;
        }

        return $url;
    }

    protected function jsonErrorResponse($message) {
        $error = array('message' => $message);

        header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
        header('Content-Type: application/json');
        echo json_encode($error);
        exit;
    }

    protected function jsonSuccessResponse($message) {
        $success = array('message' => $message);

        header($_SERVER['SERVER_PROTOCOL'] . ' 200 OK', true, 200);
        header('Content-Type: application/json');
        echo json_encode($success);
        exit;
    }

    protected function getClientIp() {
        $ipaddress = '';

        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if(isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';

        return $ipaddress;
    }
}