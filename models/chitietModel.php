<?php
require_once "Database.php";
class sanphamModel
{

    public $sanpham;

    function __construct()
    {
        $this->sanpham = new Database;
    }
    function sanphamDetail($id)
    {
        $sql = "SELECT * FROM products WHERE id = ?";
        return $this->sanpham->getOne($sql, $id);
    }
    function sanphamLienQuan($id)
{
    // Lấy category_id của sản phẩm hiện tại
    $sql = "SELECT id_category FROM products WHERE id = ?";
    $category = $this->sanpham->getOne($sql, $id);
    // Nếu tìm thấy category_id, truy vấn các sản phẩm liên quan trong cùng danh mục
    if ($category) {
        // Lấy sản phẩm có cùng category_id nhưng không bao gồm sản phẩm hiện tại
        $sql = "SELECT * FROM products WHERE id_category = ? AND id != ? LIMIT 4";
        return $this->sanpham->getAll($sql, $category['id_category'], $id);
    }

   
}

}
