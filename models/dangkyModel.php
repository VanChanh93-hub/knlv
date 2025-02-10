<?php
require_once "Database.php";
class dangkyModel {
    private $user;

    function __construct()
    {
        $this->user = new Database;
    }
    public function addUser($username,$email,$phone,$address,$role,$password){

        $sql ="INSERT INTO user(username,email,phone,address,role,password)
        VALUE (?,?,?,?,?,?)";
        return $this->user->insert($sql,$username,$email,$phone,$address,$role,$password);
    }

    function issetEmail($email){
        $sql ="SELECT * FROM user WHERE email=?";
        return $this->user->getOne($sql,$email);
    }
    function issetPhone($phone){
        $sql ="SELECT * FROM user WHERE phone=?";
        return $this->user->getOne($sql,$phone);
    }
}

?>