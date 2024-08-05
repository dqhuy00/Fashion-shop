<?php
require_once "Request/validateCheckout.php";

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
            $productCart = session_get('product_cart');
            if (!empty($productCart) && count($productCart) > 0) {
                View(['layout' => 'layouts/webLayoutDefault', 'content' => 'pages/shop/checkout']);
            } else {
                throw new Exception('không có sản phẩm ');
            }
        } catch (Exception $e) {
            back(['error' => $e->getMessage()]);
        }
        break;
    case 'create_post':
        $productCart = session_get('product_cart');
        if (!empty($productCart) && count($productCart) > 0) {
            $req = validateFormCheckout();
            $customers = $query->table('customers')->insert([
                'name' =>  $req['name'],
                'phone_number' =>  $req['phone-number'],
                'email' =>  $req['email'],
                'detail_address' =>  $req['detail_address'],
                'provincial_city' =>  $req['city_​province'],
                'district' =>  $req['district'],
                'wards' =>  $req['wards'],
                'id_user' => $current_user['id'] ?? NULL,
            ]);
            if (!empty($customers) && count($customers) > 0) {
                $status = $query->table('status')->select()->where('is_default', '=', 1)->first();
                $order = $query->table('orders')->insert([
                    'customers_id' => $customers['id'],
                    'status_id' => $status['id'],
                    'shipper' =>  $req['shipper'],
                    'payment' =>  $req['payment'],
                    'note' =>  $req['note'],
                    'order_code' => time() . "",
                ]);
                if (!empty($order) && count($order) > 0) {
                    foreach ($productCart as $value) {
                        $query->table('order_item')->insert([
                            'price' => $value['price'],
                            'product_customization_id' => $value['customization_id'],
                            'order_id' => $order['id'],
                            'quantity' => $value['quantity'],
                        ]);
                    }
                }
            }
            if (isset($req['payment'])) {
                redirect("?controller=payment&action=" . $req['payment'] . "&id=" . $order['id'] . "");
            }
        }
        break;
    case 'thanks_get':
        View(['layout' => 'layouts/webLayoutDefault', 'content' => 'pages/site/thanks']);
        break;
    default:
        echo 'không có file';
}
