<?php
require "./models/dangnhapModel.php";
class dangnhapController
{
    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            include "views/dangnhap.php";
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
            $user = $_POST['username'] ?? '';  // Lấy tên đăng nhập từ POST
            $password = $_POST['password'] ?? '';  // Lấy mật khẩu từ POST
            $this->handleLogin($user, $password);
        }

        
    }

    public function handleLogin($user, $password)
    {
        $model = new dangnhapModel;
        $login = $model->getUserName($user);


        if ($login && ($password === $login['password'])) {
            $_SESSION['user'] = [
                'id' => $login['id'],
                'username' => $login['username'],
                'email' => $login['email'],
                'phone' => $login['phone'],
                'address' => $login['address'],
                'role' => $login['role'],
            ];

            
            if($_SESSION['user']['role'] == 1){
                header("Location: ./index.php?act=admin"); 
                exit();
            }else{
                $_SESSION['thongbao'] = "Đăng Nhập Thành Công";
                header("Location: ./index.php?act=home"); // Chuyển hướng về trang chính
                exit();
            }
        } else {
            $_SESSION['thongbaologin'] = "Tên đăng nhập hoặc mật khẩu không đúng";
            header("Location: ./index.php?act=login");
            exit();
        }
    }
}
