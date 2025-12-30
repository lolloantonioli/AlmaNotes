<div class="text-white container-fluid py-5 text-center position-relative z-1" style="background-image: url(img/sfondo.jpg); background-size: cover; background-position: center;">
    <h1 class="display-5 fw-bold mt-5 mb-3">Gli appunti giusti per ogni esame</h1>
    <p class="lead mb-4 fw-light">
        Trova e condividi appunti specifici per ogni insegnamento e professore dell'UniBo
    </p>
    
    <div class="row justify-content-center">
        <div class="col-11 col-md-8 col-lg-8">
            <div class="input-group input-group-lg bg-white rounded-pill p-1 mb-5 mt-3 shadow">
                <span class="input-group-text border-0 bg-transparent ps-3 text-muted user-select-none">
                    <i class="bi bi-search"></i>
                </span>
                <input type="text" class="form-control border-0 bg-transparent shadow-none" placeholder="Cerca per esame, professore o argomento">
            </div>
        </div>
    </div>
</div>

<main class="container py-5">
    <div class="row g-5">
        
        <div class="col-12 col-lg-6">
            <h3 class="fw-bold mb-4 d-flex align-items-center gap-2">
                <i class="bi bi-graph-up-arrow user-select-none"></i> Più scaricati
            </h3>
            <div class="list-group shadow">
                
                <?php foreach ($templateParams["topappunti"] as $appunto): ?>
                <a href="#" class="list-group-item list-group-item-action border border-danger" 
                   data-bs-toggle="modal" 
                   data-bs-target="#downloadModal"
                   data-file-name="<?php echo htmlspecialchars($appunto["Nome"]); ?>"
                   data-file-url="download.php?id=<?php echo $appunto["Codice"]; ?>"
                >
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1 fw-bold"><?php echo $appunto["Nome"]; ?></h5>
                        <span class="small text-muted"><i class="bi bi-star"></i> <?php echo $appunto["media_recensioni"]; ?>/5</span>
                    </div>
                    <p class="mb-1">Prof. <?php echo $appunto["Professore"]; ?> - <?php echo $appunto["Corso_Laurea"]; ?></p>
                    <p class="small text-muted mb-0"><i class="bi bi-download"></i> <?php echo $appunto["Download"]; ?> download</p>
                </a>
                <?php endforeach; ?>
                
            </div>
        </div>

        <div class="col-12 col-lg-6">
            <h3 class="fw-bold mb-4 d-flex align-items-center gap-2">
                <i class="bi bi-clock user-select-none"></i> Ultimi caricati
            </h3>
            <div class="list-group shadow">
                
                <?php foreach ($templateParams["lastappunti"] as $appunto): ?>
                <a href="#" class="list-group-item list-group-item-action border border-danger" 
                   data-bs-toggle="modal" 
                   data-bs-target="#downloadModal"
                   data-file-name="<?php echo htmlspecialchars($appunto["Nome"]); ?>"
                   data-file-url="download.php?id=<?php echo $appunto["Codice"]; ?>"
                >
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1 fw-bold"><?php echo $appunto["Nome"]; ?></h5>
                        <span class="small text-muted"><?php echo $appunto["Data"]; ?></span>
                    </div>
                    <p class="mb-1">Prof. <?php echo $appunto["Professore"]; ?> - <?php echo $appunto["Corso_Laurea"]; ?></p>
                    <p class="small text-muted mb-0"><i class="bi bi-person"></i> <?php echo $appunto["Utente"]; ?></p>
                </a>
                <?php endforeach; ?>
                
            </div>
        </div>

    </div>
</main>

<div class="modal fade" id="downloadModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 shadow">
            
            <div class="modal-header border-bottom-0">
                <h1 class="modal-title fs-5 fw-bold text-danger">
                    <i class="bi bi-cloud-download me-2"></i>Conferma Download
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Chiudi"></button>
            </div>
            
            <div class="modal-body py-0 text-center">
                <p class="mb-1">Sei sicuro di voler scaricare questo appunto?</p>
                <p class="fs-5 fw-bold text-dark" id="modalFileName">...</p>
            </div>
            
            <div class="modal-footer border-top-0 d-flex justify-content-center gap-2 pb-4">
                <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Annulla</button>
                <a href="#" id="confirmDownloadBtn" class="btn btn-danger rounded-pill px-4 fw-bold">
                    Scarica
                </a>
            </div>

        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var downloadModal = document.getElementById('downloadModal');
        
        if (downloadModal) {
            downloadModal.addEventListener('show.bs.modal', function (event) {
                // Bottone che ha attivato il modal
                var button = event.relatedTarget;
                
                // Estrai info dagli attributi data-*
                var fileName = button.getAttribute('data-file-name');
                var fileUrl = button.getAttribute('data-file-url');
                
                // Aggiorna il contenuto del modal
                var modalTitle = downloadModal.querySelector('#modalFileName');
                var confirmBtn = downloadModal.querySelector('#confirmDownloadBtn');

                modalTitle.textContent = fileName;
                confirmBtn.setAttribute('href', fileUrl);
            });
        }
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
