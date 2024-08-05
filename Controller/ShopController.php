<?php

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
        $descriptionWeb = [
            'title' => 'shop',
        ];
        $category = $query->table('category')->select()->where('parent_id', '=', $_GET['category'] ?? 0)->all();
        $categoryChill = getCategoryChill($category);
        if (count($categoryChill) > 0) {
            if (isset($_GET['category'])) {
                $currentCategory = $query->table('category')->select()->where('id', '=', $_GET['category'])->first();
            }
            $categoryId = array_map(function ($category) {
                return $category['id'] ?? null;
            }, [...$category, ...$categoryChill, $currentCategory ?? null]);
        }
        $productsQuery = $query->table('products')->select();
        if (!empty($_GET['category'])) {
            $productsQuery = $productsQuery->whereIn('category_id', $categoryId);
        }
        if (!empty($_GET['price'])) {
            $price = explode('-', trim($_GET['price']));
            if (!empty($price[0])) {
                $productsQuery = $productsQuery->where('price', '>=', $price[0]);
            }
            if (!empty($price[1])) {
                $productsQuery = $productsQuery->where('price', '<=', $price[1]);
            }
        }
        $products = $productsQuery->orderBy($_GET['order'] ?? 'created_at', $_GET['direction'] ?? 'DESC')->paginate(25);


        View(['layout' => 'layouts/webLayoutDefault', 'content' => 'pages/shop/index'], [
            'category' => $category,
            'products' => $products,
            'descriptionWeb' => $descriptionWeb
        ]);
        break;
    case 'cart_get':
        $cart = session_get('product_cart');
        View(['layout' => 'layouts/webLayoutDefault', 'content' => 'pages/shop/cart'], ['cart' => $cart]);
        break;
    case 'cart_header_get':
        $cart = session_get('product_cart');
        View('components/cartList', ['cart' => $cart]);
        break;
    case 'detail_get':
        try {
            $product = $query->table('products')->select()->where('id', '=', $_GET['id'])->first();
            $similarProducts = $query->table('products')->select()->where('category_id', '=', $product['category_id'])->where('id', '!=', $product['id'])->all();
            $productReviews = $query->table('product_reviews')->select()->where('product_id', '=', $product['id'])->all();
            if (!empty($product) && count($product) > 0) {
                $query->table('products')->where('id', '=',  $product['id'])->update(['count_views' =>  $product['count_views'] + 1]);
                $product['images_list'] = $query->table('image')->select(['image_url', 'alt', 'id'])->where('product_id', '=', $product['id'])->all();
                $product['images_list'][] = ['image_url' => $product['feature_image'], 'id' => $product['id']];
                $attr = $query->table('attribute')->select()->where('parent_id', '=', 0)->all();
                foreach ($attr as $key => $value) {
                    $attr[$key]['children'] = $query->table('attribute_customization')
                        ->select()
                        ->join(
                            'product_customization',
                            'customization_id'
                        )
                        ->join(
                            'attribute',
                            'attribute_id'
                        )
                        ->where('product_customization.product_id', '=', $product['id'])
                        ->where('attribute.parent_id', '=',  $value['id'])
                        ->groupBy('attribute.id')
                        ->all();
                }
            }
            $descriptionWeb = [
                'title' => $product['name']
            ];
            View(
                ['layout' => 'layouts/webLayoutDefault', 'content' => 'pages/shop/detail'],
                [
                    'product' => $product,
                    'attr' => $attr,
                    'productReviews' => $productReviews,
                    'similarProducts' => $similarProducts,
                    'descriptionWeb' => $descriptionWeb
                ]
            );
        } catch (Exception $e) {
            back(['error' => $e->getMessage()]);
        }
        break;
    case 'add-cart_post':
        try {
            if (!empty($_POST['attr']) && count($_POST['attr']) > 0) {
                $cart = session_get('product_cart');
                $product = $query->table('attribute_customization')
                    ->select(
                        [
                            'products.feature_image' => 'feature_image',
                            'products.id' => 'product_id',
                            'products.category_id' => 'category_id',
                            'discount' => 'discount',
                            'products.name' => 'name',
                            'product_customization.id' => 'customization_id',
                            'product_customization.price' => 'customization_price',
                            'products.price' => 'products_price',
                            'product_customization.*'
                        ]
                    )
                    ->join('product_customization', 'customization_id')
                    ->join('products', 'product_id', 'id', 'inner', 'product_customization', 'products')
                    ->where('product_customization.product_id', '=', $_GET['id'])
                    ->whereIn('attribute_id', [...$_POST['attr']])
                    ->groupBy('product_customization.id')
                    ->having('count(product_customization.id)', '=', count($_POST['attr']))
                    ->first();
                $product['attributes'] = $query->table('attribute')->select()->whereIn('id', $_POST['attr'])->all();

                if (!empty($product) && count($product) > 0) {
                    if ($_POST['num-product'] > $product['quantity']) throw  new Exception('số lượng sản phẩm không vượt quá ' . $product['quantity']);
                    $coderProduct = $_GET['id'] . $product['customization_id'];
                    $productItem = [
                        'id' => $coderProduct,
                        'product_id' => $product['product_id'],
                        'customization_id' => $product['customization_id'],
                        'name' =>  $product['name'],
                        'quantity' =>  $_POST['num-product'] ?? 1,
                        'price' => $product['customization_price'] ?? $product['products_price'],
                        'images' => $product['feature_image'],
                        'attr' => count($product['attributes']) > 0 ? array_map(function ($attr) {
                            return ['name' => $attr['name'], 'id' => $attr['id']];
                        }, $product['attributes']) : [],
                    ];

                    if (isset($cart[$coderProduct])) {
                        $cart[$coderProduct]['quantity'] +=  $_POST['num-product'] ?? 1;
                    } else {
                        $cart[$coderProduct] = $productItem;
                    }

                    session_push('product_cart', $cart);
                    print_r(json_encode(session_get('product_cart')));
                } else {

                    throw new Exception('xin lỗi sản phẩm bạn chọn chúng không tìm thấy');
                }
            } else {
                throw new Exception('thất bại !');
            }
        } catch (Exception $e) {
            http_response_code(400);
            print_r(json_encode(['message' => $e->getMessage(), 'status' => 400]));
        }
        break;
    case 'delete-cart_get':
        try {
            $cart = session_get('product_cart');
            if (isset($cart[$_GET['id']])) {
                unset($cart[$_GET['id']]);
            }
            session_push('product_cart', $cart);
            back(['success' => 'xóa thành công']);
        } catch (Exception $e) {
            back(['error' => $e->getMessage()]);
        }
        break;
    case 'products_cart_get':

        print_r(json_encode(array_values($cart)));
        break;
    default:
        echo 'không có file';
}
function getCategoryChill($categoryParent)
{
    global $query;
    $arr = [];
    foreach ($categoryParent as $category) {
        $categoryChill = $query->table('category')->select()->where('parent_id', '=', $category['id'])->all();
        if (!empty($categoryChill) && count($categoryChill) > 0) {
            array_push($arr, [$category, ...getCategoryChill($categoryChill)]);
        } else {
            array_push($arr, $category);
        }
    }
    return $arr;
}
