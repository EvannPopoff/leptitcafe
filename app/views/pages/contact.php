<section class="contact-section">
    <div class="container">
        <h2 style="color:red;">TEST VERSION 2 - SI TU NE VOIS PAS CE TEXTE ROUGE, VIDE TON CACHE</h2>
        
        <?php if (isset($_GET['res'])): ?>
            <div style="padding:15px; background:<?= $_GET['res']=='success'?'#d4edda':'#f8d7da' ?>;">
                <?= $_GET['res']=='success' ? "Message envoyé !" : "Erreur lors de l'envoi." ?>
            </div>
        <?php endif; ?>

        <form action="index.php?page=send-message&v=2" method="POST" class="actual-form">
            <div class="form-group">
                <label>Prénom</label>
                <input type="text" name="prenom_test" required>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email_test" required>
            </div>
            <div class="form-group">
                <label>Message</label>
                <textarea name="message_test" required></textarea>
            </div>
            <button type="submit">Envoyer (Version Standard)</button>
        </form>
    </div>
</section>