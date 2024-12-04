<?php $title = "Créer un compte - Mon Site"; ?>

<div class="row justify-content-center">
    <div class="col-md-6">
        <h1 class="text-center mb-4">Créer un compte</h1>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger">
                <?= htmlspecialchars($_SESSION['error']) ?>
                <?php unset($_SESSION['error']); // Supprimer le message après affichage ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success">
                <?= htmlspecialchars($_SESSION['success']) ?>
                <?php unset($_SESSION['success']); // Supprimer le message après affichage ?>
            </div>
        <?php endif; ?>

        <form action="/compte/creer" method="POST" class="needs-validation" novalidate>
            <div class="mb-3">
                <label for="nom" class="form-label">Nom*</label>
                <input type="text"
                       class="form-control"
                       id="nom"
                       name="nom"
                       value="<?= htmlspecialchars($_SESSION['form_data']['nom'] ?? '') ?>"
                       required>
            </div>

            <div class="mb-3">
                <label for="prenom" class="form-label">Prenom*</label>
                <input type="text"
                       class="form-control"
                       id="prenom"
                       name="prenom"
                       value="<?= htmlspecialchars($_SESSION['form_data']['prenom'] ?? '') ?>"
                       required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email*</label>
                <input type="email"
                       class="form-control"
                       id="email"
                       name="email"
                       value="<?= htmlspecialchars($_SESSION['form_data']['email'] ?? '') ?>"
                       required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Mot de passe*</label>
                <input type="password" class="form-control" id="password" name="password" required>
                <i>Longueur d'au moins 8 caractères</i>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Confirmation du mot de passe*</label>
                <input type="password" class="form-control" id="confpassword" name="confpassword" required>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Créer mon compte</button>
            </div>
        </form>

        <?php
        // Nettoyer les données du formulaire après affichage
        unset($_SESSION['form_data']);
        ?>

        <p class="text-center mt-3">
            Déjà inscrit ? <a href="/connexion">Connectez-vous</a>
        </p>
    </div>
</div>