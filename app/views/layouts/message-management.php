<?php
// On initialise le manager
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
                    // SÉCURITÉ : On extrait les données que ce soit un OBJET ou un TABLEAU
                    $isObj   = is_object($m);
                    $id      = $isObj ? $m->getIdMessage() : $m['id_message'];
                    $statut  = $isObj ? $m->getStatut()    : $m['statut'];
                    $nom     = $isObj ? $m->getNom()       : $m['nom'];
                    $email   = $isObj ? $m->getEmail()     : $m['email'];
                    $cat     = $isObj ? $m->getCategorie() : $m['categorie'];
                    $contenu = $isObj ? $m->getContenu()   : $m['contenu'];
                    $date    = $isObj ? $m->getDateEnvoi() : $m['date_envoi'];
                    
                    $isNew = ($statut === 0);
                ?>
                <tr class="<?= $isNew ? 'row-new' : 'row-treated' ?>">
                    <td>
                        <span class="badge <?= $isNew ? 'badge-red' : 'badge-green' ?>">
                            <?= $isNew ? 'Nouveau' : 'Traité' ?>
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
                        <a href="mailto:<?= $email ?>?subject=Réponse : <?= $cat ?>" 
                           class="btn-reply" 
                           onclick="markAsRead(<?= $id ?>)">
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
    if(!id) return;
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