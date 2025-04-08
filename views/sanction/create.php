<?php $title = "Créer une sanction - Mon Site"; ?>
<?php if (isset($_SESSION["user"])){ ?>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card">
                <div class="card-header">
                    <h2 class="mb-0 text-center text-secondary">Créer une sanction</h2>
                </div>
                <div class="card-body">
                    <?php if (isset($errors['general'])): ?>
                        <div class="alert alert-danger">
                            <?= htmlspecialchars($errors['general']) ?>
                        </div>
                    <?php endif; ?>

                    <form class="form" method="POST" novalidate>

                        <!-- PROMOTIONS -->
                        <div class="mb-3">
                            <label for="id_prom" class="form-label">Promotion</label>
                            <select class="form-select" id="id_prom" name="id_prom" required onchange="this.form.submit()">
                                <option value="">Sélectionner une promotion</option>
                                <?php foreach ($promotions as $promotion): ?>

                                    <option value="<?= $promotion->getId() ?>" <?= $formData['id_prom'] = $promotion->getId()?>>
                                        <?= htmlspecialchars($promotion->getLibelle()) ?> - <?= htmlspecialchars($promotion->getAnnee()) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <!-- ETUDIANTS -->
                        <?php if (!empty($etudiants)): ?>
                            <div class="mb-3">
                                <label for="id_etudiant" class="form-label">Étudiant</label>
                                <select class="form-select" id="id_etudiant" name="id_etudiant" required>
                                    <option value="">Sélectionner un étudiant</option>
                                    <?php foreach ($etudiants as $etudiant): ?>
                                        <option value="<?= $etudiant->getId() ?>" <?= $formData['id_etudiant'] = $etudiant->getId() ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($etudiant->getPrenom()) ?> <?= htmlspecialchars($etudiant->getNom()) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="nom_professeur" class="form-label">Nom du professeur</label>
                                <input type="text" class="form-control" id="nom_professeur" name="nom_professeur"
                                       value="<?= htmlspecialchars($formData['nom_professeur']) ?>" required>
                            </div>

                            <div class="mb-3">
                                <label for="motif" class="form-label">Motif</label>
                                <input type="text" class="form-control" id="motif" name="motif"
                                       value="<?= htmlspecialchars($formData['motif']) ?>" required>
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Description détaillée</label>
                                <textarea class="form-control" id="description" name="description" rows="4" required><?= htmlspecialchars($formData['description']) ?></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="date_incident" class="form-label">Date de l'incident</label>
                                <input type="date" class="form-control" id="date_incident" name="date_incident"
                                       value="<?= htmlspecialchars($formData['date_incident']) ?>" required>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-warning">Créer la sanction</button>
                            </div>
                        <?php endif; ?>
                    </form>
                </div>
            </div>

            <a href="/sanction" class="btn btn-secondary mt-2">Retour à la liste</a>
        </div>
    </div>
</div>
<?php } ?>