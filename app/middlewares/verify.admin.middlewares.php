<?php

function verifyAdminMiddleware($res)
{
    if (!$res->user || $res->user->level !== 'admin') {
        header('Location: ' . BASE_URL . 'index');
        die();
    } else {
        return;
    }
}
