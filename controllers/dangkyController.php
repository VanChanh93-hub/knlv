<?php
class dangkyController {
    protected $user;
    public function index() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
            $this->handleSignup();
        } else {
            include_once "views/dangky.php";
        }
    }

    function handleSignup(){
        $username = isset($_POST['username']) ? trim($_POST['username']) : '';
        $email = isset($_POST['email']) ? trim($_POST['email']) : '';
        $role = isset($_POST['role']) ? trim($_POST['role']) : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';
        $confirm = isset($_POST['confirm-password']) ? $_POST['confirm-password'] : '';
        $error =$this->validateForm($username,$email,$password,$confirm);
        if (!empty($error)) {
            include_once "views/dangky.php";
            return;
        }

        $this->user = new dangkyModel;
        $result =$this->user->addUser($username,$email,$role,$password);
        if ($result) {
            $_SESSION['thongbao']="Đăng ký thành công";
            header("Location: index.php?act=login");
        } else {

            $error = "Đăng ký thất bại. Vui lòng thử lại!";
            include_once "views/dangky.php";
        }
    }


    public function validateForm($username,$email, $matKhau, $reMatKhau) {

        require_once "models/dangkyModel.php";
        $dangkyModel = new dangkyModel(); // Khởi tạo đối tượng dangkyModel

        if (!preg_match('/^(?!.*[_.]{2})[a-zA-Z0-9](?:[a-zA-Z0-9._]{4,18})[a-zA-Z0-9]$/', $username)) {
            return "Tên đăng nhập không hợp lệ. Vui lòng sử dụng 6-20 ký tự bao gồm chữ, số, dấu chấm hoặc gạch dưới.";
        }

        if ($dangkyModel->issetEmail($email)) {
            return"Email đã được sử dụng. Vui lòng chọn email khác.";
        }
        if ($dangkyModel->issetUsername($username)) {
            return"username đã được sử dụng. Vui lòng chọn username khác.";
        }

        if ($matKhau !== $reMatKhau) {
            return "Mật khẩu và xác nhận mật khẩu không khớp.";
        }

        if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/', $matKhau)) {
            return "Mật khẩu phải có ít nhất 8 ký tự, bao gồm chữ hoa, chữ thường, số và ký tự đặc biệt.";
        }

        return '';
    }
}
?>


