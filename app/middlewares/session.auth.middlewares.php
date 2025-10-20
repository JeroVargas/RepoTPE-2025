<?php
function sessionAuthMiddleware($res)
{
    session_start();
    if (isset($_SESSION['USER_ID'])) {
        $res->user = new stdClass();
        $res->user->id = $_SESSION['USER_ID'];
        $res->user->email = $_SESSION['USER_EMAIL'];
        $res->user->level = $_SESSION['USER_LEVEL'];
        return;
    }
}
