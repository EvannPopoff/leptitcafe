<?php
use app\controllers\AuthController;

$errorMessage = null;

// Si l'utilisateur a cliqué sur le bouton de connexion
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $auth = new \app\controllers\AuthController();
    // On récupère le message d'erreur si la connexion échoue
    $errorMessage = $auth->login(); 
}
?>

<section class="login-section">
    <h1>Espace Administration</h1>

    <?php if ($errorMessage): ?>
        <p style="color: red; background: #ffdada; padding: 10px; border: 1px solid red;">
            <?= $errorMessage ?>
        </p>
    <?php endif; ?>

    <form action="" method="POST">
        <div>
            <label for="email">Email :</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div>
            <label for="password">Mot de passe :</label>
            <input type="password" id="password" name="password" required>
        </div>
        <button type="submit">Se connecter</button>
    </form>
</section>