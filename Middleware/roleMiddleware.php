<?php

function roleMiddleware($code)
{
    $query =  new Query();
    $current_user = session_get('current_user');

    $role = $query->table('role_permission')->select('permission.id')->join('permission', 'permission_id')->where('role_id', '=', $current_user['role_id'])->where('permission.code', '=', $code)->first();
    if (!empty($role) && count($role)) {
        return true;
    } else {
        return redirect('?controller=error&action=403');
    }
}
