<!-- Add Bootstrap CSS for modal functionality -->

<div class="container mt-5">
    <div class="row">
        <!-- Sidebar -->
        <aside class="col-md-3">
            <div class="profile-sidebar">
                <div class="profile-avatar">CV</div>
                <h4 class="mt-3">Xin chào <strong>chanhV</strong></h4>
                <nav class="profile-menu">
                    <a href="#">Thông tin tài khoản</a>
                    <a href="#">Lịch sử mua hàng</a>
                    <a href="#">Đăng xuất</a>
                </nav>
            </div>
        </aside>

        <!-- Main Content -->
        <section class="col-md-9">
            <div class="content">
                <h4 class="mb-2">Quản lý đơn hàng</h4>
                <?php if (!empty($orderHistory)) : ?>
                    <?php 
                    $groupedOrders = [];
                    foreach ($orderHistory as $order) {
                        $groupedOrders[$order['order_id']][] = $order;
                    }

                    foreach ($groupedOrders as $orderId => $orders) :
                        $firstOrder = $orders[0]; 
                        // echo($firstOrder['status']);
                    ?>
                        <div class="order-card">
                            <div class="order-header d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="order-id">Mã đơn hàng: <?= $firstOrder['order_id'] ?></h5>
                                    <p>Ngày đặt hàng: <?= $firstOrder['orderdate'] ?></p>
                                    <p>Trạng thái: <b><?= $firstOrder['status'] ?></b></p>
                                </div>
                                <div class="order-total">
                                    <p class="fw-bold text-danger"><strong>Tổng tiền:</strong> <?= number_format($firstOrder['totalprice'], 0, ',', '.') ?> đ</p>
                                    <p class="fw-bold text-danger"><strong>Địa chỉ:</strong> <?= $firstOrder['address'] ?></p>
                                </div>
                            </div>
                            <div class="order-actions mt-3">
                                    <?php if ($_SESSION['user']['role'] == 0) : ?>
                                        <!-- Người dùng (khách hàng) -->
                                        <button class="btn btn-primary <?=$firstOrder['status'] === 'Thất bại' || $firstOrder['status'] === 'Thành công' ? 'd-none' : '';?>" data-bs-toggle="modal" data-bs-target="#updateAddressModal<?= $firstOrder['order_id'] ?>">Thay đổi địa chỉ</button>
                                        <button class="btn btn-danger <?=$firstOrder['status'] === 'Thất bại' || $firstOrder['status'] === 'Thành công' ? 'd-none' : '';?>" data-bs-toggle="modal" data-bs-target="#cancelOrderModal<?= $firstOrder['order_id'] ?>">Hủy đơn</button>

                                        <!-- Modal Thay đổi địa chỉ -->
                                        <div class="modal fade" id="updateAddressModal<?= $firstOrder['order_id'] ?>" tabindex="-1" aria-labelledby="updateAddressLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="updateAddressLabel">Thay đổi địa chỉ</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="post" action="index.php?act=update_address">
                                                            <input type="hidden" name="order_id" value="<?= $firstOrder['order_id'] ?>">
                                                            <div class="mb-3">
                                                                <label for="newAddress" class="form-label">Địa chỉ mới</label>
                                                                <input type="text" name="new_address" id="newAddress" class="form-control">
                                                            </div>
                                                            <button type="submit" name="update_address" class="btn btn-primary">Cập nhật</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Modal Hủy đơn hàng -->
                                        <div class="modal fade" id="cancelOrderModal<?= $firstOrder['order_id'] ?>" tabindex="-1" aria-labelledby="cancelOrderLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="cancelOrderLabel">Hủy đơn hàng</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Bạn có chắc chắn muốn hủy đơn hàng này không?</p>
                                                        <form method="post" action="index.php?act=cancel_order">
                                                            <input type="hidden" name="order_id" value="<?= $firstOrder['order_id'] ?>">
                                                            <button type="submit" name="cancel_order" class="btn btn-danger">Hủy đơn</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php elseif ($_SESSION['user']['role'] == 1) : ?>
                                        <!-- Người bán -->
                                        <button class="btn btn-success <?=$firstOrder['status'] === 'Thất bại' || $firstOrder['status'] === 'Thành công' ? 'd-none' : '';?>" data-bs-toggle="modal" data-bs-target="#updateStatusModal<?= $firstOrder['order_id'] ?>">Cập nhật trạng thái</button>

                                        <!-- Modal Cập nhật trạng thái -->
                                        <div class="modal fade" id="updateStatusModal<?= $firstOrder['order_id'] ?>" tabindex="-1" aria-labelledby="updateStatusLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="updateStatusLabel">Cập nhật trạng thái</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="post" action="index.php?act=update_status&id=<?=$firstOrder['order_id']?>">
                                                            <input type="hidden" name="order_id" value="<?= $firstOrder['order_id'] ?>">
                                                            <div class="mb-3">
                                                                <label for="newStatus" class="form-label">Trạng thái mới</label>
                                                                <select name="new_status" id="newStatus" class="form-select">
                                                                    <option selected value="Chờ xử lý">Chờ xử lý</option>
                                                                    <option value="Đang xử lý">Đang xử lý</option>
                                                                    <option value="Thất bại">Thất bại</option>
                                                                    <option value="Thành công">Thành công</option>
                                                                </select>
                                                            </div>
                                                            <button type="submit" name="update_status" class="btn btn-success">Cập nhật</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                            </div>
                            <div class="order-items mt-3">
                                <h6>Chi tiết đơn hàng:</h6>
                                <?php foreach ($orders as $item) : ?>
                                    <div class="d-flex align-items-center mb-3">
                                        <img src="public/img/product/<?=$item['image']?>" alt="Sản phẩm" class="order-image" style="width: 50px; height: 50px; margin-right: 10px;">
                                        <div>
                                            <p><strong>Tên: <?= $item['name'] ?></strong></p>
                                            <p>Giá: <?= number_format($item['product_price'], 0, ',', '.') ?> đ</p>
                                            <p>Số lượng: <?= $item['product_quantity'] ?></p>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else : ?>
                    <p>Không có đơn hàng nào trong lịch sử.</p>
                <?php endif; ?>
            </div>
        </section>
    </div>
</div>
