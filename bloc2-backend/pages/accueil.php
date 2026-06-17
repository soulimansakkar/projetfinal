<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Accueil - Wakdo</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f2f2f2; }
        nav { background: #e8210a; color: white; padding: 12px 20px; display: flex; justify-content: space-between; }
        nav a { color: white; text-decoration: none; margin-left: 15px; }
        .container { max-width: 900px; margin: 25px auto; padding: 0 15px; }
        h1 { margin-bottom: 18px; font-size: 1.3rem; }
        table { width: 100%; background: white; border-collapse: collapse; border-radius: 6px; overflow: hidden; }
        th { background: #e8210a; color: white; padding: 11px 14px; text-align: left; font-size: 0.9rem; }
        td { padding: 10px 14px; border-bottom: 1px solid #eee; font-size: 0.9rem; }
        .btn { background: #333; color: white; border: none; padding: 6px 14px; border-radius: 4px; cursor: pointer; }
    </style>
</head>
<body>
<nav>
    <strong>WAKDO Admin</strong>
    <div>
        Bonjour <?= htmlspecialchars($_SESSION['user']['prenom']) ?>
        <a href="?action=preparer">Préparation</a>
        <a href="?action=logout">Déconnexion</a>
    </div>
</nav>

<div class="container">
    <h1>Commandes prêtes à remettre</h1>

    <?php if (empty($commandes)): ?>
        <p style="color:#888">Pas de commandes prêtes pour l'instant.</p>
    <?php else: ?>
        <table>
            <tr>
                <th>N° commande</th>
                <th>Client</th>
                <th>Total</th>
                <th>Action</th>
            </tr>
            <?php foreach ($commandes as $c): ?>
            <tr>
                <td><?= $c['id'] ?></td>
                <td><strong><?= htmlspecialchars($c['numero_client']) ?></strong></td>
                <td><?= number_format($c['total'], 2) ?> €</td>
                <td>
                    <form method="POST">
                        <input type="hidden" name="commande_id" value="<?= $c['id'] ?>">
                        <button type="submit" class="btn">Remise client ✓</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
</div>
</body>
</html>
