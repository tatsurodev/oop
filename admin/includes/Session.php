<?php

class Session
{
    public $user_id;
    private $signed_in = false;

    public function __construct()
    {
        session_start();
        $this->check_the_login();
    }

    //getter
    public function is_signed_in()
    {
        return $this->signed_in;
    }

    //引数は、Userクラスのプロパティを使用
    public function login($user)
    {
        if ($user) {
            $this->user_id = $_SESSION['user_id'] = $user->id;
            $this->signed_in = true;
        }
    }

    public function logout()
    {
        unset($_SESSION['user_id']);
        $this->user_id = null;
        $this->signed_in = false;
    }

    private function check_the_login()
    {
        if (isset($_SESSION['user_id'])) {
            $this->user_id = $_SESSION['user_id'];
            $this->signed_in = true;
        } else {
            $this->user_id = null;
            $this->signed_in = false;
        }
    }
}

$session = new Session();
