<?php
require_once './app/libs/response.php';
require_once './app/middlewares/session.auth.middlewares.php';
require_once './app/middlewares/verify.auth.middlewares.php';
require_once './app/middlewares/verify.admin.middlewares.php';
require_once './app/controllers/pisos.controller.php';
require_once './app/controllers/categorias.controller.php';
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

    case 'categorias':
        $controller = new CategoriasController($res);
        $controller->showCategorias();
        break;

    // RUTA MODIFICADA: /categoria/5 (reemplaza a detalle_categoria)
    case 'categoria':
        if (isset($params[1])) {
            $id = $params[1];
            $controller = new CategoriasController($res);
            $controller->showPisosPorCategoria($id);
        } else {
            // TODO: show an error
        }
        break;

    case 'detalle_piso':
        if (isset($params[1])) {
            $id = $params[1];
            $controller = new PisosController($res);
            $controller->showPisoDetail($id);
        } else {
            $controller = new PisosController($res);
            $controller->showError("No se especificó un ID de piso.");
        }
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

    // --- RUTAS DE ADMIN PARA CATEGORIAS ---
    case 'admin':
        if (isset($params[1]) && $params[1] == 'categorias') {
            verifyAdminMiddleware($res);
            $controller = new CategoriasController($res);

            if (isset($params[2])) {
                switch ($params[2]) {
                    case 'add':
                        $controller->createCategoria();
                        break;
                    case 'delete':
                        if (isset($params[3])) {
                            $controller->deleteCategoria($params[3]);
                        }
                        break;
                    case 'edit':
                        if (isset($params[3])) {
                            $controller->showEditForm($params[3]);
                        }
                        break;
                    case 'update':
                        if (isset($params[3])) {
                            $controller->updateCategoria($params[3]);
                        }
                        break;
                }
            } else {
                $controller->showAdminPanel();
            }
        }
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
