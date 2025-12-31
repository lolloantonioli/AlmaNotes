<div class="text-white py-5 mb-4 shadow-sm" style="background-image: url('img/sfondo.jpg'); background-size: cover;">
    <div class="container text-center">
        <h1 class="display-5 fw-bold mb-3">Cerca i tuoi appunti</h1>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form action="cerca.php" method="GET" class="d-flex">
                    <input type="text" name="q" class="form-control form-control-lg rounded-start-pill border-0 px-4" placeholder="Cosa stai cercando?" value="<?php echo htmlspecialchars($templateParams["search_text"]); ?>">
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
</div>

<div class="container pb-5">
    <div class="row">
        
        <div class="col-lg-3 mb-5">
            <div class="card shadow-sm border-0 rounded-4 sticky-top" style="top: 20px; z-index: 1000;">
                <div class="card-header bg-white border-bottom-0 pt-4 px-4">
                    <h4 class="fw-bold mb-0"><i class="bi bi-funnel text-danger"></i> Filtri</h4>
                </div>
                <div class="card-body px-4 pb-4">
                    <form action="cerca.php" method="GET" id="filterForm">
                        <input type="hidden" name="q" value="<?php echo htmlspecialchars($templateParams["search_text"]); ?>">
                        
                        <div class="mb-4">
                            <label class="form-label fw-semibold small text-uppercase text-muted">Materia</label>
                            <select class="form-select bg-light border-0" name="subject" onchange="document.getElementById('filterForm').submit()">
                                <option value="">Tutte le materie</option>
                                <?php foreach($templateParams["filtri_materie"] as $mat): ?>
                                    <option value="<?php echo $mat['Codice']; ?>" <?php echo ($templateParams["selected_subject"] == $mat['Codice']) ? 'selected' : ''; ?>>
                                        <?php echo htmlspecialchars($mat['Nome']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold small text-uppercase text-muted">Professore</label>
                            <select class="form-select bg-light border-0" name="prof" onchange="document.getElementById('filterForm').submit()">
                                <option value="">Tutti i professori</option>
                                <?php foreach($templateParams["filtri_prof"] as $prof): ?>
                                    <option value="<?php echo $prof['Codice']; ?>" <?php echo ($templateParams["selected_prof"] == $prof['Codice']) ? 'selected' : ''; ?>>
                                        <?php echo htmlspecialchars($prof['Nome']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="d-grid">
                            <a href="cerca.php" class="btn btn-outline-secondary btn-sm rounded-pill">Resetta Filtri</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-9">
            
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="fw-bold m-0">Risultati <span class="text-muted fw-light fs-5">(<?php echo count($templateParams["risultati"]); ?> trovati)</span></h3>
            </div>

            <?php if(empty($templateParams["risultati"])): ?>
                <div class="alert alert-light text-center py-5 shadow-sm rounded-4" role="alert">
                    <i class="bi bi-search display-1 text-muted mb-3 d-block"></i>
                    <h4 class="fw-bold text-muted">Nessun appunto trovato</h4>
                    <p>Prova a cambiare i filtri o cerca qualcos'altro.</p>
                </div>
            <?php else: ?>
                <div class="row g-4">
                    <?php foreach($templateParams["risultati"] as $appunto): ?>
                    <div class="col-md-6 col-xl-4">
                        <div class="card h-100 shadow-sm border-0 rounded-4 card-hover transition-up">
                            <div class="card-body p-4 d-flex flex-column">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <span class="badge bg-danger bg-opacity-10 text-danger mb-2"><?php echo htmlspecialchars($appunto['Insegnamento']); ?></span>
                                    <span class="small fw-bold text-warning"><i class="bi bi-star-fill"></i> <?php echo round($appunto['media_recensioni'], 1); ?></span>
                                </div>
                                <h5 class="card-title fw-bold text-dark mb-1 text-truncate"><?php echo htmlspecialchars($appunto['Nome']); ?></h5>
                                <p class="card-text text-muted small mb-3">Prof. <?php echo htmlspecialchars($appunto['Professore']); ?></p>
                                
                                <div class="mt-auto pt-3 border-top border-light d-flex justify-content-between align-items-center">
                                    <small class="text-muted"><i class="bi bi-download me-1"></i><?php echo $appunto['Download']; ?></small>
                                    
                                    <button class="btn btn-sm btn-danger rounded-pill px-3 fw-bold"
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
                                    >Scarica</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

        </div>
    </div>
</div>

<div class="modal fade" id="downloadModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 shadow border-0">
            <div class="modal-header border-bottom-0 pb-0">
                <h1 class="modal-title fs-5 fw-bold text-danger">Dettagli Appunto</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center pt-3">
                <h3 class="fw-bold mb-3" id="modalFileName">...</h3>
                <div class="card border-0 bg-light p-3 mb-4 text-start shadow-sm rounded-3">
                    <div class="row g-2">
                         <div class="col-12"><small class="text-muted d-block">Materia</small><span class="fw-semibold" id="modalSubject">...</span></div>
                         <div class="col-12"><small class="text-muted d-block">Professore</small><span class="fw-semibold" id="modalProf">...</span></div>
                         <div class="col-6 mt-2"><small class="text-muted d-block">Valutazione</small><span class="fw-bold text-dark"><span id="modalAvg">0</span>/5</span></div>
                         <div class="col-6 mt-2"><small class="text-muted d-block">Download</small><span class="fw-semibold" id="modalDownloads">0</span></div>
                    </div>
                </div>
                <p class="text-muted mb-0 small">Vuoi scaricare questo file?</p>
            </div>
            <div class="modal-footer border-top-0 d-flex justify-content-center gap-2 pb-4">
                <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Annulla</button>
                <a href="#" id="confirmDownloadBtn" class="btn btn-danger rounded-pill px-5 fw-bold">Scarica</a>
            </div>
        </div>
    </div>
</div>

<script>
    // Script Modal (lo stesso delle altre pagine)
    document.addEventListener('DOMContentLoaded', function () {
        var downloadModal = document.getElementById('downloadModal');
        if (downloadModal) {
            downloadModal.addEventListener('show.bs.modal', function (event) {
                var button = event.relatedTarget;
                // ... (Logica di popolamento identica a quella che abbiamo già fatto) ...
                // Per brevità qui recupero solo gli ID principali, ma tu copia lo script completo da lista-appunti
                downloadModal.querySelector('#modalFileName').textContent = button.getAttribute('data-file-name');
                downloadModal.querySelector('#modalProf').textContent = button.getAttribute('data-file-prof');
                downloadModal.querySelector('#modalSubject').textContent = button.getAttribute('data-file-subject');
                downloadModal.querySelector('#modalDownloads').textContent = button.getAttribute('data-file-downloads');
                downloadModal.querySelector('#modalAvg').textContent = button.getAttribute('data-file-reviews-avg');
                downloadModal.querySelector('#confirmDownloadBtn').setAttribute('href', button.getAttribute('data-file-url'));
            });
        }
    });
</script>

<style>
/* Piccola animazione per le card */
.transition-up { transition: transform 0.2s; }
.transition-up:hover { transform: translateY(-5px); }
</style>