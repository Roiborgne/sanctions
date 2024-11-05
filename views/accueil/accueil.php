<div class="text-center">
    <h1 class="mb-4">Gestion Sanctions</h1>
</div>

<div class="row">
    <div class="col">
        <h1>Bienvenue sur le site</h1>
        <p>
            ceci est un site qui permet la gestion des sanction du lycée gaudper
        </p>
    </div>
    <div class="col">
        <img src="../../assets/image/icone_gaudper.jpeg" alt="img">
    </div>
</div>
<div class="text-center">
    <?php if (isset($_SESSION['user'])): ?>
        <div class="alert alert-success">
            Bonjour <?= $_SESSION['user']['pseudo'] ?> !
        </div>
        <div class="mt-4">
            <a href="index.php?route=profile" class="btn btn-primary btn-lg mx-2">Profile</a>
            <a href="index.php?route=deconnexion" class="btn btn-outline-primary btn-lg mx-2">Se déconnecter</a>
        </div>
    <?php else: ?>
        <div class="mt-4">
            <a href="index.php?route=creercompte" class="btn btn-primary btn-lg mx-2">Créer un compte</a>
            <a href="index.php?route=connexion" class="btn btn-outline-primary btn-lg mx-2">Se connecter</a>
        </div>
    <?php endif; ?>
</div>
