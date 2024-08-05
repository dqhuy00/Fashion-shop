<div class="container-xxl flex-grow-1 container-p-y">
    <?php View('components/alerts') ?>
    <div class="row">
        <div class="col-lg-3 col-md-12 col-3 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0">
                            <img src="public/assets/iconImages/box.png" alt="chart success" class="rounded">
                        </div>
                        <div class="dropdown">
                            <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                                <a class="dropdown-item" href="javascript:void(0);">View More</a>
                                <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                            </div>
                        </div>
                    </div>
                    <span class="fw-semibold d-block mb-1">Sảm phẩm </span>
                    <h3 class="card-title mb-2"><?= $statistical_products['total_products'] ?? 0 ?></h3>
                    <small class="text-success fw-semibold">
                        <!-- <i class="bx bx-up-arrow-alt"></i> -->
                    </small>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-12 col-3 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0">
                            <img src="public/assets/iconImages/purchasing.png" alt="chart success" class="rounded">
                        </div>
                        <div class="dropdown">
                            <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                                <a class="dropdown-item" href="javascript:void(0);">View More</a>
                                <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                            </div>
                        </div>
                    </div>
                    <span class="fw-semibold d-block mb-1">đã bán</span>
                    <h3 class="card-title mb-2"><?= $statistical_products['total_sold'] ?? 0 ?></h3>
                    <small class="text-success fw-semibold">
                        <!-- <i class="bx bx-up-arrow-alt"></i> -->
                    </small>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-12 col-3 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0">
                            <img src="public/assets/iconImages/profits.png" alt="chart success" class="rounded">
                        </div>
                        <div class="dropdown">
                            <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                                <a class="dropdown-item" href="javascript:void(0);">View More</a>
                                <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                            </div>
                        </div>
                    </div>
                    <span class="fw-semibold d-block mb-1">tổng giá SP</span>
                    <h3 class="card-title mb-2"><?= number_format($statistical_products['total_pice'] ?? 0) ?> đ</h3>
                    <small class="text-success fw-semibold">
                        <!-- <i class="bx bx-up-arrow-alt"></i> -->
                    </small>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-12 col-3 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between">
                        <div class="avatar flex-shrink-0">
                            <img src="public/assets/iconImages/products.png" alt="chart success" class="rounded">
                        </div>
                        <div class="dropdown">
                            <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                                <a class="dropdown-item" href="javascript:void(0);">View More</a>
                                <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                            </div>
                        </div>
                    </div>
                    <span class="fw-semibold d-block mb-1">tồn kho</span>
                    <h3 class="card-title mb-2"><?= $statistical_products['total_warehouse'] ?></h3>
                    <small class="text-success fw-semibold">
                        <!-- <i class="bx bx-up-arrow-alt"></i> -->
                        <!-- +72.80% -->
                    </small>
                </div>
            </div>
        </div>
    </div>
    <?php View('components/filterTable', [
        'orderby' => $orderby,
        'filter' => $filter
    ]) ?>
    <div class="card">
        <div class="card-header justify-content-between d-flex align-items-center">
            <h5>Quản lý sản phẩm</h5>
            <span>tổng </span>
        </div>
        <table class="table table-hover table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>hình</th>
                    <th>tên sản phẩm</th>
                    <th>người tạo</th>
                    <th>danh mục</th>
                    <th>giá sản phẩm</th>
                    <th>giá giảm</th>
                    <th>kho</th>
                    <th>đã bán</th>
                    <th></th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                <?php foreach ($products['data'] as $key => $value) : ?>
                    <tr>
                        <td><?= ++$key ?></td>
                        <td>
                            <div class="position-relative" style="width: 60px;">
                                <img src="<?= $value['feature_image'] ?>" class="w-100 h-100">
                            </div>
                        </td>
                        <td style="max-width: 300px; cursor: pointer;" data-value="<?= $value['id'] ?>" class="btn-show-modal" data-bs-toggle="modal" data-bs-target="#modal-product"><?= $value['name'] ?></td>
                        <td><?= $value['user_name'] ?></td>
                        <td><?= $value['category_name'] ?></td>
                        <td><?= number_format($value['price']) . ' đ'  ?></td>
                        <td><?= number_format($value['discount']) . ' đ'  ?></td>
                        <td><?= number_format($value['quantity']) ?></td>
                        <td><?= number_format($value['count_buy']) ?></td>
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
            <?php View('components/paginate', ['page' => $products['page']]) ?>
        </div>
    </div>
</div>
<?php View('components/modal/modalLink', ['id' => 'delete-product', 'title' => 'xóa banner', 'content' => 'bạn chắc muốn xóa nó không']) ?>
<?php View('components/modal/modalProducts') ?>
<script>
    const btnShowModalList = document.querySelectorAll('.btn-show-modal');
    btnShowModalList.forEach(function(button) {
        button.onclick = function(e) {
            document.querySelector('.btn-show-modal.active')?.classList.remove('active');
            e.currentTarget.classList.add('active');
        }
    });
</script>