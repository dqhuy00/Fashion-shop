<div class="container-xxl flex-grow-1 container-p-y">
    <?php View('components/alerts') ?>
    <div class="row ">
        <div class="col-md-4">
            <div class="card mb-4  h-100 position-sticky ">
                <div class="d-flex justify-content-between align-content-center card-header">
                    <h5 class="m-0 ">Tạo danh mục sản phẩm</h5>
                    <a href="?controller=category" class="btn btn-icon btn-secondary" fdprocessedid="x31gvo">
                        <i class='bx bx-add-to-queue'></i>
                    </a>
                </div>
                <div class="card-body">
                    <form action="<?= empty($category_detail['id']) ? '?controller=category&action=create_category' : '?controller=category&action=update_category&id=' . $category_detail['id'] ?> " method="POST">
                        <div class="mb-3">
                            <label for="name_category" class="form-label">tên danh mục</label>
                            <input id="name_category" value="<?= $category_detail['name'] ?? '' ?>" name="name" class="form-control" type="text" placeholder="danh mục" fdprocessedid="5dmahi">
                            <?php if (!empty($error['name'])) : ?> <p class="text-danger ms-1 mt-1  mb-0"><?= $error['name']['message'] ?></p> <?php endif ?>
                        </div>
                        <div class="mb-3">
                            <label for="defaultSelect" class="form-label">danh mục cha</label>
                            <select id="defaultSelect" class="form-select" fdprocessedid="fwn97q" name="parent_id">
                                <option value="0">chọn danh mục cha</option>
                                <?php foreach ($category_list as $key => $category) : ?>
                                    <?php if ($category['id'] != $category_detail['id']) :  ?>
                                        <option value="<?= $category['id'] ?>" <?= !empty($category_detail['parent_id']) && $category['id'] == $category_detail['parent_id'] ? 'selected' : ''  ?>><?= $category['name'] ?></option>
                                    <?php endif ?>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary" fdprocessedid="bnh72h">tạo danh mục</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card mb-4  h-100">
                <h5 class="card-header">Danh sách danh mục</h5>
                <table class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>tên danh mục</th>
                            <th>người tạo</th>
                            <th>ngày tạo</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        <?php if (count($category_list) > 0) : ?>
                            <?php foreach ($category_list as $key => $category) : ?>
                                <tr>
                                    <td><?= ++$key ?></td>
                                    <td><?= $category['name'] ?></td>
                                    <td><?= $category['user_name'] ?></td>
                                    <td><?= $category['created_at'] ?></td>
                                    <td>
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                <i class="bx bx-dots-vertical-rounded"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="?controller=category&id=<?= $category['id'] ?>"><i class="bx bx-edit-alt me-1"></i> chỉ sữa</a>
                                                <a id="btn-delete-category" data-value="?controller=category&action=delete_category&id=<?= $category['id'] ?>" class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#delete-category"><i class='bx bx-trash'></i>xóa</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        <?php else : ?>
                            <tr>
                                <td class=" text-center h-100 " colspan="6">không có dử liêu</td>
                            </tr>
                        <?php endif ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php View('components/modal/modalLink', ['id' => 'delete-category', 'btnShowModal' => 'btn-delete-category', 'title' => 'xóa tài danh mục', 'content' => 'bạn chắc muốn xóa nó không']) ?>