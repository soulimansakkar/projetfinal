<?php
session_start();

require_once 'config.php';
require_once 'db.php';
require_once 'classes/Produit.php';
require_once 'classes/Commande.php';

$action = $_GET['action'] ?? 'login';

// rediriger vers login si pas connecte
if ($action != 'login' && !isset($_SESSION['user'])) {
    header('Location: ?action=login');
    exit;
}

switch ($action) {

    case 'login':
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'] ?? '';
            $mdp = $_POST['mdp'] ?? '';

            $db = getDB();
            $stmt = $db->prepare('SELECT * FROM utilisateurs WHERE email = ?');
            $stmt->execute([$email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($mdp, $user['mot_de_passe'])) {
                $_SESSION['user'] = $user;
                header('Location: ?action=preparer');
                exit;
            } else {
                $erreur = 'Email ou mot de passe incorrect';
            }
        }
        include 'pages/login.php';
        break;

    case 'logout':
        session_destroy();
        header('Location: ?action=login');
        exit;

    case 'preparer':
        if ($_SESSION['user']['role'] != 'preparation' && $_SESSION['user']['role'] != 'admin') {
            header('Location: ?action=accueil');
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['commande_id'])) {
            $cmd = new Commande();
            $cmd->marquerPrete($_POST['commande_id']);
            header('Location: ?action=preparer');
            exit;
        }
        $cmd = new Commande();
        $commandes = $cmd->getEnAttente();
        include 'pages/preparer.php';
        break;

    case 'accueil':
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['commande_id'])) {
            $cmd = new Commande();
            $cmd->marquerLivree($_POST['commande_id']);
            header('Location: ?action=accueil');
            exit;
        }
        $cmd = new Commande();
        $commandes = $cmd->getPretes();
        include 'pages/accueil.php';
        break;

    default:
        header('Location: ?action=login');
        exit;
}
