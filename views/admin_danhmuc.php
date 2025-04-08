<h2>Danh sách danh mục</h2>

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

<!-- Nút mở popup Thêm danh mục -->
<button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addCategoryModal">Thêm danh mục mới</button>

<!-- Bảng danh sách danh mục -->
 
<table class="table table-bordered">
<thead>
    <tr>
        <th>#</th>
        <th>Tên danh mục</th>
        <th>Hình ảnh</th>
        <th>Hành động</th>
    </tr>
</thead>
<tbody>
    <?php if (!empty($categories)): ?>
        <?php foreach ($categories as $index => $cate): ?>
            <tr>
                <td><?= $index + 1; ?></td>
                <td><?= htmlspecialchars($cate['name']); ?></td>
                <td>
                    <img src="public/img/<?= htmlspecialchars($cate['image']); ?>" alt="Ảnh danh mục" width="80" height="60">
                </td>
                <td>
                    <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editCategoryModal-<?= $cate['id']; ?>">Sửa</button>

                    <form method="POST" action="index.php?act=delete_category&id=<?= $cate['id']; ?>" style="display:inline;">
    <button 
        type="submit" 
        class="btn btn-danger btn-sm"
        <?= $cate['product_count'] > 0 ? 'disabled title="Không thể xóa vì có sản phẩm"' : 'onclick="return confirm(\'Bạn có chắc muốn xóa?\')"' ?>
    >Xóa</button>
</form>

                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="4" class="text-center">Không có danh mục nào.</td>
        </tr>
    <?php endif; ?>
</tbody>
</table>

<!-- Modal Thêm danh mục -->
<div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="index.php?act=add_category" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="categoryName" class="form-label">Tên danh mục</label>
                        <input type="text" class="form-control" id="categoryName" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="categoryImage" class="form-label">Ảnh danh mục</label>
                        <input type="file" class="form-control" id="categoryImage" name="image" accept="image/*" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Thêm</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Sửa danh mục -->
<?php foreach ($categories as $cate): ?>
<div class="modal fade" id="editCategoryModal-<?= $cate['id']; ?>" tabindex="-1" aria-labelledby="editCategoryModalLabel-<?= $cate['id']; ?>" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="POST" action="index.php?act=edit_category&id=<?= $cate['id']; ?>" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="editCategoryModalLabel-<?= $cate['id']; ?>">Sửa danh mục</h5>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" value="<?= $cate['id']; ?>">
                    <input type="hidden" name="old_image" value="<?= htmlspecialchars($cate['image']); ?>">

                    <div class="mb-3">
                        <label class="form-label">Tên danh mục</label>
                        <input type="text" class="form-control" name="name" value="<?= htmlspecialchars($cate['name']); ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Ảnh hiện tại</label><br>
                        <img src="public/img/<?= htmlspecialchars($cate['image']); ?>" width="100" height="80" alt="Ảnh hiện tại">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Chọn ảnh mới (nếu muốn thay)</label>
                        <input type="file" class="form-control" name="image" accept="image/*">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="sua_danhmuc" class="btn btn-primary">Lưu thay đổi</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endforeach; ?>
