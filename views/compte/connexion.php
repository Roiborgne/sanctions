<?php $title = "Connexion - Mon Site"; ?>

<div class="row justify-content-center">
    <div class="col-md-6">
        <h1 class="text-center mb-4">Connexion</h1>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger">
                <?= htmlspecialchars($_SESSION['error']) ?>
                <?php unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success">
                <?= htmlspecialchars($_SESSION['success']) ?>
                <?php unset($_SESSION['success']); ?>
            </div>
        <?php endif; ?>

        <form action="/compte/connexion" method="POST" class="needs-validation" novalidate>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email"
                       class="form-control"
                       id="email"
                       name="email"
                       value="<?= htmlspecialchars($_SESSION['form_data']['email'] ?? '') ?>"
                       required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Mot de passe</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Se connecter</button>
            </div>
        </form>

        <?php unset($_SESSION['form_data']); ?>

        <p class="text-center mt-3">
            Pas encore de compte ? <a href="/inscription">Créez-en un</a>
        </p>
    </div>
</div>