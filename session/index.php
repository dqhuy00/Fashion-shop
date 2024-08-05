<?php
// lưu trử 
function session_get($name, $default = [])
{
    return !empty($_SESSION[$name]) ? $_SESSION[$name] : $default;
}
// them ss
function session_push($name, $data)
{
    return $_SESSION[$name] = $data;
}
// kiem tra 
function session_exists($name)
{
    return isset($_SESSION[$name]);
}

function session_remove($name)
{
    unset($_SESSION[$name]);
}
