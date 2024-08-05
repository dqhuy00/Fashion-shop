<?php
require_once 'validate.php';
function validateAttribute()
{
    $handle = [
        'name' => ['required'],
        'type' => ['required'],
        'value' => ['required'],
        'parent_id' => ['required'],
    ];
    $message = [
        'name.required' => 'tên thuộc tính không được để trống không được để trống',
        'type.required' => 'loại thuộc tính không được để trống',
        'parent_id.required' => 'nhóm thuộc tính không được để trống',
        'value.required' => 'giá không được để trống'
    ];
    return validate($handle, $message);
}
