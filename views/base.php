<?php //session_start() ; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Mon Site' ?></title>
    <link rel="icon" href="assets/image/icone_gaudper.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body{
            height: 100%;
            min-height: 100%;
        }
        footer {
            position: relative;
            height: 200px;
            margin-top: 100px;
        }
        ul{
            list-style-type: none;
        }
    </style>
</head>
<body>
<!-- Header commun -->
<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <img src="assets/image/icone_gaudper.ico" alt="icon" class="" style="height: 70px">
            <a class="navbar-brand" href="/">Gestion de Sanction</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/">Accueil</a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <?php if (isset($_SESSION['user'])): ?>
                        <li class="nav-item me-5">
                            <p class="btn btn-warning">Bonjour <?php echo $_SESSION['user']['nom']?></p>
                        </li>
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Menu
                            </button>
                            <ul class="dropdown-menu bg-dark">
                                <li class="nav-item">
                                    <a class="nav-link" href="/promotion/ajouter">Ajouter une promotion</a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/etudiant/index">Importer des étudiants</a>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/sanction">Liste des sanctions</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/sanction/create">Ajout de sanction</a>
                                </li>
                            </ul>
                        </div>
                        <li class="nav-item">
                            <a class="nav-link text-danger" href="/compte/disconnect"
                               onclick="return confirm('Êtes-vous sûr de vouloir vous déconnecter ?')">
                                Déconnexion
                            </a>
                        </li>

                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/connexion">Connexion</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/inscription">Créer un compte</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
</header>

<!-- Contenu principal -->
<main class="container mx-auto px-4 flex-grow mt-5">
    <?= $content ?>
</main>

<!-- Footer commun -->
<footer class="bg-dark text-light py-4 mt-5">
    <div class="container">
        <div class="text-decoration-none">
            <ul class="me-auto text-center">
                <li>
                    <a class="text-decoration-none text-light" href="/mentions"> Mentions légales</a>
                </li>
                <li>
                    <a class="text-decoration-none text-light" href="/"> contact</a>
                <li>
                    <a class="text-decoration-none text-light" href="https://www.facebook.com/gaudper.abraham/?locale=ml_IN"><i class="bi bi-facebook text-light"></i></a>
                    <a class="text-decoration-none text-light" href="https://www.instagram.com/gaudper/"><i class="bi bi-instagram text-light"></i></a>
                    <a class="text-decoration-none text-light" href="https://www.facebook.com/gaudper.abraham/?locale=ml_IN"><i class="bi bi-linkedin text-light"></i></a>
                </li>
            </ul>
        </div>
        <div class="row mt-3">
            <div class="col text-center">
                <p class="mb-0">&copy; <?= date('Y') ?> Tous droits réservés.</p>
            </div>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>