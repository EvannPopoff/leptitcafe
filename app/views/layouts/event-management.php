<form id="addEventForm" enctype="multipart/form-data">
    <input type="hidden" name="id" id="event_id">

    <div class="form-group">
        <label>Titre</label>
        <input type="text" name="titre" id="f_titre" required>
    </div>

    <div class="form-row">
        <div class="form-group">
            <label>Date</label>
            <input type="date" name="date_evenement" id="f_date" required>
        </div>
        <div class="form-group">
            <label>Heure</label>
            <input type="time" name="heure" id="f_heure" required>
        </div>
    </div>

    <div class="form-group">
        <label>Lieu</label>
        <input type="text" name="lieu" id="f_lieu">
    </div>

    <div class="form-group">
        <label>Description</label>
        <textarea name="description" id="f_desc" rows="3"></textarea>
    </div>

    <div class="form-group">
        <label>Image</label>
        <input type="file" name="image_event" id="f_img" accept="image/*">
    </div>

    <div class="form-group">
        <label>
            <input type="checkbox" name="mis_en_avant" id="f_top" value="1"> Mettre en avant
        </label>
    </div>

    <div class="form-actions" style="margin-top: 20px; display: flex; flex-direction: column; gap: 10px;">
        <button type="submit" id="submitBtn" class="btn-submit">Enregistrer l'événement</button>
        
        <button type="button" id="cancelBtn" class="btn-secondary" style="display:none; background: #6c757d; color: white; border: none; padding: 10px; border-radius: 5px; cursor: pointer;">
            Annuler la modification
        </button>
    </div>
</form>