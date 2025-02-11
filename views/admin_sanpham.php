<h2>Danh sách sản phẩm</h2>

<!-- Thông báo -->
<?php if (!empty($_SESSION['message'])): ?>
    <div class="alert alert-success">
        <?= $_SESSION['message']; ?>
        <?php unset($_SESSION['message']); ?>
    </div>
<?php endif; ?>

<?php if (!empty($_SESSION['error'])): ?>
    <div class="alert alert-danger">
        <?= $_SESSION['error']; ?>
        <?php unset($_SESSION['error']); ?>
    </div>
<?php endif; ?>

<!-- Nút mở popup Thêm sản phẩm -->
<button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addProductModal">Thêm sản phẩm mới</button>

<!-- Bảng danh sách sản phẩm -->
<table class="table table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>Tên sản phẩm</th>
            <th>Giá</th>
            <th>Danh mục</th>
            <th>Ảnh</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($list)): ?>
            <?php foreach ($list as $index => $product): ?>
                <tr>
                    <td><?= $index + 1; ?></td>
                    <td><?= ($product['name']); ?></td>
                    <td><?= number_format($product['price'], 0, ',', '.'); ?> đ</td>
                    <td><?= ($product['cname']); ?></td>
                    <td><img style="width: 50px" class="anhpo" src="public/img/product/<?=$product['image'];?>" alt=""></td>
                    <td>
                        <!-- Nút mở popup Sửa -->
                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editProductModal-<?= $product['id']; ?>">Sửa</button>

                        <!-- Nút xóa -->
                        <form method="POST" action="index.php?act=delete&id=<?=$product['id']?>" style="display:inline;">
                            <input type="hidden" name="product_id" value="<?= $product['id']; ?>">
                            <button type="submit" name="delete_product" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')">Xóa</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="6" class="text-center">Không có sản phẩm nào.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<!-- Modal Thêm sản phẩm -->
<div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="index.php?act=addproduct" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="addProductModalLabel">Thêm sản phẩm</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="productName" class="form-label">Tên sản phẩm</label>
                        <input type="text" class="form-control" id="productName" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="productPrice" class="form-label">Giá</label>
                        <input type="number" class="form-control" id="productPrice" name="price" required>
                    </div>
                    <div class="mb-3">
                        <label for="productCategory" class="form-label">Danh mục</label>
                        <select class="form-control" id="productCategory" name="category_id" required>
                            <?php foreach ($categories as $category): ?>
                                <option value="<?= $category['id']; ?>"><?= ($category['name']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="productImage" class="form-label">Ảnh</label>
                        <input type="file" class="form-control" id="productImage" name="image" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="them" class="btn btn-primary">Thêm sản phẩm</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Sửa sản phẩm -->
<?php foreach ($list as $product): ?>
<div class="modal fade" id="editProductModal-<?= $product['id']; ?>" tabindex="-1" aria-labelledby="editProductModalLabel-<?= $product['id']; ?>" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="index.php?act=edit&id=<?=$product['id']?>" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProductModalLabel-<?= $product['id']; ?>">Sửa sản phẩm</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" value="<?= $product['id']; ?>">
                    <div class="mb-3">
                        <label for="editProductName-<?= $product['id']; ?>" class="form-label">Tên sản phẩm</label>
                        <input type="text" class="form-control" id="editProductName-<?= $product['id']; ?>" name="name" value="<?= htmlspecialchars($product['name']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="editProductPrice-<?= $product['id']; ?>" class="form-label">Giá</label>
                        <input type="number" class="form-control" id="editProductPrice-<?= $product['id']; ?>" name="price" value="<?= $product['price']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="editProductCategory-<?= $product['id']; ?>" class="form-label">Danh mục</label>
                        <select class="form-control" id="editProductCategory-<?= $product['id']; ?>" name="category_id" required>
                            <?php foreach ($categories as $category): ?>
                                <option value="<?= $category['id']; ?>" <?= $category['id'] == $product['id_category'] ? 'selected' : ''; ?>><?= htmlspecialchars($category['name']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="editProductImage-<?= $product['id']; ?>" class="form-label">Ảnh</label>
                        <input type="file" class="form-control" id="editProductImage-<?= $product['id']; ?>" name="image">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="sua" class="btn btn-primary">Lưu thay đổi</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endforeach; ?>
