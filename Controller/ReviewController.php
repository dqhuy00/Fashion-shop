<?php
require_once 'Request/validateProductReview.php';
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
        middleware(['authMiddleware']);

        $reviewProduct = $query->table('product_reviews')->select(['products.name' => 'product_name', 'product_reviews.*'])->join('products', 'product_id')->paginate(25);
        View(['layout' => 'layouts/adminLayout', 'content' => 'pages/products/ProductReview'], ['reviewProduct' => $reviewProduct]);
        break;
    case 'detail_get':
        middleware(['authMiddleware']);
        $review = $query->table('product_reviews')->select()->where('id', '=', $_GET['id'])->all();
        View(['layout' => 'layouts/adminLayout', 'content' => 'pages/products/detailProductReview'], ['review' => $review]);
        break;
    case 'create_post':
        try {
            if (!empty($_POST['email']) && !empty($_POST['review'])) {
                $review =  $query->table('product_reviews')->insert([
                    'name' => $_POST['name'],
                    'product_id' => $_GET['id'],
                    'user_id' =>   $current_user['id'] ?? NULL,
                    'email' => $_POST['email'],
                    'scores' => $_POST['rating'],
                    'text' => $_POST['review']
                ]);
                if (empty($review)) {
                    throw new Exception('bình luận không có');
                }
            } else {
                throw new Exception('bạn đang thiếu các trường');
            }
        } catch (Exception $e) {
            http_response_code($e->getCode());
            print_r($e->getMessage());
        }
        break;
    case 'show_preview_get':
        $productReviews = $query->table('product_reviews')->select()->where('product_id', '=', $_GET['id'])->all();
        View('components/review-product', ['product_reviews' => $productReviews]);
        break;
    default:
        echo 'không có file';
}
