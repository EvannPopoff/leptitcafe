<div id="calendar"></div>

<script>
var calendar; // Variable globale pour être accessible par les autres scripts

document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        locale: 'fr',
        firstDay: 1, // Semaine commence le lundi
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,listWeek'
        },
        buttonText: {
            today: "Aujourd'hui",
            month: "Mois",
            week: "Semaine",
            list: "Liste"
        },
        
        // Source des données JSON
        events: 'index.php?page=events-json',

        // --- ACTION AU CLIC SUR UN ÉVÉNEMENT ---
        eventClick: function(info) {
            var event = info.event;

            // 1. On remplit les champs du formulaire (Vérifie bien que ces IDs existent dans event-management.php)
            var idField = document.getElementById('event_id');
            var titreField = document.getElementById('f_titre');
            var dateField = document.getElementById('date_evenement');
            var heureField = document.getElementById('heure');
            var lieuField = document.getElementById('lieu');
            var descField = document.getElementById('description');
            var avantField = document.getElementById('mis_en_avant');

            if (idField) idField.value = event.id;
            if (titreField) titreField.value = event.title;
            
            // Formatage de la date (YYYY-MM-DD)
            if (dateField) dateField.value = event.startStr.split('T')[0];

            // Récupération des données étendues (provenant de ton JSON)
            if (event.extendedProps) {
                if (heureField) heureField.value = event.extendedProps.heure || "";
                if (lieuField) lieuField.value = event.extendedProps.lieu || "";
                if (descField) descField.value = event.extendedProps.description || "";
                if (avantField) avantField.checked = (event.extendedProps.mis_en_avant == 1);
            }

            // 2. Mise à jour visuelle des boutons du dashboard
            var submitBtn = document.getElementById('submitBtn');
            var deleteBtn = document.getElementById('deleteBtn');
            var cancelBtn = document.getElementById('cancelBtn');
            var formTitle = document.getElementById('formTitle');

            if (submitBtn) submitBtn.innerText = "Modifier l'événement";
            if (deleteBtn) deleteBtn.style.display = "block";
            if (cancelBtn) cancelBtn.style.display = "block";
            if (formTitle) formTitle.innerText = "Modifier l'événement";

            // 3. Scroll automatique vers le formulaire sur mobile
            document.querySelector('.admin-sidebar').scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
    });

    calendar.render();
});
</script>