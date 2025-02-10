<?php
require "./models/giohangModel.php";
require_once "./models/Database.php";

class giohangController {
    public function index() {
        $cart = new cart();
        $dscart = $cart->getAllCart();
        $products = []; // Mảng chứa thông tin sản phẩm trong giỏ

        foreach ($dscart as $item) {
            $productInfo = $cart->getProductById($item['product_id']);
            if ($productInfo) {
                $products[] = array_merge($item, $productInfo);
            }
        }
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $cart = new cart();
            $cart->deleteCart($id);
            header("Location: index.php?act=cart");
            exit();
        }
        if (isset($_POST['cong']) || isset($_POST['tru'])) {
            $idCart = $_POST['idCart'];
            $quantity = $_POST['quantity'];
        
            if (isset($_POST['cong'])) {
                $quantity++;
            }
        
            if (isset($_POST['tru']) && $quantity > 1) {
                $quantity--;
            }
        
            $cart->updateCart($idCart, $quantity);
            header("Location: index.php?act=cart");
            exit();
        }

        require_once 'views/giohang.php';
    }
}
?>
