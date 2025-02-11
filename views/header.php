<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foodhub</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./public/css/css.css">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <a href="index.php?act=home"><img class="logo" src="public/img/logo/z6215359941229_754e80e8136e728fe0d8a2fe90863d90-removebg-preview.png" alt="Foodhub Logo"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav w-100 justify-content-center fw-semibold">
                    <li class="nav-item me-3"><a class="nav-link" href="index.php?act=home">Trang chủ</a></li>
                    <li class="nav-item me-3"><a class="nav-link" href="index.php?act=product">Sản phẩm</a></li>
                    <li class="nav-item me-3"><a class="nav-link" href="index.php?act=contact">Liên hệ</a></li>



                    <li class="nav-item me-3"><a class="nav-link" href="index.php?act=signup">Đăng ký</a></li>
                    <li class="nav-item me-3"><a class="nav-link" href="index.php?act=login">Đăng nhập</a></li>
                </ul>
                <div class="d-flex align-items-center">
                    <input type="search" class="search" placeholder="Tìm kiếm">
                    <?php if(isset($_SESSION['user']['username'])): ?>
                    <a class="btn user text-white ms-3 p-2" href="index.php?act=account">
                        <?php
                            echo $_SESSION['user']['username'];
                        ?>
                    </a>
                    <?php endif;?>

                    <a class="nav-link ms-3" href="index.php?act=cart">
                        <i class="fa fa-shopping-bag fs-4"></i>
                    </a>
                </div>
            </div>
        </div>
    </nav>