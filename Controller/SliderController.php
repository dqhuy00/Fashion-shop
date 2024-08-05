<?php
require_once 'Request/validateFormSlider.php';
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
        $slider_list = $query->table('slider')->select(['users.name' => 'user_name', 'slider.*'])->join('users', 'user_id ')->orderBy('created_at')->all();
        View(['layout' => 'layouts/adminLayout', 'content' => 'pages/slider/index'], ['slider_list' => $slider_list]);
        break;
    case 'create_get':
        View(['layout' => 'layouts/adminLayout', 'content' => 'pages/slider/formCU']);
        break;
    case 'create_post':
        try {
            $req = validateFormSlider();
            $slider =  $query->table('slider')->insert([
                'images' => $req['slider-images'],
                'name' =>  $req['slider-name'] ?? '',
                'user_id' => $current_user['id'],
                'url' => $req['slider-path'] ?? '',
                'sub_title' => $req['sub_title'] ?? '',
            ]);
            if (count($slider) > 0) {
                back(['success' => 'tạo slider thành công']);
            }
        } catch (Exception $e) {
            back(['error' => $e->getMessage()]);
        }
        break;
    case 'update_get':
        try {
            $slider = $query->table('slider')->select()->where('id', '=', $_GET['id'])->first();
            View(['layout' => 'layouts/adminLayout', 'content' => 'pages/slider/formCU'], ['slider' => $slider] ?? []);
        } catch (Exception $e) {
            back(['error' => $e->getMessage()]);
        }
        break;
    case 'update_post':
        $req = validateFormSlider();
        $slider = $query->table('slider')->select()->where('id', '=', $_GET['id'])->first();
        if (count($slider) > 0) {
            $query->table('slider')->where('id', '=', $slider['id'])->update([
                'name' => $req['slider-name'] ?? $slider['name'],
                'images' => $_POST['slider-images'] ?? $slider['images'],
                'url' => $req['slider-path'] ?? $slider['url'],
                'sub_title' => $req['sub_title'] ?? '',
            ]);
            back(['success' => 'slider cập nhập thành công']);
        } else {
            throw new Exception('không tìm thấy slider');
        }
        break;
    case 'delete_get':
        try {
            $slider = $query->table('slider')->select()->where('id', '=', $_GET['id'])->first();
            if (count($slider) > 0) {
                $query->table('slider')->where('id', '=', $slider['id'])->delete();
                back(['success' => 'xóa thành công']);
            } else {
                back(['error' => 'xóa slider thất bại']);
            }
        } catch (Exception $e) {
            back(['error' => $e->getMessage()]);
        }
        break;
    default:
        echo 'không có file';
}
