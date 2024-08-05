<?php
require_once 'validate.php';
function validateCustomization()
{
    $handle = [
        'product' => ['required'],
        'attribute' => ['required'],
    ];
    $message = [
        'product.required' => 'hãy chọn sản phẩm',
        'attribute.required' => 'thuộc tính không được để trống',
    ];
    return validate($handle, $message);
}
