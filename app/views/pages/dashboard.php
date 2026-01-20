<link rel="stylesheet" href="assets/css/dashboard.css">
<div class="dashboard-container">
    <div class="admin-grid">
        <aside class="admin-sidebar">
            <div class="user-info-box">
                <p>Admin : <strong><?= $_SESSION['admin_email'] ?></strong></p>
                <a href="index.php?page=logout" class="logout-link">Déconnexion</a>
            </div>
            <div class="form-card">
                <h3 id="formTitle">Ajouter un événement</h3>
                <div id="formFeedback" class="alert"></div>
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
    const form = document.getElementById('addEventForm');
    const deleteBtn = document.getElementById('deleteBtn');
    const cancelBtn = document.getElementById('cancelBtn');

    // 1. Sauvegarde (Create / Update)
    form.onsubmit = function(e) {
        e.preventDefault();
        fetch('index.php?page=save-event', { method: 'POST', body: new FormData(this) })
        .then(r => r.json()).then(data => {
            alert(data.message);
            if(data.status === 'success') { resetForm(); calendar.refetchEvents(); }
        });
    };

    // 2. Suppression
    deleteBtn.onclick = function() {
        const id = document.getElementById('event_id').value;
        if(confirm("Supprimer ?")) {
            fetch('index.php?page=delete-event', {
                method: 'POST',
                headers: {'Content-Type': 'application/json'},
                body: JSON.stringify({id: id})
            }).then(() => { resetForm(); calendar.refetchEvents(); });
        }
    };

    cancelBtn.onclick = resetForm;

    function resetForm() {
        form.reset();
        document.getElementById('event_id').value = "";
        document.getElementById('deleteBtn').style.display = "none";
        document.getElementById('cancelBtn').style.display = "none";
        document.getElementById('submitBtn').innerText = "Enregistrer l'événement";
    }
});
</script>