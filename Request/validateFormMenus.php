<?php
require_once 'validate.php';
function validateFormMenus()
{
    $handle = [
        'name' => ['required'],
        'menu_url' => ['required'],
    ];
    $message = [
        'name.required' => 'tên menus không được để trống',
        'menu_url.required' => 'đường dẫn không được để trống',
    ];
    return validate($handle, $message);
}
