<div class="container-xxl flex-grow-1 container-p-y">
    <?php View('components/alerts') ?>
    <div class="row">
        <div class="col-5">
            <div class="card">
                <h5 class="card-header">thông tin đơn hàng</h5>
                <div class="card-body">
                    <div class="demo-inline-spacing mt-3">
                        <form action="?controller=order&action=update&id=<?= $productDetail['id'] ?>" method="POST">
                            <ul class="list-group">
                                <li class="list-group-item d-flex align-items-center">
                                    mã đơn hàng :
                                    <span class="ms-1"> <?= $productDetail['id'] ?> </span>
                                </li>
                                <li class="list-group-item d-flex align-items-center">
                                    tên người nhận :
                                    <span class="ms-1"> <?= $productDetail['customer_name'] ?> </span>
                                </li>
                                <li class="list-group-item d-flex align-items-center">
                                    số điện thoại :
                                    <span class="ms-1"> <?= $productDetail['customer_phone_number'] ?> </span>
                                </li>
                                <li class="list-group-item d-flex align-items-center">
                                    email :
                                    <span class="ms-1"> <?= $productDetail['customer_email'] ?> </span>
                                </li>
                                <li class="list-group-item d-flex align-items-center">
                                    tỉnh/thành phố :
                                    <span class="ms-1"> <?= $productDetail['customer_provincial_city'] ?> </span>
                                </li>
                                <li class="list-group-item d-flex align-items-center">
                                    quận/huyện :
                                    <span class="ms-1"> <?= $productDetail['customer_district'] ?> </span>
                                </li>
                                <li class="list-group-item d-flex align-items-center">
                                    xa/phường :
                                    <span class="ms-1"> <?= $productDetail['customer_wards'] ?> </span>
                                </li>
                                <li class="list-group-item d-flex align-items-center">
                                    chi tiết:
                                    <span class="ms-1"> <?= $productDetail['customer_provincial_city'] . '/' . $productDetail['customer_district'] . '/' . $productDetail['customer_wards'] . '/' . $productDetail['customer_address'] ?> </span>
                                </li>
                                <li class="list-group-item d-flex align-items-center  ">
                                    tổng giá sản phẩm :
                                    <span class="text-danger ms-1"><?= number_format($productDetail['total']) ?> đ</span>
                                </li>
                                <li class="list-group-item d-flex align-items-center  ">
                                    phương thức vận chuyển :
                                    <span class="ms-1"> <?= $productDetail['shipper']  ?> </span>
                                </li>
                                <li class="list-group-item d-flex align-items-center  ">
                                    phương thức thanh toán:
                                    <span class="ms-1"> <?= $productDetail['payment']  ?> </span>
                                </li>
                                <li class="list-group-item d-flex align-items-center  ">
                                    <?= $productDetail['is_paid'] == 1 ? '<span class="text-success ms-1"> đã thanh toán </span> ' : '<span class="text-danger ms-1"> chưa thanh toán </span> ' ?>
                                </li>
                                <li class="list-group-item d-flex align-items-center">
                                    <span class="d-d-inline-block" style="width: max-content;">trạng thái đơn hàng : </span>
                                    <select id="defaultSelect" class="form-select  ms-2" fdprocessedid="pe94go" style="max-width: 300px;" name="status">
                                        <?php if (isset($statusList) && count($statusList) > 0) : ?>
                                            <?php foreach ($statusList as $status) : ?>
                                                <option value="<?= $status['id'] ?>" <?= $status['id'] ==  $productDetail['status_id'] ? 'selected' : ''   ?>><?= $status['name'] ?></option>
                                            <?php endforeach ?>
                                        <?php endif ?>
                                    </select>
                                </li>
                            </ul>
                            <div class="d-flex justify-content-between align-items-center ">
                                <button type="submit" class="btn btn-primary mt-3">lưu</button>
                                <?php if ($productDetail['is_paid'] != 1) : ?>
                                    <button type="submit" name="update_paid" value="1" class="btn btn-primary mt-3">đã thanh toán</button>

                                <?php endif ?>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-7">
            <?php if (isset($productDetail['productsList']) && count($productDetail['productsList']) > 0) : ?>
                <div class="card">
                    <div class="card-header d-flex  justify-content-between  align-item-center ">
                        <h5>sản phẩm</h5>
                        <div class="action">
                            <?php if ($productDetail['is_paid'] == 0 || $productDetail['status_is_paid'] == 0) : ?>
                                <button type="button" class="btn btn-primary mb-0" data-bs-toggle="modal" data-bs-target="#modal-products-list" fdprocessedid="zygmmq">
                                    thêm sản phẩm
                                </button>
                                <button class="btn btn-primary mb-0" type="button" onclick="handleClickUpdateOrderItem()">
                                    cập nhập SP
                                </button>
                            <?php endif ?>
                        </div>
                    </div>
                    <div class="card-body w-100 ">
                        <form action="?controller=order&action=update-order-item&id=<?= $_GET['id'] ?>" method="post" name="update-order-item">
                            <div class="row w-100">
                                <?php foreach ($productDetail['productsList'] as $product) : ?>
                                    <div class="col-12">
                                        <div class="card mb-3 position-relative ">
                                            <div class="row g-0">
                                                <div class="col-md-2">
                                                    <img class="card-img card-img-left" src="<?= $product['product_feature_image'] ?>" alt="Card image">
                                                </div>
                                                <div class="col-md-9">
                                                    <div class="card-body py-3 w-100">
                                                        <h6 class="card-title"><?= $product['product_name'] ?>
                                                            <span class="card-text mb-0 ms-auto ">#<?= $product['product_customization_id'] ?></span>
                                                        </h6>
                                                        <div class="d-flex justify-content-between  align-items-center ">
                                                            <p class="card-text mb-0">
                                                                <?php
                                                                if (isset($product['attr']) && count($product['attr']) > 0) {
                                                                    echo join('-', array_map(function ($attr) {
                                                                        return $attr['name'];
                                                                    }, $product['attr']));
                                                                }
                                                                ?>
                                                            </p>
                                                            <p class="card-text mb-0 text-danger fw-light fs-6">giá: <?= number_format($product['price']) ?> VNĐ</small>
                                                            </p>
                                                        </div>
                                                        <div class="d-flex justify-content-between  align-items-center mt-auto">
                                                            <div class="row">
                                                                <label for="input-quantity" class="col-md-2 col-form-label" style="width: max-content;">số lượng</label>
                                                                <div class="col-md-3">
                                                                    <input class="form-control text-center" <?= $productDetail['is_paid'] == 0 || $productDetail['status_is_paid'] == 0 ? '' : 'disabled ' ?> type="text" value="<?= $product['quantity'] ?>" name="quantity[<?= $product['product_customization_id'] ?>]" id="input-quantity" fdprocessedid="f4ekri">
                                                                </div>
                                                            </div>
                                                            <p class="card-text mb-0 text-danger fw-light fs-6 flex-1">tổng : <?= number_format($product['total']) ?> VNĐ</small></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php if ($productDetail['is_paid'] == 0 || $productDetail['status_is_paid'] == 0) : ?>
                                                <a href="?controller=order&action=delete-order-item&id=<?= $product['id'] ?>" class="btn btn-icon shadow-sm btn-light position-absolute end-0 p-3" style="transform: translate(30%,-30%); width: 0; height: 0;">
                                                    <span class="tf-icons bx bx-x fs-4"></span>
                                                </a>
                                            <?php endif ?>

                                            <input type="checkbox" value="<?= $product['product_customization_id'] ?>" checked hidden name="product_customization_id[]">
                                        </div>
                                    </div>
                                <?php endforeach ?>
                            </div>
                        </form>
                    </div>

                </div>
            <?php else : ?>
                <div class="text-center ">không có dữ liệu</div>
            <?php endif ?>

        </div>
    </div>
</div>
<script>
    function handleClickUpdateOrderItem(e) {
        document.forms['update-order-item'].submit();
    }
</script>
<?php View('components/modal/modalProductsList/index') ?>