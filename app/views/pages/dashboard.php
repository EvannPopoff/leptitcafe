<?php
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
                <h3 id="formTitle">Ajouter un événement</h3> 
                <div id="formFeedback" class="alert"></div>
                <?php include 'app/views/layouts/event-management.php'; ?>
            </div>

            <div class="form-card block-section">
                <h3>🚫 Bloquer un créneau</h3>
                <form id="blockSlotForm">
                    <div class="form-group">
                        <label>Date</label>
                        <input type="date" name="date_creneau" required>
                    </div>
                    <div class="form-row-flex">
                        <div class="form-group">
                            <label>Début</label>
                            <input type="time" name="heure_debut" required>
                        </div>
                        <div class="form-group">
                            <label>Fin</label>
                            <input type="time" name="heure_fin" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Motif</label>
                        <input type="text" name="motif_blocage" placeholder="ex: Travaux, Privé">
                    </div>
                    <button type="submit" id="blockBtn" class="btn-block">Verrouiller le créneau</button>
                </form>
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
    const blockForm = document.getElementById('blockSlotForm');

    // --- Gestion Événements ---
    if (eventForm) {
        eventForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            
            fetch('index.php?page=save-event', { method: 'POST', body: formData })
            .then(r => r.json())
            .then(data => {
                alert(data.message);
                if (data.status === 'success') {
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
        });
    } else {
        console.error("Erreur : Formulaire 'blockSlotForm' introuvable dans le HTML.");
    }
});
</script>