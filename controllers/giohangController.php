<?php
require "./models/giohangModel.php";
require_once "./models/Database.php";

class giohangController {
    public function index() {
        $cart = new cart();
        $products = []; 
        if (isset($_POST['addtocart']) && $_POST['addtocart']) {
            $user_id = $_SESSION['user']['id'];
            if(isset($_POST['id']) ) {
                $idProduct = $_POST['id'];
                $quantity = $_POST['quantity'];
                $cart->insertCart($user_id, $idProduct, $quantity);
                header("Location: index.php?act=cart");
                exit();
            } else{
                echo "khong tim thay san pham";
            }
        }

        if (isset($_SESSION['user']['id'])) {
            $user_id = $_SESSION['user']['id'];
            $dscart = $cart->getAllcartByUser($user_id);
            foreach ($dscart as $item) {
                $productInfo = $cart->getProductById($item['product_id']);
                if ($productInfo) {
                    $products[] = array_merge($item, $productInfo);
                }
            }
        } else {
            $dscart = [];
        }

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $cart->deleteCart($id);
            header("Location: index.php?act=cart");
            exit();
        }

        // Cập nhật số lượng sản phẩm
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

        // Hiển thị view
        require_once 'views/giohang.php';
    }
}
?>
