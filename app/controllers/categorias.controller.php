<?php
require_once './app/models/categorias.model.php';
require_once './app/views/templates/categorias.view.php';

class CategoriasController
{
    private $model;
    private $view;

    public function __construct($res)
    {
        $this->model = new CategoriasModel();
        $this->view = new CategoriasView($res->user);
    }

    public function showCategorias()
    {
        $categorias = $this->model->getAllCategorias();
        $this->view->showCategorias($categorias);
    }

    public function showCategoriaDetail($id)
    {
        $categoria = $this->model->getCategoriaWithPisos($id);
        if ($categoria) {
            $this->view->showCategoriaDetail($categoria);
        } else {
            // TODO: show an error view
        }
    }
}
