<?php
// kiểm tra có biến action không nếu có thì loại bỏ khoản trắng hai đầu , biến chuổi hoa thành chuổi thường ;
// còn nếu không có mặt định là index;

// view lấy sử dụng đẻ render review không cần trực tiếp sử dụng include require;
$action = !empty($_GET['action']) ? strtolower(trim($_GET['action'] . '_' . $_SERVER['REQUEST_METHOD'])) : strtolower('index' . '_' . $_SERVER['REQUEST_METHOD']);
// sử dụng thư viện query
// nó là một class nên sử dụng new
// ! thư viện nầy chư có đầy đủ các chức năng nên thiếu cái gì thì thêm vào hoạt alo tui4
$current_user = session_get('current_user');
$query = new Query();
switch ($action) {
    case 'index_get':
        try {
            middleware(['authMiddleware', 'roleMiddleware:GET_ORDERS']);
            $statistical = [];
            $orderBy = [
                [
                    'name' => 'ngày tạo',
                    'value' => 'created_at',
                ],
                [
                    'name' => 'trạng thái',
                    'value' => 'status_id',
                ],
                [
                    'name' => 'Số điện thoại',
                    'value' => 'customer_phone_number',
                ],
                [
                    'name' => 'tỉnh/thành phố',
                    'value' => 'customer_provincial_city',
                ],
                [
                    'name' => 'trạng thái thanh toán',
                    'value' => 'is_paid',
                ],

            ];
            // lấy tất cả hóa đớn

            $orderQuery = $query->table('orders')->select([
                'customers.name' => 'customer_name',
                'customers.phone_number' => 'customer_phone_number',
                'customers.provincial_city' => 'customer_provincial_city',
                'customers.email' => 'customer_email',
                'customers.district' => 'customer_district',
                'status.name' => 'status_name',
                'status.type' => 'status_type',
                'status.description' => 'status_description',
                'orders.*',
                '(SELECT SUM( price * quantity ) from order_item WHERE order_id = orders.id)' => 'total',
            ])
                ->join('customers', 'customers_id')
                ->join('status', 'status_id')
                ->where('status_id', isset($_GET['type']) ? '=' : 'IS NOT NULL', $_GET['type'] ?? null);

            if (!empty($_GET['search']) && $_GET['search'] != '') {
                $orderQuery = $orderQuery
                    ->where('customers.name', 'like', '%' . trim($_GET['search']) . '%')
                    ->or('customers.phone_number', 'like', '%' . trim($_GET['search']) . '%')
                    ->or('orders.order_code', 'like', '%' . trim($_GET['search']) . '%');
            }
            $orderList = $orderQuery->orderBy($_GET['order'] ?? 'created_at', $_GET['direction'] ?? 'DESC')
                ->paginate(25);
            // thông kế hóa đơn
            $statistical['total_order'] = count($orderList);
            $statistical['status'] = $query->table('status')
                ->select([
                    'count(orders.status_id)' => 'total',
                    'status.name' => 'name',
                    'status.id' => 'id',
                    'status.type' => 'type',
                    'status.*'
                ])
                ->join('orders', 'status_id', 'id', 'LEFT', 'orders', 'status')
                ->where('status.total_bill', '=', 1)
                ->groupBy('status.id')->all();
            View(['layout' => 'layouts/adminLayout', 'content' => 'pages/order/index'], [
                'orderList' => $orderList,
                'statistical' => $statistical,
                'orderBy' => $orderBy
            ]);
        } catch (Exception $e) {
            back(['error' => $e->getMessage()]);
        }
        break;
    case 'detail_get':
        middleware(['authMiddleware', 'roleMiddleware:GET_ORDERS']);

        $statusList = $query->table('status')->select()->all();
        $productDetail = $query->table('orders')->select(
            [
                'customers.name' => 'customer_name',
                'customers.phone_number' => 'customer_phone_number',
                'customers.email' => 'customer_email',
                'customers.detail_address' => 'customer_address',
                'customers.provincial_city' => 'customer_provincial_city',
                'customers.district' => 'customer_district',
                'customers.wards' => 'customer_wards',
                'status.is_paid' => 'status_is_paid',
                'orders.*',
                '(SELECT SUM( price * quantity ) from order_item WHERE order_id = orders.id)' => 'total',
            ]
        )->join('customers', 'customers_id')->join('status', 'status_id')->where('orders.id', '=', $_GET['id'])->first();

        $productDetail['productsList'] = $query->table('order_item')
            ->select([
                'order_item.quantity * order_item.price ' => 'total', 'order_item.*',
                'products.feature_image' => 'product_feature_image',
                'products.name' => 'product_name',
                'product_customization.id' => 'product_customization_id',
            ])
            ->join('orders', 'order_id')
            ->join('product_customization', 'product_customization_id')
            ->join('products', 'product_id', 'id', 'inner', 'product_customization', 'products')
            ->where('orders.id', '=', $_GET['id'])->all();
        $productDetail['productsList']  = array_map(function ($productsCustomization) {
            global $query;
            $attr = $query->table('attribute_customization')->select('attribute.*')->join('attribute', 'attribute_id')->where('customization_id', '=', $productsCustomization['product_customization_id'])->all();
            $productsCustomization['attr'] =  $attr;
            return $productsCustomization;
        },  $productDetail['productsList']);
        View(['layout' => 'layouts/adminLayout', 'content' => 'pages/order/detail'], ['productDetail' => $productDetail, 'statusList' => $statusList]);
        break;
    case 'create_post':
        middleware(['authMiddleware', 'roleMiddleware:POST_ORDERS']);

        $statusDetail = $query->table('status')->select()->where('id', '=', $_GET['id'])->first();
        View(['layout' => 'layouts/adminLayout', 'content' => 'pages/order/formStatus'], ['statusDetail' => $statusDetail]);
        break;
    case 'update_post':
        try {
            middleware(['authMiddleware', 'roleMiddleware:PUT_ORDERS']);

            $order = $query->table('orders')->select()->where('id', '=', $_GET['id'])->first();

            if (!empty($order) && count($order) > 0) {
                if (!empty($_POST['update_paid'])) {
                    $status = $query->table('status')->select()->where('is_paid', '=', 1)->first();
                    $query->table('orders')->where('id', '=', $_GET['id'])->update([
                        'status_id' => $status['id'],
                        'is_paid' => 1
                    ]);
                } else {
                    $query->table('orders')->where('id', '=', $_GET['id'])->update([
                        'status_id' => $_POST['status'],
                    ]);
                }

                back(['success' => 'cập nhập đơn hàng thành công']);
            }
            if (count($dataRes)) back(['success' => 'tạo trạng thái thành công']);
        } catch (Exception $e) {
            back(['error' => $e->getMessage()]);
        }
        break;
    case 'update-order-item_post':
        try {
            middleware(['authMiddleware', 'roleMiddleware:PUT_ORDERS']);

            $order = $query->table('orders')->select()->where('id', '=', $_GET['id'])->first();
            if (isset($order) && count($order) > 0 && !empty($_POST['product_customization_id'])) {

                foreach ($_POST['product_customization_id'] as $key => $id) {
                    $orderItem = $query->table('order_item')->select()->where('product_customization_id', '=',  $id)->first();
                    if (!empty($orderItem) && count($orderItem) > 0) {

                        $query->table('order_item')->where('id', '=',  $orderItem['id'])->update([
                            'quantity' =>  $_POST['quantity'][$id],
                        ]);
                    } else {
                        $productsCustomization = $query->table('product_customization')->select()->where('id', '=', $id)->first();
                        $query->table('order_item')->insert([
                            'order_id' => $_GET['id'],
                            'quantity' => $_POST['quantity'][$id],
                            'product_customization_id' => $id,
                            'price' => $productsCustomization['price']
                        ]);
                    }
                }
                back(['success' => 'cập nhập dữ liệu thành công']);
            } else {
                throw new Exception('bạn chư chọn sản phẩm');
            }
        } catch (Exception $e) {
            back(['error' => $e->getMessage()]);
        }
        break;
    case 'delete-order-item_get':
        try {
            middleware(['authMiddleware', 'roleMiddleware:DELETE_ORDERS']);
            $orderItem = $query->table('order_item')->select()->where('id', '=', $_GET['id'])->first();
            if (isset($orderItem) && count($orderItem) > 0) {
                $orderItemList = $query->table('order_item')->select()->where('order_id', '=', $orderItem['order_id'])->all();
                if (count($orderItemList) > 1) {
                    $orderItem = $query->table('order_item')->where('id', '=', $_GET['id'])->delete();
                    back(['success' => 'xóa sản phẩm thành công']);
                } else {
                    throw new Exception('đơn hàng phải có ích nhất một sản phẩm');
                }
            } else {
                throw new Exception('không tìm thấy sản phẩm');
            }
        } catch (Exception $e) {
            back(['error' => $e->getMessage()]);
        }
        break;
    default:
        echo 'không có file';
}
