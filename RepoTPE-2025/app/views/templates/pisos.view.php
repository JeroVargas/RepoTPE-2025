<?php

class PisosView{
    private $user = null;

    public function __construct($user) {
        $this->user = $user;
    }
// este es el llamado a la vista de lo que voy a mostrar en la funcion 
    public function showHome(){
        require 'app/views/templates/index.phtml';
    }

    public function showPisos($pisos){
    require 'app/views/templates/lista_pisos.phtml';
}



    public function showLogin(){
        require 'app/views/templates/form.login.phtml';
    }

    public function showError($error){
        require 'app/views/templates/error.phtml';
    }
}