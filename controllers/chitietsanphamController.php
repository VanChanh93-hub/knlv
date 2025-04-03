<?php
require_once "models/chitietModel.php";
require_once "models/thongtintaikhoanModel.php";
class chitietsanphamController
{
    public function index($id)
    {
        $sanphamModel = new sanphamModel();
        $thongtintaikhoanModel = new thongtintaikhoanModel();
        $detail = $sanphamModel->sanphamDetail($id); // Lấy sản phẩm chi tiết
        $lienquan = $sanphamModel->sanphamLienQuan($id);
        $user = $thongtintaikhoanModel->getUser($id);

        $show = [
            'detail' => $detail,
            'lienquan' => $user
        ];

        require_once 'views/chitietsanpham.php';
    }
}

?>