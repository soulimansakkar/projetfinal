<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion - Wakdo</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f2f2f2; display: flex; justify-content: center; align-items: center; height: 100vh; }
        .login-box { background: white; padding: 30px; border-radius: 6px; width: 340px; }
        h2 { text-align: center; margin-bottom: 20px; color: #e8210a; }
        label { display: block; margin-bottom: 4px; font-size: 0.9rem; color: #555; }
        input { width: 100%; padding: 9px; border: 1px solid #ccc; border-radius: 4px; margin-bottom: 14px; }
        button { width: 100%; background: #e8210a; color: white; border: none; padding: 10px; border-radius: 4px; cursor: pointer; }
        .erreur { color: red; font-size: 0.85rem; margin-bottom: 10px; }
    </style>
</head>
<body>
<div class="login-box">
    <h2>WAKDO Admin</h2>
    <?php if (isset($erreur)): ?>
        <p class="erreur"><?= $erreur ?></p>
    <?php endif; ?>
    <form method="POST">
        <label>Email</label>
        <input type="email" name="email" required>
        <label>Mot de passe</label>
        <input type="password" name="mdp" required>
        <button type="submit">Se connecter</button>
    </form>
</div>
</body>
</html>
