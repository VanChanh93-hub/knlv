<?php
require_once "Database.php";

class cart extends Database{
    public $db;
    public function __construct(){
        $this->db = new Database();

    }
    public function getAllCart(){
        $sql = "SELECT * FROM cart";
        return $this->db->getAll($sql);
    }
    public function getProductById($id){
        $sql = "SELECT name , price, image FROM products WHERE id = $id";
        return $this->db->getOne($sql);
    }
    public function deleteCart($id){
        $sql = "DELETE FROM cart WHERE id = $id";
        return $this->db->delete($sql);
    }
    public function updateCart($id,$quantity){
        $sql = "UPDATE cart SET quantity = $quantity WHERE id = $id";
        return $this->db->update($sql);
    }
}

