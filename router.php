<?php
require_once './app/libs/response.php';
require_once './app/middlewares/session.auth.middlewares.php';
require_once './app/middlewares/verify.auth.middlewares.php';
require_once './app/middlewares/verify.admin.middlewares.php';
require_once './app/controllers/pisos.controller.php';
require_once './app/controllers/auth.controller.php';

define('BASE_URL', '//' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']) . '/');

$res = new Response();

sessionAuthMiddleware($res);

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

    case 'verificar-login':
        $controller = new AuthController($res);
        $controller->verifyLogin();
        break;

    case 'register':
        $controller = new AuthController($res);
        $controller->showRegister();
        break;

    case 'register-user':
        $controller = new AuthController($res);
        $controller->registerUser();
        break;

    case 'panel_de_control':
        verifyAdminMiddleware($res);
        $controller = new PisosController($res);
        $controller->showPanelDeControl();
        break;

    case 'show-add-piso-form':
        verifyAdminMiddleware($res);
        $controller = new PisosController($res);
        $controller->showAddForm();
        break;

    case 'add-piso':
        verifyAdminMiddleware($res);
        $controller = new PisosController($res);
        $controller->addPiso();
        break;

    case 'delete-piso':
        verifyAdminMiddleware($res);
        $controller = new PisosController($res);
        if (isset($params[1])) {
            $id = $params[1];
            $controller->deletePiso($id);
        } else {
            $controller->showError("No se especifico un ID para borrar.");
        }
        break;

    case 'show-edit-form':
        verifyAdminMiddleware($res);
        $controller = new PisosController($res);
        $id = $params[1];
        $controller->showEditForm($id);
        break;

    case 'update-piso':
        verifyAdminMiddleware($res);
        $controller = new PisosController($res);
        $controller->updatePiso();

        break;

    case 'logout':
        $controller = new AuthController($res);
        $controller->logout();
        break;

    case 'error':
        sessionAuthMiddleware($res);
        $controller = new PisosController($res);
        $controller->showError("404 Page Not Found");
        break;

    default:
        $controller = new PisosController($res);
        $error = "404 Page Not Found";
        $controller->showError($error);
        break;
}
