<div id="calendar-container">
        <div id="calendar"></div>
    </div>
</div>

<div id="eventModal" class="custom-modal">
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

<!-- FullCalendar JS et initialisation -->

<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js"></script>

<script>
// Icones utiles pour le calendrier : 📅📍🏷️📄
// Tout trouvable dans la doc officielle : https://fullcalendar.io/docs
// Initialisation du calendrier
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    
    var calendar = new FullCalendar.Calendar(calendarEl, {
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
        
        // -Connexion au JSON
        events: 'index.php?page=events-json', 
        
        // Lorsqu'on clique
        eventClick: function(info) {
            const event = info.event;
            const props = event.extendedProps;

            // Remplissage de la pop-up
            document.getElementById('modalTitle').innerText = event.title;
            document.getElementById('modalDescription').innerText = props.description || "Aucune description.";
            document.getElementById('modalPlace').innerText = props.place || "Non précisé";
            document.getElementById('modalType').innerText = props.type || "Non précisé";
            
            // Formatage de la date
            document.getElementById('modalDate').innerText = event.start.toLocaleDateString('fr-FR');
            document.getElementById('modalHour').innerText = event.start.toLocaleTimeString('fr-FR', {hour: '2-digit', minute:'2-digit'});

            // Image
            const imgTag = document.getElementById('modalImage');
            imgTag.src = props.image_url
                ? "assets/images/events/" + props.image_url
                : "assets/images/tagada.jpg";

            // PDF
            const pdfBtn = document.getElementById('modalPdf');
            if (props.prog_url) {
                pdfBtn.style.display = 'inline-block';
                pdfBtn.href = "assets/pdf/" + props.prog_url;
            } else {
                pdfBtn.style.display = 'none';
            }

            // Affichage
            document.getElementById('eventModal').style.display = 'block';
        }
    });

    calendar.render();

    // Fermeture de la pop-up
    document.querySelector('.close-modal').onclick = function() {
        document.getElementById('eventModal').style.display = 'none';
    };
    window.onclick = function(event) {
        if (event.target == document.getElementById('eventModal')) {
            document.getElementById('eventModal').style.display = 'none';
        }
    };
});
</script>