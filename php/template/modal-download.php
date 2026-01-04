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