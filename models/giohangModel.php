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
    public function getAllcartByUser($id){
        $sql = "SELECT * FROM cart WHERE user_id = $id";
        return $this->db->getAll($sql);
    }
    public function insertCart($user_id, $product_id, $quantity) {
        // Đảm bảo số lượng luôn lớn hơn 0
        if ($quantity <= 0) {
            $quantity = 1;
        }
    
        // Kiểm tra xem sản phẩm đã có trong giỏ hàng chưa
        $sqlCheck = "SELECT quantity FROM cart WHERE user_id = $user_id AND product_id = $product_id";
        $existingCart = $this->db->getOne($sqlCheck);
    
        if ($existingCart) {
            // Nếu sản phẩm đã có, cập nhật số lượng mới
            $newQuantity = $existingCart['quantity'] + $quantity;
            $sqlUpdate = "UPDATE cart SET quantity = $newQuantity WHERE user_id = $user_id AND product_id = $product_id";
            return $this->db->update($sqlUpdate);
        } else {
            // Nếu sản phẩm chưa có, thêm mới vào giỏ hàng
            $sqlInsert = "INSERT INTO cart (user_id, product_id, quantity) VALUES ($user_id, $product_id, $quantity)";
            return $this->db->insert($sqlInsert);
        }
    }
    
}
