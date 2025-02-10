<?php

require_once "models/sanphamModel.php";

class sanphamController
{
    public function index($id = null)
    {
        $sanphamModel = new sanphamModel();

        // Lấy tất cả sản phẩm
        $products = $sanphamModel->show(); 
        
        // Lấy tất cả danh mục
        $categories = $sanphamModel->showCate(); 

        // Kiểm tra nếu có id để lấy sản phẩm theo danh mục
        if ($id) {
            // Nếu có id, lấy sản phẩm trong danh mục
            $categoryProducts = $sanphamModel->showCateOne($id); 
            // Nếu có sản phẩm trong danh mục, sử dụng sản phẩm đó, nếu không, thông báo không có sản phẩm
            if (empty($categoryProducts)) {
                $categoryMessage = "Không có sản phẩm trong danh mục này.";
                $allProducts = []; // Không có sản phẩm
            } else {
                $allProducts = $categoryProducts;
                $categoryMessage = null; // Không có thông báo nếu có sản phẩm
            }
        } else {
            // Nếu không có id, sử dụng tất cả sản phẩm
            $allProducts = $products;
            $categoryMessage = null; // Không có thông báo nếu có tất cả sản phẩm
        }

        // Load view để hiển thị sản phẩm và danh mục
        require_once 'views/sanpham.php'; 
    }
}
?>
