<?php
require_once './app/models/pisos.model.php';
require_once './app/models/categorias.model.php';
require_once './app/views/templates/pisos.view.php';

class PisosController
{
    private $model;
    private $categorias_model;
    private $view;

    public function __construct($res)
    {
        $this->model = new PisosModel();
        $this->categorias_model = new CategoriasModel();
        $this->view = new PisosView($res->user);
    }

    public function showHome()
    {
        //muestro el index.phtml
        return $this->view->showHome();
    }

    public function showPisos()
    {
        $pisos = $this->model->getPisos();
        $this->view->showPisos($pisos);
    }

    public function showPisoDetail($id)
    {
        $piso = $this->model->getPiso($id);
        if ($piso) {
            $this->view->showPisoDetail($piso);
        } else {
            $this->view->showError("Piso no encontrado.");
        }
    }

    public function showPanelDeControl()
    {
        $pisos = $this->model->getPisos();
        $this->view->showPanelDeControl($pisos); // cambiamos esto
    }

    public function showAddForm()
    {
        // 1. Pido todas las categorías al modelo
        $categorias = $this->categorias_model->getAllCategorias();

        // 2. Le pido a la vista que muestre el form, pasándole la lista de categorías
        $this->view->showAddForm($categorias);
    }

    public function addPiso()
    {
        // Chequear antes de utilizar el $_POST
        if (
            !isset($_POST['id_categoria']) ||
            !isset($_POST['tipo_variante']) ||
            !isset($_POST['origen']) ||
            !isset($_POST['acabados_comunes']) ||
            !isset($_POST['uso_recomendado'])
        ) {
            $this->view->showError("Faltan datos en el formulario.");
            return;
        }

        $id_categoria = $_POST['id_categoria'];
        $tipo_variante = $_POST['tipo_variante'];
        $origen = $_POST['origen'];
        $acabados_comunes = $_POST['acabados_comunes'];
        $uso_recomendado = $_POST['uso_recomendado'];

        if (empty($id_categoria) || empty($tipo_variante) || empty($origen)) {
            $this->view->showError("Faltan datos obligatorios: Categoria, Tipo de Variante u origen.");
            return;
        }

        // No cheuquean que exista el tipo de categoria
        $categoria = $this->categorias_model->getCategoriaById($id_categoria);
        if (!$categoria) {
            $this->view->showError("La categoría seleccionada no existe.");
            return;
        }

        $this->model->insertPiso($id_categoria, $tipo_variante, $origen, $acabados_comunes, $uso_recomendado);

        header('Location: ' . BASE_URL . 'panel_de_control');
    }

    public function showEditForm($id)
    {
        // 1. Pido el piso específico que se va a editar
        $piso = $this->model->getPiso($id);

        // 2. Pido todas las categorías
        $categorias = $this->categorias_model->getAllCategorias();

        // 3. Si el piso existe, le pido a la vista que muestre el form,
        //    pasándole tanto los datos del piso como la lista de categorías.
        if ($piso) {
            $this->view->showEditForm($piso, $categorias);
        } else {
            $this->view->showError("Piso no encontrado.");
        }
    }

    public function updatePiso()
    {
        // Chequear antes de utilizar el $_POST
        if (
            !isset($_POST['id']) ||
            !isset($_POST['id_categoria']) ||
            !isset($_POST['tipo_variante']) ||
            !isset($_POST['origen']) ||
            !isset($_POST['acabados_comunes']) ||
            !isset($_POST['uso_recomendado'])
        ) {
            $this->view->showError("Faltan datos en el formulario.");
            return;
        }

        $id = $_POST['id'];
        $id_categoria = $_POST['id_categoria'];
        $tipo_variante = $_POST['tipo_variante'];
        $origen = $_POST['origen'];
        $acabados_comunes = $_POST['acabados_comunes'];
        $uso_recomendado = $_POST['uso_recomendado'];

        if (empty($id) || empty($id_categoria) || empty($tipo_variante) || empty($origen)) {
            $this->view->showError("Faltan datos obligatorios: ID, Categoria, Tipo de Variante u origen.");
            return;
        }

        // No chequean que exista el piso
        $piso = $this->model->getPiso($id);
        if (!$piso) {
            $this->view->showError("El piso que intenta actualizar no existe.");
            return;
        }

        // No chequean que exista el tipo de categoria
        $categoria = $this->categorias_model->getCategoriaById($id_categoria);
        if (!$categoria) {
            $this->view->showError("La categoría seleccionada no existe.");
            return;
        }

        $this->model->editPisoById($id, $id_categoria, $tipo_variante, $origen, $acabados_comunes, $uso_recomendado);
        header('Location: ' . BASE_URL . 'panel_de_control');
    }

    public function deletePiso($id)
    {
        if (empty($id)) {
            $this->view->showError("Error al selecionar el item");
            return;
        }

        // No chequean que exista el piso
        $piso = $this->model->getPiso($id);
        if (!$piso) {
            $this->view->showError("El piso que intenta eliminar no existe.");
            return;
        }

        $this->model->deletePisoById($id);
        header('Location: ' . BASE_URL . 'panel_de_control');
    }


    public function showError($error)
    {
        //muestro el error.phtml
        return $this->view->showError($error);
    }
}
