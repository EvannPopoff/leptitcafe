<div class="contact-form-wrapper">
    <h2 class="contact-main-title">Contactez-nous</h2>
    <div id="contactFeedback" style="display:none; padding: 15px; margin-bottom: 20px; border-radius: 5px;"></div>

    <form class="actual-form" id="contactForm" method="POST" action="index.php?page=send-message">
        <div class="form-row" style="display: flex; gap: 15px;">
            <div class="form-group" style="flex: 1;">
                <label>Prénom</label>
                <input type="text" name="firstname" required>
            </div>
            <div class="form-group" style="flex: 1;">
                <label>Nom</label>
                <input type="text" name="lastname" required>
            </div>
        </div>

        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" required>
        </div>

        <div class="form-group">
            <label>Sujet</label>
            <select name="categorie" required style="width:100%; padding:10px;">
                <option value="Information">Information</option>
                <option value="Adhésion">Adhésion</option>
            </select>
        </div>

        <div class="form-group">
            <label>Message</label>
            <textarea name="contenu" required></textarea>
        </div>

        <button type="submit" id="contactSubmit" class="contact-submit-btn">Envoyer</button>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('contactForm');
    
    if (!form) {
        console.error("ERREUR CRITIQUE : Le formulaire #contactForm est introuvable dans le DOM !");
        return;
    }

    form.addEventListener('submit', function(e) {
        // ON BLOQUE L'ENVOI CLASSIQUE (L'URL NE DOIT PLUS BOUGER)
        e.preventDefault();
        console.log("Envoi AJAX lancé...");

        const btn = document.getElementById('contactSubmit');
        const feedback = document.getElementById('contactFeedback');
        
        btn.disabled = true;
        btn.innerText = "Chargement...";

        const formData = new FormData(this);

        fetch('index.php?page=send-message', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            console.log("Réponse reçue du serveur");
            return response.json();
        })
        .then(data => {
            feedback.style.display = 'block';
            feedback.innerText = data.message;
            feedback.style.backgroundColor = (data.status === 'success') ? '#d4edda' : '#f8d7da';
            if (data.status === 'success') form.reset();
        })
        .catch(error => {
            console.error('Erreur Fetch:', error);
            alert("Erreur technique : vérifiez la console (F12)");
        })
        .finally(() => {
            btn.disabled = false;
            btn.innerText = "Envoyer";
        });
    });
});
</script>