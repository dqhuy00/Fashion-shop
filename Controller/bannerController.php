<?php
require_once 'Request/validateFormBanner.php';
require_once 'Request/validateFormGroup.php';
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
        middleware(['authMiddleware', 'roleMiddleware:GET_BANNER']);
        $bannerList = $query->table('banner')->select(['banner_group.name' => 'group_name', 'users.name' => 'user_name', 'banner.*'])->join('banner_group', 'banner_group_id')->join('users', 'user_id')->all();
        View(['layout' => 'layouts/adminLayout', 'content' => 'pages/banner/index'], ['bannerList' => $bannerList]);
        break;
    case 'create_get':
        middleware(['authMiddleware', 'roleMiddleware:POST_BANNER']);
        $bannerGroup = $query->table('banner_group')->select()->all();
        View(['layout' => 'layouts/adminLayout', 'content' => 'pages/banner/formCU'], ['bannerGroup' => $bannerGroup]);
        break;
    case 'create_post':
        try {
            middleware(['authMiddleware', 'roleMiddleware:POST_BANNER']);
            $req = validateFormBanner();
            $query->table('banner')->insert([
                'name' => $_POST['banner-name'] ?? '',
                'images' => $req['banner-images'],
                'banner_group_id' => $_POST['banner-group'] ?? 0,
                'user_id' => $current_user['id'],
                'url' => $_POST['banner-path'] ?? '',
                'sub_title' => $req['sub_title'],
            ]);
            back(['success' => 'tạo thành công']);
        } catch (Exception $e) {
            back(['error' => $e->getMessage()]);
        }
        break;
    case 'update_get':
        try {
            middleware(['authMiddleware', 'roleMiddleware:PUT_BANNER']);
            if ($_GET['id']) {
                $banner = $query->table('banner')->select()->where('id', '=', $_GET['id'])->first();
                $bannerGroup = $query->table('banner_group')->select()->all();
                View(['layout' => 'layouts/adminLayout', 'content' => 'pages/banner/formCU'], ['bannerGroup' => $bannerGroup, 'banner' => $banner]);
            } else {
                throw new Exception('không tìm thấy banner cập nhập');
            }
        } catch (Exception $e) {
            back(['error' => $e->getMessage()]);
        }
        break;
    case 'update_post':
        try {
            middleware(['authMiddleware', 'roleMiddleware:PUT_BANNER']);
            $req = validateFormBanner();
            $banner = $query->table('banner')->select()->where('id', '=', $_GET['id'])->first();
            if (count($banner)) {
                $query->table('banner')->where('id', '=', $banner['id'])->update([
                    'name' => $_POST['banner-name'] ?? $banner['name'],
                    'images' => $req['banner-images'] ?? $banner['images'],
                    'banner_group_id' => $_POST['banner-group'] ?? $banner['banner_group_id'],
                    'url' => $_POST['banner-path'] ?? $banner['url'],
                    'sub_title' => $req['sub_title'],
                ]);
                back(['success' => 'banner cập nhập thành công']);
            } else {
                throw new Exception('không tìm thấy banner');
            }
        } catch (Exception $e) {
            back(['error' => $e->getMessage()]);
        }
        break;
    case 'delete_get':
        middleware(['authMiddleware', 'roleMiddleware:DELETE_BANNER']);
        try {
            $banner = $query->table('banner')->select()->where('id', '=', $_GET['id'])->first();
            if (count($banner) > 0) {
                $query->table('banner')->where('id', '=', $banner['id'])->delete();
                back(['success' => 'xóa banner thành công']);
            } else {
                throw new Exception('xóa thất bại không tìm thấy banner');
            }
        } catch (Exception $e) {
            back(['error' => $e->getMessage()]);
        }
        break;
    case 'create-group_get':
        middleware(['authMiddleware', 'roleMiddleware:CREATE_GROUP_BANNER']);
        $groupList = $query->table('banner_group')->select()->all();
        View(['layout' => 'layouts/adminLayout', 'content' => 'pages/banner/group'], ['groupList' => $groupList ?? []]);
        break;
    case 'update-banner-group_get':
        middleware(['authMiddleware', 'roleMiddleware:UPDATE_GROUP_BANNER']);
        try {
            $bannerGroup = $query->table('banner_group')->select()->where('id', '=', $_GET['id'])->first();
            if (count($bannerGroup) > 0) {
                $groupList = $query->table('banner_group')->select()->all();
                View(['layout' => 'layouts/adminLayout', 'content' => 'pages/banner/group'], ['groupList' => $groupList, 'bannerGroup' => $bannerGroup]);
            } else {
                throw new Exception('không tìm thấy nhóm này');
            }
        } catch (Exception $e) {
            back(['error' => $e->getMessage()]);
        }
        break;
    case 'create-group_post':
        middleware(['authMiddleware', 'roleMiddleware:CREATE_GROUP_BANNER']);

        try {
            $req = validateFormGroup();
            $group = $query->table('banner_group')->insert([
                'name' => $req['name'],
                'user_id' => $current_user['id'],
                'description' => $req['description'],

            ]);
            if (!count($group)) throw new Exception('tạo banner group thất bại');
            back(['success' => 'tạo  banner group thành công']);
        } catch (Exception $e) {
            back(['error' => $e->getMessage()]);
        }
        break;
    case 'update-group_post':
        middleware(['authMiddleware', 'roleMiddleware:UPDATE_GROUP_BANNER']);
        try {
            $req = validateFormGroup();
            $bannerGroup = $query->table('banner_group')->select()->where('id', '=', $_GET['id'])->first();
            if (!empty($bannerGroup) && count($bannerGroup) > 0) {
                $query->table('banner_group')->where('id', '=',  $bannerGroup['id'])->update([
                    'name' => $req['name'],
                    'description' => $req['description'],
                ]);
                back(['success' => 'cập nhập banner group thành công']);
            } else {
                throw new Exception('cập nhập thất bại không tìm thấy group');
            }
        } catch (Exception $e) {
            back(['error' => $e->getMessage()]);
        }
        break;
    case 'delete-banner-group_get':
        middleware(['authMiddleware', 'roleMiddleware:DELETE_GROUP_BANNER']);

        try {
            $bannerGroup = $query->table('banner_group')->select()->where('id', '=', $_GET['id'])->first();
            if (!empty($bannerGroup) && count($bannerGroup) > 0) {
                $banner = $query->table('banner_group')->select()->join('banner', 'id', 'banner_group_id')->where('banner_group.id', '=',  $bannerGroup['id'])->first();
                if (empty($banner)) {
                    $query->table('banner_group')->where('id', '=',  $bannerGroup['id'])->delete();
                    back(['success' => 'xóa banner group thành công']);
                } else {
                    throw new Exception('nhóm banner đã được sử dụng');
                }
            } else {
                throw new Exception('xóa thất bại không tìm thấy group');
            }
        } catch (Exception $e) {
            back(['error' => $e->getMessage()]);
        }
        break;
    default:
        echo 'không có file';
}
