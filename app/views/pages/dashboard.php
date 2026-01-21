<?php

echo "coucou";
$db = \app\config\Database::getInstance();

// On vérifie si l'admin est bien connecté.
if (!isset($_SESSION['admin_id'])) {
    header('Location: index.php?page=login');
    exit();
}
?>

<link rel="stylesheet" href="assets/css/dashboard.css">
<link rel="stylesheet" href="assets/css/admin-dashboard.css">

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
    const deleteBtn = document.getElementById('deleteBtn'); // Nouveau
    const feedback = document.getElementById('formFeedback');
    const eventIdInput = document.getElementById('event_id');
    const formTitle = document.getElementById('formTitle');

    // Reset UI
    function resetUI() {
        eventForm.reset();
        if(eventIdInput) eventIdInput.value = "";
        submitBtn.innerText = "Enregistrer l'événement";
        formTitle.innerText = "Ajouter un événement";
        if(cancelBtn) cancelBtn.style.display = "none";
        if(deleteBtn) deleteBtn.style.display = "none"; // On cache le bouton supprimer
    }

    // 2. Logique créer et supprimer
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
                    resetUI();
                    if (typeof calendar !== 'undefined') {
                        calendar.refetchEvents();
                    }
                }
            })
            .catch(error => { console.error('Erreur:', error); alert("Erreur technique."); })
            .finally(() => { submitBtn.disabled = false; });
        });
    }

    // Logique supprimer
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
                        if (typeof calendar !== 'undefined') {
                            calendar.refetchEvents();
                        }
                    }
                })
                .catch(error => console.error('Erreur:', error));
            }
        });
    }

    // Bouton annuler
    if (cancelBtn) {
        cancelBtn.addEventListener('click', function() {
            resetUI();
            feedback.style.display = 'none';
        });
    }

    <section class="admin-messages-section">
        <h2>Gestion des Contacts</h2>
        <?php include 'app/views/layouts/admin-messages.php'; ?>
    </section>
});
</script>