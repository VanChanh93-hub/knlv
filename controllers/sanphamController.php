<?php

require_once "models/sanphamModel.php";

class sanphamController
{
    public function index($id = null)
    {
        $sanphamModel = new sanphamModel();

        $id = $_GET['id'] ?? '';
        // Lấy tất cả sản phẩm
        $products = $sanphamModel->show();

        // Lấy tất cả danh mục
        $categories = $sanphamModel->showCate();

        // Hiển thị sản phẩm theo danh mục
        if ($id) {
            $categoryProducts = $sanphamModel->showCateOne($id);
            $allProducts = empty($categoryProducts) ? [] : $categoryProducts;
            $categoryMessage = empty($categoryProducts) ? "Không có sản phẩm trong danh mục này." : null;
        } else {
            $allProducts = $products;
            $categoryMessage = '';
        }

        require_once 'views/sanpham.php';
    }

    public function delete()
    {
        $sanphamModel = new sanphamModel();

        if (isset($_POST['delete_product'])) {
            $id_product = $_GET['id'];

            if ($sanphamModel->hasOrders($id_product)) {
                $_SESSION['error'] = "Sản phẩm này đã có lượt đặt hàng và không thể xóa!";
            } else {
                $sanphamModel->deleteProduct($id_product);
                $_SESSION['message'] = "Xóa sản phẩm thành công!";
            }

            header("Location: index.php?act=admin_product");
            exit();
        }
    }

    public function edit()
    {
        $sanphamModel = new sanphamModel();

        if (isset($_POST['sua'])) {
            $id_product = $_GET['id'];
            $name = $_POST['name'];
            $price = $_POST['price'];
            $category_id = $_POST['category_id'];
        
            // Xử lý upload file
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $target_dir = "public/img/product/";
                $filename = basename($_FILES["image"]["name"]);

                $target_file = $target_dir . basename($_FILES["image"]["name"]);
                move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
            } else {
                $target_file = null; // Nếu không upload ảnh mới
            }
        
            $sanphamModel->updateProduct($id_product, $name, $price, $category_id, $filename);
        
            $_SESSION['message'] = "Cập nhật sản phẩm thành công!";
            header("Location: index.php?act=admin_product");
            exit();
        }
            }

    public function add()
{
    $sanphamModel = new sanphamModel();

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['them'])) {
        // $seller_id = (int)$_SESSION['user']['id'];
        // echo $_SESSION['user']['id'];
        $name = $_POST['name'];
        $price = $_POST['price'];
        $id_category = $_POST['category_id'];

        // Xử lý upload file
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $target_dir = "public/img/product/";
            $filename = basename($_FILES["image"]["name"]);
            $target_file = $target_dir . basename($_FILES["image"]["name"]);
            move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
        } else {
            $target_file = ""; // Nếu không upload ảnh
        }

        $sanphamModel->addProduct($name, $price, $id_category, $filename);

        $_SESSION['message'] = "Thêm sản phẩm mới thành công!";
        header("Location: index.php?act=admin_product");
        exit();
    }

}

    public function listproduct(){
        $sanphamModel = new sanphamModel();

        $seller_id = $_SESSION['user']['id'] ?? '';
        $list = $sanphamModel->listPro($seller_id);
        $categories = $sanphamModel->showCate();

        require_once 'views/admin_sanpham.php';

    }
}
