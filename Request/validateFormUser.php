<?php
require_once 'validate.php';
function validateFormUserCreate()
{
    $handle = [
        'name' => ['required', 'minLength:4'],
        'username' => ['required', 'minLength:4', 'maxLength:50'],
        'password' => ['required', 'minLength:5', 'maxLength:20'],
    ];
    $message = [
        'name.required' => 'tên không được để trống',
    ];
    return validate($handle, $message);
}
function validateFormUserUpdate()
{
    $handle = [
        'name' => ['required', 'minLength:4', 'maxLength:50'],
        'username' => ['required', 'minLength:4', 'maxLength:50'],
    ];
    $message = [
        'name.required' => 'tên không được để trống',
    ];
    return validate($handle, $message);
}
