<?php
require "Database.php";
    class adminModel {
        private $user ;
        function  __construct(){
            $this->user =new Database ;
        }


        function getUser(){
            $sql ="SELECT COUNT(*) as buyer FROM user Where role = 0";
            return $this->user->getOne($sql);
        }

        function getSeller(){
            $sql ="SELECT COUNT(*) as seller FROM user Where role = 1";
            return $this->user->getOne($sql);
        }

        function getOrder(){
            $sql ="SELECT COUNT(*) AS total_orders
            FROM orders;";
            return $this->user->getOne($sql);
        }

        
        

    }


?>