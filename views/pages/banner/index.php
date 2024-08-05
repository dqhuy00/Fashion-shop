<div class="container-xxl flex-grow-1 container-p-y">
    <?php View('components/alerts') ?>
    <div class="card">
        <h5 class="card-header">banner</h5>
        <table class="table table-hover table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>hình</th>
                    <th>tên banner</th>
                    <th>tiêu đề phụ</th>
                    <th>người tạo</th>
                    <th>nhóm</th>
                    <th>ngày tạo</th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                <?php if (isset($bannerList) && count($bannerList) > 0) : ?>
                    <?php foreach ($bannerList as $key => $banner) : ?>
                        <tr>
                            <td><?= ++$key ?></td>
                            <td>
                                <div class="position-relative" style="width: 100px;">
                                    <img src="<?= $banner['images'] ?>" class="w-100 h-100">
                                </div>
                            </td>
                            <td style="max-width: 300px; "><?= $banner['name'] ?></td>
                            <td><?= $banner['sub_title'] ?></td>
                            <td><?= $banner['user_name'] ?></td>
                            <td><?= $banner['group_name'] ?></td>
                            <td><?= $banner['created_at'] ?></td>

                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="?controller=banner&action=update&id=<?= $banner['id'] ?>"><i class="bx bx-edit-alt me-1"></i> chỉ sữa</a>
                                        <a id="btn-delete-product" data-value="?controller=banner&action=delete&id=<?= $banner['id'] ?>" class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#delete-banner"><i class="bx bx-trash me-1"></i>xóa sản phẩm</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach ?>
                <?php else : ?>
                    <tr>
                        <td colspan="7" class="text-center ">không có dữ liệu</td>
                    </tr>
                <?php endif ?>
            </tbody>
        </table>
    </div>
</div>
<?php View('components/modal/modalLink', ['id' => 'delete-banner', 'title' => 'xóa sản phẩm', 'content' => 'bạn chắc muốn xóa nó không']) ?>