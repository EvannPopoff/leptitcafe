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
<<<<<<< HEAD
    const blockForm = document.getElementById('blockSlotForm');

    // --- Gestion Événements ---
=======
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
>>>>>>> parent of 34d9e8a (test slot grisé)
    if (eventForm) {
        eventForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
<<<<<<< HEAD
            
            fetch('index.php?page=save-event', { method: 'POST', body: formData })
            .then(r => r.json())
=======
            submitBtn.disabled = true;
            submitBtn.innerText = "Enregistrement...";

            fetch('index.php?page=save-event', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
>>>>>>> parent of 34d9e8a (test slot grisé)
            .then(data => {
                feedback.style.display = 'block';
                feedback.innerText = data.message;
                feedback.className = 'alert ' + (data.status === 'success' ? 'alert-success' : 'alert-error');

                if (data.status === 'success') {
<<<<<<< HEAD
                    eventForm.reset();
                    // On vérifie si calendar existe avant de rafraîchir
                    if (typeof calendar !== 'undefined' && calendar !== null) {
                        calendar.refetchEvents();
                    } else {
                        console.error("Erreur : La variable 'calendar' n'est pas accessible.");
                    }
                }
            });
        });
    }

    // --- Gestion Blocage ---
    if (blockForm) {
        console.log("Formulaire de blocage détecté !"); // Test de détection
        blockForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);

            fetch('index.php?page=block-slot', { method: 'POST', body: formData })
            .then(r => {
                if(!r.ok) throw new Error("Erreur réseau (vérifie index.php)");
                return r.json();
            })
            .then(data => {
                alert(data.message);
                if (data.status === 'success') {
                    blockForm.reset();
                    if (typeof calendar !== 'undefined') calendar.refetchEvents();
                }
            })
            .catch(err => {
                console.error("Erreur Fetch Blocage:", err);
                alert("Erreur lors de l'envoi. Vérifiez la console (F12).");
            });
=======
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
>>>>>>> parent of 34d9e8a (test slot grisé)
        });
    } else {
        console.error("Erreur : Formulaire 'blockSlotForm' introuvable dans le HTML.");
    }
});
</script>