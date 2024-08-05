<?php
require_once 'Request/validateAuth.php';
require_once 'Request/validateFormUser.php';

// kiểm tra có biến action không nếu có thì loại bỏ khoản trắng hai đầu , biến chuổi hoa thành chuổi thường ;
// còn nếu không có mặt định là index;

// view lấy sử dụng đẻ render review không cần trực tiếp sử dụng include require;
$action = !empty($_GET['action']) ? strtolower(trim($_GET['action'] . '_' . $_SERVER['REQUEST_METHOD'])) : strtolower('index' . '_' . $_SERVER['REQUEST_METHOD']);
// sử dụng thư viện query
// nó là một class nên sử dụng new
// ! thư viện nầy chư có đầy đủ các chức năng nên thiếu cái gì thì thêm vào hoạt alo tui
$query = new Query();
$current_user = session_get('current_user', []);
switch ($action) {
    case 'index_get':
        View(['layout' => 'layouts/adminLayoutEmpty', 'content' => 'pages/auth/LoginAdmin']);
        break;
    case 'login_post':
        $req = validateAuth();
        $username = $_POST['username'];
        $user = $query->table('users')->select(['role.name' => 'role_name', 'users.*'])->join('role', 'role_id', 'id')->where('username', '=', $username)->first();
        if ($user && password_verify($_POST['password'], $user['password']) && $user['locked'] == 0) {
            $current_user = [
                'id' => $user['id'],
                'name' => $user['name'],
                'photo_url' => $user['photo_url'],
                'role_id' => $user['role_id'],
                'role_name' => $user['role_name'],
                'locked' => $user['locked']
            ];
            session_push('current_user', $current_user);
            redirect('index.php?controller=dashboard', ['success' => 'đăng nhập thành công']);
        } else {
            back(['error' => 'tài khoản hoạt mật khẩu không chín xát']);
        }
        break;
    case 'login_user_get':
        View('pages/auth/loginUser');
        break;
    case 'login_user_post':
        $req = validateAuth();
        $username = $req['username'];
        $user = $query->table('users')->select(['role.name' => 'role_name', 'users.*'])->join('role', 'role_id', 'id')->where('username', '=', $username)->first();
        if ($user && password_verify($_POST['password'], $user['password']) && $user['locked'] == 0) {
            $current_user = [
                'id' => $user['id'],
                'name' => $user['name'],
                'photo_url' => $user['photo_url'],
                'role_id' => $user['role_id'],
                'role_name' => $user['role_name'],
                'locked' => $user['locked']
            ];
            session_push('current_user', $current_user);
            redirect('?controller=site', ['success' => 'đăng nhập thành công']);
        } else {
            back(['error' => 'tài khoản hoạt mật khẩu không chín xát']);
        }
        break;
    case 'logout_get':
        if (session_get('current_user')) {
            session_remove('current_user');
            back(['success' => 'login thành công']);
        }
        break;
    case 'register_post':
        try {
            $req = validateFormUserCreate();
            $username = $query->table('users')->select()->where('username', '=', $req['username'])->first();
            if (!empty($username) && count($username) > 0) throw new Exception('tài khoản nầy đã có người tạo');
            $hashed_password = password_hash($req['password'], PASSWORD_DEFAULT);
            $data = $query->table('users')->insert([
                'username' => $req['username'],
                'password' =>  $hashed_password,
                'name' => $req['name'],
                'photo_url' => 'public/assets/iconImages/user.png',
            ]);
            if (!empty($data)) {
                redirect('?controller=auth&action=login_user');
            }
        } catch (Exception $e) {
            back(['error' => $e->getMessage()]);
        }
        break;
    default:
        echo 'không có file';
}
