<?php
require_once './app/libs/response.php';
require_once './app/middlewares/session.auth.middlewares.php';
require_once './app/middlewares/verify.auth.middlewares.php';
require_once './app/controllers/pisos.controller.php';
require_once './app/controllers/auth.controller.php';

define('BASE_URL', '//' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']) . '/');

$res = new Response();

$action = 'index';
if (!empty($_GET['action'])) {
    $action = $_GET['action'];
}

$params = explode('/', $action);

switch ($params[0]) {
    case 'index':
        //sessionAuthMiddleware($res);
        $controller = new PisosController($res);
        $controller->showHome();
        break;

    case 'lista_pisos':
        $controller = new PisosController($res);
        $controller->showPisos();
        break;

    case 'login':
        $controller = new AuthController($res);
        $controller->showLogin();
        break;

    case 'error':
        sessionAuthMiddleware($res);
        $controller = new PisosController();
        $controller->showError("404 Page Not Found");
        break;

    default:
        $controller = new PisosController();
        $error = "404 Page Not Found";
        $controller->showError($error);
        break;
}
