<?php
// On vérifie si l'admin est bien connecté.
if (!isset($_SESSION['admin_id'])) {
    header('Location: index.php?page=login');
    exit();
}
?>

<link rel="stylesheet" href="assets/css/dashboard.css">

<div class="dashboard-container">
    <div class="admin-grid">
        
        <aside class="admin-sidebar">
            <div class="user-info-box">
                <p>Connecté : <strong><?= htmlspecialchars($_SESSION['admin_email'] ?? 'Admin') ?></strong></p>
                <a href="index.php?page=logout" class="logout-link">Déconnexion</a>
            </div>

            <div class="form-card">
                <h3 id="formTitle">Ajouter un événement</h3> <div id="formFeedback" class="alert"></div>
                <?php include 'app/views/layouts/event-management.php'; ?>
            </div>
        </aside>

        <main class="admin-main">
            <h1 class="main-title">Tableau de bord</h1>
            <?php include 'app/views/layouts/calendar.php'; ?>
        </main>
        
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const eventForm = document.getElementById('addEventForm');
    const submitBtn = document.getElementById('submitBtn');
    const cancelBtn = document.getElementById('cancelBtn');
    const feedback = document.getElementById('formFeedback');
    const eventIdInput = document.getElementById('event_id');
    const formTitle = document.getElementById('formTitle');

    // Reset le formulaire
    function resetUI() {
        eventForm.reset();
        if(eventIdInput) eventIdInput.value = ""; // On vide l'ID caché
        submitBtn.innerText = "Enregistrer l'événement";
        formTitle.innerText = "Ajouter un événement";
        if(cancelBtn) cancelBtn.style.display = "none";
        // On ne cache pas forcément le deleteBtn ici, car il est géré par le clic calendrier
        const deleteBtn = document.getElementById('deleteBtn');
        if(deleteBtn) deleteBtn.style.display = "none";
    }

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
                    resetUI(); // Réinitialisation complète après succès
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
                // Si on était en train de modifier, on garde le texte modifier si erreur, 
                // sinon resetUI a déjà remis le texte par défaut.
                if (!eventIdInput.value) {
                    submitBtn.innerText = "Enregistrer l'événement";
                } else {
                    submitBtn.innerText = "Enregistrer les modifications";
                }
            });
        });
    }

    // bouton annuler changement
    if (cancelBtn) {
        cancelBtn.addEventListener('click', function() {
            resetUI();
            feedback.style.display = 'none';
        });
    }
});
</script>