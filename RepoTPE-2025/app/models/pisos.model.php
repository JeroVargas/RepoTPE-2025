<?php 

class PisosModel{

    private $db;

    public function __construct(){
        $this->db = new PDO('mysql:host=localhost;dbname=pisostpe;charset=utf8', 'root', '');
    }

        //funcion para obetener TODOS los pisos y sus categorias

        public function getPisos(){

            $query = $this->db->prepare('SELECT p.*, c.nombre AS categoria FROM pisos p JOIN categorias c ON p.id_categoria = c.id');

            $query->execute();

            $pisos = $query->fetchAll(PDO::FETCH_OBJ);

            return $pisos;

        }

    

    

        //funcion para obtener cada piso individualmente por ID, con su categoria

        public function getPiso($id){

            $query = $this->db->prepare('SELECT p.*, c.nombre AS categoria FROM pisos p JOIN categorias c ON p.id_categoria = c.id WHERE p.id = ?');

            $query->execute([$id]);

            $piso = $query->fetch(PDO::FETCH_OBJ);

            return $piso;

        }


}