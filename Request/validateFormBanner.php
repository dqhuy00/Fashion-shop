<?php
require_once 'validate.php';
function validateFormBanner()
{
    $handle = [
        'banner-name' => ['required'],
        'banner-group' => ['required'],
        'banner-images' => ['required'],
    ];
    $message = [
        'banner-name.required' => 'tên menus không được để trống',
        'banner-group.required' => 'đường dẫn không được để trống',
        'banner-images.required' => 'ảnh không được để trống'
    ];
    return validate($handle, $message);
}
