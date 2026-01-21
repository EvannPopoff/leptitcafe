<link rel="stylesheet" href="assets/css/contact.css">

<section class="contact-section">
    <div class="container">
        <div class="contact-grid">
            <div class="contact-form-wrapper">
                <h2 class="contact-main-title">Contactez-nous</h2>
                <p class="contact-description">Prenez contact avec nous par téléphone ou en ligne.</p>

                <div id="contactFeedback" style="display:none; padding: 15px; margin-bottom: 20px; border-radius: 5px;"></div>

                <form class="actual-form" id="contactForm" method="POST">
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
                        <select name="categorie" style="width: 100%; padding: 10px; border-radius: 5px; border: 1px solid #ddd;">
                            <option value="Information">Information</option>
                            <option value="Adhésion">Adhésion</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Message</label>
                        <textarea name="contenu" required></textarea>
                    </div>

                    <div class="form-checkbox">
                        <input type="checkbox" id="terms" required>
                        <label for="terms">J'accepte les conditions</label>
                    </div>

                    <button type="submit" id="contactSubmit" class="contact-submit-btn">Envoyer</button>
                </form>
            </div>
            
            </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const contactForm = document.getElementById('contactForm');
    const feedback = document.getElementById('contactFeedback');
    const submitBtn = document.getElementById('contactSubmit');

    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            // C'EST CETTE LIGNE QUI EMPÊCHE LE LIEN BIZARRE DANS L'URL
            e.preventDefault(); 
            
            submitBtn.disabled = true;
            submitBtn.innerText = "Envoi...";

            const formData = new FormData(this);

            fetch('index.php?page=send-message', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                feedback.style.display = 'block';
                feedback.innerText = data.message;
                feedback.style.backgroundColor = (data.status === 'success') ? '#d4edda' : '#f8d7da';
                if (data.status === 'success') contactForm.reset();
            })
            .catch(error => {
                console.error('Erreur:', error);
                alert("Erreur de connexion au serveur.");
            })
            .finally(() => {
                submitBtn.disabled = false;
                submitBtn.innerText = "Envoyer";
            });
        });
    } else {
        console.error("ERREUR : Le formulaire avec l'ID 'contactForm' est introuvable !");
    }
});
</script>