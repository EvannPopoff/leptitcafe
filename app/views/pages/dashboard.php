<?php
// On vérifie si l'admin est bien passé par la case "login"
if (!isset($_SESSION['admin_id'])) {
    // Si non, on le renvoie vers la page de connexion
    header('Location: index.php?page=login');
    exit();
}
?>

<link rel="stylesheet" href="assets/css/dashboard.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<section class="dashboard">
    <div class="dashboard-header">
        <div>
            <h1>Tableau de Bord</h1>
            <p class="dashboard-intro">Bienvenue dans l'espace administrateur du P'tit Café</p>
        </div>
        <img src="assets/images/dashboard/plant.png" alt="Plante" class="header-plant">
    </div>

    <nav class="dashboard-nav">
        <a href="index.php?page=gestion_evenements">Gérer les événements</a>
        <a href="index.php?page=logout" class="logout-btn">Se déconnecter</a>
    </nav>
</section>

<div class="stats-container">
        <div class="stat-card">
            <div class="stat-info">
                <h3>Événements</h3>
                <span class="stat-number">5</span>
                <p>À venir ce mois-ci</p>
            </div>
            <i class="fa-solid fa-calendar"></i>
        </div>
        </div>

    <div class="reser-vations-section"> 
        <h2>Dernières Réservations</h2>
        <table class="reservations-table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Client</th>
                    <th>Type</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>25 Jan 2026</td>
                    <td>Sophie Martin</td>
                    <td>Anniversaire</td>
                    <td class="actions">
                        <i class="fa-solid fa-check"></i>
                        <i class="fa-solid fa-xmark"></i>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>