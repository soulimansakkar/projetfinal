<?php

class Commande {

    private $db;

    public function __construct() {
        $this->db = getDB();
    }

    public function getEnAttente() {
        $stmt = $this->db->query(
            'SELECT * FROM commandes WHERE statut = "en_attente" ORDER BY created_at ASC'
        );
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPretes() {
        $stmt = $this->db->query(
            'SELECT * FROM commandes WHERE statut = "prete" ORDER BY created_at ASC'
        );
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function marquerPrete($id) {
        $stmt = $this->db->prepare('UPDATE commandes SET statut = "prete" WHERE id = ?');
        $stmt->execute([$id]);
    }

    public function marquerLivree($id) {
        $stmt = $this->db->prepare('UPDATE commandes SET statut = "livree" WHERE id = ?');
        $stmt->execute([$id]);
    }

    // creer une commande depuis le front
    public function creer($data) {
        $stmt = $this->db->prepare(
            'INSERT INTO commandes (num_client, montant, statut) VALUES (?, ?, "en_attente")'
        );
        $stmt->execute([$data['numero_commande'], $data['montant_total']]);
        return $this->db->lastInsertId();
        // les lignes de commande pas implementees
    }
}
