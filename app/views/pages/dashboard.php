<?php
// On vérifie si l'admin est bien connecté.
if (!isset($_SESSION['admin_id'])) {
    header('Location: index.php?page=login');
    exit();
}

// Initialisation de la connexion pour les managers inclus dans les layouts
$db = \app\config\Database::getInstance();
?>

<link rel="stylesheet" href="assets/css/dashboard.css">
<link rel="stylesheet" href="assets/css/admin-dashboard.css">
<link rel="stylesheet" href="assets/css/admin-management.css">

<div class="dashboard-container">
    
    <!-- Header Dashboard -->
    <div class="dashboard-header">
        <div class="header-left">
            <h1>Tableau de Bord</h1>
            <p>Bienvenue dans l'espace administrateur du P'tit Café</p>
        </div>
        <div class="header-right">
            <img src="assets/images/dashboard-plant.png" alt="Plante" class="header-plant">
        </div>
    </div>

    <!-- 3 Cartes Stats -->
    <div class="stats-cards">
        <div class="stat-card stat-green">
            <div class="stat-info">
                <span class="stat-number">5</span>
                <span class="stat-label">Événements</span>
                <span class="stat-sub">À venir ce mois-ci</span>
            </div>
            <i class="fa-solid fa-calendar stat-icon"></i>
        </div>
        <div class="stat-card stat-green">
            <div class="stat-info">
                <span class="stat-number">3</span>
                <span class="stat-label">Réservations</span>
                <span class="stat-sub">En attente de validation</span>
            </div>
            <i class="fa-solid fa-clock stat-icon"></i>
        </div>
        <div class="stat-card stat-green">
            <div class="stat-info">
                <span class="stat-number">12</span>
                <span class="stat-label">Messagerie</span>
                <span class="stat-sub">Nouveaux messages</span>
            </div>
            <i class="fa-solid fa-envelope stat-icon"></i>
        </div>
    </div>

    <!-- Section Réservations -->
    <div class="section-reservations">
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
                        <button class="btn-accept">✓</button>
                        <button class="btn-reject">✗</button>
                    </td>
                </tr>
                <tr>
                    <td>28 Jan 2026</td>
                    <td>Jean Dupont</td>
                    <td>Réunion Asso</td>
                    <td class="actions">
                        <button class="btn-accept">✓</button>
                        <button class="btn-reject">✗</button>
                    </td>
                </tr>
                <tr>
                    <td>02 Fév 2026</td>
                    <td>Lucas Bernard</td>
                    <td>Team name</td>
                    <td class="actions">
                        <button class="btn-accept">✓</button>
                        <button class="btn-reject">✗</button>
                    </td>
                </tr>
                <tr>
                    <td>05 Fév 2026</td>
                    <td>Emma Petit</td>
                    <td>Fête de Famille</td>
                    <td class="actions">
                        <button class="btn-accept">✓</button>
                        <button class="btn-reject">✗</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Section Bottom (Messages + Upload) -->
    <div class="section-bottom">
        <!-- Messages -->
        <div class="section-messages">
            <h2>Derniers Messages</h2>
            <p>Les demandes de contact reçues via le site.</p>
            <input type="text" placeholder="Chercher un message..." class="search-messages">
            <div class="messages-list">
                <div class="message-item">
                    <span class="message-date">20 Jan</span>
                    <div class="message-content">
                        <strong>Privatisation Salle</strong>
                        <p>Marie Curie • "Bonjour, est-il possible de..."</p>
                    </div>
                    <button class="btn-arrow">→</button>
                </div>
                <div class="message-item">
                    <span class="message-date">19 Jan</span>
                    <div class="message-content">
                        <strong>Proposition Concert</strong>
                        <p>Groupe Rock • "Nous aimerions jouer..."</p>
                    </div>
                    <button class="btn-arrow">→</button>
                </div>
                <div class="message-item">
                    <span class="message-date">18 Jan</span>
                    <div class="message-content">
                        <strong>Question Adhésion</strong>
                        <p>Question Adhésion</p>
                    </div>
                    <button class="btn-arrow">→</button>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // --- Logique Événements (existante) ---
    const eventForm = document.getElementById('addEventForm');
    if (eventForm) {
        eventForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
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
                    if (typeof calendar !== 'undefined') {
                        calendar.refetchEvents();
                    }
                }
            })
            .catch(error => { console.error('Erreur:', error); })
            .finally(() => { submitBtn.disabled = false; });
        });
    }

    if (deleteBtn) {
        deleteBtn.addEventListener('click', function() {
            const id = eventIdInput.value;
            if (!id) return;
            if (confirm("Voulez-vous vraiment supprimer cet événement ?")) {
                const formData = new FormData();
                formData.append('id', id);
                fetch('index.php?page=delete-event', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    alert(data.message);
                    if (data.status === 'success') {
                        resetUI();
                        if (typeof calendar !== 'undefined') { calendar.refetchEvents(); }
                    }
                });
            }
        });
    }

    if (cancelBtn) {
        cancelBtn.addEventListener('click', function() {
            resetUI();
            feedback.style.display = 'none';
        });
    }
});
</script>
