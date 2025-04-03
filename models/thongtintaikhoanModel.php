<?php
require_once "Database.php";

class thongtintaikhoanModel
{
    private $user;
    function  __construct()
    {
        $this->user = new Database;
    }


    function getUser($id)
    {
        $sql = "SELECT * FROM user Where id=?";
        return $this->user->getOne($sql, $id);
    }

    function updateUser($username, $email, $phone, $address, $id)
    {
        $sql = "UPDATE user SET username= ?,email=?, phone=? ,address=? WHERE id=?";
        return $this->user->update($sql, $username, $email, $phone, $address, $id);
    }

    function issetEmail($email)
    {
        $sql = "SELECT * FROM user WHERE email=?";
        return $this->user->getOne($sql, $email);
    }


    function issetPhone($phone)
    {
        $sql = "SELECT * FROM user WHERE phone=?";
        return $this->user->getOne($sql, $phone);
    }
    function issetUsername($username)
    {
        $sql = "SELECT * FROM user WHERE username=?";
        return $this->user->getOne($sql, $username);
    }

    public function ChangePass($password, $id)
    {
        try {
            $sql = "UPDATE user SET password = ? WHERE id = ?;";
            $this->user->update($sql, $password, $id);
            return true;
        } catch (\Exception $th) {
            echo $th->getMessage();
            return false;
        }
    }

    public function selectUserById($id)
    {
        $sql = "SELECT * FROM user WHERE id = ?;";
        return $this->user->getOne($sql, $id);;
    }

    public function updateaCode($reset_code, $reset_expiry, $id)
    {
        try {
            $sql = "UPDATE user SET reset_code = ?, reset_expiry = ? WHERE id = ?";
            $this->user->update($sql, $reset_code, $reset_expiry, $id);
            return true;
        } catch (\Exception $th) {
            $_SESSION['thongbao'] = $th->getMessage();
            return false;
        }
    }

    public function selectUserEmail($email)
    {
        $sql = "SELECT * FROM user WHERE email = ?;";
        return $this->user->getOne($sql, $email);
    }

    public function deleteVerificationCode($email)
    {
        $sql = "UPDATE user SET reset_code = NULL, reset_expiry = NULL WHERE email = ?";
        return $this->user->update($sql, $email);
    }

    public function checkVerificationCode($email, $reset_code)
    {
        $sql = "SELECT reset_expiry FROM user WHERE email = ? AND reset_code = ?";
        $result = $this->user->getAll($sql, [$email, $reset_code]);

        if (!empty($result) && isset($result[0]["reset_expiry"])) {
            $current_time = new DateTime();
            $expiry_time = new DateTime($result[0]["reset_expiry"]);

            if ($current_time > $expiry_time) {
                $this->deleteVerificationCode($email);
                return false;
            }
            return true;
        }
        return false;
    }


    public function updatePassWord($password,$email, $reset_code){
        try{
            $sql = "UPDATE user SET password = ? WHERE email = ? AND reset_code = ?;";
            $this->user->update($sql, $password, $email, $reset_code);
            return true;
        }catch(\Exception $th){
            echo $th->getMessage();
            return false;
        }
        
    }
}
