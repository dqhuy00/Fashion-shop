<?php
require_once 'validate.php';
function validateCategory()
{
    $handle = [
        'name' => ['required'],
    ];
    $message = [
        'name.required' => 'tên không được để trống',
    ];
    return validate($handle, $message);
}
