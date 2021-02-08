<?php
define('SESSION_USER_ID', 'session_user_id');

class Auth
{
    public $User;
    public $logged = false;

    public function __construct()
    {
        if(isset($_SESSION[SESSION_USER_ID])){
            $this->setUser($_SESSION[SESSION_USER_ID]);
        }
    }

    public function setUser($userId)
    {
        $this->User = new User($userId);
        $this->logged = true;

        $_SESSION[SESSION_USER_ID] = $userId;
    }   

    public function logOut()
    {
        $this->logged = false;
        unset($_SESSION[SESSION_USER_ID]);
        unset($this->User);
    }
}


