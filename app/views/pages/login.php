<?php
use app\controllers\AuthController;
$errorMessage = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $auth = new \app\controllers\AuthController();
    $errorMessage = $auth->login(); 
}
?>

<link rel="stylesheet" href="assets/css/login.css">

<section class="login-section">
    <div class="login-container">
        <h1>CONNEXION</h1>
        <p class="login-intro">Veuillez vous identifier pour accéder au tableau de bord.</p>
        
        <?php if ($errorMessage): ?>
        <p class="error-message"><?= $errorMessage ?></p>
        <?php endif; ?>
        
  <form action="" method="POST">
            <div class="form-group">
                <label for="email">Adresse email :</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Mot de passe :</label>
                <input type="password" id="password" name="password" required>
          </div>
            <button type="submit" class="btn-login">Se connecter</button>
        </form> <a href="#" class="forgot-password">Mot de passe oublié ?</a>
    </div>
</section>