<link rel="stylesheet" href="assets/css/contact.css">

<section class="contact-section">
    <div class="container">
        <div class="contact-grid">
            
            <div class="contact-form-wrapper">
                <h2 class="contact-main-title">Contact us</h2>
                <p class="contact-description">Prenez contact avec nous par téléphone, en ligne ou directement au P’tit Café.</p>

                <?php if (isset($_GET['res'])): ?>
                    <div style="padding: 15px; margin-bottom: 20px; border-radius: 5px; 
                         background-color: <?= $_GET['res'] === 'success' ? '#d4edda' : '#f8d7da' ?>; 
                         color: <?= $_GET['res'] === 'success' ? '#155724' : '#721c24' ?>;
                         border: 1px solid <?= $_GET['res'] === 'success' ? '#c3e6cb' : '#f5c6cb' ?>;">
                        <?= $_GET['res'] === 'success' ? "Votre message a bien été envoyé !" : "Une erreur est survenue lors de l'envoi." ?>
                    </div>
                <?php endif; ?>

                <form class="actual-form" action="index.php?page=send-message" method="POST">
                    <input type="hidden" name="categorie" value="Contact Site">

                    <div class="form-group">
                        <label for="name">Prénom</label>
                        <input type="text" id="name" name="firstname" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="surname">Nom</label>
                        <input type="text" id="surname" name="lastname" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" required>
                    </div>

                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea id="message" name="contenu" placeholder="Type your message..." required></textarea>
                    </div>

                    <div class="form-checkbox">
                        <input type="checkbox" id="terms" required>
                        <label for="terms">I accept the <u>Terms</u></label>
                    </div>

                    <button type="submit" class="contact-submit-btn">Submit</button>
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
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2816.516428753232!2d3.8837373!3d45.0448834!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47f5fa45388c34f3%3A0xc69678170d1e1f98!2s25%20Pl.%20du%20March%C3%A9%20Couvert%2C%2043000%20Le%20Puy-en-Velay!5e0!3m2!1sfr!2sfr!4v1700000000000!5m2!1sfr!2sfr" 
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