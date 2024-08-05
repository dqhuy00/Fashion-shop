<?php
require_once 'authMiddleware.php';
require_once 'roleMiddleware.php';
function middleware($middleware)
{
    $rl = false;
    foreach ($middleware as $middleware) {
        $middlewareArr = explode(':', $middleware);

        $nameFn = array_shift($middlewareArr);

        $rl =  call_user_func($nameFn, ...$middlewareArr ?? []);
        if ($rl == false) {
            break;
        }
    }
    if ($rl == false) {
        redirect('?controller=error&action=403');
        exit;
    }
}
function nextMiddleware()
{
    return true;
}
