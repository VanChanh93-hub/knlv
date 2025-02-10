<main class="sanpham">
  <!-- Danh mục món ăn -->
  <h4 class="text-center pb-2">Danh mục món ăn</h4>

  <div class="category-container">
  <?php foreach ($categories as $cate): ?>
    <div class="category-item">
      <a href="index.php?act=product&id=<?= $cate['id'] ?>" class="text-decoration-none text-dark">
        <img src="public/img/<?= $cate['image'] ?>" alt="Món chính">
        <p class="fw-semibold fs-5"><?= $cate['name'] ?></p>
      </a>
    </div>
    <?php endforeach; ?>
    <!-- <div class="category-item">
      <img src="public/img/categories/th1.webp" alt="Ăn vặt">
      <p class="fw-semibold fs-5">Ăn vặt</p>
    </div>
    <div class="category-item">
      <img src="public/img/categories/th.webp" alt="Đồ uống">
      <p class="fw-semibold fs-5">Đồ uống</p>
    </div>
    <div class="category-item">
      <img src="public/img/categories/khac.png" alt="Khác">
      <p class="fw-semibold fs-5">Khác</p>
    </div> -->
  </div>

  <!-- Danh sách sản phẩm -->
  <h4 class="text-center pb-2">Danh sách sản phẩm</h4>
  <?php if ($categoryMessage): ?>
    <p class="text-center text-danger"><?= $categoryMessage ?></p>
  <?php endif; ?>
  <div class="product-container">
    <?php foreach ($allProducts as $sp): ?>
      <div class="product-item">
        <a href="index.php?act=detail&id=<?= $sp['id'] ?>" class="text-decoration-none text-dark">
          <img src="public/img/<?= $sp['image'] ?>" alt="Bánh tráng trộn">
          <div class="product-info">
            <h3><?= $sp['name'] ?></h3>
            <p><?= $sp['price'] ?>đ</p>
            <a href="#" class="add-to-cart">Thêm vào giỏ hàng</a>
          </div>
        </a>
      </div>
    <?php endforeach; ?>

    <!-- <div class="product-item">
    <a href="index.php?act=detail" class="text-decoration-none text-dark">
        <img src="public/img/product/tratac.webp" alt="Trà tắc">
        <div class="product-info">
            <h3>Trà tắc</h3>
            <p>10.000đ</p>
            <a href="#" class="add-to-cart">Thêm vào giỏ hàng</a>
        </div>
    </a>
    </div>

    <div class="product-item">
      <img src="public/img/product/kimbap.webp" alt="Kimbap">
      <div class="product-info">
        <h3>Kimbap</h3>
        <p>25.000đ</p>
        <a href="#" class="add-to-cart">Thêm vào giỏ hàng</a>
      </div>
    </div>

    <div class="product-item">
      <img src="public/img/product/sandwich.webp" alt="Sandwich">
      <div class="product-info">
        <h3>Sandwich</h3>
        <p>18.000đ</p>
        <a href="#" class="add-to-cart">Thêm vào giỏ hàng</a>
      </div>
    </div>

    <div class="product-item">
      <img src="public/img/product/473777209_1751508748968671_85550.webp" alt="Trái cây hũ">
      <div class="product-info">
        <h3>Trái cây hũ</h3>
        <p>15.000đ</p>
        <a href="#" class="add-to-cart">Thêm vào giỏ hàng</a>
      </div>
    </div> -->


  </div>
  </div>
</main>