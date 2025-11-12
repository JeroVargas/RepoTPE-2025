<?php
require_once './app/models/categorias.model.php';
require_once './app/models/pisos.model.php'; // Necesitamos el modelo de pisos
require_once './app/views/templates/categorias.view.php';

class CategoriasController
{
    private $model;
    private $pisos_model; // Añadimos el modelo de pisos
    private $view;

    public function __construct($res)
    {
        $this->model = new CategoriasModel();
        $this->pisos_model = new PisosModel(); // Instanciamos el modelo de pisos
        $this->view = new CategoriasView($res->user);
    }

    // Muestra la lista de todas las categorías
    public function showCategorias()
    {
        $categorias = $this->model->getAllCategorias();
        $this->view->showCategorias($categorias);
    }

    // Muestra el detalle de una categoría, que ahora es la lista de pisos de esa categoría
    public function showPisosPorCategoria($id)
    {
        $categoria = $this->model->getCategoriaById($id);
        if (!$categoria) {
            // TODO: show an error view
            $this->view->showError("Categoría no encontrada.");
            return;
        }

        $pisos = $this->pisos_model->getByCategoria($id);
        // Reutilizamos una vista existente si es posible, o creamos una nueva.
        // Por ahora, asumimos que tenemos una vista para la lista de pisos.
        $this->view->showPisos($pisos, $categoria->nombre); // Pasamos el nombre para el título
    }

    /**
     * Métodos para el panel de administración
     */

    // Muestra el panel de administración de categorías
    public function showAdminPanel()
    {
        $categorias = $this->model->getAllCategorias();
        $this->view->showAdminPanel($categorias); // Necesitaremos crear esta vista
    }

    // Procesa la creación de una nueva categoría
    public function createCategoria()
    {
        if (!isset($_POST['nombre']) || empty(trim($_POST['nombre']))) {
            $this->view->showError("El nombre de la categoría es obligatorio.");
            return;
        }
        // Sanitizamos el input para prevenir XSS
        $nombre = htmlspecialchars($_POST['nombre']);
        $this->model->insertCategoria($nombre);
        header('Location: ' . BASE_URL . 'admin/categorias');
    }

    // Procesa la eliminación de una categoría
    public function deleteCategoria($id)
    {
        // Opcional: verificar que la categoría no tenga pisos asociados antes de borrar
        $pisos = $this->pisos_model->getByCategoria($id);
        if (count($pisos) > 0) {
            $this->view->showError("No se puede eliminar una categoría con pisos asociados.");
            return;
        }

        $this->model->deleteCategoria($id);
        header('Location: ' . BASE_URL . 'admin/categorias');
    }

    // Muestra el formulario de edición
    public function showEditForm($id)
    {
        $categoria = $this->model->getCategoriaById($id);
        if ($categoria) {
            $this->view->showEditForm($categoria); // Necesitaremos crear esta vista
        } else {
            $this->view->showError("Categoría no encontrada.");
        }
    }

    // Procesa la actualización de una categoría
    public function updateCategoria($id)
    {
        if (!isset($_POST['nombre']) || empty(trim($_POST['nombre']))) {
            $this->view->showError("El nombre de la categoría es obligatorio.");
            return;
        }
        // Sanitizamos el input para prevenir XSS
        $nombre = htmlspecialchars($_POST['nombre']);
        $this->model->updateCategoria($id, $nombre);
        header('Location: ' . BASE_URL . 'admin/categorias');
    }
}
