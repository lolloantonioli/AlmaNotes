<div class="text-white container-fluid py-5 text-center position-relative z-1" style="background-image: url(img/sfondo.jpg); background-size: cover; background-position: center;">
    <h1 class="display-5 fw-bold mt-5 mb-3">Gli appunti giusti per ogni esame</h1>
    <p class="lead mb-4 fw-light">
        Trova e condividi appunti specifici per ogni insegnamento e professore dell'UniBo
    </p>
    
    <div class="row justify-content-center">
        <div class="col-11 col-md-8 col-lg-8">
            <form action="cerca.php" method="GET" class="d-flex mb-5 mt-3">
                <input type="text" name="q" class="form-control form-control-lg focus-ring focus-ring-danger rounded-start-pill border-0 px-4" placeholder="Cerca per esame, professore o argomento" autocomplete="off" value="<?php echo htmlspecialchars($templateParams["search_text"] ?? ''); ?>">
                <button type="submit" class="btn btn-dark rounded-end-pill px-4 fw-bold">CERCA</button>

                <?php if(!empty($templateParams["selected_prof"])): ?>
                    <input type="hidden" name="prof" value="<?php echo htmlspecialchars($templateParams["selected_prof"]); ?>">
                <?php endif; ?>
                <?php if(!empty($templateParams["selected_subject"])): ?>
                    <input type="hidden" name="subject" value="<?php echo htmlspecialchars($templateParams["selected_subject"]); ?>">
                <?php endif; ?>
            </form>
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
                        <h5 class="mb-1 fw-bold"><?php echo $appunto["Nome"]; ?></h5>
                        <span class="small text-muted"><i class="bi bi-star-fill text-warning"></i> <?php echo round($appunto["media_recensioni"], 1); ?></span>
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
        <div class="modal-content rounded-4 shadow border-0">
            
            <div class="modal-header border-bottom-0 pb-0">
                <h1 class="modal-title fs-5 fw-bold" style="color: #BB2E29;">
                    <i class="bi bi-file-earmark-pdf me-2"></i>Dettagli Appunto
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Chiudi"></button>
            </div>
            
            <div class="modal-body text-center pt-3">
                
                <h3 class="fw-bold mb-3" id="modalFileName">...</h3>

                <div class="card border-0 bg-light p-3 mb-4 text-start shadow-sm rounded-3">
                    <div class="row g-3">
                        
                        <div class="col-12">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-book fs-5 me-3"></i>
                                <div>
                                    <small class="text-muted d-block text-uppercase" style="font-size: 0.75rem;">Materia</small>
                                    <span class="fw-semibold" id="modalSubject">...</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-person-badge fs-5 me-3"></i>
                                <div>
                                    <small class="text-muted d-block text-uppercase" style="font-size: 0.75rem;">Professore</small>
                                    <span class="fw-semibold" id="modalProf">...</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-12">
                             <div class="d-flex align-items-center">
                                <i class="bi bi-mortarboard fs-5 me-3"></i>
                                <div>
                                    <small class="text-muted d-block text-uppercase" style="font-size: 0.75rem;">Corso di Laurea</small>
                                    <span class="fw-semibold" id="modalCourse">...</span>
                                </div>
                            </div>
                        </div>

                        <hr class="my-2 opacity-25">

                        <div class="col-6">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-star-fill text-warning fs-5 me-3"></i>
                                <div>
                                    <small class="text-muted d-block text-uppercase" style="font-size: 0.75rem;">Valutazione</small>
                                    <span class="fw-bold text-dark">
                                        <span id="modalAvg">0</span>/5 
                                        <small class="fw-normal text-muted ms-1">(<span id="modalCount">0</span>)</small>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-cloud-arrow-down fs-5 me-3"></i>
                                <div>
                                    <small class="text-muted d-block text-uppercase" style="font-size: 0.75rem;">Download</small>
                                    <span class="fw-semibold" id="modalDownloads">0</span>
                                </div>
                            </div>
                        </div>

                        <hr class="my-2 opacity-25">

                        <div class="col-6">
                            <small class="text-muted d-block">Caricato da:</small>
                            <span class="fw-semibold small" id="modalUser">...</span>
                        </div>
                        <div class="col-6 text-end">
                            <small class="text-muted d-block">Il:</small>
                            <span class="fw-semibold small" id="modalDate">...</span>
                        </div>
                    </div>
                </div>

                <p class="text-muted mb-0 small">Sei sicuro di voler scaricare questo file?</p>
            </div>
            
            <div class="modal-footer border-top-0 d-flex justify-content-center gap-2 pb-4">
                <button type="button" class="btn btn-light rounded-pill px-4 fw-semibold" data-bs-dismiss="modal">Annulla</button>
                <a href="#" id="confirmDownloadBtn" class="btn btn-danger rounded-pill px-5 fw-bold shadow-sm">
                    <i class="bi bi-download me-2 text-white"></i>Scarica
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
                var button = event.relatedTarget;
                
                // Recupero dati
                var fileName = button.getAttribute('data-file-name');
                var prof = button.getAttribute('data-file-prof');
                var course = button.getAttribute('data-file-course');
                var subject = button.getAttribute('data-file-subject');
                var user = button.getAttribute('data-file-user');
                var date = button.getAttribute('data-file-date');
                var downloads = button.getAttribute('data-file-downloads');
                var avg = button.getAttribute('data-file-reviews-avg');
                var count = button.getAttribute('data-file-reviews-count');
                var fileUrl = button.getAttribute('data-file-url');
                
                // Aggiorno UI
                downloadModal.querySelector('#modalFileName').textContent = fileName;
                downloadModal.querySelector('#modalProf').textContent = prof;
                downloadModal.querySelector('#modalCourse').textContent = course;
                downloadModal.querySelector('#modalSubject').textContent = subject;
                downloadModal.querySelector('#modalUser').textContent = user;
                downloadModal.querySelector('#modalDate').textContent = date;
                downloadModal.querySelector('#modalDownloads').textContent = downloads;
                downloadModal.querySelector('#modalAvg').textContent = avg;
                downloadModal.querySelector('#modalCount').textContent = count;
                
                downloadModal.querySelector('#confirmDownloadBtn').setAttribute('href', fileUrl);
            });
        }
    });
</script>