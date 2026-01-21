<link rel="stylesheet" href="assets/css/contact.css">
<section class="contact-section">
    <div class="container">
        <div class="contact-grid">
            
                        <div class="contact-form-wrapper">
                <h2 class="contact-main-title">Contactez-nous</h2>
                <p class="contact-description">Prenez contact avec nous par téléphone, en ligne ou directement au P’tit Café.</p>

                <div id="contactFeedback" style="display:none; padding: 15px; margin-bottom: 20px; border-radius: 5px;"></div>

                <form class="actual-form" id="contactForm">
                    <div class="form-row" style="display: flex; gap: 15px;">
                        <div class="form-group" style="flex: 1;">
                            <label for="name">Prénom</label>
                            <input type="text" id="name" name="firstname" required>
                        </div>
                        <div class="form-group" style="flex: 1;">
                            <label for="surname">Nom</label>
                            <input type="text" id="surname" name="lastname" required>
                        </div>
                    </div>

                    <div class="form-row" style="display: flex; gap: 15px;">
                        <div class="form-group" style="flex: 1;">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" required>
                        </div>
                        <div class="form-group" style="flex: 1;">
                            <label for="telephone">Téléphone (Optionnel)</label>
                            <input type="tel" id="telephone" name="telephone">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="categorie">Sujet de votre message</label>
                        <select id="categorie" name="categorie" required style="width: 100%; padding: 10px; border-radius: 5px; border: 1px solid #ddd;">
                            <option value="Information">Demande d'information</option>
                            <option value="Adhésion">Question sur l'adhésion</option>
                            <option value="Événement">À propos d'un événement</option>
                            <option value="Autre">Autre</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea id="message" name="contenu" placeholder="Comment pouvons-nous vous aider ?" required></textarea>
                    </div>

                    <div class="form-checkbox">
                        <input type="checkbox" id="terms" required>
                        <label for="terms">J'accepte les conditions d'utilisation</label>
                    </div>

                    <button type="submit" class="contact-submit-btn" id="contactSubmit">Envoyer le message</button>
                </form>
            </div>

            <div class="contact-details">
                <div class="detail-item">
                    <div class="detail-icon">✉️</div>
                    <div class="detail-text">
                        <strong>Email</strong>
                        <p>cafejeunespousses[at]gmail.com</p>
                    </div>
                </div>
                <div class="detail-item">
    <div class="detail-icon">🕒</div>
    <div class="detail-text">
        <strong>Horaires</strong>
        <p>
            Mercredi : 10:00 – 18:00<br>
            Vendredi : 10:00 – 12:00<br>
            Samedi : 10:00 – 14:00<br>
        </p>
    </div>
</div>

                <div class="detail-item">
                    <div class="detail-icon">📞</div>
                    <div class="detail-text">
                        <strong>Téléphone</strong>
                        <p>07 78 68 53 37</p>
                    </div>
                </div>

                <div class="detail-item">
                    <div class="detail-icon">📍</div>
                    <div class="detail-text">
                        <strong>Adresse</strong>
                        <p>25 Place Du Marché Couvert<br>43000 Le Puy-en-Velay</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<section class="map-section">
    <div class="container">
        <div class="map-wrapper">
            <h2 class="map-title">Retrouvez-nous</h2>
            
            <div class="map-container">
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2813.245848243444!2d3.8824360767073245!3d45.045330861019014!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47f5fa57df8442a5%3A0x7d06637150c9f13e!2s25%20Pl.%20du%20March%C3%A9%20Couvert%2C%2043000%20Le%20Puy-en-Velay!5e0!3m2!1sfr!2sfr!4v1705592000000!5m2!1sf!2sfr" 
                    width="100%" 
                    height="450" 
                    style="border:0;" 
                    allowfullscreen="" 
                    loading="lazy" 
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
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
            e.preventDefault();

            // UI : On montre qu'on traite l'envoi
            submitBtn.disabled = true;
            submitBtn.innerText = "Envoi en cours...";

            const formData = new FormData(this);

            fetch('index.php?page=send-message', { // Assure-toi d'ajouter ce cas dans ton index.php
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                feedback.style.display = 'block';
                feedback.innerText = data.message;
                
                if (data.status === 'success') {
                    feedback.style.backgroundColor = '#d4edda';
                    feedback.style.color = '#155724';
                    contactForm.reset(); // On vide le formulaire
                } else {
                    feedback.style.backgroundColor = '#f8d7da';
                    feedback.style.color = '#721c24';
                }
            })
            .catch(error => {
                console.error('Erreur:', error);
                alert("Une erreur technique est survenue.");
            })
            .finally(() => {
                submitBtn.disabled = false;
                submitBtn.innerText = "Envoyer le message";
            });
        });
    }
});
</script>