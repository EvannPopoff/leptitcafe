<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Le P'tit Café</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

    <?php 
    // 1. On inclut le header (commun à toutes les pages)
    include 'app/views/layouts/header.php'; 

    // 2. LE ROUTAGE : On récupère la page demandée dans l'URL
    // Si l'URL est index.php?page=apropos, alors $page vaudra "apropos"
    // Si aucune page n'est précisée (accueil), on met "home" par défaut
    $page = isset($_GET['page']) ? $_GET['page'] : 'home';

    // 3. LA LOGIQUE D'AFFICHAGE
    // On définit le chemin du dossier des pages pour plus de clarté
    $viewPath = 'app/views/pages/';

    switch ($page) {
        case 'home':
            include $viewPath . 'home.php';
            break;

        case 'apropos':
            include $viewPath . 'apropos.php';
            break;

        // Si la page demandée n'existe pas, on peut afficher une erreur 404
        default:
            echo "<main><h1>Erreur 404</h1><p>La page n'existe pas.</p></main>";
            break;
    }

    // 4. On inclut le footer (commun à toutes les pages)
    include 'app/views/layouts/footer.php'; 
    ?>

</body>
</html>