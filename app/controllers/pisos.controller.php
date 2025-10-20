<?php
require_once './app/models/pisos.model.php';
require_once './app/views/templates/pisos.view.php';

class PisosController
{
    private $model;
    private $view;

    public function __construct($res)
    {
        $this->model = new PisosModel();
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

    public function showPanelDeControl()
    {
        $pisos = $this->model->getPisos();
        $this->view->showPanelDeControl($pisos); // cambiamos esto
    }

    public function showAddForm()
    {
        // 1. Pido todas las categorías al modelo
        $categorias = $this->model->getAllCategorias();

        // 2. Le pido a la vista que muestre el form, pasándole la lista de categorías
        $this->view->showAddForm($categorias);
    }

    public function addPiso()
    {
        $tipo_variante = $_POST['tipo_variante'];
        $origen = $_POST['origen'];
        $acabados_comunes = $_POST['acabados_comunes'];
        $uso_recomendado = $_POST['uso_recomendado'];
        $id_categoria = $_POST['id_categoria'];

        if (empty($id_categoria) || empty($tipo_variante) || empty($origen)) {
            $this->view->showError("Faltan datos obligatorios: Categoria, Tipo de Variante u origen.");
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
        $categorias = $this->model->getAllCategorias();

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
        $id = $_POST['id'];
        $tipo_variante = $_POST['tipo_variante'];
        $origen = $_POST['origen'];
        $acabados_comunes = $_POST['acabados_comunes'];
        $uso_recomendado = $_POST['uso_recomendado'];
        $id_categoria = $_POST['id_categoria'];

        $this->model->editPisoById($id, $id_categoria, $tipo_variante, $origen, $acabados_comunes, $uso_recomendado);
        header('Location: ' . BASE_URL . 'panel_de_control');
    }

    public function deletePiso($id)
    {
        if (empty($id)) {
            $this->view->showError("Error al selecionar el item");
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
