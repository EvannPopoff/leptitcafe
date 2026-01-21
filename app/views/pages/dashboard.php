<?php

if (!isset($_SESSION['admin_id'])) {
    header('Location: index.php?page=login');
    exit();
}
?>

<link rel="stylesheet" href="assets/css/dashboard.css">

<div class="dashboard-container">
    
    <div class="dashboard-header">
        <div class="header-left">
            <h1>Tableau de Bord</h1>
            <p>Bienvenue dans l'espace administrateur du P'tit Café</p>
        </div>
        <div class="header-right">
            <img src="assets/images/plant.png" alt="Plante" class="header-plant">
        </div>
    </div>

    <div class="stats-cards">
        <div class="stat-card">
            <div class="stat-info">
                <span class="stat-number">5</span>
                <span class="stat-label">Événements</span>
                <span class="stat-sub">À venir ce mois-ci</span>
            </div>
            <i class="fa-solid fa-calendar stat-icon"></i>
        </div>
        <div class="stat-card">
            <div class="stat-info">
                <span class="stat-number">3</span>
                <span class="stat-label">Réservations</span>
                <span class="stat-sub">En attente de validation</span>
            </div>
            <i class="fa-solid fa-clock stat-icon"></i>
        </div>
        <div class="stat-card">
            <div class="stat-info">
                <span class="stat-number">12</span>
                <span class="stat-label">Messagerie</span>
                <span class="stat-sub">Nouveaux messages</span>
            </div>
            <i class="fa-solid fa-envelope stat-icon"></i>
        </div>
    </div>

    <div class="admin-grid" style="margin-top: 30px;">
        
        <aside class="admin-sidebar">
            <div class="user-info-box">
                <p>Connecté : <strong><?= htmlspecialchars($_SESSION['admin_email'] ?? 'Admin') ?></strong></p>
                <a href="index.php?page=logout" class="logout-link">Déconnexion</a>
            </div>

            <div class="form-card">
                <h3>Ajouter un événement</h3>
                <div id="formFeedback" class="alert"></div>
                <?php include 'app/views/layouts/event-management.php'; ?>
            </div>
        </aside>

        <main class="admin-main">
            <h2 class="main-title" style="color: var(--primary-dark);">Calendrier des Événements</h2>
            <div class="calendar-container" style="background: white; padding: 20px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.05);">
                <?php include 'app/views/layouts/calendar.php'; ?>
            </div>
        </main>
        
    </div>
</div>

<script>

document.addEventListener('DOMContentLoaded', function() {
    const eventForm = document.getElementById('addEventForm');
    
    if (eventForm) {
        eventForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            const submitBtn = document.getElementById('submitBtn');
            const feedback = document.getElementById('formFeedback');

            submitBtn.disabled = true;
            submitBtn.innerText = "Enregistrement...";

            fetch('index.php?page=save-event', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                feedback.style.display = 'block';
                feedback.innerText = data.message;
                feedback.className = 'alert ' + (data.status === 'success' ? 'alert-success' : 'alert-error');

                if (data.status === 'success') {
                    eventForm.reset();
                 
                    if (typeof calendar !== 'undefined') {
                        calendar.refetchEvents();
                    }
                }
            })
            .catch(error => {
                console.error('Erreur:', error);
                alert("Erreur technique.");
            })
            .finally(()=> {
                submitBtn.disabled = false;
                submitBtn.innerText = "Enregistrer l'événement";
            });
        });
    }
});
</script>