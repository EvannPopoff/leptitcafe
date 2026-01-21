<div id="calendar-container">
    <div id="calendar"></div>
</div>

<div id="eventModal" class="custom-modal" style="display:none;">
    </div>

<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js"></script>

<script>
var calendar;

document.addEventListener('DOMContentLoaded', function() {
    var calendarElement = document.getElementById('calendar');
    
    calendar = new FullCalendar.Calendar(calendarElement, {
        initialView: 'dayGridMonth',
        locale: 'fr',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek'
        },
        buttonText: {
            today: "Aujourd'hui",
            month: "Mois",
            week: "Semaine"
        },
        
        events: 'index.php?page=events-json', 
        
        // Une seule fonction eventclick
        eventClick: function(info) {
            const event = info.event;
            const props = event.extendedProps;

            // Remplissage du formulaire de modification (Admin)
            // On vérifie que les éléments existent avant de les remplir
            if (document.getElementById('event_id')) {
                document.getElementById('event_id').value = event.id;
                document.getElementById('f_titre').value = event.title;
                
                // Gestion de la date et l'heure
                if (event.startStr.includes('T')) {
                    const parts = event.startStr.split('T');
                    document.getElementById('f_date').value = parts[0];
                    document.getElementById('f_heure').value = parts[1].substring(0, 5);
                } else {
                    document.getElementById('f_date').value = event.startStr;
                }

                // extendedProps (Attention : vérifie les noms dans ton JSON)
                if (document.getElementById('f_lieu')) document.getElementById('f_lieu').value = props.place || "";
                if (document.getElementById('f_desc')) document.getElementById('f_desc').value = event.extendedProps.description || props.desc || "";
                if (document.getElementById('f_top')) document.getElementById('f_top').checked = (props.top_event == 1);

                // Mise à jour visuelle des boutons
                document.getElementById('submitBtn').innerText = "Modifier l'événement";
                document.getElementById('cancelBtn').style.display = "block";
                if (document.getElementById('deleteBtn')) document.getElementById('deleteBtn').style.display = "block";
                
                // Optionnel : remonter vers le formulaire sur mobile
                document.querySelector('.admin-sidebar').scrollIntoView({ behavior: 'smooth' });
            }

            
               
               document.getElementById('modalTitle').innerText = event.title;
               document.getElementById('modalDescription').innerText = props.description || "Aucune description.";
               document.getElementById('eventModal').style.display = 'block';
            
        }
    });

    calendar.render();

    // Fermeture de la pop-up (si utilisée)
    const closeModal = document.querySelector('.close-modal');
    if (closeModal) {
        closeModal.onclick = function() {
            document.getElementById('eventModal').style.display = 'none';
        };
    }
});
</script>