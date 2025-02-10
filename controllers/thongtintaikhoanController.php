<?php
require "models/thongtintaikhoanModel.php";
class thongtintaikhoanController {
    private $user;

    function __construct() {
        $this->user = new thongtintaikhoanModel();
    }

    public function index() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
            $this->handleUpdate();

        } else {
            if(isset($_SESSION['user'])) {
                $profile = $this->user->getUser($_SESSION['user']['id']);
                require_once 'views/thongtintaikhoan.php';
            }
        }
    }


    function handleUpdate(){
        $username = isset($_POST['username']) ? trim($_POST['username']) : '';
        $email = isset($_POST['email']) ? trim($_POST['email']) : '';
        $sdt = isset($_POST['sdt']) ? trim($_POST['sdt']) : '';
        $address = isset($_POST['address']) ? trim($_POST['address']) : '';

        $error =$this->validateForm($username,$email,$sdt);

        if (!empty($error)) {
            $profile = $this->user->getUser($_SESSION['user']['id']);
            include_once "views/thongtintaikhoan.php";
            return;
        }


        $result = $this->user->updateUser($username,$email,$sdt,$address,$_SESSION['user']['id']);
        if ($result) {
            $_SESSION['thongbao']="Cập nhật thông tin thành công";
            header("Location: index.php?act=account");
        } else {

            $error = "Cập nhật thông tin thất bại. Vui lòng thử lại!";
            include_once "views/thongtintaikhoan.php";
        }
    }



    public function validateForm($username,$email,$sdt) {


        if (!preg_match('/^(?!.*[_.]{2})[a-zA-Z0-9](?:[a-zA-Z0-9._]{4,18})[a-zA-Z0-9]$/', $username)) {
            return "Tên đăng nhập không hợp lệ. Vui lòng sử dụng 6-20 ký tự bao gồm chữ, số, dấu chấm hoặc gạch dưới.";
        }

        // if ($this->user->issetEmail($email)) {
        //     return"Email đã được sử dụng. Vui lòng chọn email khác.";
        // }
        // if ($this->user->issetUsername($username)) {
        //     return"username đã được sử dụng. Vui lòng chọn username khác.";
        // }

        // if ($this->user->issetPhone($sdt)) {
        //     return "Số điện thoại đã được sử dụng. Vui lòng chọn Số điện thoại khác.";
        // }

        if (!preg_match('/^[0-9]{10}$/', $sdt)) {
            return "Số điện thoại phải gồm 10 chữ số.";
        }





        return '';
    }
}
?>


