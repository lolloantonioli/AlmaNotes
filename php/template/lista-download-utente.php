<div class="container py-5">
    <div class="row g-5">
        <div class="col-12">
            <div class="d-flex align-items-center mb-4 gap-3">
                <h3 class="fw-bold mb-0 d-flex align-items-center gap-2">
                    <i class="bi bi-download"></i> I file che hai scaricato
                </h3>
            </div>
            
            <?php if (empty($templateParams["downloadedFiles"])): ?>
                <div class="alert alert-info" role="alert">
                    Non hai ancora scaricato alcun file.
                </div>
            <?php else: ?>
                <div class="list-group shadow">
                    <?php foreach ($templateParams["downloadedFiles"] as $appunto): ?>
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
                        <div class="d-flex justify-content-between align-items-center">
                            <p class="small text-muted mb-0"><i class="bi bi-download"></i> <?php echo $appunto["Download"]; ?> download</p>
                            <small class="text-secondary fst-italic">Scaricato il: <?php echo $appunto["Data_Download"]; ?></small>
                        </div>
                    </a>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            
            <a href="profilo.php" class="btn fw-bold px-3 mt-4 shadow rounded-3" style="background-color: #BB2E29; color: white;">Torna al profilo</a>

        </div>
    </div>
</div>