<?php $title = "importer des étudiants - Mon Site"; ?>
<?php if (isset($_SESSION["user"])){ ?>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h1 class="text-center mb-4">Importer des étudiants</h1>

            <?php if (isset($_SESSION["message"]['warning'])): ?>
                <div class="alert alert-danger">
                    <?= htmlspecialchars($_SESSION["message"]['warning']) ?>
                    <?php unset($_SESSION["message"]['warning']); // Supprimer le message après affichage ?>
                </div>
            <?php endif; ?>

            <?php if (isset($_SESSION["error"])): ?>
                <div class="alert alert-danger">
                    <?= htmlspecialchars($_SESSION['error']) ?>
                    <?php unset($_SESSION["error"]); // Supprimer le message après affichage ?>
                </div>
            <?php endif; ?>

            <?php if (isset($_SESSION["message"]['success'])): ?>
                <div class="alert alert-success">
                    <?= htmlspecialchars($_SESSION["message"]['success']) ?>
                    <?php unset($_SESSION["message"]['success']); // Supprimer le message après affichage ?>
                </div>
            <?php endif; ?>

            <form action="/etudiant/importer" method="POST" class="needs-validation" novalidate>
                <div class="mb-3">
                    <label for="fichier" class="form-label">Fichier*</label>
                    <input type="file"
                           class="form-control"
                           id="fichier"
                           name="fichier"
                           value="<?= htmlspecialchars($_SESSION['form_data']['fichier'] ?? '') ?>"
                           accept=".csv"
                           required>
                </div>

                <div class="mb-3">
                    <?php if (!empty($promotions)): ?>
                    <label for="prom" class="form-label">Promotion associée*</label>
                    <select class="form-select" id="prom" name="prom" required>
                    <option value="">Sélectionnez une promotion</option>
                    <?php foreach ($promotions as $promotion): ?>
                    <option value="<?= $promotion->getId() ?>" <?= (isset($_SESSION['form_data']['prom']) && $_SESSION['form_data']['prom'] == $promotion->getId()) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($promotion->getLibelle()) ?> - <?= htmlspecialchars($promotion->getAnnee()) ?>
                    </option>
                    <?php endforeach; ?>
                </select>
                    <?php else: ?>
                    <div class="alert alert-warning">
                        Aucune promotion disponible. Veuillez en ajouter une avant d'importer des étudiants.
                    </div>
        <?php endif; ?>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Ajouter les étudiants</button>
                </div>
            </form>

            <?php
            // Nettoyer les données du formulaire après affichage
            unset($_SESSION['form_data']); ?>
        </div>
    </div>
<?php }else{?>
    <div class="container">
        <h3 class="text-center row">Veuillez vous connecter pour accéder à cette page</h3>
        <p>Déjà un compte, <a href="/connexion">Connectez vous</a></p>
        <p>Pas encore de compte, <a href="/inscription">inscrivez vous</a>
    </div>
<?php } ?>