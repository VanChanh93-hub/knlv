<div class="container mt-5">
        <div class="row">
          <aside class="col-md-3">
            <div class="profile-sidebar">
                <div class="profile-avatar">CV</div>
                <h4 class="mt-3">Xin chào <strong>chanhV</strong></h4>
                <nav class="profile-menu">
                    <a href="#">Thông tin tài khoản</a>
                    <a href="index.php?act=history">Lịch sử mua hàng</a>
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