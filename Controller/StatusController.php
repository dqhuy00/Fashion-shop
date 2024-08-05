<?php
require_once 'Request/validateFormStatus.php';

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
        middleware(['authMiddleware', 'roleMiddleware:GET_STATUS']);
        $statusList = $query->table('status')->select()->all();
        View(['layout' => 'layouts/adminLayout', 'content' => 'pages/order/status'], ['statusList' => $statusList]);
        break;
    case 'create_get':
        middleware(['authMiddleware', 'roleMiddleware:POST_STATUS']);

        View(['layout' => 'layouts/adminLayout', 'content' => 'pages/order/formStatus']);
        break;
    case 'create_post':
        try {
            middleware(['authMiddleware', 'roleMiddleware:POST_STATUS']);
            $req = validateFormStatus();
            if (isset($req['is_default'])) {
                $dataDefault =  $query->table('status')->where('is_default', '=', 1)->update(['is_default' => 0]);
            }
            $dataRes = $query->table('status')->insert([
                'name' => $req['name'],
                'description' => $req['description'],
                'user_id' => $current_user['id'],
                'is_paid' => $req['is_paid'] ?? 0,
                'icon' => $req['icon'],
                'total_bill' => $req['total_bill'] ?? 0,
                'is_default' => $req['is_default'] ?? 0,
                'type' => $req['type'],
            ]);
            if (count($dataRes)) back(['success' => 'tạo trạng thái thành công']);
        } catch (Exception $e) {
            back(['error' => $e->getMessage()]);
        }
        break;
    case 'update_get':
        middleware(['authMiddleware', 'roleMiddleware:PUT_STATUS']);

        $statusDetail = $query->table('status')->select()->where('id', '=', $_GET['id'])->first();
        View(['layout' => 'layouts/adminLayout', 'content' => 'pages/order/formStatus'], ['statusDetail' => $statusDetail]);
        break;
    case 'update_post':
        try {
            middleware(['authMiddleware', 'roleMiddleware:PUT_STATUS']);

            $req = validateFormStatus();
            $statusDetail = $query->table('status')->select()->where('id', '=', $_GET['id'])->first();
            if (!empty($statusDetail) && count($statusDetail) > 0) {
                if (isset($req['is_default'])) {
                    $dataDefault =  $query->table('status')->where('is_default', '=', 1)->update(['is_default' => 0]);
                }
                $query->table('status')->where('id', '=', $_GET['id'])->update([
                    'name' => $req['name'] ??   $statusDetail['name'],
                    'description' => $req['description'] ?? $statusDetail['description'],
                    'icon' => $req['icon'] ?? $statusDetail['icon'],
                    'total_bill' => $req['total_bill'] ?? 0,
                    'is_default' => $req['is_default'] ?? 0,
                    'type' => $req['type'],
                    'is_paid' => $req['is_paid'] ?? 0,
                ]);
                back(['success' => 'tạo trạng thái thành công']);
            }
        } catch (Exception $e) {
            back(['error' => $e->getMessage()]);
        }
        break;
    case 'delete_get':
        try {
            middleware(['authMiddleware', 'roleMiddleware:DELETE_STATUS']);

            $statusDetail = $query->table('status')->select()->where('id', '=', $_GET['id'])->first();
            if (!empty($statusDetail) && count($statusDetail) > 0) {
                $orderStatus = $query->table('status')->select()->join('orders', 'id', 'status_id')->where('status.id', '=', $_GET['id'])->all();
                if (empty($orderStatus)) {
                    $query->table('status')->where('id', '=', $statusDetail['id'])->delete();
                    back(['success' => 'tạo trạng thái thành công']);
                } else {
                    throw new Exception('trạng thái đang được sử dụng');
                }
            } else {
                throw new Exception('trạng thái không được tìm thấy');
            }
        } catch (Exception $e) {
            back(['error' => $e->getMessage()]);
        }
        break;
    default:
        echo 'không có file';
}
