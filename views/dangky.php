<div class="dangnhap">

        <div class="login-form">

            <h2>Đăng ký tài khoản</h2>
            <?php if(!empty($error)){
          echo '<p class="action_login">'.$error .'</p>';
          ;
      }?>
            <form action="index.php?act=signup" method="POST">
              <div class="form-group">
                <label for="username">Tên đăng nhập</label>
                <input type="text" id="text" name="username" placeholder="Nhập tên đăng nhập" required>
              </div>
              <div class="form-group">
                <label for="email">Địa chỉ email</label>
                <input type="email" id="text" name="email" placeholder="Nhập địa chỉ email" required>
              </div>
              <div class="form-group">
                <label for="sdt">Số điện thoại</label>
                <input type="text" id="text" name="sdt" placeholder="Nhập Số điện thoại" required>
              </div>
              <div class="form-group">
                <label for="address">Địa chỉ</label>
                <input type="text" id="text" name="address" placeholder="Nhập Địa chỉ" required>
              </div>
              <div class="form-group">
                <label for="role">Loại đăng ký</label>
                <select name="role">
                    <option value="0">Đăng ký mua hàng</option>
                    <option value="1">Đăng ký bán hàng</option>
                </select>
              </div>
              <div class="form-group">
                <label for="password">Mật khẩu</label>
                <input type="password" id="password" name="password" placeholder="Nhập mật khẩu" required>
              </div>
              <div class="form-group">
                <label for="confirm-password">Nhập lại mật khẩu</label>
                <input type="password" id="password" name="confirm-password" placeholder="Nhập mật khẩu" required>
              </div>
              <button type="submit" name="submit">Đăng ký</button>
              <div class="extra-links">
                <p><a href="index.php?act=login">Đã có tài khoản?<u class="text-dark"> Đăng nhập</u></a></p>
              </div>
            </form>
          </div>
        </div>