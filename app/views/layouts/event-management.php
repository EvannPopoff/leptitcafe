DÉBUT DU FORMULAIRE TEST

<form id="addEventForm" enctype="multipart/form-data">
    <input type="hidden" name="id" id="event_id">

    <div class="form-group">
        <label>Titre</label>
        <input type="text" name="titre" id="f_titre" required>
    </div>

    <div class="form-row">
        <div class="form-group">
            <label>Date</label>
            <input type="date" name="date_evenement" id="date_evenement" required>
        </div>
        <div class="form-group">
            <label>Heure</label>
            <input type="time" name="heure" id="heure" required>
        </div>
    </div>

    <div class="form-group">
        <label>Lieu</label>
        <input type="text" name="lieu" id="lieu">
    </div>

    <div class="form-group">
        <label>Description</label>
        <textarea name="description" id="description" rows="3"></textarea>
    </div>

    <div class="form-group">
        <label>Image</label>
        <input type="file" name="image_event" accept="image/*">
    </div>

    <div class="form-group">
        <label>
            <input type="checkbox" name="mis_en_avant" id="mis_en_avant" value="1"> Mettre en avant
        </label>
    </div>

    <div class="form-actions" style="margin-top: 20px;">
        <button type="submit" id="submitBtn" class="btn-submit">Enregistrer l'événement</button>
        
        <button type="button" id="deleteBtn" class="btn-danger" style="display:none; width:100%; margin-top:10px; background-color: #d9534f; color: white; border: none; padding: 10px; border-radius: 5px; cursor: pointer;">
            Supprimer l'événement
        </button>
        
        <button type="button" id="cancelBtn" class="btn-secondary" style="display:none; width:100%; margin-top:5px; padding: 8px; border-radius: 5px; cursor: pointer;">
            Annuler la sélection
        </button>
    </div>
</form>