<?php
require_once 'Request/validateCategory.php';
// kiểm tra có biến action không nếu có thì loại bỏ khoản trắng hai đầu , biến chuổi hoa thành chuổi thường ;
// còn nếu không có mặt định là index;

// view lấy sử dụng đẻ render review không cần trực tiếp sử dụng include require;
$action = !empty($_GET['action']) ? strtolower(trim($_GET['action'])) : 'index';
// sử dụng thư viện query
// nó là một class nên sử dụng new
// ! thư viện nầy chư có đầy đủ các chức năng nên thiếu cái gì thì thêm vào hoạt alo tui
$query = new Query();
$current_user = session_get('current_user', []);
$currentDate = new DateTime();
switch ($action) {
    case 'index':
        if (count($current_user) > 0 && $_SERVER['REQUEST_METHOD'] == 'GET') {
            $category_list = $query->table('category')->select(['users.name' => 'user_name', 'category.*'])->join('users', 'user_id')->where('category.parent_id', '=', 0)->orderBy('parent_id', 'asc')->all();
            $category_list = filterCategory($category_list);
            if (!empty($_GET['id'])) {
                $category_detail = $query->table('category')->select()->where('id', '=', $_GET['id'])->first();
            }
            View(['layout' => 'layouts/adminLayout', 'content' => 'pages/products/category'], ['category_list' => $category_list, 'category_detail' => $category_detail ?? []]);
        }
        break;
    case 'delete_category':
        try {
            if (count($current_user) > 0 && $_SERVER['REQUEST_METHOD'] == 'GET') {
                $category = $query->table('category')->select()->where('id', '=', $_GET['id'])->first();
                if (isset($category)) {
                    $query->table('category')->where('parent_id', '=', $category['id'])->update([
                        'parent_id' => $category['parent_id'],
                    ]);
                    $query->table('category')->where('id', '=', $category['id'])->delete();
                    back(['success' => 'xóa dữ liệu thành công']);
                } else {
                    throw new Exception('không tìm thấy category');
                }
            }
        } catch (Exception $e) {
            back(['error' => $e->getMessage()]);
        }
        break;
    case 'update_category':
        if (count($current_user) > 0 && $_SERVER['REQUEST_METHOD'] == 'POST') {
            $category = $query->table('category')->select()->where('id', '=', $_GET['id'])->first();
            if ($category) {
                $query->table('category')->where('id', '=', $_GET['id'])->update([
                    'name' => $_POST['name'] ?? $category['name'],
                    'parent_id' => $_POST['parent_id'] ?? $category['parent_id'],
                    // 'updated_at' => $currentDate->format('Y-m-d H:i:s'),
                ]);
            }

            back(['success' => 'cập nhập danh mục sản phẩm thành công']);
        }
        break;
    case 'create_category':
        try {
            $req = validateCategory();
            if (count($current_user) > 0 && $_SERVER['REQUEST_METHOD'] == 'POST') {
                $category = $query->table('category')->insert([
                    'name' =>  $req['name'],
                    'parent_id' =>  $req['parent_id'],
                    'user_id' => $current_user['id'],
                ]);
                if ($category) back(['success' => 'tạo danh mục sản phẩm thành công']);
            }
        } catch (Exception $e) {
        }
        break;
    default:
        View('error/404');
        break;
}

function filterCategory($categoryList, $str = ' ')
{
    global $query;
    $arr = [];
    foreach ($categoryList as $category) {
        $categoryChill = $query->table('category')->select(['users.name' => 'user_name', 'category.*'])->join('users', 'user_id')->where('parent_id', '=', $category['id'])->all();

        $category['name'] = $str  . $category['name'];
        if (count($categoryChill) > 0 &&  $category['parent_id'] == 0) {
            array_push($arr, $category, ...filterCategory($categoryChill, $str .= '--'));
        } else {
            array_push($arr, [...$category]);
        }
    }
    return $arr;
}
