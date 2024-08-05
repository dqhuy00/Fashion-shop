<?php

// kiểm tra có biến action không nếu có thì loại bỏ khoản trắng hai đầu , biến chuổi hoa thành chuổi thường ;
// còn nếu không có mặt định là index;

// view lấy sử dụng đẻ render review không cần trực tiếp sử dụng include require;
$action = !empty($_GET['action']) ? strtolower(trim($_GET['action'] . '_' . $_SERVER['REQUEST_METHOD'])) : strtolower('index' . '_' . $_SERVER['REQUEST_METHOD']);
// sử dụng thư viện query
// nó là một class nên sử dụng new
// ! thư viện nầy chư có đầy đủ các chức năng nên thiếu cái gì thì thêm vào hoạt alo tui4
session_exists('current_user') ? $current_user = session_get('current_user') :  redirect('?controller=auth');
$query = new Query();
switch ($action) {
    case 'index_get':
        $statistical_orders = $query->table('orders')->select(
            [
                'sum(order_item.price * order_item.quantity)' => 'revenue',
                'sum(order_item.quantity)' => 'total_product_sold'
            ]
        )->join('order_item', 'id', 'order_id')->where('orders.is_paid', '=', 1)->first();

        $statistical_products = $query->table('products')->select([
            'sum(quantity)' => 'total_warehouse',
            'count(id)' => 'total_products',
            'sum(price * quantity)' => 'total_price'
        ])->first();
        $statistical_user = $query->table('users')->select([
            'count(id)' => 'total_user'
        ])->first();
        View(['layout' => 'layouts/adminLayout', 'content' => 'pages/site/dashboard'], [
            'statistical_products' => $statistical_products,
            'statistical_user' => $statistical_user,
            'statistical_orders' => $statistical_orders
        ]);
        break;
    case 'statistical_orders_get':
        // thông kê theo năm
        $statistical_orders = $query->table('orders')->select(
            [
                'count(DISTINCT  CASE WHEN orders.is_paid = 1 THEN 1 END )' => 'total_orders_paid',
                'count(DISTINCT CASE WHEN orders.is_paid = 1 THEN customers_id END )' => 'total_customers_paid',
                'count(DISTINCT orders.id)' => 'total_orders',
                'count(DISTINCT customers_id)' => 'total_customers',
                'sum(CASE WHEN orders.is_paid = 1 THEN order_item.quantity END)' => 'total_product_paid',
                'sum(order_item.quantity)' => 'total_product',
                'sum(CASE WHEN orders.is_paid = 1 THEN order_item.price * order_item.quantity ELSE 0 END)' => 'total_revenue_paid',
                'sum(order_item.price * order_item.quantity)' => 'total_revenue',
                '(sum(order_item.price * order_item.quantity) * 100) / (SELECT SUM(order_item.price * order_item.quantity) FROM order_item)' => 'percentage',
                'year(orders.created_at)' => 'year'
            ]
        )->join('order_item', 'id', 'order_id', 'left')->groupBy('YEAR(orders.created_at)')->first();
        // thống kê theo loại
        $statistical_orders['order_products_category'] = $query->table('order_item')->select([
            'SUM(CASE WHEN orders.is_paid = 1 THEN order_item.quantity * order_item.price ELSE 0 END)' => 'total_revenue_paid',
            'SUM(order_item.quantity * order_item.price)' => 'total_revenue',
            'SUM(CASE WHEN orders.is_paid = 1 THEN order_item.quantity END)' => 'total_product_paid',
            'SUM(order_item.quantity * order_item.price) / ' . $statistical_orders['total_revenue'] . ' * 100' => "percentage",
            'SUM(order_item.quantity)' => 'total_products',
            'category.name' => 'category_name',
        ])
            ->join('orders', 'order_id')
            ->join('product_customization', 'product_customization_id')
            ->join('products', 'product_id', 'id', 'inner', 'product_customization', 'products')
            ->join('category', 'category_id', 'id', 'inner',  'products', 'category')
            ->groupBy('category.id')
            ->all();
        // thống kê theo tháng
        $statisticalOrderAllMonth = $query->table('order_item')->select([
            'MONTH(created_at)' => 'month',
            '(SUM(price * quantity) * 100 / (SELECT SUM(price * quantity) FROM order_item))' => 'total_percentage',
            'created_at', 'sum(price * quantity)' => 'total'
        ])->groupBy('MONTH(created_at)')->all();
        $detail = [];
        $currentDate = new DateTime();
        for ($i = $currentDate->sub(new DateInterval('P6M'))->format('m') - 1; $i < 12; ++$i) {
            $moth = $i + 1;
            $index = array_search($moth, array_column($statisticalOrderAllMonth, 'month'));
            if (isset($index) && $index !== false) {
                array_push($detail, [
                    'moth' =>  $moth,
                    'total_percentage' => $statisticalOrderAllMonth[$index]['total_percentage'],
                    'total' => $statisticalOrderAllMonth[$index]['total']
                ]);
            } else {
                array_push($detail, ['moth' =>  $moth, 'total_percentage' => 0, 'total' => 0]);
            }
        }
        $statistical_orders['statisticalMonth'] = $detail;
        print_r(json_encode($statistical_orders));
        break;
    default:
        echo 'không có file';
}
