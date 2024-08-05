<?php

// kiểm tra có biến action không nếu có thì loại bỏ khoản trắng hai đầu , biến chuổi hoa thành chuổi thường ;
// còn nếu không có mặt định là index;

// view lấy sử dụng đẻ render review không cần trực tiếp sử dụng include require;
$action = !empty($_GET['action']) ? strtolower(trim($_GET['action'] . '_' . $_SERVER['REQUEST_METHOD'])) : strtolower('index' . '_' . $_SERVER['REQUEST_METHOD']);
// sử dụng thư viện query
// nó là một class nên sử dụng new
// ! thư viện nầy chư có đầy đủ các chức năng nên thiếu cái gì thì thêm vào hoạt alo tui
$query = new Query();
switch ($action) {
    case 'index_get':
        $category = $query->table('category')->select('category.*')
            ->join('products', 'id', 'category_id')
            ->groupBy('category.id')
            ->orderBy('products.count_views')
            ->limit(5)->all();
        $idCategory = array_map(function ($category) {
            return $category['id'];
        }, $category);
        if (count($idCategory) > 0) {
            $products = $query->table('products')->select()->whereIn('category_id', $idCategory)->orderBy('created_at')->limit(14)->all();
        }
        $productView = $query->table('products')->select()->orderBy('count_views', 'DESC')->limit(12)->all();
        $productLike =  $query->table('products')->select()->orderBy('count_likes', 'DESC')->limit(12)->all();
        View(
            ['layout' => 'layouts/webLayoutHeaderOpacity', 'content' => 'pages/site/home'],
            [
                'category' => $category,
                'products' => $products ?? [],
                'productView' => $productView,
                'productLike' => $productLike
            ]
        );
        break;
    case 'about_get':
        View(['layout' => 'layouts/webLayoutHeaderOpacity', 'content' => 'pages/site/about']);
        break;
    case 'concat_get':
        View(['layout' => 'layouts/webLayoutHeaderOpacity', 'content' => 'pages/site/concat']);
        break;
    default:
        echo 'không có file';
}
function categoryChild($categoryChill)
{
    $arr = [];
    global $query;
    foreach ($categoryChill as $value) {
        $category = $query->table('category')->select('*')->where('parent_id', '=', $value['id'])->all();
        if (!empty($category) && count($category) > 0) {
            $arr[] = [...$value, 'children' => categoryChild($category)];
        } else {
            $arr[] = [...$value];
        }
    }
    return $arr;
}
