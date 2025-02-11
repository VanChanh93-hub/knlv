<?php
require_once "Database.php";

class order extends Database{
    public $db;
    public function __construct(){
        $this->db = new Database();
    }
    
    public function insertOrder($orderdate, $totalprice,$status,$id_user,$note,$address,$phone,$fullname){
        $sql = "INSERT INTO orders (orderdate, totalprice, status, id_user, note, address, phone, fullname) VALUES (?, ?, ?, ?, ?, ?,?,?)";
        return $this->db->insert($sql, $orderdate, $totalprice, $status, $id_user, $note, $address,$phone,$fullname);
        
    }
    public function insertOrderDetail($order_id,$id_product, $price, $quantity){
        $sql = "INSERT INTO orders_detail (order_id, id_product, price, quantity) VALUES (?,?, ?, ?)";
        return $this->db->insert($sql,$order_id, $id_product, $price, $quantity);
    }
    public function getUserInfo($id_user){
        $sql = "SELECT * FROM user WHERE id = ?";
        return $this->db->getOne($sql, $id_user);
    }
    public function deleteCartByUser($id_user){
        $sql = "DELETE FROM cart WHERE user_id = ?";
        return $this->db->delete($sql, $id_user);
    }
    
}
