<?php

class CategoriasModel
{

    private $db;

    public function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;dbname=pisostpe;charset=utf8', 'root', '');
    }

    public function getAllCategorias()
    {
        $query = $this->db->prepare("SELECT * FROM categorias");
        $query->execute();
        $categorias = $query->fetchAll(PDO::FETCH_OBJ);
        return $categorias;
    }

    public function getCategoriaById($id)
    {
        $query = $this->db->prepare("SELECT * FROM categorias WHERE id = ?");
        $query->execute([$id]);
        $categoria = $query->fetch(PDO::FETCH_OBJ);
        return $categoria;
    }

    public function getCategoriaWithPisos($id)
    {
        $query = $this->db->prepare("SELECT * FROM categorias WHERE id = ?");
        $query->execute([$id]);
        $categoria = $query->fetch(PDO::FETCH_OBJ);

        if ($categoria) {
            $query_pisos = $this->db->prepare("SELECT * FROM pisos WHERE id_categoria = ?");
            $query_pisos->execute([$id]);
            $pisos = $query_pisos->fetchAll(PDO::FETCH_OBJ);
            $categoria->pisos = $pisos;
        }

        return $categoria;
    }

    public function insertCategoria($nombre)
    {
        $query = $this->db->prepare("INSERT INTO categorias (nombre) VALUES (?)");
        $query->execute([$nombre]);
        return $this->db->lastInsertId();
    }

    public function updateCategoria($id, $nombre)
    {
        $query = $this->db->prepare("UPDATE categorias SET nombre = ? WHERE id = ?");
        $query->execute([$nombre, $id]);
    }

    public function deleteCategoria($id)
    {
        $query = $this->db->prepare("DELETE FROM categorias WHERE id = ?");
        $query->execute([$id]);
    }
}
