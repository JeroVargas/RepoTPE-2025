<?php

class CategoriasView
{
    private $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function showCategorias($categorias)
    {
        require_once './app/views/templates/lista_categorias.phtml';
    }

    public function showPisos($pisos, $categoria_nombre)
    {
        // Reutilizamos la vista de lista de pisos
        require_once './app/views/templates/lista_pisos.phtml';
    }

    public function showAdminPanel($categorias)
    {
        // Esta será la nueva vista para el admin
        require_once './app/views/templates/admin_categorias.phtml';
    }

    public function showEditForm($categoria)
    {
        // Esta será la nueva vista para editar
        require_once './app/views/templates/form_edit_categoria.phtml';
    }

    public function showError($error)
    {
        // Reutilizamos la vista de error genérica
        require_once './app/views/templates/error.phtml';
    }
}
