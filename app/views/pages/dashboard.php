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
    <header class="dashboard-header">
        <h1>Tableau de bord</h1>
        <div class="header-info">
            <span>Connecté : <strong><?= htmlspecialchars($_SESSION['admin_email'] ?? 'Admin') ?></strong></span>
            <a href="index.php?page=logout" class="btn btn-danger" style="margin-left: 15px;">Déconnexion</a>
        </div>
    </header>

    <hr>

    <div class="admin-grid">
        <aside class="admin-sidebar">
            <div class="form-card">
                <h3>Ajouter un événement</h3>
                <div id="formFeedback" class="alert"></div>
                
                <?php include 'app/views/layouts/event-management.php'; ?>
            </div>
        </aside>

        <main class="admin-main">
            <?php include 'app/views/layouts/calendar.php'; ?>
        </main>
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
                    // On rafraîchit FullCalendar sans recharger la page
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