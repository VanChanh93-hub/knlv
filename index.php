<?php
// Bắt đầu session nếu cần
session_start();
require "views/header.php";
// Lấy tham số từ URL (vd: index.php?page=about)
$act = isset($_GET['act']) ? $_GET['act'] : 'home';

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
        $controller->index();
        break;
    case 'detail':
        require_once 'controllers/chitietsanphamController.php';
        $controller = new chitietsanphamController();
        $controller->index();
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
        require_once 'controllers/thongtintaikhoanController.php';
        $controller = new thongtintaikhoanController();
        $controller->index();
        break;
    case 'cart':
        require_once 'controllers/giohangController.php';
        $controller = new giohangController();
        $controller->index();
        break;
    case 'orderorder':
        require_once 'controllers/donhangController.php';
        $controller = new donhangController();
        $controller->index();
        break;
    case 'cart':
        require_once 'controllers/giohangController.php';
        $controller = new giohangController();
        $controller->index();
        break;

    default:
        echo "404 - Trang không tồn tại!";
        break;
}




require "views/footer.php";
?>
