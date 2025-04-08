<?php
require_once 'models/danhmucModel.php';

class danhmucController {
    public function index() {
       
        $model = new Category();
        $categories = $model->getAll();
       
        require 'views/admin_danhmuc.php'; // View hiển thị giao diện danh mục
    }

    public function add() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = $_POST['name'];
            $filename = null;
    
            $model = new Category();
    
            // 🔍 Kiểm tra tên đã tồn tại chưa
            if ($model->existsByName($name)) {
                $_SESSION['thongbao'] = "Tên danh mục đã tồn tại!";
                header("Location: index.php?act=categories");
                return;
            }
    
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $target_dir = "public/img/categories/";
                $raw_name = basename($_FILES["image"]["name"]);
                $target_file = $target_dir . $raw_name;
    
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                    $filename = "categories/" . $raw_name;
                }
            }
    
            $model->add($name, $filename);
    
            $_SESSION['thongbao'] = "Thêm danh mục thành công!";
            header("Location: index.php?act=categories");
        } else {
            require "views/admin/category/add.php";
        }
    }
    
    
    
    

    public function edit() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $filename = $_POST['old_image'] ?? null;
    
            $model = new Category();
    
            // 🔍 Kiểm tra trùng tên, loại trừ chính nó
            if ($model->existsByName($name, $id)) {
                $_SESSION['thongbao'] = "Tên danh mục đã tồn tại!";
                header("Location: index.php?act=categories");
                return;
            }
    
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $target_dir = "public/img/categories/";
                $raw_name = basename($_FILES["image"]["name"]);
                $target_file = $target_dir . $raw_name;
    
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                    $filename = "categories/" . $raw_name;
                }
            }
    
            $model->update($id, $name, $filename);
    
            $_SESSION['thongbao'] = "Cập nhật danh mục thành công!";
            header("Location: index.php?act=categories");
        }
    }
    
    

    public function delete() {
        $id = $_GET['id'] ?? null;
        if ($id) {
        
            $model = new Category();
            $model->delete($id);
            $_SESSION['message'] = 'Xóa danh mục thành công!';
        }
        header('Location: index.php?act=categories');
    }
}
