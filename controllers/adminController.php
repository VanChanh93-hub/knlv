<?php
require_once 'models/adminModel.php';
class adminController {
    public function index() {
        $adminModel = new adminModel();

        if(isset($_SESSION['user']) && $_SESSION['user']['role'] == 2){
            $user = $adminModel->getUser();
            $seller = $adminModel->getSeller();
            $order = $adminModel->getOrder();
    
    
            require_once 'views/admin.php';
        }else{
            $_SESSION['thongbao'] = "Bạn không có quyền hạn";
                header("Location: ./index.php?act=home"); // Chuyển hướng về trang chính
                exit();
        }
        
    }
}
?>


