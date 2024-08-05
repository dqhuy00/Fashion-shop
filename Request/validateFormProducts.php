<?php
require_once 'validate.php';
function validateFormProducts()
{
    $handle = [
        'name-product' => ['required'],
        'feature_image' => ['required'],
        'quantity-product' => ['required', 'isNumber'],
        'discount-product' => ['isNumber'],
        'price-product' => ['required', 'isNumber'],
        'category' => ['required', 'isNumber'],
    ];
    $message = [
        'name.required' => 'tên trạng thái không được để tróng',
        'color.required' => 'màu trạng thái không được để tróng',

    ];
    return validate($handle, $message);
}
