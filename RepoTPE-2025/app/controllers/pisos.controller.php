<?php
require_once './app/models/pisos.model.php';
require_once './app/views/templates/pisos.view.php';

class PisosController{
    private $model;
    private $view;
                                
    public function __construct($res) {
        $this->model = new PisosModel();
        $this->view = new PisosView($res->user);
    }

    public function showHome(){
        //muestro el index.phtml
        return $this->view->showHome();
    }

    public function showPisos(){
    $pisos = $this->model->getPisos();
    $this->view->showPisos($pisos);
}


    
    public function showError($error){
        //muestro el error.phtml
        return $this->view->showError($error);
    }
}