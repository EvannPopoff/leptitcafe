<?php
// On vérifie si l'admin est bien connecté.
if (!isset($_SESSION['admin_id'])) {
    // Redirection vers la page de login si non connecté
    header('Location: index.php?page=login');
    // On arrête le script pour éviter tout affichage non désiré
    exit();
}
?>

<link rel="stylesheet" href="assets/css/dashboard.css">

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

    <!-- Section Gestion Événements -->
    <div class="section-evenements">
        <h2>Gestion des Événements</h2>
        <p>Ajoutez, modifiez ou supprimez les activités à venir au café</p>
        <div class="evenements-cards">
            <div class="event-card">
                <div class="event-header">
                    <i class="fa-solid fa-calendar"></i>
                    <div>
                        <strong>Soirée Jazz Live</strong>
                        <span>14 Fév 2026 • Musique</span>
                    </div>
                    <button class="btn-more">...</button>
                </div>
                <p class="event-desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                <button class="btn-modifier">Modifier</button>
            </div>
            <div class="event-card">
                <div class="event-header">
                    <i class="fa-solid fa-calendar"></i>
                    <div>
                        <strong>Atelier Réparation</strong>
                        <span>20 Fév 2026 • Bricolage</span>
                    </div>
                    <button class="btn-more">...</button>
                </div>
                <p class="event-desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                <button class="btn-modifier">Modifier</button>
            </div>
            <div class="event-card">
                <div class="event-header">
                    <i class="fa-solid fa-calendar"></i>
                    <div>
                        <strong>Soirée Jeux de Société</strong>
                        <span>28 Fév 2026 • Famille</span>
                    </div>
                    <button class="btn-more">...</button>
                </div>
                <p class="event-desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                <button class="btn-modifier">Modifier</button>
            </div>
        </div>
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

        <!-- Upload -->
        <div class="section-upload">
            <h2>Importer un Document</h2>
            <p>Glissez-déposez vos affiches ou programmes PDF ici.</p>
            <div class="upload-zone">
                <i class="fa-solid fa-cloud-arrow-up"></i>
            </div>
        </div>
    </div>

</div>

<script>
// Logique AJAX (Comme vu précédemment)
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
            .finally(() => {
                submitBtn.disabled = false;
                submitBtn.innerText = "Enregistrer l'événement";
            });
        });
    }
});
</script>