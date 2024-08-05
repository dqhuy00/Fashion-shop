<?php
require_once 'validate.php';

function validateFormStatus()
{
    $handle = [
        'name' => ['required', 'minLength:4', 'maxLength:50'],
        'type' => ['required']
    ];
    $message = [
        'name.required' => 'tên không được để trống',
    ];
    return validate($handle, $message);
}
