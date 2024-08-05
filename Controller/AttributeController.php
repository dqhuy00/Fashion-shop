<?php
require_once 'Request/validateAttribute.php';
require_once 'Request/validateCustomization.php';

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
        middleware(['authMiddleware', 'roleMiddleware:GET_ATTRIBUTE_PRODUCTS']);
        $attributeList = $query->table('attribute')->select()->orderBy('created_at')->all();
        if (!empty($_GET['id'])) {
            $detailAttribute = $query->table('attribute')->select()->where('id', '=', $_GET['id'])->first();
        }
        $parentAttribute = $query->table('attribute')->select()->where('parent_id', '=', 0)->all();
        $parentAttributeList =  renderParentAttribute($parentAttribute, $query);
        View(
            [
                'layout' => 'layouts/adminLayout',
                'content' => 'pages/products/attribute'
            ],
            [
                'parentAttribute' => $parentAttribute,
                'attributeList' => $parentAttributeList,
                'detailAttribute' => $detailAttribute ?? []
            ]
        );
        break;
    case 'create_post':
        middleware(['authMiddleware', 'roleMiddleware:POST_ATTRIBUTE_PRODUCTS']);
        $req = validateAttribute();
        $attribute = $query->table('attribute')->insert([
            'name' => $req['name'],
            'value' => $req['value'],
            'static_path' => $req['static_path'],
            'parent_id' => $req['parent_id'],
            'type' => $req['type'],
            'user_id' => $current_user['id'],
            'description' => $req['description']
        ]);
        if (is_array($attribute)) {
            back(['success' => 'tạo thuộc tính thành công']);
        }
        break;
    case 'update_post':
        middleware(['authMiddleware', 'roleMiddleware:PUT_ATTRIBUTE_PRODUCTS']);

        $req = validateAttribute();
        $attribute = $query->table('attribute')->select()->where('id', '=', $_GET['id'])->first();
        if (is_array($attribute)) {
            $query->table('attribute')->where('id', '=', $attribute['id'])->update([
                'name' => $req['name'] ?? $attribute['name'],
                'value' => $req['value'] ?? $attribute['value'],
                'static_path' => $req['static_path'] ?? $attribute['static_path'],
                'parent_id' => $req['parent_id'] ?? $attribute['parent_id'],
                'type' => $req['type'] ?? $attribute['type'],
                'description' => $req['description'] ?? $attribute['description']
            ]);
            back(['success' => 'tạo thuộc tính thành công']);
        }

        break;
    case 'delete_get':
        middleware(['authMiddleware', 'roleMiddleware:DELETE_ATTRIBUTE_PRODUCTS']);

        $attribute = $query->table('attribute')->select()->where('id', '=', $_GET['id'])->first();
        if (is_array($attribute)) {
            $attributeChill = $query->table('attribute')->select()->where('parent_id', '=', $attribute['id'])->all();
            if (count($attributeChill) > 0) {
                back(['error' => 'bạn không thể xóa thuộc tính vì nó là cao nhất']);
            } else {
                $query->table('attribute')->where('id', '=', $_GET['id'])->delete();
                back(['success' => 'xóa thành công']);
            }
        }
        break;
    case 'customization_get':
        $attr_list = renderParentAttributeChill($query->table('attribute')->select()->where('parent_id', '=', 0)->all(), $query);
        $productsCustomizationList = $query->table('product_customization')->join('products', 'product_id')->select(['products.name' => 'product_name', 'product_customization.*'])->all();
        $productsCustomizationList = array_map(function ($productsCustomization) {
            global $query;
            $attr = $query->table('attribute_customization')->select('attribute.*')->join('attribute', 'attribute_id')->where('customization_id', '=', $productsCustomization['id'])->all();
            $productsCustomization['attr'] =  $attr;
            return $productsCustomization;
        }, $productsCustomizationList);
        $products = $query->table('products')->select()->orderBy('created_at')->all();
        if (!empty($_GET['id'])) {
            $productDetail = $query->table('products')
                ->select([
                    '(SELECT (products.quantity - SUM(product_customization.quantity))  FROM product_customization WHERE product_id = products.id)' => 'quantity_remaining',
                    'products.*'
                ])
                ->where('id', '=', $_GET['id'])
                ->first();
        }
        View(['layout' => 'layouts/adminLayout', 'content' => 'pages/products/customization'], [
            'attr_list' => $attr_list,
            'products' => $products,
            'productDetail' => $productDetail ?? [],
            'customizationList' => $productsCustomizationList
        ]);
        break;
    case 'attributes_products_get':
        $attr = $query->table('attribute')->select()->where('parent_id', '=', 0)->all();
        if (!empty($_GET['attr'])) {
            $productAttr =
                $query
                ->table('attribute_customization')
                ->select()
                ->join('attribute', 'attribute_id')
                ->join('product_customization', 'customization_id')
                ->join('products', 'product_id', 'id', 'inner', 'product_customization', 'products')
                ->whereIn('attribute_id', explode(',', $_GET['attr']))
                ->where('products.id', '=', $_GET['id'])
                ->all();
            $productAttr =
                $query
                ->table('attribute_customization')
                ->select()
                ->join('attribute', 'attribute_id')
                ->join('product_customization', 'customization_id')
                ->where('attribute_id', '!=', $_GET['attr'])
                ->whereIn('customization_id', array_column($productAttr, 'customization_id'))
                ->all();
        }
        print_r(json_encode($productAttr));
        break;
    case 'create_customization_post':
        try {
            $req = validateCustomization();
            $attribute_customization =  $query->table('attribute_customization')->select()->join('product_customization', 'customization_id')->whereIn('attribute_id', $req['attribute'])->where('product_id', '=', $req['product'])->all();
            if (count($attribute_customization) >= count($req['attribute'])) throw new Exception('sản phẩm đã được tạo');
            $customization = $query->table('product_customization')->insert([
                'product_id' => $req['product'],
                'price' => $req['product_price'],
                'quantity' => $req['product_quantity'],
                'weight' => $req['product_weight'],
            ]);
            if (count($customization) > 0) {
                foreach ($req['attribute'] as $key => $value) {
                    $attribute = $query->table('attribute')->select()->where('id', '=', $value)->first();
                    $query->table('attribute_customization')->insert([
                        'customization_id' => $customization['id'],
                        'attribute_id' => $attribute['id'],
                        'parent_id' => $attribute['parent_id'],
                    ]);
                }
                back(['success' => 'tạo thành công']);
            }
        } catch (Exception $e) {
            back(['error' => $e->getMessage()]);
        }
        break;
    case 'details_customer':
        $details_customer = $query->table('attribute_customization')
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
                ]
            )
            ->join('product_customization', 'customization_id')
            ->join('products', 'product_id', 'id', 'inner', 'product_customization', 'products')
            ->where('product_customization.product_id', '=', $_GET['id'])
            ->whereIn('attribute_id', explode(',', $_POST['attr']))
            ->groupBy('product_customization.id')
            ->having('count(product_customization.id)', '=', count(explode(',', $_POST['attr'])))
            ->first();
        print_r(json_encode($details_customer));
        break;
    default:
        echo 'không có file';
        break;
}
function renderParentAttribute($dataAttribute, $query, $render = [])
{
    foreach ($dataAttribute as $value) {
        $attributeList =  $query->table('attribute')->select()->where('parent_id', '=', $value['id'])->all();
        if (count($attributeList) > 0 && is_array($attributeList)) {
            array_push($render, $value, ...renderParentAttribute($attributeList, $query));
        } else {
            if ($value['parent_id'] != 0) {
                $value['name'] = '-- ' . $value['name'];
            }
            array_push($render, $value);
        }
    }
    return $render;
}
function renderParentAttributeChill($dataAttribute, $query, $render = [])
{
    foreach ($dataAttribute as $value) {
        $attributeList =  $query->table('attribute')->select()->where('parent_id', '=', $value['id'])->all();
        if (count($attributeList) > 0 && is_array($attributeList)) {
            $value['children'] = renderParentAttribute($attributeList, $query);
            array_push($render, $value);
        } else {
            array_push($render, $value);
        }
    }
    return $render;
}
