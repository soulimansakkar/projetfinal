<?php

class Produit {

    private $db;

    public function __construct() {
        $this->db = getDB();
    }

    public function getAll() {
        $stmt = $this->db->query('SELECT * FROM produits ORDER BY nom');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // recuperer un produit par son id
    public function getById($id) {
        $stmt = $this->db->prepare('SELECT * FROM produits WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // j'ai pas eu le temps de brancher la création/modification depuis l'interface
    public function save($data) {
        if (!empty($data['id'])) {
            $stmt = $this->db->prepare('UPDATE produits SET nom=?, prix=? WHERE id=?');
            $stmt->execute([$data['nom'], $data['prix'], $data['id']]);
        } else {
            $stmt = $this->db->prepare('INSERT INTO produits (nom, prix, categorie) VALUES (?,?,?)');
            $stmt->execute([$data['nom'], $data['prix'], $data['categorie']]);
        }
    }
}
