<?php
// On s'assure que le manager utilise le bon nom de table
$msgManager = new app\models\managers\MessageManager($db);
$allMessages = $msgManager->findAll();
?>

<link rel="stylesheet" href="assets/css/admin-management.css">

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
                    // Détection automatique : Objet ou Tableau ?
                    $isObj = is_object($m);
                    
                    // On récupère les données avec une valeur par défaut si vide
                    $id      = $isObj ? $m->getIdMessage() : ($m['id_message'] ?? null);
                    $statut  = $isObj ? $m->getStatut()    : ($m['statut'] ?? 0);
                    $nom     = $isObj ? $m->getNom()       : ($m['nom'] ?? 'Inconnu');
                    $email   = $isObj ? $m->getEmail()     : ($m['email'] ?? '');
                    $cat     = $isObj ? $m->getCategorie() : ($m['categorie'] ?? 'Général');
                    $contenu = $isObj ? $m->getContenu()   : ($m['contenu'] ?? '');
                    $date    = $isObj ? $m->getDateEnvoi() : ($m['date_envoi'] ?? 'now');
                ?>
                <tr class="<?= $statut === 0 ? 'row-new' : 'row-treated' ?>">
                    <td>
                        <span class="badge <?= $statut === 0 ? 'badge-red' : 'badge-green' ?>">
                            <?= $statut === 0 ? 'Nouveau' : 'Traité' ?>
                        </span>
                    </td>
                    <td style="white-space: nowrap;"><?= date('d/m H:i', strtotime($date)) ?></td>
                    <td>
                        <strong><?= htmlspecialchars($nom) ?></strong><br>
                        <small style="color: #666;"><?= htmlspecialchars($email) ?></small>
                    </td>
                    <td><strong><?= htmlspecialchars($cat) ?></strong></td>
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