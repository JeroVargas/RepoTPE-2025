<?php
require_once 'app/models/user.model.php';
require_once 'app/views/templates/auth.view.php'; // usamos la vista que ya existe

class AuthController
{
    private $model;
    private $view;

    public function __construct($res)
    {
        $this->model = new UserModel();
        $this->view = new AuthView();
    }

    // Muestra el formulario de login
    public function showLogin($error = null)
    {
        $this->view->showLogin($error);
    }

    // Muestra el formulario de registro
    public function showRegister($error = null)
    {
        require 'app/views/templates/form_register.phtml';
    }

    public function verifyLogin()
    {
        if (!empty($_POST['email']) && !empty($_POST['password'])) {
            $userEmail = $_POST['email'];
            $password = $_POST['password'];

            $user = $this->model->getUserByEmail($userEmail);

            if ($user && password_verify($password, $user->password)) {
                session_start();
                $_SESSION['USER_ID'] = $user->id;
                $_SESSION['USER_EMAIL'] = $user->email;
                $_SESSION['USER_LEVEL'] = $user->level;
                if ($_SESSION['USER_LEVEL'] == 'admin') {
                    header('Location: ' . BASE_URL . 'panel_de_control');
                } else {
                    header('Location: ' . BASE_URL . 'index');
                }
            } else {
                $this->view->showLogin("Usuario o contraseña incorrectos.");
            }
        } else {
            $this->view->showLogin("Usuario o contraseña incorrectos.");
        }
    }

    public function registerUser()
    {
        // 1. Obtener datos del formulario
        $userEmail = $_POST['email'];
        $userPassword = $_POST['password'];

        // Primero, asegurarse de que los campos no estén vacíos (¡ESTA ES LA LÍNEA CORREGIDA!)
        if (empty($userEmail) || empty($userPassword)) {
            $this->showRegister("Por favor, complete todos los campos.");
            return; // Detiene la ejecución aquí
        }

        // 2. Verificar si el email ya existe
        $userExistente = $this->model->getUserByEmail($userEmail);

        // 3. Tomar la decisión
        if ($userExistente) {
            // Si el usuario ya existe, mostramos un error
            $this->showRegister("El correo electrónico ya está en uso. Por favor, elija otro.");
        } else {
            // Si no existe, procedemos a crearlo
            $hash = password_hash($userPassword, PASSWORD_ARGON2ID);
            $this->model->addUser($userEmail, $hash);

            // Y lo enviamos a la página de login para que pueda iniciar sesión
            header('Location: ' . BASE_URL . 'login');
        }
    }


    public function logout()
    {
        session_start(); // Va a buscar la cookie
        session_destroy(); // Borra la cookie que se buscó
        header('Location: ' . BASE_URL);
    }
}
