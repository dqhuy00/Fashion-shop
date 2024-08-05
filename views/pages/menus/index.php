<div class="container-xxl flex-grow-1 container-p-y">
    <?php View('components/alerts') ?>
    <div class="card">
        <h5 class="card-header">banner</h5>
        <table class="table table-hover table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>hình</th>
                    <th>tên</th>
                    <th> miêu tả</th>
                    <th>người tạo</th>
                    <th>ngày tạo</th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                <?php if (isset($menusList) && count($menusList) > 0) : ?>
                    <?php foreach ($menusList as $key => $menus) : ?>
                        <tr>
                            <td><?= ++$key ?></td>
                            <td style="max-width: 300px; "><?= $menus['name'] ?></td>
                            <td><?= $menus['url'] ?></td>
                            <td><?= $menus['description'] ?></td>
                            <td><?= $menus['user_name'] ?></td>
                            <td><?= $menus['created_at'] ?></td>

                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="?controller=menu&action=update&id=<?= $menus['id'] ?>"><i class="bx bx-edit-alt me-1"></i> chỉ sữa</a>
                                        <a id="btn-delete-product" data-value="?controller=menu&action=delete&id=<?= $menus['id'] ?>" class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#delete-menu"><i class="bx bx-trash me-1"></i>xóa sản phẩm</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach ?>
                <?php else : ?>
                    <tr>
                        <td class="text-center " collapse="7">không có dữ liệu</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php View('components/modal/modalLink', ['id' => 'delete-menu', 'title' => 'xóa menu', 'content' => 'bạn chắc muốn xóa nó không']) ?>