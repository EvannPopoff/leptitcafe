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
    // logique des événements
    const eventForm = document.getElementById('addEventForm');
    const submitBtn = document.getElementById('submitBtn');
    const cancelBtn = document.getElementById('cancelBtn');
    const deleteBtn = document.getElementById('deleteBtn');
    const feedback = document.getElementById('formFeedback');
    const eventIdInput = document.getElementById('event_id');
    const formTitle = document.getElementById('formTitle');

    function resetUI() {
        eventForm.reset();
        if(eventIdInput) eventIdInput.value = "";
        submitBtn.innerText = "Enregistrer l'événement";
        formTitle.innerText = "Ajouter un événement";
        if(cancelBtn) cancelBtn.style.display = "none";
        if(deleteBtn) deleteBtn.style.display = "none";
    }

    if (eventForm) {
        eventForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            submitBtn.disabled = true;
            fetch('index.php?page=save-event', { method: 'POST', body: formData })
            .then(r => r.json())
            .then(data => {
                alert(data.message);
                if (data.status === 'success') {
                    resetUI();
                    if (typeof calendar !== 'undefined') calendar.refetchEvents();
                }
            })
            .finally(() => { submitBtn.disabled = false; });
        });
    }

    // logique de blocage
    const blockForm = document.getElementById('blockSlotForm');
    if (blockForm) {
        blockForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            fetch('index.php?page=block-slot', { method: 'POST', body: formData })
            .then(r => r.json())
            .then(data => {
                alert(data.message);
                if (data.status === 'success') {
                    blockForm.reset();
                    if (typeof calendar !== 'undefined') calendar.refetchEvents();
                }
            });
        });
    }
});
</script>