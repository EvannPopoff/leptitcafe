<form id="addEventForm" enctype="multipart/form-data">
    <div class="form-group">
        <label>Titre</label>
        <input type="text" name="titre" required>
    </div>
    <div class="form-row">
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
        <textarea name="description" rows="3"></textarea>
    </div>
    <div class="form-group">
        <label>Image</label>
        <input type="file" name="image_event" accept="image/*">
    </div>
    <div class="form-group">
        <label>
            <input type="checkbox" name="mis_en_avant" value="1"> Mettre en avant
        </label>
    </div>
    <button type="submit" id="submitBtn" class="btn-submit">Enregistrer l'événement</button>
</form>