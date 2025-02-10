<?php
require_once "Database.php";
class sanphamModel
{

    public $sanpham;

    function __construct()
    {
        $this->sanpham = new Database;
    }
    function show()
    {
        $sql = "SELECT * FROM products";
        return $this->sanpham->getAll($sql);
    }
    function showCate()
    {
        $sql = "SELECT * FROM categories";
        return $this->sanpham->getAll($sql);
    }
    function showCateOne($id)
    {
        $sql = "SELECT * FROM products WHERE id_category = ?";
        return $this->sanpham->getAll($sql, $id);
    }

}
