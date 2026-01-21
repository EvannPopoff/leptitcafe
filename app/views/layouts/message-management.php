<?php
// On initialise le manager (le $db vient de la page qui inclut ce layout)
$msgManager = new app\models\managers\MessageManager($db);
$allMessages = $msgManager->findAll();
?>

<div class="messages-card">
    <table class="messages-table">
        <thead>
            <tr>
                <th>Statut</th>
                <th>Date</th>
                <th>Expéditeur</th>
                <th>Sujet</th>
                <th>Message</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($allMessages as $m): ?>
                <?php $isNew = ($m->getStatut() === 0); ?>
                <tr class="<?= $isNew ? 'row-new' : 'row-treated' ?>">
                    <td>
                        <span class="badge <?= $isNew ? 'badge-red' : 'badge-green' ?>">
                            <?= $isNew ? 'Nouveau' : 'Traité' ?>
                        </span>
                    </td>
                    <td><?= date('d/m H:i', strtotime($m->getDateEnvoi())) ?></td>
                    <td>
                        <strong><?= htmlspecialchars($m->getNom()) ?></strong><br>
                        <small><?= htmlspecialchars($m->getEmail()) ?></small>
                    </td>
                    <td><?= htmlspecialchars($m->getCategorie()) ?></td>
                    <td><div class="msg-preview" title="<?= htmlspecialchars($m->getContenu()) ?>">
                        <?= htmlspecialchars($m->getContenu()) ?>
                    </div></td>
                    <td>
                        <a href="mailto:<?= $m->getEmail() ?>?subject=Réponse : <?= $m->getCategorie() ?>" 
                           class="btn-reply" 
                           onclick="markAsRead(<?= $m->getIdMessage() ?>)">
                           Répondre
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script>
function markAsRead(id) {
    const formData = new FormData();
    formData.append('id_message', id);

    fetch('index.php?page=mark-message-treated', {
        method: 'POST',
        body: formData
    }).then(() => {
        // On recharge la vue après 1s pour voir le changement de couleur
        setTimeout(() => { location.reload(); }, 1000);
    });
}
</script>