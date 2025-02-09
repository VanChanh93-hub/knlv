<?php
require_once "Database.php";
class dangnhapModel {
    public function getUserName($username){
        $user = new Database;
        $sql ="SELECT * FROM user WHERE username=?";
        return $user->getOne($sql,$username);
    }
}

?>