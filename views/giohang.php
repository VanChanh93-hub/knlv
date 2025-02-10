<div class="container cart-container">
    <h2 class="text-center mb-4 text-uppercase fw-bold">Giỏ Hàng Của Bạn</h2>
    <div class="row">
        <div class="col-lg-8 col-md-7 col-sm-12">

        <div class="cart-box">
    <?php if (count($products) > 0): ?>
        <p class="fw-semibold">Bạn đang có <strong class="text-danger"><?php echo count($products); ?> sản phẩm</strong> trong giỏ hàng</p>

        <?php foreach ($products as $product){ ?>
        <div class="cart-item d-flex">
            <img src="public/img/<?= $product['image'] ?>" alt="<?= $product['name'] ?>">
            <div class="item-details flex-grow-1">
                <h3 class="fw-bold text-dark"><?= $product['name'] ?></h3>
                <p class="text-muted">Giá: <span class="item-price fw-bold text-danger"><?= number_format($product['price']) ?> ₫</span></p>
                <form action="index.php?act=cart" method="post">
                <div class="quantity">
                    <button class="btn btn-outline-secondary" name ='tru'>-</button>
                    <input type="hidden" name="idCart" value="<?= $product['id']; ?>">
                    <input type="text" class="form-control text-center" name="quantity" min="1" readonly value="<?= $product['quantity'] ?>">
                    <button class="btn btn-outline-secondary " name="cong">+</button>
                </div>
            </form>
            </div>
            <div class="price-and-remove">
                <p class="fw-bold text-danger price"><?= number_format($product['price'] * $product['quantity']) ?> ₫</p>
                <a href="index.php?act=cart&id=<?= $product['id'] ?>" onclick="return confirm('Bạn có chắc muốn xoá sản phẩm này không?')">
    <button class="btn-close remove-item" aria-label="Remove"></button>
</a>

            </div>
        </div>
        <?php } ?>

    <?php else: ?>
        <script>
            document.querySelector('.cart-box').textContent = 'Giỏ hàng của bạn hiện tại đang trống';
        </script>
    <?php endif; ?>
</div>


        </div>

        <div class="col-lg-4 col-md-5 col-sm-12">
            <div class="order-summary">
                <h2 class="summary-title">Thông Tin Đơn Hàng</h2>
                <p class="fw-bold">Tổng cộng: <span class="total-price">1,500,000 ₫</span></p>
                <p class="text-success fw-semibold">Phí vận chuyển: Miễn phí</p>
                <button class="button-link">Đặt Hàng Ngay</button>
            </div>
        </div>
    </div>
</div>