<?php
require_once  'Middleware/authMiddleware.php';
require_once 'Request/validateFormUser.php';
// kiểm tra có biến action không nếu có thì loại bỏ khoản trắng hai đầu , biến chuổi hoa thành chuổi thường ;
// còn nếu không có mặt định là index;

// view lấy sử dụng đẻ render review không cần trực tiếp sử dụng include require;
$action = !empty($_GET['action']) ? strtolower(trim($_GET['action'])) : 'index';
// sử dụng thư viện query
// nó là một class nên sử dụng new
// ! thư viện nầy chư có đầy đủ các chức năng nên thiếu cái gì thì thêm vào hoạt alo tui
$current_user = session_get('current_user');
$query = new Query();
switch ($action) {
    case 'index':
        try {
            middleware(['authMiddleware', 'roleMiddleware:GET_USER']);
            $data = $query->table('users')->select(['users.id' => 'id', 'users.photo_url' => 'photo_url', 'role.name' => 'role_name', 'users.*', 'users.name' => 'user_name', 'username', 'users.created_at' => 'created_at'])->join('role', 'role_id', 'id', 'left')->orderBy('created_at')->limit(25)->all();
            View(['layout' => 'layouts/adminLayout', 'content' => 'pages/users/table'], ['user_list' => $data]);
        } catch (Exception $e) {
        }
        break;
    case 'lock_user':
        try {
            middleware(['authMiddleware']);
            $user = $query->table('users')->select()->where('id', '=', $_GET['id'])->first();
            if ($user) {
                $data =  $query->table('users')->where('id', '=', $user['id'])->update([
                    'locked' => 1
                ]);
                back(['success' => 'khóa tài khoản thành công']);
            }
        } catch (Exception $e) {
            back(['error' => $e->getMessage()]);
        }
        break;
    case 'unlock_user':
        try {
            middleware(['authMiddleware']);
            $user = $query->table('users')->select()->where('id', '=', $_GET['user'])->first();
            if ($user) {
                $data =  $query->table('users')->where('id', '=', $user['id'])->update([
                    'locked' => 0
                ]);
                back(['success' => 'đã mỡ khóa tài khoản']);
            }
        } catch (Exception $e) {
            back(['error' => $e->getMessage()]);
        }
        break;
    case 'create_user':
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            try {
                middleware(['authMiddleware', 'roleMiddleware:POST_USER']);
                $req = validateFormUserCreate();
                $username = $query->table('users')->select()->where('username', '=', $req['username'])->first();
                if (!empty($username) && count($username) > 0) throw new Exception('tài khoản nầy đã có người tạo');
                if (isset($_FILES)) {
                    $file_url = upload_file($_FILES['avatar'], ['store' => 'avatar']);
                }

                $hashed_password = password_hash($req['password'], PASSWORD_DEFAULT);
                $data = $query->table('users')->insert([
                    'username' => $req['username'],
                    'password' =>  $hashed_password,
                    'name' => $req['name'],
                    'photo_url' => $file_url ?? 'public/assets/iconImages/user.png',
                    'role_id' => $req['role'],
                ]);
                if ($data) back(['success' => 'tạo tài khoản thành công ! oke']);
            } catch (Exception $e) {
                back(['error' => $e->getMessage()]);
            }
            break;
        }
        break;
    case 'create':
        middleware(['authMiddleware', 'roleMiddleware:POST_USER']);
        $role = $query->table('role')->select()->all();
        View(['layout' => 'layouts/adminLayout', 'content' => 'pages/users/form'], ['role_list' => $role]);
        break;
    case 'update':
        middleware(['authMiddleware', 'roleMiddleware:PUT_USER']);
        $user = $query->table('users')->select()->where('id', '=', $_GET['id'])->first();
        if ($user) {
            $role = $query->table('role')->select()->all();
            View(['layout' => 'layouts/adminLayout', 'content' => 'pages/users/form'], ['role_list' => $role, 'user' => $user]);
        }
        back(['success' => 'update tài khoản thành công']);
        break;
    case 'update_user':
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            try {
                middleware(['authMiddleware', 'roleMiddleware:PUT_USER']);
                $req = validateFormUserUpdate();
                $user = $query->table('users')->select()->where('id', '=', $_GET['id'])->first();
                if ($user) {
                    if (!empty($req['password'])) {
                        $hashed_password = password_hash($req['password'], PASSWORD_DEFAULT);
                    }
                    if ($_FILES['avatar']) {
                        $file_url = upload_file($_FILES['avatar'], ['store' => 'avatar']);
                    }
                    $query->table('users')->where('id', '=', $_GET['id'])->update([
                        'name' => $req['name'] ?? $user['name'],
                        'password' => $hashed_password ?? $user['password'],
                        'role_id' => $req['role'] ?? $user['role'],
                        'name' => $req['name'] ?? $user['name'],
                        'photo_url' =>   $file_url ?? $user['photo_url'],
                    ]);
                }
                back(['success' => 'cập nhập tài khoản người dùng thành công ! oke']);
            } catch (Exception $e) {
                back(['error' => $e->getMessage()]);
            }
        }
        break;
    case 'delete':
        middleware(['authMiddleware', 'roleMiddleware:DELETE_USER']);
        $data = $query->table('users')->where('id', '=', 4)->delete();
        print_r($data);
        break;
    default:
        View('error/404');
        break;
}
