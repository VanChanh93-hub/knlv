<?php
require_once "models/chitietModel.php";
class chitietsanphamController
{
    public function index($id)
    {
        $sanphamModel = new sanphamModel();
        $detail = $sanphamModel->sanphamDetail($id); // Lấy sản phẩm chi tiết
        $lienquan = $sanphamModel->sanphamLienQuan($id);
        require_once 'views/chitietsanpham.php';
    }
}

?>