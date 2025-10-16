<?php

class UserModel
{
    private $db;

    public function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;dbname=pisostpe;charset=utf8', 'root', '');
    }

    //obtengo de la base de datos el email y contraseña



    public function getUserByEmail($email)
    {
        $query = $this->db->prepare("SELECT * FROM usuarios WHERE email = ?");
        $query->execute([$email]);

        $user = $query->fetch(PDO::FETCH_OBJ);

        return $user;
    }

    public function loginUser()
    {
        if (!empty($_POST['email'] && !empty($_POST['password']))) {
            $userEmail = $_POST['email'];
            $userPassword = $_POST['password'];

            $query = $this->db->prepare('SELECT * from users where email = ?');
            $query->execute($userEmail);
            $user = $query->fetch(PDO::FETCH_OBJ);

            if ($user && password_verify($userPassword, ($user->password))) {
                echo ' salio todo bien, manito ';
            } else {
                echo ' intentalo de nuevo ';
            }
        }
    }


    public function addUser()
    {
        if (!empty($_POST['email'] && !empty($_POST['password']))) {
            $userEmail = $_POST['email'];
            $userPassword = password_hash($_POST['password'], PASSWORD_ARGON2ID);

            $query = $this->db->prepare('INSERT INTO users (email, password) VALUES (?,?');
            $query->execute([$userEmail, $userPassword]);
        }
    }
}
