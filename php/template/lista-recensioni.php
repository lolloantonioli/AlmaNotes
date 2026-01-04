<main class="container py-5">
    <!-- Flash Message -->
    <?php if(isset($_SESSION['flash_message'])): ?>
    <div class="alert alert-<?php echo $_SESSION['flash_type'] === 'success' ? 'success' : 'danger'; ?> alert-dismissible fade show mb-4" role="alert">
        <strong><?php echo $_SESSION['flash_type'] === 'success' ? '✓' : '✕'; ?></strong> <?php echo $_SESSION['flash_message']; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php unset($_SESSION['flash_message']); unset($_SESSION['flash_type']); ?>
    <?php endif; ?>
    
    <div class="row g-5">
        <div class="col-12">
            <div class="d-flex align-items-center mb-4 gap-3">
                <h3 class="fw-bold mb-0 d-flex align-items-center gap-2">
                    <i class="bi bi-star"></i> Recensisci ciò che hai scaricato
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
                       data-bs-target="#reviewModal"
                       data-file-codice="<?php echo $appunto["Codice"]; ?>"
                       data-file-name="<?php echo htmlspecialchars($appunto["Nome"]); ?>"
                       data-file-prof="<?php echo htmlspecialchars($appunto["Professore"]); ?>"
                       data-file-course="<?php echo htmlspecialchars($appunto["Corso_Laurea"]); ?>"
                    >
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1 fw-bold"><?php echo htmlspecialchars($appunto["Nome"]); ?></h5>
                            <span class="small text-muted">Data download: <?php echo $appunto["Data_Download"]; ?></span>
                        </div>
                        <p class="mb-1">Prof. <?php echo htmlspecialchars($appunto["Professore"]); ?> - <?php echo htmlspecialchars($appunto["Corso_Laurea"]); ?></p>
                        <p class="small text-muted mb-0"><i class="bi bi-download"></i> <?php echo $appunto["Download"]; ?> download</p>
                    </a>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</main>
<div class="modal fade" id="reviewModal" tabindex="-1" aria-labelledby="reviewModalLabel" aria-hidden="true" data-bs-backdrop="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 shadow border-0">
            <div class="modal-header border-bottom-0 pb-0">
                <h1 class="modal-title fs-5 fw-bold" id="reviewModalLabel" style="color: #BB2E29"><i class="bi bi-star me-2"></i>Lascia una Recensione</h1>
                <button type="button" class="btn-close focus-ring focus-ring-danger" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h4 class="fw-bold mb-1" id="modalFileName">...</h4>
                <p class="text-muted small mb-4">
                    <span id="modalProf">Prof. ...</span> - <span id="modalCourse">...</span>
                </p>
                
                <div class="text-center mb-4">
                    <p class="text-muted mb-3">Quanto è utile questo appunto?</p>
                    <div class="d-flex justify-content-center gap-2 mb-3" id="starsContainer">
                        <button type="button" class="btn btn-light btn-lg star-btn" data-star="1" title="Pessimo">★</button>
                        <button type="button" class="btn btn-light btn-lg star-btn" data-star="2" title="Scarso">★</button>
                        <button type="button" class="btn btn-light btn-lg star-btn" data-star="3" title="Buono">★</button>
                        <button type="button" class="btn btn-light btn-lg star-btn" data-star="4" title="Molto Buono">★</button>
                        <button type="button" class="btn btn-light btn-lg star-btn" data-star="5" title="Eccellente">★</button>
                    </div>
                    <p class="text-muted small">
                        <span id="ratingText">Seleziona una valutazione</span>
                    </p>
                </div>
            </div>
            <div class="modal-footer border-top-0 d-flex justify-content-center gap-2 pb-4">
                <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Annulla</button>
                <button type="button" id="submitReviewBtn" class="btn btn-danger rounded-pill px-5 fw-bold" disabled>Invia Recensione</button>
            </div>
        </div>
    </div>
</div>
