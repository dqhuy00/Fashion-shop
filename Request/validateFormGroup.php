<?php
require_once 'validate.php';
function validateFormGroup()
{
    $handle = [
        'name' => ['required'],
    ];
    $message = [
        'name.required' => 'tên nhóm không được để trống không được để trống',
    ];
    return validate($handle, $message);
}
