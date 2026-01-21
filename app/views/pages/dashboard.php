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
                <?php 
                    // Sécurité : On vérifie si $m est un objet ou un tableau
                    $statut = is_object($m) ? $m->getStatut() : $m['statut'];
                    $nom = is_object($m) ? $m->getNom() : $m['nom'];
                    $email = is_object($m) ? $m->getEmail() : $m['email'];
                    $cat = is_object($m) ? $m->getCategorie() : $m['categorie'];
                    $date = is_object($m) ? $m->getDateEnvoi() : $m['date_envoi'];
                    $contenu = is_object($m) ? $m->getContenu() : $m['contenu'];
                    $id = is_object($m) ? $m->getIdMessage() : $m['id_message'];
                ?>
                <tr class="<?= $statut == 0 ? 'row-new' : 'row-treated' ?>">
                    <td>
                        <span class="badge <?= $statut == 0 ? 'badge-red' : 'badge-green' ?>">
                            <?= $statut == 0 ? 'Nouveau' : 'Traité' ?>
                        </span>
                    </td>
                    <td><?= date('d/m H:i', strtotime($date)) ?></td>
                    <td>
                        <strong><?= htmlspecialchars($nom) ?></strong><br>
                        <small><?= htmlspecialchars($email) ?></small>
                    </td>
                    <td><?= htmlspecialchars($cat) ?></td>
                    <td>
                        <div class="msg-preview" title="<?= htmlspecialchars($contenu) ?>">
                            <?= htmlspecialchars($contenu) ?>
                        </div>
                    </td>
                    <td>
                        <a href="mailto:<?= $email ?>" class="btn-reply" onclick="markAsRead(<?= $id ?>)">
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
    fetch('index.php?page=mark-message-treated', { method: 'POST', body: formData });
}
</script>