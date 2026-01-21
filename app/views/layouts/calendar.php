<div id="eventModal" class="custom-modal" style="display:none;">
    <div class="modal-content">
        <span class="close-modal">&times;</span>
        <div class="modal-body">
            <h2 id="modalTitle"></h2>
            <div class="modal-grid">
                <div class="modal-image-container">
                    <img id="modalImage" src="" alt="Affiche événement">
                </div>
                <div class="modal-info">
                    <p><strong>📅 Date :</strong> <span id="modalDate"></span> à <span id="modalHour"></span></p>
                    <p><strong>📍 Lieu :</strong> <span id="modalPlace"></span></p>
                    <p><strong>🏷️ Type :</strong> <span id="modalType"></span></p>
                    <hr>
                    <p id="modalDescription"></p>
                    <a id="modalPdf" href="#" class="btn-pdf" target="_blank">📄 Voir le programme (PDF)</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="calendar-container">
    <div id="calendar"></div>
</div>

<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js"></script>

<script>
var calendar;

document.addEventListener('DOMContentLoaded', function() {
    var calendarElement = document.getElementById('calendar');
    
    calendar = new FullCalendar.Calendar(calendarElement, {
        initialView: window.innerWidth < 768 ? 'listWeek' : 'dayGridMonth',
        locale: 'fr',
        eventOverlap: false, // EMPECHE LES COLLISIONS
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,listWeek'
        },
        events: 'index.php?page=events-json', 
        
        eventClick: function(info) {
            const event = info.event;
            const props = event.extendedProps;

            // SI ZONE BLOQUÉE
            if (event.display === 'background') {
                alert("Ce créneau est verrouillé : " + (event.title || "Indisponible"));
                return;
            }

            const adminForm = document.getElementById('addEventForm');

            if (adminForm) {
                document.getElementById('event_id').value = event.id;
                document.getElementById('f_titre').value = event.title;
                const startParts = event.startStr.split('T');
                document.getElementById('f_date').value = startParts[0];
                if (startParts[1]) document.getElementById('f_heure').value = startParts[1].substring(0, 5);
                document.getElementById('f_lieu').value = props.place || "";
                document.getElementById('f_desc').value = props.description || "";
                
                document.getElementById('formTitle').innerText = "Modifier l'événement";
                document.getElementById('submitBtn').innerText = "Enregistrer les modifications";
                document.getElementById('cancelBtn').style.display = "block";
                if(document.getElementById('deleteBtn')) document.getElementById('deleteBtn').style.display = "block";
                
                document.querySelector('.admin-sidebar').scrollIntoView({ behavior: 'smooth' });
            } 
            else {
                // ... (Reste de ta modal visiteur inchangée) ...
            }
        }
    });
    calendar.render();
});
</script>