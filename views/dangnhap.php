<div class="dangnhap">
        <div class="login-form">
            <h2>Đăng nhập tài khoản</h2><?php if(isset($_SESSION['thongbaologin'])){
          echo '<p class="action_login">'.$_SESSION['thongbaologin'] .'</p>';
          unset($_SESSION['thongbaologin']);
      }?>
            <form action="index.php?act=login" method="POST">
              <div class="form-group">
                <label for="text">Tên đăng nhập</label>
                <input type="text" id="text" name="username" placeholder="Nhập tên đăng nhập" required>
              </div>
              <div class="form-group">
                <label for="password">Mật khẩu</label>
                <input type="password" id="password" name="password" placeholder="Nhập mật khẩu" required>
              </div>
              <button type="submit" name="submit">Đăng nhập</button>
              <div class="extra-links">
                <p>              <a href="index.php?act=changepass" class="text-danger">Quên mật khẩu?</a>
                </p>
                <div class="text-center mb-3 text-dark">Hoặc</div>
                <p><a href="index.php?act=signup">Tạo tài khoản?</a></p>
              </div>
            </form>
          </div>
        </div>