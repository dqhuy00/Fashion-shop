<div class="container-xxl flex-grow-1 container-p-y">
    <?php View('components/alerts') ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4  h-100 position-sticky ">
                <div class="d-flex justify-content-between align-content-center card-header">
                    <h5 class="m-0 ">Tạo trạng thái đơn hàng</h5>
                    <a href="?controller=status" class="btn btn-icon btn-secondary" fdprocessedid="x31gvo">
                        <i class="bx bx-add-to-queue"></i>
                    </a>
                </div>
                <div class="card-body">
                    <form action="?controller=status&action=<?= empty($statusDetail['id']) ? 'create' : 'update&id=' . $statusDetail['id'] ?>" method="POST">
                        <div class="mb-3">
                            <label for="name_attribute" class="form-label">tên thuộc tính</label>
                            <input id="name_attribute" value="<?= $statusDetail['name'] ??  old('name') ?>" name="name" class="form-control" type="text" placeholder="tên trạng thoái hoán đơn" fdprocessedid="5dmahi">
                            <?php if (!empty($error['name'])) : ?> <p class="text-danger ms-1 mt-1  mb-0"><?= $error['name']['message'] ?></p> <?php endif ?>
                        </div>
                        <div class="mb-3">
                            <label for="icon-status" class="form-label">icon</label>
                            <input id="icon-status" value="<?= $statusDetail['icon'] ?? old('icon') ?>" name="icon" class="form-control" type="text" placeholder="icon" fdprocessedid="5dmahi">
                            <?php if (!empty($error['icon'])) : ?> <p class="text-danger ms-1 mt-1  mb-0"><?= $error['icon']['message'] ?></p> <?php endif ?>
                        </div>
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" value="1" <?= old('is_default') == 1 || !empty($statusDetail['is_default']) && $statusDetail['is_default'] == 1 ? 'checked' : '' ?> id="is_default" name="is_default">
                            <label class="form-check-label" for="is_default" style="cursor: pointer;"> dùng làm trạng thái mặt định </label>
                            <?php if (!empty($error['is_default'])) : ?> <p class="text-danger ms-1 mt-1  mb-0"><?= $error['is_default']['message'] ?></p> <?php endif ?>
                        </div>
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" value="1" <?= old('total_bill') == 1 || !empty($statusDetail['total_bill'])  &&  $statusDetail['total_bill'] == 1 ? 'checked' : '' ?> id="total-bill" name="total_bill">
                            <label class="form-check-label" for="total-bill" style="cursor: pointer;"> thống kê số lượng hóa đơn </label>
                            <?php if (!empty($error['total-bill'])) : ?> <p class="text-danger ms-1 mt-1  mb-0"><?= $error['total-bill']['message'] ?></p> <?php endif ?>
                        </div>
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" value="1" <?= old('is_paid') == 1 || !empty($statusDetail['is_paid'])  &&  $statusDetail['is_paid'] == 1 ? 'checked' : '' ?> id="is_paid" name="is_paid">
                            <label class="form-check-label" for="is_paid" style="cursor: pointer;"> tự động cập nhập khi thanh toán thành công </label>
                            <?php if (!empty($error['is_paid'])) : ?> <p class="text-danger ms-1 mt-1  mb-0"><?= $error['is_paid']['message'] ?></p> <?php endif ?>
                        </div>
                        <div class="mb-3">
                            <label for="type">chọn kiểu thông báo</label>
                            <select id="type" class="form-select" fdprocessedid="pe94go" name="type">
                                <option value="warning" <?= old('type') == 'warning' || !empty($statusDetail['type']) && $statusDetail['type'] == 'warning'  ? 'selected' : '' ?>>WARNING</option>
                                <option value="info" <?= old('type') == 'info' || !empty($statusDetail['type']) && $statusDetail['type'] == 'info'  ? 'selected' : '' ?>>INFO</option>
                                <option value="success" <?= old('type') == 'success' || !empty($statusDetail['type']) && $statusDetail['type'] == 'success'  ? 'selected' : '' ?>>SUCCESS</option>
                                <option value="danger" <?= old('type') == 'danger' || !empty($statusDetail['type']) && $statusDetail['type'] == 'danger'  ? 'selected' : '' ?>>ERROR</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="description-attribute" class="form-label">mô tả thuộc tích</label>
                            <textarea class="form-control" id="description-attribute" value="" rows="3" name="description" spellcheck="false"><?= $statusDetail['description'] ?? old('description') ?></textarea>
                            <?php if (!empty($error['description'])) : ?> <p class="text-danger ms-1 mt-1  mb-0"><?= $error['description']['message'] ?></p> <?php endif ?>
                        </div>
                        <button type="submit" class="btn btn-primary" fdprocessedid="bnh72h"> <?= empty($statusDetail['id']) ? ' tạo trạng thái'  : 'cập nhập trạng thái' ?> </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>