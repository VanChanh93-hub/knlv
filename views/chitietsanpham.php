<main class="container-xl my-5 chitietsanpham">
  <form action="index.php?act=cart" method="post">
  <?php if($detail): ?>
    <input type="hidden" name="id" value="<?= $detail['id'] ?>">
    <input type="hidden" name="user_id" value="<?= $_SESSION['user']['id'] ?? 1 ?>">
    <input type="hidden" name="quantity" value="1">

    <div class="row g-4">
      <!-- Product Details Section -->
      <div class="col-md-6 h-75">
        <img class="w-100 h-50" src="public/img/<?= $detail['image'] ?>" alt="Product Image" class="img-fluid rounded">
      </div>
      <div class="col-md-6">
        <div class="product-details">
          <h1 class="product-title"><?= $detail['name'] ?></h1>
          <p class="price"><?= $detail['price'] ?>đ</p>
          <p>Người bán: <b>admin123</b></p>
          <p>Mô tả sản phẩm nếu có</p>
          <p>Mì trộn trứng + xúc xích" là sự kết hợp hoàn hảo giữa mì trộn dai ngon, trứng chiên mềm mịn, và xúc xích đậm đà hương vị. Mỗi phần mì được chế biến với công thức đặc biệt, thêm vào rau xanh tươi ngon, tạo nên bữa ăn vừa ngon miệng vừa bổ dưỡng. Đây là lựa chọn lý tưởng cho bữa sáng, bữa trưa, hoặc bữa tối nhẹ nhàng. Thưởng thức ngay để cảm nhận hương vị tuyệt vời!</p>
          <input type="submit"name="addtocart" value="Thêm với giỏ hàng" class="btn btn-custom w-100">
        </div>
      </div>
    </div>
  <?php endif; ?>
  </form>
  <!-- Suggested Products Section -->
  <div class="mt-5">
    <h2 class="text-center fw-bold mb-4 ">Bạn có thể thích</h2>

    <div class="product-container">
    <?php foreach ($lienquan as $lq): ?>
      <div class="product-item">
      <a href="index.php?act=detail&id=<?= $lq['id'] ?>" class="text-decoration-none text-dark">
        <img src="public/img/<?= $lq['image'] ?>" alt="Bánh tráng trộn">
        <div class="product-info">
          <h3><?= $lq['name'] ?></h3>
          <p><?= $lq['price'] ?>đ</p>
          <a href="#" class="add-to-cart">Thêm vào giỏ hàng</a>
        </div>
      </div>
      <?php endforeach; ?>
      <!-- <div class="product-item">
        <img src="public/img/product/tratac.webp" alt="Trà tắc">
        <div class="product-info">
          <h3>Trà tắc</h3>
          <p>10.000đ</p>
          <a href="#" class="add-to-cart">Thêm vào giỏ hàng</a>
        </div>
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
      </div> -->
    </div>
  </div>
</main>