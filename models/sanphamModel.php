<?php
require_once "Database.php";

class sanphamModel
{
    public $sanpham;

    function __construct()
    {
        $this->sanpham = new Database;
    }

    // Hiển thị tất cả sản phẩm
    function show()
    {
        $sql = "SELECT * FROM products";
        return $this->sanpham->getAll($sql);
    }

    // Hiển thị danh mục sản phẩm
    function showCate()
    {
        $sql = "SELECT * FROM categories";
        return $this->sanpham->getAll($sql);
    }

    // Hiển thị sản phẩm theo danh mục
    function showCateOne($id)
    {
        $sql = "SELECT * FROM products WHERE id_category = ?";
        return $this->sanpham->getAll($sql, $id);
    }

    function hasOrders($id_product)
    {
        $sql = "SELECT COUNT(*) as order_count FROM orders_detail WHERE id_product = ?";
        $result = $this->sanpham->getOne($sql, $id_product);
        return $result['order_count'] > 0;
    }

    function deleteProduct($id)
    {
        $sql = "DELETE FROM products WHERE id = ?";
        return $this->sanpham->delete($sql, $id);
    }

    function getProductById($id)
    {
        $sql = "SELECT * FROM products WHERE id = ?";
        return $this->sanpham->getOne($sql, $id);
    }

    function updateProduct($id, $name, $price, $id_category, $description, $image = null)
    {
        if ($image) {
            $sql = "UPDATE products SET name = ?, price = ?, id_category = ?, description = ?, image = ? WHERE id = ?";
            return $this->sanpham->update($sql, $name, $price, $id_category, $description, $image, $id);
        } else {
            $sql = "UPDATE products SET name = ?, price = ?, id_category = ? , description = ? WHERE id = ?";
            return $this->sanpham->update($sql, $name, $price, $id_category, $description, $id);
        }
    }


    function addProduct($name, $price, $id_category, $description, $image)
    {
        // var_dump($_SESSION['user']['id']);
        $sql = "INSERT INTO products (name, price, id_category, description, image) VALUES (?, ?, ?, ?, ?)";
        return $this->sanpham->insert($sql, $name, $price, $id_category, $description, $image);
    }



    function listPro()
    {
        $sql = "SELECT p.*, c.name as cname
                FROM products p
                INNER JOIN categories c ON c.id = p.id_category";

        return $this->sanpham->getAll($sql); // Truyền mảng tham số key-value
    }
    public function findProduct($keyword)
    {
        $sql = "SELECT * FROM products WHERE name LIKE :keyword";
        return $this->sanpham->getAll($sql, [':keyword' => "%$keyword%"]);
    }
    
}
