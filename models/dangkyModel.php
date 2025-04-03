<?php
require_once "Database.php";
class dangkyModel {
    private $user;

    function __construct()
    {
        $this->user = new Database;
    }
    public function addUser($username,$email,$password){

        $sql ="INSERT INTO user(username,email,phone,address,role,password)
        VALUE (?,?,'','',0,?)";
        return $this->user->insert($sql,$username,$email,$password);
    }

    function issetEmail($email){
        $sql ="SELECT * FROM user WHERE email=?";
        return $this->user->getOne($sql,$email);
    }
    function issetUsername($username){
        $sql ="SELECT * FROM user WHERE username=?";
        return $this->user->getOne($sql,$username);
    }
    
}

?>