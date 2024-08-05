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
        $roles = $query->table('role')->select()->paginate(25);
        View(['layout' => 'layouts/adminLayout', 'content' => 'pages/role/index'], ['roles' => $roles]);
        break;
    case 'create_get':
        $permission = $query->table('permission')->select()->where('parent_id', '=', 0)->all();
        View(['layout' => 'layouts/adminLayout', 'content' => 'pages/role/formCU'], ['permission' => $permission]);
        break;
    case 'create_post':
        $role = $query->table('role')->insert([
            'name' => $_POST['name'],
        ]);
        foreach ($_POST['permission'] as $permissionId) {
            $query->table('role_permission')->insert(
                [
                    'role_id' => $role['id'],
                    'permission_id' => $permissionId
                ]
            );
        }
        break;
    case 'update_get':
        $role = $query->table('role')->select()->where('id', '=', $_GET['id'])->first();
        $role['permission_id'] = array_map(function ($role_permission) {
            return $role_permission['permission_id'];
        }, $query->table('role_permission')->select('permission_id')->where('role_id', '=', $role['id'])->all());

        $permission = $query->table('permission')->select()->where('parent_id', '=', 0)->all();
        View(['layout' => 'layouts/adminLayout', 'content' => 'pages/role/formCU'], ['permission' => $permission, 'role' => $role]);
        break;
    case 'update_post':
        $role = $query->table('role')->select()->where('id', '=', $_GET['id'])->first();
        if (!empty($role) && count($role) > 0) {
            $query->table('role')->where('id', '=', $_GET['id'])->update([
                'name' => $_POST['name'],
            ]);
            if (!empty($_POST['permission']) && count($_POST['permission']) > 0) {
                $query->table('role_permission')->where('role_id', '=', $_GET['id'])->whereNotIn('permission_id', $_POST['permission'])->delete();

                foreach ($_POST['permission'] as $permissionId) {
                    $role_permission = $query->table('role_permission')->select()->where('role_id', '=', $_GET['id'])->where('permission_id', '=', $permissionId)->first();
                    if (empty($role_permission)) {
                        $query->table('role_permission')->insert(
                            [
                                'role_id' => $role['id'],
                                'permission_id' => $permissionId
                            ]
                        );
                    }
                }
            }

            back();
        }
        break;
    default:
        echo 'không có file';
}
