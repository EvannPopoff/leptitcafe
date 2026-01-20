<?php

// On vérifie si l'admin est bien connecté.
if (!isset($_SESSION['admin_id'])) {
    // Redirection vers la page de login si non connecté.
    header('Location: index.php?page=login');
    // Empêche l'exécution du reste du script si non connecté.
    exit();
}
?>

// 

<div class="dashboard-container">
    <header class="dashboard-header">
        <h1>Tableau de bord</h1>
        <p>Connecté : <strong><?= htmlspecialchars($_SESSION['admin_email'] ?? 'Admin') ?></strong></p>
        
        <nav class="dashboard-nav">
            <a href="index.php?page=event-management" class="btn">Gérer les événements</a>
            <a href="index.php?page=logout" class="btn btn-danger">Se déconnecter</a>
        </nav>
    </header>

    <hr>

    <?php include 'app/views/layouts/calendar.php'; ?>
    
</div>