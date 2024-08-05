<?php
require_once "Request/validateFormMenus.php";
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
        middleware(['authMiddleware', 'roleMiddleware:GET_MENUS']);
        $menusList = $query->table('menus')->select(['users.name' => "user_name", 'menus.*'])->join('users', 'user_id')->orderBy('created_at')->all();
        View(['layout' => 'layouts/adminLayout', 'content' => 'pages/menus/index'], ['menusList' => $menusList]);
        break;
    case 'create_get':
        middleware(['authMiddleware', 'roleMiddleware:POST_MENUS']);
        $menusList = $query->table('menus')->select()->orderBy('created_at')->all();
        View(['layout' => 'layouts/adminLayout', 'content' => 'pages/menus/formCU'], ['menusList' => $menusList]);
        break;
    case 'create_post':
        try {
            middleware(['authMiddleware', 'roleMiddleware:POST_MENUS']);
            $req = validateFormMenus();
            $menus =  $query->table('menus')->insert([
                'name' => $req['name'],
                'parent_id' => $req['menus_parent'],
                'url' => $req['menu_url'] ?? '',
                'description' => $req['description'],
                'user_id' => $current_user['id'],
            ]);
            if (count($menus) > 0) back(['success' => 'tạo menu thành công']);
        } catch (Exception $e) {
            back(['error' => $e->getMessage()]);
        }
        break;
    case 'update_get':
        try {
            middleware(['authMiddleware', 'roleMiddleware:PUT_MENUS']);
            $menu = $query->table('menus')->select()->where('id', '=', $_GET['id'])->first();
            if (count($menu) > 0) {
                $menusList = $query->table('menus')->select()->orderBy('created_at')->all();
                View(['layout' => 'layouts/adminLayout', 'content' => 'pages/menus/formCU'], ['menusList' => $menusList, 'menu' => $menu]);
            } else {
                throw new Exception('không tìm thấy menu');
            }
        } catch (\Exception $e) {
            back(['error' => $e->getMessage()]);
        }

        break;
    case 'update_post':
        try {
            middleware(['authMiddleware', 'roleMiddleware:PUT_MENUS']);

            $req = validateFormMenus();
            $menu = $query->table('menus')->select()->where('id', '=', $_GET['id'])->first();
            if (count($menu) > 0) {
                $query->table('menus')->where('id', '=', $menu['id'])->update([
                    'name' => $req['name'],
                    'parent_id' => $req['menus_parent'],
                    'url' => $req['menu_url'] ?? '',
                    'description' => $req['description'],
                ]);
                back(['success' => 'tạo menu thành công']);
            };
        } catch (Exception $e) {
            back(['error' => $e->getMessage()]);
        }
        break;
    case 'delete_get':

        try {
            middleware(['authMiddleware', 'roleMiddleware:DELETE_MENUS']);
            $menu = $query->table('menus')->select()->where('id', '=', $_GET['id'])->first();
            if (isset($menu['id'])) {
                $query->table('menus')->where('id', '=',  $menu['id'])->delete();
                back(['success' => 'xóa thành công']);
            } else {
                throw new Exception('không tìm thấy menu');
            }
        } catch (Exception $e) {
            back(['error' => $e->getMessage()]);
        }
        break;
    default:
        View('error/404');
        break;
}
