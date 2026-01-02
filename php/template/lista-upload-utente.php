<main class="container py-5">
    <div class="row g-5">
        <div class="col-12">
            <div class="d-flex align-items-center mb-4 gap-3">
                <h3 class="fw-bold mb-0 d-flex align-items-center gap-2">
                    <i class="bi bi-upload"></i> I file che hai caricato
                </h3>
            </div>
            
            <?php if (empty($templateParams["uploadedFiles"])): ?>
                <div class="alert alert-info" role="alert">
                    Non hai ancora caricato alcun file.
                </div>
            <?php else: ?>
                <div class="list-group shadow">
                    <?php foreach ($templateParams["uploadedFiles"] as $appunto): ?>
                    <a class="list-group-item list-group-item-action border border-danger">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1 fw-bold"><?php echo htmlspecialchars($appunto["Nome"]); ?></h5>
                            <span class="small text-muted"><i class="bi bi-star"></i> <?php echo number_format($appunto["media_recensioni"], 1); ?>/5</span>
                        </div>
                        <p class="mb-1">Prof. <?php echo htmlspecialchars($appunto["Professore"]); ?> - <?php echo htmlspecialchars($appunto["Corso_Laurea"]); ?></p>
                        <p class="small text-muted mb-0"><i class="bi bi-download"></i> <?php echo $appunto["Download"]; ?> download</p>
                    </a>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            
            <div class="mt-4">
                <a href="profilo.php" class="btn btn-outline-danger rounded-pill px-4 fw-bold">
                    <i class="bi bi-arrow-left me-2"></i> Torna al profilo
                </a>
            </div>
        </div>
    </div>
</main>
