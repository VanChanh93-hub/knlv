<div class="container mt-5">
        <div class="row">
          <aside class="col-md-3">
            <div class="profile-sidebar">
                <div class="profile-avatar">CV</div>
                <h4 class="mt-3">Xin chào <strong><?= $profile['username'] ?? '' ?></strong></h4>
                <nav class="profile-menu">
                    <a href="index.php?act=account">Thông tin tài khoản</a>
                    <a href="index.php?act=history">Lịch sử mua hàng</a>
                    <a data-bs-toggle="modal" data-bs-target="#changePassModal" class="btn btn-link">Đổi mật khẩu</a>
                    <a href="index.php?act=logout">Đăng xuất</a>
                </nav>
            </div>
        </aside>
            <div class="col-md-8 main-content">
                <form action="index.php?act=account" method="post" class="card p-4">
                    <div class="top-bar">
                        <h5 style="font-weight: bold;">THÔNG TIN TÀI KHOẢN</h5>

                        <button type="submit" name="submit" class="btn btn-primary btn-sm update-account-btn" >
                            CẬP NHẬT THÔNG TIN TÀI KHOẢN
                        </button>

                    </div>
                    <?php if(!empty($error)){
                            echo '<p class="action_login">'.$error .'</p>';
                        }?>
                    <div class="form-group">
                        <label for="text">Tên đăng nhập</label>
                        <input type="text" id="username" name="username" value="<?= $profile['username'] ?? '' ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" id="email" name="email" value="<?= $profile['email'] ?? '' ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="sdt">Số điện thoại</label>
                        <input type="text" id="sdt" name="sdt" value="<?= $profile['phone'] ?? '' ?>" >
                    </div>
                    <div class="form-group">
                        <label for="address">Địa chỉ</label>
                        <input type="text" id="address" name="address" value="<?= $profile['address'] ?? '' ?>" >
                    </div>

                </form>
            </div>
        </div>
    </div>

  <!-- Modal đổi mật khẩu -->
  <div class="modal fade" id="changePassModal" aria-hidden="true" aria-labelledby="loginLabel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5 fw-bold w-100 text-center" id="registerLabel">Đổi mật khẩu</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form method="post" action="index.php?act=resetpass">
            <div class="mb-3">
              <label for="loginUsername" class="form-label">Mật khẩu cũ</label>
              <input type="password" class="form-control" id="loginUsername" placeholder="Nhập username của bạn..." name="oldpassword" require>
            </div>
            <div class="mb-3">
              <label for="loginPassword" class="form-label">Mật khẩu mới</label>
              <input type="password" class="form-control" id="loginPassword" placeholder="Nhập mật khẩu..." name="password" require>
            </div>
            <div class="mb-3">
              <label for="loginPassword" class="form-label">Nhập lại mật khẩu mới</label>
              <input type="password" class="form-control" id="loginPassword" placeholder="Nhập mật khẩu..." name="password1" require>
            </div>
            <div class="modal-footer d-flex flex-column align-items-center">
              <button type="submit" class="btn btn-dark ps-5 pe-5" name="changepass">Cập nhật mật khẩu</button>
              <a href="index.php?act=changepass" class="text-danger">Quên mật khẩu?</a>
            </div>
          </form>
        </div>

      </div>
    </div>
  </div>