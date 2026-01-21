<?php
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
                    
                    <td class="clickable-msg" onclick="openModal('<?= addslashes(htmlspecialchars($m->getNom())) ?>', '<?= addslashes(htmlspecialchars($m->getContenu())) ?>')">
                        <div class="msg-preview">
                            <?= htmlspecialchars(mb_strimwidth($m->getContenu(), 0, 50, "...")) ?>
                        </div>
                        <span class="read-hint">Lire...</span>
                    </td>

                    <td>
                        <a href="mailto:<?= $m->getEmail() ?>?subject=Réponse : <?= $m->getCategorie() ?>" 
                           class="btn-reply" onclick="markAsRead(<?= $m->getIdMessage() ?>)">
                           Répondre
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<div id="messageModal" class="admin-modal">
    <div class="modal-content">
        <span class="close-btn" onclick="closeModal()">&times;</span>
        <h3 id="modalTitle">Message</h3>
        <hr>
        <div id="modalBody" class="modal-body"></div>
    </div>
</div>

<script>
// Fonction pour ouvrir la modale
function openModal(sender, content) {
    document.getElementById('modalTitle').innerText = "Message de " + sender;
    document.getElementById('modalBody').innerText = content;
    document.getElementById('messageModal').style.display = "flex";
}

// Fonction pour fermer la modale
function closeModal() {
    document.getElementById('messageModal').style.display = "none";
}

// Fermer si on clique en dehors de la fenêtre blanche
window.onclick = function(event) {
    const modal = document.getElementById('messageModal');
    if (event.target == modal) {
        closeModal();
    }
}

function markAsRead(id) {
    const formData = new FormData();
    formData.append('id_message', id);
    fetch('index.php?page=mark-message-treated', {
        method: 'POST',
        body: formData
    }).then(() => {
        setTimeout(() => { location.reload(); }, 1000);
    });
}
</script>