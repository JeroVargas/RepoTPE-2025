<?php

class PisosModel
{

    private $db;

    public function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;dbname=pisostpe;charset=utf8', 'root', '');
    }

    //funcion para obetener TODOS los pisos y sus categorias

    public function getPisos()
    {

        $query = $this->db->prepare('SELECT p.*, c.nombre AS categoria FROM pisos p JOIN categorias c ON p.id_categoria = c.id');

        $query->execute();

        $pisos = $query->fetchAll(PDO::FETCH_OBJ);

        return $pisos;
    }

    public function getAllCategorias()
    {
        $query = $this->db->prepare("SELECT * FROM categorias");
        $query->execute();
        $categorias = $query->fetchAll(PDO::FETCH_OBJ);
        return $categorias;
    }


    //funcion para obtener cada piso individualmente por ID, con su categoria

    public function getPiso($id)
    {

        $query = $this->db->prepare('SELECT p.*, c.nombre AS categoria FROM pisos p JOIN categorias c ON p.id_categoria = c.id WHERE p.id = ?');

        $query->execute([$id]);

        $piso = $query->fetch(PDO::FETCH_OBJ);

        return $piso;
    }

    public function insertPiso($id_categoria, $tipo_variante, $origen, $acabados_comunes, $uso_recomendado)
    {
        $query = $this->db->prepare('INSERT INTO pisos(id_categoria, tipo_variante, origen, acabados_comunes, uso_recomendado) VALUES(?,?,?,?,?) ');
        $query->execute([$id_categoria, $tipo_variante, $origen, $acabados_comunes, $uso_recomendado]);
        return $this->db->lastInsertId();
    }

    public function editPisoById($id, $id_categoria, $tipo_variante, $origen, $acabados_comunes, $uso_recomendado)
    {
        $query = $this->db->prepare('UPDATE pisos SET id_categoria = ?, tipo_variante = ?, origen = ?, acabados_comunes = ?, uso_recomendado = ? WHERE id = ?');
        $query->execute([$id_categoria, $tipo_variante, $origen, $acabados_comunes, $uso_recomendado, $id]);
    }

    public function deletePisoById($id)
    {
        $query = $this->db->prepare('DELETE FROM pisos WHERE id = ?');
        $query->execute([$id]);
    }
}
