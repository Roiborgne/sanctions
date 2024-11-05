<?php
session_start();

// Récupération de l'EntityManager
$entityManager = require_once __DIR__ . '/../config/bootstrap.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Mon Site' ?></title>
    <link rel="icon" href="../assets/image/icone%20gaudper.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
<!-- Header commun -->
<?php include_once __DIR__ . '/../views/includes/header.php'; ?>

<!-- Contenu principal -->
<main class="container py-4">
    <?php
    // Mise en place du routing
    $route = $_GET['route'] ?? 'accueil';

    // Tester la valeur de $route
    switch ($route) {
        case 'accueil':
            $accueilControleur = new \App\Controleurs\AccueilControleur();
            $accueilControleur->accueil();
            break;

        case 'mentions':
            $accueilControleur = new \App\Controleurs\MentionsControleur();
            $accueilControleur->mentions();
            break;

        default:
            http_response_code(404);
            echo "Erreur 404 : Page non trouvée";
            break;
    }
    ?>
</main>

<!-- Footer commun -->
<?php include_once __DIR__ . '/../views/includes/footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>