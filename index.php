<?php
require 'bootstrap.php';
session_start();
$error = session_get('error');
session_remove('error');
$message = session_get('message');
session_remove('message');

$controller = 'site';
// kiểm tra biến controller có tồn tại không 
if (!empty($_GET['controller'])) {
    // nếu nó có tồn tại thì tiến hành xóa khoản trắng hai bên biến chử hoa thành chử thường và viết chử cái đầu tiên thành chử hoa
    // ví dự UsEr = User , USER = User , ' user ' = User , user = User
    $controller = Ucwords(strtolower(trim($_GET['controller'])));
    // tiến hành cộng biến với chuổi controller.php;
    // ví dụ controller = user => UserController.php
    // mặt định nó siteController chỏ tới trang home php
}
// và require_one file UserController.php trông đường dẫn Controller/UserController.php
$url = "Controller/$controller" . "Controller.php";
file_exists($url) ? require_once $url : View('error/404');
