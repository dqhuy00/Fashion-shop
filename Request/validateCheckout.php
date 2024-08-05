<?php
require_once 'validate.php';
function validateFormCheckout()
{
    $handle = [
        'name' => ['required'],
        'phone-number' => ['required', 'isNumber'],
        'shipper' => ['required'],
        'city_​province' => ['required'],
        'district' => ['required'],
        'wards' => ['required'],
    ];
    $message = [
        'name.required' => 'tên không được để trống',
        'phone-number.required' => 'số điện thoại người dùng không được để trống',
        'city_​province.required' => 'tỉnh/thành phố không được để trống ',
        'district.required' => 'quận/huyện không được để trống',
        'wards.required' => 'phường/xã không được để trống'
    ];
    return validate($handle, $message);
}
