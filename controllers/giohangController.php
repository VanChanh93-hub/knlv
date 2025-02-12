<?php
require "./models/giohangModel.php";
require_once "./models/Database.php";

class giohangController {
    public function index() {
        if(isset($_SESSION['user'])){
            if ($_SESSION['user']['role'] == 0) {
                $cart = new cart();
                $products = []; 
                
                // Xử lý thêm vào giỏ hàng
                if (isset($_POST['addtocart']) && $_POST['addtocart']) {
                    if (isset($_SESSION['user']['id'])) {
                        $user_id = $_SESSION['user']['id'];
                        if (isset($_POST['id'])) {
                            $idProduct = $_POST['id'];
                            $quantity = $_POST['quantity'];
                            $cart->insertCart($user_id, $idProduct, $quantity);
                            header("Location: index.php?act=cart");
                            exit();
                        } else {
                            echo "Không tìm thấy sản phẩm";
                        }
                    } else {
                        header("Location: index.php?act=login");
                        exit();
                    }
                }
    
                if (isset($_SESSION['user']['id'])) {
                    $user_id = $_SESSION['user']['id'];
                    $dscart = $cart->getAllcartByUser($user_id);
                    $totalPrice = 0;
    
                    foreach ($dscart as $item) {
                        $productInfo = $cart->getProductById($item['product_id']);
                        $totalPrice += $item['quantity'] * $productInfo['price'];
                        if ($productInfo) {
                            $products[] = array_merge($item, $productInfo);
                        }
                    }
                } else {
                    $dscart = [];
                }
    
                // Xóa sản phẩm khỏi giỏ hàng
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                    $cart->deleteCart($id);
                    header("Location: index.php?act=cart");
                    exit();
                }
    
                // Cập nhật số lượng sản phẩm trong giỏ
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
            } else {
                $_SESSION['thongbao'] = "Tài khoản người bán không được phép mua hàng";
                header('Location: index.php');
                exit();
            }
        }else{
            $_SESSION['thongbao'] = "Bạn cần phải đăng nhập";
            header('Location: index.php');
            exit();
        }
    }
}
