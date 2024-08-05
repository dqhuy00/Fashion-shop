<?php
require_once 'validate.php';
function validateAuth()
{
    $handle = [
        'username' => ['required'],
        'password' => ['required'],
    ];
    $message = [
        'username.required' => 'tài khoản không được để trống',
        'password.required' => 'mật khẩu không được để trống',
    ];
    return validate($handle, $message);
}
