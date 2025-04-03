<?php
require_once 'models/orderModel.php';

class lichsumuahangController {
    private $model;

    public function __construct() {
        $this->model = new OrderModel();
    }

    public function index() {
        $user_id = $_SESSION['user']['id'];
        $role = $_SESSION['user']['role']; // Kiểm tra role của user
        $orderHistory = [];
        $orderHistory = $this->model->getOrder($user_id);
        require_once 'views/lichsumuahang.php';
    }

    public function updateAddress() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_address'])) {
            $order_id = $_POST['order_id'];
            $new_address = $_POST['new_address'];

            if ($this->model->updateAddress($order_id, $new_address)) {
                $_SESSION['thongbao'] = "Cập nhật địa chỉ thành công!";
            } else {
                $_SESSION['thongbao'] = "Cập nhật địa chỉ thất bại!";
            }
            header("Location: index.php?act=history");
            exit();
        }
    }

    // public function updateStatus() {
    //     if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_status'])) {
    //         $order_id = $_POST['order_id'];
    //         $new_status = $_POST['new_status'];

    //         if ($this->model->updateStatus($order_id, $new_status)) {
    //             $_SESSION['message'] = "Cập nhật trạng thái thành công!";
    //         } else {
    //             $_SESSION['error'] = "Cập nhật trạng thái thất bại!";
    //         }
    //         header("Location: index.php?act=history");
    //         exit();
    //     }
    // }

    public function cancelOrder() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cancel_order'])) {
            $order_id = $_POST['order_id'];

            if ($this->model->updateStatus($order_id, "Thất bại")) {
                $_SESSION['thongbao'] = "Đơn hàng đã được hủy!";
            } else {
                $_SESSION['thongbao'] = "Hủy đơn hàng thất bại!";
            }
            header("Location: index.php?act=history");
        }
    }
}
?>
