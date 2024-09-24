<?php

session_start();    

class CSRF {

    private $token;

    public function __construct() {
        if (empty($_SESSION['token'])) {
            $this->token = bin2hex(random_bytes(32));
            $_SESSION['token'] = $this->token;
        } else {
            $this->token = $_SESSION['token'];
        }
    }

    public function getToken() {
        return $_SESSION['token'];
    }

    public function addToken(){
        $token = $this->getToken();
        return '<input type="hidden" name="token" value="'.$token.'">';
    }

    public function validateToken($token){
        return hash_equals($_SESSION['token'], $token);
    }

    public function verifyRequest($method = 'POST'){
        $method = strtoupper($method);

        if ($method === 'POST' && isset($_POST['token'])) {
            return $this->validateToken($_POST['token']);
        } elseif ($method === 'GET' && isset($_GET['token'])) {
            return $this->validateToken($_GET['token']);
        }

        return false;
    }

}
