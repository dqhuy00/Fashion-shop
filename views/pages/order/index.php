<div class="container-xxl flex-grow-1 container-p-y">
    <div class="overflow-x-scroll w-100 ">
        <div class="d-flex mb-4 justify-content-start  align-item-between w-100">
            <?php foreach ($statistical['status'] as $key => $value) : ?>
                <div class="w-25 flex-shrink-0 px-2 ">
                    <div class="card ">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0">
                                    <img src="public/assets/img/icons/unicons/chart-success.png" alt="chart success" class="rounded">
                                </div>
                                <div class="dropdown">
                                    <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                                        <a class="dropdown-item" href="?controller=order&type=<?= $value['id'] ?>">xem thêm</a>
                                        <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                                    </div>
                                </div>
                            </div>
                            <span class="fw-semibold d-block mb-1"><?= $value['name'] ?></span>
                            <h3 class="card-title mb-2"><?= $value['total'] ?></h3>
                            <!-- <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +72.80%</small> -->
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div>
    <?php View('components/filterTable', ['orderby' => $orderBy]) ?>
    <div class="card">
        <div class="card-header d-flex  align-items-center justify-content-between  ">
            <h5><a href="?controller=order">quẩn lý đơn hàng</a></h5>
            <p>có : <?= $statistical['total_order'] ?> hóa đơn</p>
        </div>
        <div class="card-body">
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th>mã ĐH</th>
                        <th>tên khách hàng</th>
                        <th>SĐT</th>
                        <th>ST thanh toán</th>
                        <th>thành phố</th>
                        <th>ngày tạo</th>
                        <th>trạng thái</th>
                        <th>thanh toán</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    <?php if (isset($orderList) && count($orderList) > 0) : ?>
                        <?php foreach ($orderList['data'] as $key => $order) : ?>
                            <tr>
                                <td>#<?= $order['order_code'] ?></td>
                                <td><a href="?controller=order&action=detail&id=<?= $order['id'] ?>"><?= $order['customer_name'] ?></a></td>
                                <td><?= $order['customer_phone_number'] ?></td>
                                <td><?= number_format($order['total']) ?> đ</td>
                                <td><?= $order['customer_provincial_city'] ?> </td>
                                <td><?= $order['created_at'] ?></td>
                                <td> <span class="badge bg-<?= $order['status_type'] ?>"><?= $order['status_name'] ?></span> </td>
                                <th> <?= $order['is_paid'] == 1 ? '<span class="text-success ms-1"> đã thanh toán </span> ' : '<span class="text-danger ms-1"> chưa thanh toán </span> ' ?>
                                </th>
                            </tr>
                        <?php endforeach ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="8" class="text-center">không có dữ liệu</td>
                        </tr>
                    <?php endif ?>
                </tbody>

            </table>
            <div class="py-3 px-2">
                <?php View('components/paginate', ['page' => $orderList['page']]) ?>
            </div>
        </div>

    </div>
</div>