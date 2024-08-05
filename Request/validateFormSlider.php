<?php
require_once 'validate.php';
function validateFormSlider()
{
    $handle = [
        'slider-name' => ['required'],
        'slider-images' => ['required'],
    ];
    $message = [
        'slider-name.required' => 'tên slider không được để trống',
        'slider-images.required' => 'images slider không được để trống',
    ];
    return validate($handle, $message);
}
