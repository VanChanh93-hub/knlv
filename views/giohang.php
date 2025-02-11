<div class="container cart-container py-4">
    <h2 class="text-center mb-4 text-uppercase fw-bold">Giỏ Hàng Của Bạn</h2>
    <div class="row g-4">
        <div class="col-lg-8">
            <div class="cart-box p-3 border rounded bg-white shadow-sm">
                <?php if (count($products) > 0): ?>
                    <p class="fw-semibold">Bạn đang có <strong class="text-danger"><?php echo count($products); ?> sản phẩm</strong> trong giỏ hàng</p>
                    <?php foreach ($products as $product) { ?>
                        <div class="cart-item d-flex align-items-center p-3 border rounded mb-3 bg-light">
                            <img src="public/img/product/<?= $product['image'] ?>" alt="<?= $product['name'] ?>" class="img-thumbnail me-3" style="width: 80px; height: 80px; object-fit: cover;">
                            <div class="item-details flex-grow-1">
                                <h5 class="fw-bold text-dark m-0"><?= $product['name'] ?></h5>
                                <p class="text-muted small m-0">Giá: <span class="fw-bold text-danger"><?= number_format($product['price']) ?> ₫</span></p>
                                <form action="index.php?act=cart" method="post" class="d-flex align-items-center mt-2">
                                    <button class="btn btn-outline-secondary btn-sm" name='tru'>-</button>
                                    <input type="hidden" name="idCart" value="<?= $product['id']; ?>">
                                    <input type="text" class="form-control text-center mx-2" name="quantity" min="1" readonly value="<?= $product['quantity'] ?>" style="width: 50px;">
                                    <button class="btn btn-outline-secondary btn-sm" name="cong">+</button>
                                </form>
                            </div>
                            <div class="text-end">
                                <p class="fw-bold text-danger mb-1">
                                    <?= number_format($product['price'] * $product['quantity']) ?> ₫
                                </p>
                                <a href="index.php?act=cart&id=<?= $product['id'] ?>" onclick="return confirm('Bạn có chắc muốn xoá sản phẩm này không?')">
                                    <button class="btn-close remove-item" aria-label="Remove"></button>
                                </a>
                            </div>
                        </div>
                    <?php } ?>
                <?php else: ?>
                    <p class="text-center text-muted">Giỏ hàng của bạn hiện tại đang trống</p>
                <?php endif; ?>
            </div>
        </div>        
        <form action="index.php?act=order" method="post">
                    <input type="hidden" name="totalPrice" value="<?= $totalPrice ?>">
                    <input type="hidden" name="price" value="<?= $product['price'] ?>">
        <div class="col-lg-4">
            <div class="order-summary p-3 border rounded bg-white shadow-sm">
                <h4 class="summary-title fw-bold mb-3">Thông Tin Đơn Hàng</h4>
                <p class="fw-bold">Tổng cộng: <span class="total-price text-danger"><?php echo number_format($totalPrice); ?> ₫</span></p>
                <p class="text-success fw-semibold">Phí vận chuyển: Miễn phí</p>
                <input type="submit" name="checkout" class="button-link button-link-red" value="ĐẶT HÀNG NGAY">
            </div>
        </div>
    </div>
    <div class="order-form mt-4 p-4 border rounded bg-white shadow-sm">
        <h4 class="fw-bold mb-3">Thông Tin Giao Hàng</h4>
            <div class="mb-3">
                <label for="fullName" class="form-label">Họ và Tên</label>
                <input type="text" name="fullName" class="form-control" id="fullName" name="fullName" required>
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Số Điện Thoại</label>
                <input type="text " class="form-control" id="phone" name="phone" required>
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Địa Chỉ Giao Hàng</label>
                <textarea class="form-control" id="address" name="address" rows="1" placeholder="Vd: Tàng 8, T806" required></textarea>
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Ghi chú giao hàng</label>
                <textarea class="form-control" id="address" name="note" rows="3" required></textarea>
            </div>
    </div>
    </form>

</div>
<?php

?>