<div class="container-xxl flex-grow-1 container-p-y">
    <?php View('components/alerts') ?>

    <div class="row">
        <div class="col-4">
            <div class="card mb-4 mb-xl-0">
                <div class="card-header d-flex justify-content-between  align-items-center ">
                    <h5>tùy biến</h5>
                    <button id="btn-more-customization" type="button" class="btn btn-primary"><i class='bx bxs-add-to-queue'></i></button>
                </div>
                <div class="card-body ">
                    <div class="customization-form">
                        <form action="?controller=attribute&action=create_customization" method="POST">
                            <div class="mb-3">
                                <label for="product-list" class="form-label">sản phẩm</label>
                                <select id="product-list" class="form-select" fdprocessedid="huu2px" name="product">
                                    <option value="">chọn sản phẩm</option>
                                    <?php foreach ($products as $key => $value) : ?>
                                        <option value="<?= $value['id'] ?>" <?= isset($productDetail['id']) && $value['id'] == $productDetail['id'] || $value['id'] == old('product') ? 'selected' : '' ?>><?= $value['name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?php if (!empty($error['product'])) : ?> <p class="text-danger ms-1 mt-1  mb-0"><?= $error['product']['message'] ?></p> <?php endif ?>
                            </div>
                            <div class="mb-3">
                                <h6>thuộc tính</h6>
                                <div class="row">
                                    <?php foreach ($attr_list as $key => $value) : ?>
                                        <div class="col">
                                            <select id="defaultSelect" name="attribute[]" class="form-select" fdprocessedid="lhqxok">
                                                <option value="" selected disabled><?= $value['name'] ?></option>
                                                <?php foreach ($value['children'] as $key => $value) : ?>
                                                    <option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    <?php endforeach; ?>
                                    <?php if (!empty($error['attribute'])) : ?> <p class="text-danger ms-1 mt-1  mb-0"><?= $error['attribute']['message'] ?></p> <?php endif ?>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="price_product" class="form-label">giá sản phẩm (mặt định lấy giả gốc)</label>
                                <input id="price_product" value="<?= $productDetail['price'] ?? old('product_price') ?>" class="form-control" name="product_price" type="text" placeholder="giá sản phẩm" fdprocessedid="731r6">
                                <?php if (!empty($error['product_price'])) : ?> <p class="text-danger ms-1 mt-1  mb-0"><?= $error['product_price']['message'] ?></p> <?php endif ?>
                            </div>
                            <div class="mb-3">
                                <label for="quantity_product" class="form-label">số lượng (không vượt qua <?= $productDetail['quantity_remaining'] ?? $productDetail['quantity'] ?? '' ?> sản phẩm)</label>
                                <input id="quantity_product" class="form-control" value="<?= old('product_quantity') ?>" type="number" min="1" max="<?= $productDetail['quantity_remaining'] ?? $productDetail['quantity']  ?? '' ?>" name="product_quantity" placeholder="số lượng sản phẩm" fdprocessedid="731r6">
                                <?php if (!empty($error['product_quantity'])) : ?> <p class="text-danger ms-1 mt-1  mb-0"><?= $error['product_quantity']['message'] ?></p> <?php endif ?>
                            </div>
                            <div class="mb-3">
                                <label for="product-weight" class="form-label">cân nặng (kg)</label>
                                <input id="product-weight" class="form-control" type="text" name="product_weight" <?= old('product_weight') ?> placeholder="cân nặng" fdprocessedid="731r6">
                                <?php if (!empty($error['product_weight'])) : ?> <p class="text-danger ms-1 mt-1  mb-0"><?= $error['product_weight']['message'] ?></p> <?php endif ?>
                            </div>
                            <button class="btn btn-primary ">tạo tùy biến sản phẩm</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card mb-4  h-100">
                <h5 class="card-header">Danh sách danh mục</h5>
                <table class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <th>mã</th>
                            <th>tên</th>
                            <th>giá</th>
                            <th>cân nặng</th>
                            <th>số lượng</th>
                            <th>thuộc tính</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        <?php foreach ($customizationList as $key => $value) : ?>
                            <tr>
                                <td><?= $value['id'] ?></td>
                                <td><?= $value['product_name'] ?></td>
                                <td><?= $value['price'] ?></td>
                                <td><?= $value['weight'] ?></td>
                                <td><?= $value['quantity'] ?></td>
                                <td><?php
                                    if (isset($value['attr']) && $value['attr'] > 0) {
                                        echo join('-', array_map(function ($attr) {
                                            return $attr['name'];
                                        }, $value['attr']));
                                    }
                                    ?></td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown" fdprocessedid="k4mzlr">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="?controller=attribute&amp;id=10"><i class="bx bx-edit-alt me-1"></i> chỉ sữa</a>
                                            <a data-value="?controller=attribute&amp;action=delete&amp;id=10" class="dropdown-item btn-delete-attr" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#delete-attribute"><i class="bx bx-trash"></i>xóa</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    document.querySelector('#product-list').onchange = function(e) {
        window.location = `?controller=attribute&action=customization&id=${e.target.value}`;
    }
</script>