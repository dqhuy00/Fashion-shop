<?php
function authMiddleware()
{
    return session_exists('current_user') ? true : redirect('?controller=auth');
}
