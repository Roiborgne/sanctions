<div class="text-center">
    <h1 class="mb-4">Gestion Sanctions</h1>
</div>

<div class="row">
    <div class="col">
        <h1>Bienvenue sur le site</h1>
        <p>
            Ceci est un site qui permet la gestion des sanctions du lycée gaudper
        </p>
    </div>
</div>
<div class="text-center">
    <?php if (isset($_SESSION['message'])):
    foreach ($_SESSION['message'] as $item) {?>
        <div class="alert alert-success">
            <?= $item ?> !
        </div>
        <?php } ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['user'])): ?>
        <div class="alert alert-success">
            Bonjour <?= $_SESSION['user']['prenom'] ?> !
        </div>
        <div class="mt-4">
            <a href="/promotion" class="btn btn-primary btn-lg mx-2">Promotion</a>
            <a class="btn btn-primary btn-lg mx-2" href="/compte/disconnect"
               onclick="return confirm('Êtes-vous sûr de vouloir vous déconnecter ?')">
                Déconnexion
            </a>
        </div>
    <?php else: ?>
        <div class="mt-4">
            <a href="/inscription" class="btn btn-primary btn-lg mx-2">Créer un compte</a>
            <a href="/connexion" class="btn btn-outline-primary btn-lg mx-2">Se connecter</a>
        </div>
    <?php endif; ?>
</div>
