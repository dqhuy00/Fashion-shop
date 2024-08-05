<div class="container-xxl flex-grow-1 container-p-y">
    <?php View('components/alerts') ?>

    <div class="row mb-5">
        <div class="col-md-12">
            <div class="card mb-4  h-100">
                <h5 class="card-header">Trạng thái đơn hàng</h5>
                <table class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <th>tên trạng thái</th>
                            <th>type</th>
                            <th>mô tả trạng thái</th>
                            <th>mặt định</th>
                            <th>thông kê</th>
                            <th>icon</th>
                            <th>ngày tạo</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        <?php if (isset($statusList) && count($statusList) > 0) : ?>
                            <?php foreach ($statusList as $status) : ?>
                                <tr>
                                    <td><?= $status['name'] ?></td>
                                    <td><?= $status['type'] ?></td>
                                    <td><?= $status['description'] ?></td>
                                    <td><?= $status['is_default'] == 1 ? 'true' : 'false' ?></td>
                                    <td><?= $status['total_bill'] == 1 ? 'true' : 'false' ?></td>
                                    <td><?= $status['icon'] ?></td>
                                    <td><?= $status['created_at'] ?></td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" fdprocessedid="77irqr">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="?controller=status&action=update&id=<?= $status['id'] ?>"><i class="bx bx-edit-alt me-1"></i> sữa</a>
                                                <a data-value="?controller=status&action=delete&id=<?= $status['id'] ?>" class="dropdown-item btn-delete-attr" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#delete-status"><i class="bx bx-trash"></i>xóa</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        <?php endif ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php View('components/modal/modalLink', ['id' => 'delete-status', 'title' => 'xóa trạng thái', 'content' => 'bạn chắc muốn xóa nó không']) ?>