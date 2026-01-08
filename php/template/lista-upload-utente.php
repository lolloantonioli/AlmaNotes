<div class="container py-5">
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
                    
                    <div class="list-group-item border border-danger p-0 overflow-hidden mb-0">
                        
                        <a href="#" class="list-group-item-action d-block p-3 text-decoration-none text-body"
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
                                <span class="small text-muted"><i class="bi bi-star-fill text-warning"></i> <?php echo round($appunto["media_recensioni"], 1); ?></span>
                            </div>
                            <p class="mb-1">Prof. <?php echo htmlspecialchars($appunto["Professore"]); ?> - <?php echo htmlspecialchars($appunto["Corso_Laurea"]); ?></p>
                            <p class="small text-muted mb-0"><i class="bi bi-download"></i> <?php echo $appunto["Download"]; ?> download</p>
                        </a>

                        <div class="d-flex border-top border-danger-subtle bg-light">
                            <button class="border-0 border-end text-dark w-50 py-2 fw-semibold small"
                                    data-bs-toggle="modal" 
                                    data-bs-target="#renameModal"
                                    data-id="<?php echo $appunto["Codice"]; ?>"
                                    data-name="<?php echo htmlspecialchars($appunto["Nome"]); ?>">
                                <i class="bi bi-pencil-square me-2"></i>Modifica
                            </button>
                            
                            <button class="border-0 w-50 py-2 fw-semibold small red-btn"
                                    data-bs-toggle="modal" 
                                    data-bs-target="#deleteModal"
                                    data-id="<?php echo $appunto["Codice"]; ?>">
                                <i class="bi bi-trash me-2"></i>Elimina
                            </button>
                        </div>

                    </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            
            <a href="profilo.php" class="btn fw-bold px-3 mt-4 shadow rounded-3 red-input">Torna al profilo</a>
        </div>
    </div>
</div>

<div class="modal fade" id="renameModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 shadow border-0">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title fw-bold">Modifica Nome Appunto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pt-0">
                <form action="gestisci-appunto.php" method="POST">
                    <input type="hidden" name="action" value="update">
                    <input type="hidden" name="id" id="renameId">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control focus-ring focus-ring-danger rounded-3" id="renameInput" name="nome" required placeholder="Nome file">
                        <label for="renameInput">Nuovo nome del file</label>
                    </div>
                    <div class="d-flex justify-content-end gap-2">
                        <button type="button" class="btn btn-light rounded-pill px-3" data-bs-dismiss="modal">Annulla</button>
                        <button type="submit" class="btn btn-danger rounded-pill px-4 fw-bold">Salva</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 shadow border-0">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title fw-bold text-danger">Elimina Appunto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center pt-0 pb-4">
                <i class="bi bi-exclamation-triangle text-warning display-1 mb-3"></i>
                <p class="fs-5 mb-1">Sei sicuro di voler eliminare questo appunto?</p>
                <form action="gestisci-appunto.php" method="POST" class="mt-4 d-flex justify-content-center gap-2">
                    <input type="hidden" name="action" value="delete">
                    <input type="hidden" name="id" id="deleteId">
                    <button type="button" class="btn btn-light rounded-pill px-4 fw-bold" data-bs-dismiss="modal">Annulla</button>
                    <button type="submit" class="btn btn-danger rounded-pill px-4 fw-bold shadow-sm">Sì, Elimina</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Gestione Rinomina
    var renameModal = document.getElementById('renameModal');
    if (renameModal) {
        renameModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;
            var id = button.getAttribute('data-id');
            var name = button.getAttribute('data-name');
            renameModal.querySelector('#renameId').value = id;
            renameModal.querySelector('#renameInput').value = name;
        });
    }
    // Gestione Elimina
    var deleteModal = document.getElementById('deleteModal');
    if (deleteModal) {
        deleteModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;
            var id = button.getAttribute('data-id');
            deleteModal.querySelector('#deleteId').value = id;
        });
    }
});
</script>