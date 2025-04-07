<div class="container mt-4">

    <h2 class="text-center mb-4 text-primary">Liste des sanctions</h2>

    <?php if (empty($sanctions)): ?>
        <div class="alert alert-warning text-center">
            Aucune sanction enregistrée pour le moment.
        </div>
    <?php else: ?>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            <?php foreach ($sanctions as $sanction): ?>
                <div class="col">
                    <div class="card h-100 shadow-sm">
                        <div class="card-header bg-warning text-dark">
                            <h5 class="card-title text-center">Motif : <?= htmlspecialchars($sanction->getMotif()) ?></h5>
                        </div>
                        <div class="card-body">

                            <div class="mb-2">
                                <strong>Étudiant :</strong><br>
                                <?= htmlspecialchars($sanction->getEtudiant()->getPrenom()) ?> <?= htmlspecialchars($sanction->getEtudiant()->getNom()) ?>
                            </div>

                            <div class="mb-2">
                                <strong>Promotion :</strong><br>
                                <?= htmlspecialchars($sanction->getEtudiant()->getPromotion()->getLibelle()) ?>
                            </div>

                            <div class="mb-2">
                                <strong>Professeur :</strong><br>
                                <?= htmlspecialchars($sanction->getNomProfesseur()) ?>
                            </div>

                            <div class="mb-2">
                                <strong>Description :</strong><br>
                                <?= htmlspecialchars($sanction->getDescription()) ?>
                            </div>

                            <div class="mb-2">
                                <strong>Date de l'incident :</strong><br>
                                <?= $sanction->getDateIncident()->format('d/m/Y') ?>
                            </div>
                        </div>
                        <div class="card-footer text-muted text-center">
                            <div>
                                <small>Ajoutée le <?= $sanction->getDateCreation()->format('d/m/Y H:i') ?></small>
                            </div>
                            <div>
                                <small>Surveillant : <?= htmlspecialchars($sanction->getCreateur()->getNom()) ?></small>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <div class="mt-4 text-center">
        <a href="/sanction/create" class="btn btn-success me-2">Créer une nouvelle sanction</a>
        <a href="/promotions" class="btn btn-secondary">Voir les promotions</a>
    </div>
</div>
