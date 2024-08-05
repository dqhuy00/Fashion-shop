<div class="container-xxl flex-grow-1 container-p-y">
    <?php View('components/alerts') ?>
    <div class="card">
        <div class="card-header justify-content-between d-flex align-items-center">
            <h5>Quản lý phân quyền</h5>
            <span>tổng </span>
        </div>
        <table class="table table-hover table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>tên quền</th>
                    <th>mô tả</th>
                    <th>ngày tạo</th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                <?php foreach ($roles['data'] as $key => $value) : ?>
                    <tr>
                        <td><?= ++$key ?></td>
                        <td><?= $value['name'] ?></td>
                        <td><?= $value['description'] ?></td>
                        <td><?= $value['created_at'] ?></td>

                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="?controller=role&action=update&id=<?= $value['id'] ?>"><i class="bx bx-edit-alt me-1"></i> chỉ sữa</a>
                                    <a id="btn-delete-product" data-value="?controller=product&action=delete&id=<?= $value['id'] ?>" class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#delete-product"><i class='bx bx-trash me-1'></i>xóa sản phẩm</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
        <div class="py-3 px-2">
            <?php View('components/paginate', ['page' => $roles['page']]) ?>
        </div>
    </div>
</div>