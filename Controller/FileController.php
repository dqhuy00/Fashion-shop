<?php

// kiểm tra có biến action không nếu có thì loại bỏ khoản trắng hai đầu , biến chuổi hoa thành chuổi thường ;
// còn nếu không có mặt định là index;

// view lấy sử dụng đẻ render review không cần trực tiếp sử dụng include require;
$action = !empty($_GET['action']) ? strtolower(trim($_GET['action'])) : 'index';
// sử dụng thư viện query
// nó là một class nên sử dụng new
// ! thư viện nầy chư có đầy đủ các chức năng nên thiếu cái gì thì thêm vào hoạt alo tui
$query = new Query();
switch ($action) {
    case 'index':
        $path = 'store/images';
        $files_list = scandir($path, SCANDIR_SORT_ASCENDING);
        $files_list_new = array_filter($files_list, function ($file) {
            $tex = pathinfo($file,  PATHINFO_EXTENSION);
            return in_array($tex, ['jpg', 'jpeg', 'png', 'gif', 'webp']);
        });
        $path_file_list = array_map(function ($file) use ($path) {
            return $path . '/' . $file;
        }, $files_list_new);
        print_r(json_encode($path_file_list));
        break;
    case 'upload':
        $fileList = $_FILES['upload'];
        $file_upload = upload_multiple_file($fileList);
        if ($file_upload) {
            print_r(json_encode($file_upload));
        }
        break;
    default:
        echo 'không có file';
}
