<?php
require_once 'validate.php';
function validateProductReview()
{
    $handle = [
        'name' => ['required'],
        'email' => ['required'],
    ];
    $message = [
        'name.required' => 'tên không được để trống',
        'email.required' => 'email không đươc để trống'
    ];
    return validate($handle, $message);
}
