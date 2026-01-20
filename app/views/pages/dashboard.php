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
    <h1>Tableau de Bord</h1>
    <p class="dashboard-intro">Bienvenue dans l'espace administrateur du P'tit Café</p>

    <div class="stats-container">
        <div class="stat-card">
            <div class="stat-info">
                <h3>Événements</h3>
                <span class="stat-number">5</span>
                <p>À venir ce mois-ci</p>
            </div>
            <i class="fa-solid fa-calender"></i>
        </div>
        <div class="stat-card">
            <div class="stat-info">
                <h3>Réservations</h3>
                <span class="stat-number">3</span>
                <p>En attente de validation</p>
            </div>
            <i class="fa-solid fa-clock"></i>
        </div>
        <div class="stat-card">
            <div class="stat-info">
                <h3>Messagerie</h3>
                <span class="stat-number">12</span>
                <p>Nouveaux messages</p>
            </div>
            <i class="fa-solid fa-envelop"></i>
        </div>
    </div>

    <div class="reservations-section">
        <h2>Dernières Réservations</h2>
        <p>Gérez les demandes de location et d'anniversaires ici.</p>
        
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
                <tr>
                    <td>28 Jan 2026</td>
                    <td>Jean Dupont</td>
                    <td>Réunion Asso</td>
                    <td class="actions">
                        <i class="fa-solid fa-check"></i>
                        <i class="fa-solid fa-xmark"></i>
                    </td>
                </tr>
                <tr>
                    <td>02 Fév 2026</td>
                    <td>Lucas Bernard</td>
                    <td>Team name</td>
                    <td class="actions">
                        <i class="fa-solid fa-check"></i>
                        <i class="fa-solid fa-xmark"></i>
                    </td>
                </tr>
                <tr>
                    <td>05 Fév 2026</td>
                    <td>Emma Petit</td>
                    <td>Fête de Famille</td>
                    <td class="actions">
                        <i class="fa-solid fa-check"></i>
                        <i class="fa-solid fa-xmark"></i>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <nav class="dashboard-nav">
        <a href="index.php?page=gestion_evenements">Gérer les événements</a>
        <a href="index.php?page=logout" class="logout-btn">Se déconnecter</a>
    </nav>
</section>