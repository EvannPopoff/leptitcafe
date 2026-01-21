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
        initialView: 'dayGridMonth',
        locale: 'fr',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,listWeek'
        },
        buttonText: {
            today: "Aujourd'hui", month: "Mois", week: "Semaine", list: "Planning"
        },
        events: 'index.php?page=events-json', 
        
        eventClick: function(info) {
            const event = info.event;
            const props = event.extendedProps;
            const adminForm = document.getElementById('addEventForm');

            // Mode admin
            if (adminForm) {
                document.getElementById('event_id').value = event.id;
                document.getElementById('f_titre').value = event.title;
                
                const startParts = event.startStr.split('T');
                document.getElementById('f_date').value = startParts[0];
                if (startParts[1]) {
                    document.getElementById('f_heure').value = startParts[1].substring(0, 5);
                }

                document.getElementById('f_lieu').value = props.place || "";
                document.getElementById('f_desc').value = props.description || "";
                if(document.getElementById('f_top')) {
                    document.getElementById('f_top').checked = (props.top_event == true);
                }

                document.getElementById('submitBtn').innerText = "Enregistrer les modifications";
                document.getElementById('cancelBtn').style.display = "block";
                document.getElementById('formTitle').innerText = "Modifier l'événement";
                
                // On remonte pour voir le formulaire
                document.querySelector('.admin-sidebar').scrollIntoView({ behavior: 'smooth' });
            } 
            
            // Mode visiteur
            else {
                document.getElementById('modalTitle').innerText = event.title;
                document.getElementById('modalDescription').innerText = props.description || "Aucune description.";
                document.getElementById('modalPlace').innerText = props.place || "Non précisé";
                document.getElementById('modalType').innerText = props.type || "Non précisé";
                document.getElementById('modalDate').innerText = event.start.toLocaleDateString('fr-FR');
                document.getElementById('modalHour').innerText = event.start.toLocaleTimeString('fr-FR', {hour: '2-digit', minute:'2-digit'});

                // Gestion Image
                const imgTag = document.getElementById('modalImage');
                if (props.image_url && props.image_url !== "null" && props.image_url !== "") {
                    imgTag.src = "assets/images/events/" + props.image_url;
                    document.querySelector('.modal-image-container').style.display = 'block';
                } else {
                    document.querySelector('.modal-image-container').style.display = 'none';
                }

                // Gestion PDF
                const pdfBtn = document.getElementById('modalPdf');
                if (props.prog_url) {
                    pdfBtn.style.display = 'inline-block';
                    pdfBtn.href = "assets/pdf/" + props.prog_url;
                } else {
                    pdfBtn.style.display = 'none';
                }

                document.getElementById('eventModal').style.display = 'block';
            }
        }
    });

    calendar.render();

    // Fermeture de la pop-up
    const closeBtn = document.querySelector('.close-modal');
    if(closeBtn) {
        closeBtn.onclick = function() {
            document.getElementById('eventModal').style.display = 'none';
        };
    }
    window.onclick = function(event) {
        const modal = document.getElementById('eventModal');
        if (event.target == modal) { modal.style.display = 'none'; }
    };
});
</script>