<?php
require_once 'models/adminModel.php';
require_once 'models/sanphamModel.php';
class adminController {
    public function index() {
        $adminModel = new adminModel();

        if(isset($_SESSION['user']) && $_SESSION['user']['role'] == 1){
            $sanphamModel = new sanphamModel();
            $list = $sanphamModel->listPro();
            $categories = $sanphamModel->showCate();
    
            require_once 'views/admin_sanpham.php';
        }else{
            $_SESSION['thongbao'] = "Bạn không có quyền hạn";
                header("Location: ./index.php?act=home"); // Chuyển hướng về trang chính
                exit();
        }
        
    }
}
?>


