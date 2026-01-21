<?php
// Dans dashboard.php, on récupère les messages
$msgManager = new app\models\managers\MessageManager($db);
$allMessages = $msgManager->findAll();
?>

<section class="messages-section">
    <h2>📬 Messages reçus</h2>
    <div class="table-responsive">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Expéditeur</th>
                    <th>Catégorie</th>
                    <th>Statut</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($allMessages as $m): ?>
                <tr class="<?= $m->getStatut() === 0 ? 'new-msg' : 'read-msg' ?>">
                    <td><?= date('d/m H:i', strtotime($m->getDateEnvoi())) ?></td>
                    <td><strong><?= htmlspecialchars($m->getNom()) ?></strong><br><small><?= $m->getEmail() ?></small></td>
                    <td><?= htmlspecialchars($m->getCategorie()) ?></td>
                    <td><?= $m->getStatut() === 0 ? '🔴 Nouveau' : '🟢 Traité' ?></td>
                    <td>
                        <a href="mailto:<?= $m->getEmail() ?>?subject=Réponse à votre message (<?= $m->getCategorie() ?>)" 
                           class="btn-reply" 
                           onclick="markMessageRead(<?= $m->getIdMessage() ?>)">
                           Répondre
                        </a>
                    </td>
                </tr>
                <tr class="msg-content">
                    <td colspan="5">
                        <p><em>Message :</em> <?= nl2br(htmlspecialchars($m->getContenu())) ?></p>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>

<script>
// Fonction pour mettre à jour le statut en base quand on clique sur "Répondre"
function markMessageRead(id) {
    const formData = new FormData();
    formData.append('id', id);
    
    fetch('index.php?page=mark-message-read', {
        method: 'POST',
        body: formData
    }).then(() => {
        // Optionnel : recharger ou griser la ligne. Pratique
    });
}
</script>