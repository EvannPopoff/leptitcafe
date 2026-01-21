<link rel="stylesheet" href="assets/css/contact.css">

<section class="contact-section">
    <div class="container">
        <h2 class="contact-main-title">Contactez-nous</h2>

        <?php if (isset($_GET['res'])): ?>
            <div style="padding:15px; margin-bottom:20px; border-radius:5px; background:<?= $_GET['res']=='success'?'#d4edda':'#f8d7da' ?>; color:<?= $_GET['res']=='success'?'#155724':'#721c24' ?>;">
                <?= $_GET['res'] == 'success' ? "Votre message a été envoyé avec succès !" : "Erreur lors de l'envoi du message." ?>
            </div>
        <?php endif; ?>

        <form action="index.php?page=send-message" method="POST" class="actual-form">
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

            <div class="form-row" style="display: flex; gap: 15px;">
                <div class="form-group" style="flex: 1;">
                    <label>Email</label>
                    <input type="email" name="email" required>
                </div>
                <div class="form-group" style="flex: 1;">
                    <label>Téléphone</label>
                    <input type="tel" name="telephone">
                </div>
            </div>

            <div class="form-group">
                <label>Sujet</label>
                <select name="categorie" required style="width:100%; padding:10px; border:1px solid #ccc;">
                    <option value="Information">Demande d'information</option>
                    <option value="Adhésion">Question sur l'adhésion</option>
                    <option value="Autre">Autre</option>
                </select>
            </div>

            <div class="form-group">
                <label>Message</label>
                <textarea name="contenu" rows="5" required></textarea>
            </div>

            <button type="submit" class="contact-submit-btn">Envoyer mon message</button>
        </form>
    </div>
</section>