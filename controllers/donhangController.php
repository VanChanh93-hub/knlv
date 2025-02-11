<?php
require "./models/giohangModel.php";
require_once "./models/Database.php";
require_once "./models/donhangModel.php";

class donhangController {
    public function index() {
        if ($_SESSION['user']['role'] == 0) {
            $cart = new cart();
            $order = new order();
            $dscart = $cart->getAllcartByUser($_SESSION['user']['id']);
            $user_info = $order->getUserInfo($_SESSION['user']['id']);
            if (isset($_POST['checkout']) && $_POST['checkout']) {
                if (isset($_SESSION['user']['id'])) {
                    $user_id = $_SESSION['user']['id'];
                    if (isset($_POST['address'], $_POST['phone'], $_POST['note'], $_POST['totalPrice'], $_POST['price'], $_POST['fullName'])) {
                        $address = $_POST['address'];
                        $phone = $_POST['phone'];
                        $note = $_POST['note'];
                        $totalPrice = $_POST['totalPrice'];
                        $price = $_POST['price'];
                        $fullName = $_POST['fullName'];
                        $orderDay = date('Y-m-d');
                        $idorder = $order->insertOrder($orderDay, $totalPrice, 'Chờ xử lý', $user_id, $note, $address, $phone, $fullName);
                        foreach ($dscart as $item) {
                            $order->insertOrderDetail($idorder, $item['product_id'], $price, $item['quantity']);
                        }
                        header("Location: index.php?act=cart");
                        $order->deleteCartByUser($user_id);
                    }
                }
            }
        } else {
            $_SESSION['thongbao'] = "Tài khoản người bán không được phép mua hàng";
            header('location: index.php');
            exit();
        }
    }
}
