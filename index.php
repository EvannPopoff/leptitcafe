<?php
    // Ici c'est la partie pour le nom des pages
    // On récupère la page demandée via l'URL sinon on met "home" par défaut.
    $page = isset($_GET['page']) ? $_GET['page'] : 'home';

    switch ($page) {
        case 'home':
            $title = "Accueil - Le P'tit Café";
            break;

        case 'apropos':
           $title = "A propos - Le P'tit Café";
            break;
case 'membership':
$title = "Adhérer - Le P'tit Café";
break;

    }

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="icon" type="image/x-icon" href="">
</head>
<body>

    <?php 
    //Header dispo sur toutes les pages pour éviter de les recopier sur les nouvelles pages.
    include 'app/views/layouts/header.php'; 
        

    // On définit le chemin du dossier des pages directement pour plus de clarté.
    $viewPath = 'app/views/pages/';


    switch ($page) {
        case 'home':
            include $viewPath . 'home.php';
            break;

        case 'apropos':
            include $viewPath . 'apropos.php';
            break;

case 'membership':
    include $viewPath . 'membership.php';
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