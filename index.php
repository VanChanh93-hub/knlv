<?php
// Bắt đầu session nếu cần

session_start();
ob_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

require "views/header.php";
if (isset($_SESSION['thongbao'])) {
    echo '<script>alert("' . $_SESSION['thongbao'] . '")</script>';
    unset($_SESSION['thongbao']);
}

// Lấy tham số từ URL (vd: index.php?page=about)
$act = isset($_GET['act']) ? $_GET['act'] : 'home';
$id = isset($_GET['id']) ? $_GET['id'] : 'product';
// var_dump($_SESSION['user']['id']);
// Dùng switch-case để điều hướng
switch ($act) {
    case 'home':
        require_once 'controllers/homeController.php';
        $controller = new homeController();
        $controller->index();
        break;

    case 'product':
        require_once 'controllers/sanphamController.php';
        $controller = new sanphamController();
        $controller->index($id);
        break;

    case 'findProduct':
        require_once 'controllers/sanphamController.php';
        $controller = new sanphamController();
        $controller->findProduct();
        break;

    case 'admin_product':
        require_once 'controllers/sanphamController.php';
        $controller = new sanphamController();
        $controller->listproduct();
        break;

    case 'addproduct':
        require_once 'controllers/sanphamController.php';
        $controller = new sanphamController();
        $controller->add();
        break;

    case 'delete':
        require_once 'controllers/sanphamController.php';
        $controller = new sanphamController();
        $controller->delete();
        break;
    case 'edit':
        require_once 'controllers/sanphamController.php';
        $controller = new sanphamController();
        $controller->edit();
        break;
    case 'detail':
        require_once 'controllers/chitietsanphamController.php';
        $controller = new chitietsanphamController();
        $controller->index($id);
        break;
    case 'login':
        require_once 'controllers/dangnhapController.php';
        $controller = new dangnhapController();
        $controller->index();
        break;
    case 'signup':
        require_once 'controllers/dangkyController.php';
        $controller = new dangkyController();
        $controller->index();
        break;
    case 'contact':
        require_once 'controllers/lienheController.php';
        $controller = new lienheController();
        $controller->index();
        break;
    case 'account':
        if (isset($_SESSION['user'])) {
            require_once 'controllers/thongtintaikhoanController.php';
            $controller = new thongtintaikhoanController();
            $controller->index();
        } else {
            require_once 'controllers/homeController.php';
            $controller = new homeController();
            $controller->index();
        }
        break;
    case 'resetpass':
        require_once 'controllers/thongtintaikhoanController.php';
        $controller = new thongtintaikhoanController();
        $controller->changepass();
        break;

    case 'changepass':
        require_once 'controllers/thongtintaikhoanController.php';
        $controller = new thongtintaikhoanController();
        $controller->resetpass();
        break;
    case 'cart':
        require_once 'controllers/giohangController.php';
        $controller = new giohangController();
        $controller->index();
        break;
    case 'order':
        require_once 'controllers/donhangController.php';
        $controller = new donhangController();
        $controller->index();
        break;
    case 'history':
        require_once 'controllers/lichsumuahangController.php';
        $controller = new lichsumuahangController();
        $controller->index();
        break;
    case 'update_address':
        require_once 'controllers/lichsumuahangController.php';
        $controller = new lichsumuahangController();
        $controller->updateAddress();
        break;
    // case 'update_status':
    //     require_once 'controllers/lichsumuahangController.php';
    //     $controller = new lichsumuahangController();
    //     $controller->updateStatus();
    //     break;

    case 'cancel_order':
        require_once 'controllers/lichsumuahangController.php';
        $controller = new lichsumuahangController();
        $controller->cancelOrder();

        break;

    case 'admin':
        require_once 'controllers/adminController.php';
        $controller = new adminController();
        $controller->index();

        break;
    case 'logout':
        unset($_SESSION['user']);
        $_SESSION['thongbao'] = "Đăng Xuất Thành Công";

        header('location:index.php');
        break;
    default:
        echo "404 - Trang không tồn tại!";
        break;
}




require "views/footer.php";
