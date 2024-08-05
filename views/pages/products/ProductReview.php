<div class="container-xxl flex-grow-1 container-p-y">
    <?php View('components/alerts') ?>

    <div class="card mb-4">
        <div class="card-body">
            <div class="row">
                <?php if (isset($orderby)) : ?>
                    <div class="col-3">
                        <div class="row">
                            <label for="html5-text-input" class="col-md-2 col-form-label" style="width: max-content;">xấp sếp </label>
                            <div class="col-md-8">
                                <select id="defaultSelect" class="form-select select-filter" fdprocessedid="8k2ey4">
                                    <?php foreach ($orderby as $value) : ?>
                                        <option value="<?= currentRouter([...$_GET, 'order' => $value['value']]) ?>" <?= isset($_GET['order']) && $value['value'] == $_GET['order'] ? 'selected' : "" ?>><?= $value['name'] ?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="row">
                            <label for="html5-text-input" class="col-md-2 col-form-label" style="width: max-content;">theo</label>
                            <div class="col-md-8">
                                <select id="defaultSelect" class="form-select select-filter" fdprocessedid="8k2ey4">
                                    <option value="<?= currentRouter([...$_GET, 'direction' => 'DESC']) ?>" <?= !empty($_GET['direction']) && $_GET['direction'] == 'DESC' ? 'selected' : '' ?>>DESC (tăng dần)</option>
                                    <option value="<?= currentRouter([...$_GET, 'direction' => 'ASC']) ?>" <?= !empty($_GET['direction']) && $_GET['direction'] == 'ASC' ? 'selected' : '' ?>>ASC (giảm dần)</option>
                                </select>
                            </div>
                        </div>
                    </div>

                <?php endif ?>
                <div class="col-3">
                    <div class="row">
                        <label for="html5-text-input" class="col-md-2 col-form-label">Text</label>
                        <div class="col-md-10">
                            <select id="defaultSelect" class="form-select" fdprocessedid="8k2ey4">
                                <option>Default select</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="row">
                        <form action="<?= currentRouter([...$_GET]) ?>" method="get">
                            <div class="input-group input-group-merge">
                                <span class="input-group-text" id="basic-addon-search31"><i class="bx bx-search"></i></span>
                                <input type="text" class="form-control" name="search" placeholder="Search..." value="<?= $_GET['search'] ?? '' ?>" aria-label="Search..." aria-describedby="basic-addon-search31" fdprocessedid="r56tls">
                                <?php foreach ($_GET as $key => $value) : ?>
                                    <?php if ($key != 'search') : ?>
                                        <input type="text" class="form-control" hidden name="<?= $key ?>" value="<?= $value ?>">
                                    <?php endif ?>
                                <?php endforeach; ?>
                                <button type="submit" class="btn btn-primary active" fdprocessedid="2ula2">tìm kiếm</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header justify-content-between d-flex align-items-center">
            <h5>Quản lý sản phẩm</h5>
            <span>tổng</span>
        </div>
        <table class="table table-hover table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>hình</th>
                    <th>tên sản phẩm</th>
                    <th>Người đăng</th>
                    <th>nội dụng</th>
                    <th>điểm</th>
                    <th>email</th>
                    <th>tài khoảng</th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                <?php foreach ($reviewProduct['data'] as $key => $value) : ?>
                    <tr>
                        <td><?= ++$key ?></td>
                        <td style="width: 60px;">
                            <div class="position-relative">
                                <img src="public/assets/iconImages/user.png" class="w-100 ">
                            </div>
                        </td>
                        <td><a href="?controller=review&action=detail&id=<?= $value['id'] ?>"><?= $value['product_name'] ?></a></td>
                        <td><?= $value['name'] ?></td>
                        <td><?= $value['text'] ?></td>
                        <td><?= $value['scores'] ?></td>
                        <td><?= $value['email'] ?></td>
                        <td></td>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="?controller=product&action=update&id=<?= $value['id'] ?>"><i class="bx bx-edit-alt me-1"></i> chỉ sữa</a>
                                    <a id="btn-delete-product" data-value="?controller=product&action=delete&id=<?= $value['id'] ?>" class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#delete-product"><i class='bx bx-trash me-1'></i>xóa sản phẩm</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
        <div class="py-3 px-2">
            <?php View('components/paginate', ['page' => $reviewProduct['page']]) ?>
        </div>
    </div>
</div>
<!-- <?php View('components/modal/modalLink', ['id' => 'delete-product', 'title' => 'xóa banner', 'content' => 'bạn chắc muốn xóa nó không']) ?>
<?php View('components/modal/modalProducts') ?>
<script>
    const btnShowModalList = document.querySelectorAll('.btn-show-modal');
    btnShowModalList.forEach(function(button) {
        button.onclick = function(e) {
            document.querySelector('.btn-show-modal.active')?.classList.remove('active');
            e.currentTarget.classList.add('active');
        }
    });
    document.querySelectorAll('.select-filter').forEach(function(select) {
        select.onchange = function(e) {
            location.href = e.currentTarget.value;
        }
    });
</script> -->