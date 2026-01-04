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
                    <a href="#" class="list-group-item list-group-item-action border border-danger"
                       data-bs-toggle="modal" 
                       data-bs-target="#downloadModal"
                       data-file-name="<?php echo htmlspecialchars($appunto["Nome"]); ?>"
                       data-file-prof="<?php echo htmlspecialchars($appunto["Professore"]); ?>"
                       data-file-course="<?php echo htmlspecialchars($appunto["Corso_Laurea"]); ?>"
                       data-file-subject="<?php echo htmlspecialchars($appunto["Insegnamento"]); ?>"
                       data-file-user="<?php echo htmlspecialchars($appunto["Utente"]); ?>"
                       data-file-date="<?php echo htmlspecialchars($appunto["Data"]); ?>"
                       data-file-downloads="<?php echo htmlspecialchars($appunto["Download"]); ?>"
                       data-file-reviews-avg="<?php echo htmlspecialchars(round($appunto["media_recensioni"], 1)); ?>"
                       data-file-reviews-count="<?php echo htmlspecialchars($appunto["numero_recensioni"]); ?>"
                       data-file-url="download.php?id=<?php echo $appunto["Codice"]; ?>"
                    >
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1 fw-bold"><?php echo htmlspecialchars($appunto["Nome"]); ?></h5>
                            <span class="small text-muted"><i class="bi bi-star-fill text-warning"></i> <?php echo number_format($appunto["media_recensioni"], 1); ?></span>
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