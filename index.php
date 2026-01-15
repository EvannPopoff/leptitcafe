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
    include 'app/views/layouts/header.php'; 

    // On récupère la page demandée dans l'URL
    // Si l'URL est index.php?page=apropos, alors $page vaudra "apropos"
    // Si aucune page n'est précisée, on met "home" par défaut qui est la page d'accueil.
    $page = isset($_GET['page']) ? $_GET['page'] : 'home';

    // LOGIQUE D'AFFICHAGE
    // On définit le chemin du dossier des pages pour plus de clarté
    $viewPath = 'app/views/pages/';

    switch ($page) {
        case 'home':
            include $viewPath . 'home.php';
            break;

        case 'apropos':
            include $viewPath . 'apropos.php';
            break;

        // Erreur 404
        default:
            echo "<main><h1>Erreur 404</h1><p>La page n'existe pas. Désolé :(</p></main>";
            break;
    }

    // Footer
    include 'app/views/layouts/footer.php'; 
    ?>

</body>
</html>