<?php
class lienheController {
    public function index() {
        include_once "views/lienhe.php";
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
                $address = $_POST['email'];
                $name = $_POST['name'] ?? "";
                $problem = $_POST['problem'] ?? "";
                $mess = $_POST['message'] ?? "";

                if (empty($address) || empty($name) || empty($mess)) {
                    $_SESSION['thongbao'] = 'Vui long nhập đủ thông tin!';
                    header('location: ./index.php?act=contact');
                    exit();
                } else {
                    $sendResult = $this->sendmail($address, $name, $mess,$problem);
                    if ($sendResult === true) {
                        $_SESSION['thongbao'] = 'Gửi thành công!';

                        header('location: ./index.php?act=contact');
                        exit();

                    } else {
                        $_SESSION['thongbao'] = 'Gửi không thành công vui lòng gửi lại!';

                        header('location: ./index.php?act=contact');
                        exit();

                    }
                }
            }

    }



    public function sendmail($address, $name, $mess,$problem) {

        require 'PHPMailer-master/PHPMailer-master/src/PHPMailer.php';
        require 'PHPMailer-master/PHPMailer-master/src/SMTP.php';

        $mail = new \PHPMailer\PHPMailer\PHPMailer();

            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'wd19305.ps39144.toanlt@gmail.com';
            $mail->Password   = 'httn roup adxd wkvp';
            $mail->SMTPSecure = \PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port       = 465;

            //người gửi
            $mail->setFrom('wd19305.ps39144.toanlt@gmail.com' ,$address);

            //người nhận
            $mail->addAddress('wd19305.ps39144.toanlt@gmail.com');

            //thêm phần này để không bị lỗi font chữ
            $mail->CharSet = 'UTF-8';

            $mail->isHTML(true);
            $mail->Subject = "Liên hệ từ : " . $name;
            $mail->Body    = "<h2>".$problem."</h2>".$mess;

            $mail->send();
            return true;
        }
    }


?>
