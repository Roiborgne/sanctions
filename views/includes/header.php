<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <img src="../../assets/image/icone_gaudper.jpeg" alt="icon">
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
                        <li class="nav-item">
                            <p class="btn btn-warning">connecté en tant que <?php echo $_SESSION['user']['pseudo']?></p>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/profil">Mon Profil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-danger" href="/index.php?route=deconnexion"
                               onclick="return confirm('Êtes-vous sûr de vouloir vous déconnecter ?')">
                                Déconnexion
                            </a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?route=connexion">Connexion</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?route=creercompte">Créer un compte</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
</header>