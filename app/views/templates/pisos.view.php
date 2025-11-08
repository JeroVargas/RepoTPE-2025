<?php

class PisosView
{
    private $user = null;

    public function __construct($user)
    {
        $this->user = $user;
    }
    // este es el llamado a la vista de lo que voy a mostrar en la funcion 
    public function showHome()
    {
        require 'app/views/templates/index.phtml';
    }

    public function showPisos($pisos)
    {
        require 'app/views/templates/lista_pisos.phtml';
    }

    public function showPisoDetail($piso)
    {
        require 'app/views/templates/detalle_piso.phtml';
    }

    public function showLogin()
    {
        require 'app/views/templates/form_login.phtml';
    }

    public function showPanelDeControl($pisos)
    {
        require 'app/views/templates/panel_de_control.phtml';
    }

    public function showAddForm($categorias)
    {
        require_once 'app/views/templates/form_add_piso.phtml';
    }

    public function showEditForm($piso, $categorias)
    {
        require_once 'app/views/templates/form_edit_piso.phtml';
    }

    public function showError($error)
    {
        require 'app/views/templates/error.phtml';
    }
}
