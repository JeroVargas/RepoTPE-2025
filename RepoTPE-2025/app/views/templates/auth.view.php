<?php

class AuthView {
    private $user = null;
// este es el llamado a la vista de lo que voy a mostrar en la funcion 
    public function showLogin($error = '') {
        
        require 'app/views/templates/form_login.phtml';
    }

    public function showSignup($error = '') {
        require 'app/views/templates/form_signup.phtml';
    }
}