<?php

use PHPMailer\PHPMailer\PHPMailer;

require "models/thongtintaikhoanModel.php";
class thongtintaikhoanController
{
    private $user;

    function __construct()
    {
        $this->user = new thongtintaikhoanModel();
    }

    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
            $this->handleUpdate();
        } else {
            if (isset($_SESSION['user'])) {
                $profile = $this->user->getUser($_SESSION['user']['id']);
                require_once 'views/thongtintaikhoan.php';
            }
        }
    }


    function handleUpdate()
    {
        $username = isset($_POST['username']) ? trim($_POST['username']) : '';
        $email = isset($_POST['email']) ? trim($_POST['email']) : '';
        $sdt = isset($_POST['sdt']) ? trim($_POST['sdt']) : '';
        $address = isset($_POST['address']) ? trim($_POST['address']) : '';

        $_SESSION['thongbao'] = $this->validateForm($username, $email, $sdt);

        if (!empty($_SESSION['thongbao'])) {
            $profile = $this->user->getUser($_SESSION['user']['id']);
            include_once "views/thongtintaikhoan.php";
            return;
        }


        $result = $this->user->updateUser($username, $email, $sdt, $address, $_SESSION['user']['id']);
        if ($result) {
            $_SESSION['thongbao'] = "Cập nhật thông tin thành công";
            header("Location: index.php?act=account");
        } else {

            $_SESSION['thongbao'] = "Cập nhật thông tin thất bại. Vui lòng thử lại!";
            include_once "views/thongtintaikhoan.php";
        }
    }



    public function validateForm($username, $email, $sdt)
    {


        if (!preg_match('/^(?!.*[_.]{2})[a-zA-Z0-9](?:[a-zA-Z0-9._]{4,18})[a-zA-Z0-9]$/', $username)) {
            return "Tên đăng nhập không hợp lệ. Vui lòng sử dụng 6-20 ký tự bao gồm chữ, số, dấu chấm hoặc gạch dưới.";
        }

        if ($this->user->issetEmail($email)) {
            return"Email đã được sử dụng. Vui lòng chọn email khác.";
        }
        if ($this->user->issetUsername($username)) {
            return"username đã được sử dụng. Vui lòng chọn username khác.";
        }

        if ($this->user->issetPhone($sdt)) {
            return "Số điện thoại đã được sử dụng. Vui lòng chọn Số điện thoại khác.";
        }

        if (!preg_match('/^[0-9]{10}$/', $sdt)) {
            return "Số điện thoại phải gồm 10 chữ số.";
        }
        return '';
    }

    public function changepass()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['changepass'])) {
            $oldpass    = trim($_POST['oldpassword'] ?? '');
            $newpassword  = trim($_POST['password'] ?? '');
            $newpassword1 = trim($_POST['password1'] ?? '');

            // Kiểm tra nếu có trường nào bị bỏ trống
            if (empty($oldpass) || empty($newpassword) || empty($newpassword1)) {
                $_SESSION['thongbao'] = "Vui lòng điền đầy đủ thông tin!";
                header('location: index.php?act=account');
                exit();
            }

            // Kiểm tra mật khẩu mới nhập lại có khớp không
            if ($newpassword !== $newpassword1) {
                $_SESSION['thongbao'] = "Mật khẩu nhập lại không khớp!";
                header('location: index.php?act=account');
                exit();
            }

            $id = $_SESSION['user']['id'];
            $infouser = $this->user->selectUserById($id);
            $passwordFromDB = $infouser['password'] ?? '';

            // var_dump($passwordFromDB);
            // return;
            // Kiểm tra mật khẩu cũ có đúng không
            if ($oldpass !== $passwordFromDB) {
                $_SESSION['thongbao'] = "Mật khẩu cũ không chính xác!";
                header('location: index.php?act=account');
                exit();
            }

            // Cập nhật mật khẩu mới
            $setsuccess = $this->user->ChangePass($newpassword, $id);

            if ($setsuccess) {
                $_SESSION['thongbao'] = "Cập nhật mật khẩu thành công!";
                header('location: index.php?act=account');
                unset($_SESSION['user']);
                exit();
            } else {
                $_SESSION['thongbao'] = "Đổi mật khẩu không thành công! Vui lòng thử lại.";
                header('location: index.php?act=account');
                exit();
            }
        }
    }


    public function resetpass()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? null;
            $code = $_POST['otp'] ?? null;
            $password = $_POST['newPassword'] ?? null;
            $emailPattern = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";

            header("Content-Type: application/json");
            ob_clean(); // Xóa toàn bộ output buffer trước khi in JSON

            if (empty($email)) {
                echo json_encode(["status" => "error", "message" => "Email không được để trống!"]);
                exit;
            }

            if (!preg_match($emailPattern, $email)) {
                echo json_encode(["status" => "error", "message" => "Email không đúng định dạng!"]);
                exit;
            }

            if ($email && !$code) {
                $check = $this->user->selectUserEmail($email);
                if ($check) {
                    $otpCode = rand(10000, 99999);
                    $expiry = date('Y-m-d H:i:s', strtotime('+5 minutes'));
                    $id = $check['id'];
                    $updatecode = $this->user->updateaCode($otpCode, $expiry, $id);
                    if ($updatecode) {
                        if ($this->sendEmail($email, $otpCode)) {
                            echo json_encode(["status" => "success", "message" => "Mã xác thực đã được gửi"]);
                            exit;
                        } else {
                            echo json_encode(["status" => "error", "message" => "Gửi thất bại! Xin thử lại"]);
                            exit;
                        }
                    } else {
                        echo json_encode(["status" => "error", "message" => "Cập nhật mã thất bại"]);
                        exit;
                    }
                } else {
                    echo json_encode(["status" => "error", "message" => "Email chưa được đăng ký!"]);
                    exit;
                }
            }

            if ($email && $code) {
                if (empty($password)) {
                    echo json_encode(["status" => "error", "message" => "Mật khẩu mới không được để trống!"]);
                    exit;
                }

                $user = $this->user->selectUserEmail($email);
                if (!$user) {
                    echo json_encode(["status" => "error", "message" => "Email không tồn tại!"]);
                    exit;
                }

                $oldPasswordHash = $user['password'];

                if (password_verify($password, $oldPasswordHash)) {
                    echo json_encode(["status" => "error", "message" => "Mật khẩu mới không được giống với mật khẩu cũ!"]);
                    exit;
                }

                // $hashPassword = password_hash($password, PASSWORD_DEFAULT);

                $isValid = $this->user->checkVerificationCode($email, $code);
                if ($isValid) {
                    $setPass = $this->user->updatePassWord($password, $email, $code);
                    if ($setPass) {
                        echo json_encode(["status" => "success", "message" => "Đổi mật khẩu thành công"]);
                        $this->user->deleteVerificationCode($email);
                        exit;
                    } else {
                        echo json_encode(["status" => "error", "message" => "Đổi mật khẩu không thành công"]);
                        exit;
                    }
                } else {
                    echo json_encode(["status" => "error", "message" => "Mã xác thực không hợp lệ hoặc đã hết hạn!"]);
                    exit;
                }
            }
            echo json_encode(["status" => "error", "message" => "Vui lòng nhập email và mã OTP!"]);
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            include_once './views/resetpass.php';
        }
        
    }



    private function sendEmail($email, $code)
    {
        require 'PHPMailer-master/PHPMailer-master/src/PHPMailer.php';
        require 'PHPMailer-master/PHPMailer-master/src/SMTP.php';
        require 'PHPMailer-master/PHPMailer-master/src/Exception.php';

        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = "tiennttps39163@gmail.com";
            $mail->Password   = "fubamlrqynmfpdvw";
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port       = 465;

            $mail->setFrom("tiennttps39163@gmail.com", "Hỗ trợ khách hàng");
            $mail->addAddress($email);

            $mail->CharSet = 'UTF-8';
            $mail->isHTML(true);
            $mail->Subject = "Xác thực tài khoản của bạn";
            $mail->Body = "
            <div style='font-family: Arial, sans-serif; font-size: 14px; color: #333;'>
                <h2 style='color:rgb(2, 2, 2);'>Mã xác thực tài khoản</h2>
                <p>Xin chào,</p>
                <p>Bạn đã yêu cầu đặt lại mật khẩu cho tài khoản của mình. Dưới đây là mã xác thực của bạn:</p>
                <p style='font-size: 18px; font-weight: bold; color:rgb(2, 2, 2); background: #f8f9fa; padding: 10px; display: inline-block; border-radius: 5px;'>
                    $code
                </p>
                <p><strong>Lưu ý:</strong> Mã này có hiệu lực trong vòng <span style='color:rgb(7, 7, 7);'>5 phút</span>. Vui lòng sử dụng sớm.</p>
                <p>Nếu bạn không yêu cầu đặt lại mật khẩu, hãy bỏ qua email này.</p>
                <p>Trân trọng,</p>
                <p><strong>Đội ngũ hỗ trợ</strong></p>
            </div>
        ";

            $mail->send();
            return true;
        } catch (Exception $e) {
            echo "Lỗi gửi email: {$mail->ErrorInfo}";
            return false;
        }
    }



}
