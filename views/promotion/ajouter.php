<?php $title = "Ajouter une promotion - Mon Site"; ?>

<div class="row justify-content-center">
    <div class="col-md-6">
        <h1 class="text-center mb-4">Ajouter une promotion</h1>

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

        <form action="/promotion/ajouter" method="POST" class="needs-validation" novalidate>
            <div class="mb-3">
                <label for="libelle" class="form-label">Libellé*</label>
                <input type="text"
                       class="form-control"
                       id="libelle"
                       name="libelle"
                       value="<?= htmlspecialchars($_SESSION['form_data']['libelle'] ?? '') ?>"
                       required>
            </div>

            <div class="mb-3">
                <label for="annee" class="form-label">Année*</label>
                <input type="number"
                       min="0"
                       minlength="4"
                       maxlength="4"
                       class="form-control"
                       id="annee"
                       name="annee"
                       value="<?= htmlspecialchars($_SESSION['form_data']['annee'] ?? '') ?>"
                       required>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-primary">Ajouter la promotion</button>
            </div>
        </form>

        <?php
        // Nettoyer les données du formulaire après affichage
        unset($_SESSION['form_data']); ?>

    </div>
</div>