<?php
function currentRouter($paramArr = [])
{
    if (isset($paramArr) && count($paramArr) > 0) {
        $param = array_map(function ($key, $value) {
            return $key . '=' . $value;
        }, array_keys($paramArr), $paramArr);
    }
    return $_SERVER['PHP_SELF'] . '?' . (join('&', $param) ?? '');
}
