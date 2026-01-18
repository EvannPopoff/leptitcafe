<?php
// On vérifie si l'admin est bien passé par la case "login"
if (!isset($_SESSION['admin_id'])) {
    // Si non, on le renvoie vers la page de connexion
    header('Location: index.php?page=login');
    exit();
}
?>

<h1>Bienvenue sur votre tableau de bord</h1>
<p>Vous êtes connecté en tant que : <?= $_SESSION['admin_email'] ?></p>

<nav>
    <ul>
        <li><a href="index.php?page=gestion_evenements">Gérer les événements</a></li>
        <li><a href="index.php?page=logout">Se déconnecter</a></li>
    </ul>
</nav>