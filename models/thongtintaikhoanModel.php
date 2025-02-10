<?php
require "Database.php";
    class thongtintaikhoanModel {
        private $user ;
        function  __construct(){
            $this->user =new Database ;
        }


        function getUser($id){
            $sql ="SELECT * FROM user Where id=?";
            return $this->user->getOne($sql,$id);
        }

        function updateUser($username,$email,$phone,$address,$id){
            $sql ="UPDATE user SET username= ?,email=?, phone=? ,address=? WHERE id=?";
            return $this->user->update($sql,$username,$email,$phone,$address,$id);
        }

        function issetEmail($email){
            $sql ="SELECT * FROM user WHERE email=?";
            return $this->user->getOne($sql,$email);
        }


        function issetPhone($phone){
            $sql ="SELECT * FROM user WHERE phone=?";
            return $this->user->getOne($sql,$phone);
        }
        function issetUsername($username){
            $sql ="SELECT * FROM user WHERE username=?";
            return $this->user->getOne($sql,$username);
        }
    }


?>