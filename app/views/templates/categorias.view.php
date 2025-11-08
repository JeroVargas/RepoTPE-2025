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

    public function showCategoriaDetail($categoria)
    {
        require_once './app/views/templates/detalle_categoria.phtml';
    }
}
