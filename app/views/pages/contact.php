<link rel="stylesheet" href="assets/css/contact.css">

<section class="contact-section">
    <div class="container">
        <div class="contact-form-wrapper">
            <h2 class="contact-main-title">Contactez-nous</h2>
            
            <?php if (isset($_GET['res'])): ?>
                <div style="padding: 15px; margin-bottom: 20px; border-radius: 5px; 
                     background-color: <?= $_GET['res'] === 'success' ? '#d4edda' : '#f8d7da' ?>; 
                     color: <?= $_GET['res'] === 'success' ? '#155724' : '#721c24' ?>;">
                    <?= $_GET['res'] === 'success' ? "Merci ! Votre message a bien été envoyé." : "Erreur : " . htmlspecialchars($_GET['msg']) ?>
                </div>
            <?php endif; ?>

            <form class="actual-form" action="index.php?page=send-message" method="POST">
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
                    <select name="categorie" required style="width: 100%; padding: 10px;">
                        <option value="Information">Information</option>
                        <option value="Adhésion">Adhésion</option>
                        <option value="Autre">Autre</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Message</label>
                    <textarea name="contenu" required></textarea>
                </div>

                <button type="submit" class="contact-submit-btn">Envoyer le message</button>
            </form>
        </div>
        </div>
</section>