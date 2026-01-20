<?php
// On vérifie si l'admin est connecté
if (!isset($_SESSION['admin_id'])) {
    // Si non, on le renvoie vers la page de login
    header('Location: index.php?page=login');
    exit();
}
?>

<h2>Ajouter un nouvel événement</h2>

<form action="index.php?page=save-event" method="POST" enctype="multipart/form-data" class="admin-form"> <!-- enctype pour l'upload d'images -->
    <div class="form-group">
        <label>Titre de l'événement</label>
        <input type="text" name="titre" required>
    </div>

    <div class="form-grid">
        <div class="form-group">
            <label>Date</label>
            <input type="date" name="date_evenement" required>
        </div>
        <div class="form-group">
            <label>Heure</label>
            <input type="time" name="heure" required>
        </div>
    </div>

    <div class="form-group">
        <label>Lieu</label>
        <input type="text" name="lieu">
    </div>

    <div class="form-group">
        <label>Description</label>
        <textarea name="description" rows="4"></textarea>
    </div>

    <div class="form-group">
        <label>Image d'illustration</label>
        <input type="file" name="image_event" accept="image/*">
    </div>

    <div class="form-group">
        <label>
            <input type="checkbox" name="mis_en_avant" value="1"> Mettre en avant cet événement
        </label>
    </div>

    <button type="submit" class="btn-submit">Enregistrer l'événement</button>
</form>