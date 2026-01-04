<div class="text-white py-5 mb-4 shadow-sm" style="background-image: url('img/sfondo.jpg'); background-size: cover;">
    <div class="container text-center">
        <h1 class="display-5 fw-bold mb-3">Cerca i tuoi appunti</h1>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form action="cerca.php" method="GET" class="d-flex">
                    <input type="text" name="q" class="form-control form-control-lg focus-ring focus-ring-danger rounded-start-pill border-0 px-4" autocomplete="off" placeholder="Cosa stai cercando?" value="<?php echo htmlspecialchars($templateParams["search_text"]); ?>">
                    <button type="submit" class="btn btn-dark rounded-end-pill px-4 fw-bold">CERCA</button>
                    
                    <?php if(!empty($templateParams["selected_prof"])): ?>
                        <input type="hidden" name="prof" value="<?php echo htmlspecialchars($templateParams["selected_prof"]); ?>">
                    <?php endif; ?>
                    <?php if(!empty($templateParams["selected_subject"])): ?>
                        <input type="hidden" name="subject" value="<?php echo htmlspecialchars($templateParams["selected_subject"]); ?>">
                    <?php endif; ?>
                    <?php if(!empty($templateParams["selected_course"])): ?>
                        <input type="hidden" name="course" value="<?php echo htmlspecialchars($templateParams["selected_course"]); ?>">
                    <?php endif; ?>
                    <?php if(!empty($templateParams["selected_user"])): ?>
                        <input type="hidden" name="user" value="<?php echo htmlspecialchars($templateParams["selected_user"]); ?>">
                    <?php endif; ?>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Chip Filtri Applicati -->
<?php if(!empty($templateParams["selected_prof"]) || !empty($templateParams["selected_subject"]) || !empty($templateParams["selected_course"]) || !empty($templateParams["selected_user"])): ?>
<div class="d-flex gap-2 justify-content-center py-4 flex-wrap">
    <?php if(!empty($templateParams["selected_subject"])): 
        $filtroMateria = null;
        foreach($templateParams["filtri_materie"] as $m) {
            if($m['Codice'] === $templateParams["selected_subject"]) {
                $filtroMateria = $m;
                break;
            }
        }
    ?>
    <span class="badge d-flex align-items-center p-2 ps-3 fs-6 text-danger-emphasis bg-danger-subtle border border-danger-subtle rounded-pill">
        Materia: <?php echo htmlspecialchars($filtroMateria ? $filtroMateria['Nome'] : ''); ?>
        <span class="vr mx-2"></span>
        <a href="cerca.php?q=<?php echo urlencode($templateParams["search_text"]); ?>&prof=<?php echo urlencode($templateParams["selected_prof"]); ?>&course=<?php echo urlencode($templateParams["selected_course"]); ?>&user=<?php echo urlencode($templateParams["selected_user"]); ?>" class="text-danger" style="text-decoration: none;">✕</a>
    </span>
    <?php endif; ?>

    <?php if(!empty($templateParams["selected_prof"])): 
        $filtroProf = null;
        foreach($templateParams["filtri_prof"] as $p) {
            if($p['Codice'] === $templateParams["selected_prof"]) {
                $filtroProf = $p;
                break;
            }
        }
    ?>
    <span class="badge d-flex align-items-center p-2 ps-3 fs-6 text-danger-emphasis bg-danger-subtle border border-danger-subtle rounded-pill">
        Prof: <?php echo htmlspecialchars($filtroProf ? $filtroProf['Nome'] : ''); ?>
        <span class="vr mx-2"></span>
        <a href="cerca.php?q=<?php echo urlencode($templateParams["search_text"]); ?>&subject=<?php echo urlencode($templateParams["selected_subject"]); ?>&course=<?php echo urlencode($templateParams["selected_course"]); ?>&user=<?php echo urlencode($templateParams["selected_user"]); ?>" class="text-danger" style="text-decoration: none;">✕</a>
    </span>
    <?php endif; ?>

    <?php if(!empty($templateParams["selected_course"])): ?>
    <span class="badge d-flex align-items-center p-2 ps-3 fs-6 text-danger-emphasis bg-danger-subtle border border-danger-subtle rounded-pill">
        Corso: <?php echo htmlspecialchars($templateParams["selected_course"]); ?>
        <span class="vr mx-2"></span>
        <a href="cerca.php?q=<?php echo urlencode($templateParams["search_text"]); ?>&prof=<?php echo urlencode($templateParams["selected_prof"]); ?>&subject=<?php echo urlencode($templateParams["selected_subject"]); ?>&user=<?php echo urlencode($templateParams["selected_user"]); ?>" class="text-danger" style="text-decoration: none;">✕</a>
    </span>
    <?php endif; ?>

    <?php if(!empty($templateParams["selected_user"])): ?>
    <span class="badge d-flex align-items-center p-2 ps-3 fs-6 text-danger-emphasis bg-danger-subtle border border-danger-subtle rounded-pill">
        Utente: <?php echo htmlspecialchars($templateParams["selected_user"]); ?>
        <span class="vr mx-2"></span>
        <a href="cerca.php?q=<?php echo urlencode($templateParams["search_text"]); ?>&prof=<?php echo urlencode($templateParams["selected_prof"]); ?>&subject=<?php echo urlencode($templateParams["selected_subject"]); ?>&course=<?php echo urlencode($templateParams["selected_course"]); ?>" class="text-danger" style="text-decoration: none;">✕</a>
    </span>
    <?php endif; ?>
</div>
<?php endif; ?>

<div class="container pb-5">
    <div class="row">
        
        <!-- Chip Filtri -->
        <div class="col-12 mb-4">
            <button type="button" class="badge d-inline-flex align-items-center p-2 ps-3 text-danger-emphasis bg-danger-subtle border border-danger-subtle rounded-pill" data-bs-toggle="modal" data-bs-target="#filtersModal">
                <i class="bi bi-funnel me-2"></i> Filtri
                <?php if(!empty($templateParams["selected_prof"]) || !empty($templateParams["selected_subject"]) || !empty($templateParams["selected_course"]) || !empty($templateParams["selected_user"])): ?>
                    <span class="badge bg-danger ms-2">
                        <?php echo intval(!empty($templateParams["selected_prof"])) + intval(!empty($templateParams["selected_subject"])) + intval(!empty($templateParams["selected_course"])) + intval(!empty($templateParams["selected_user"])); ?>
                    </span>
                <?php endif; ?>
            </button>
        </div>

        <div class="col-12">
            
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="fw-bold m-0">Risultati <span class="text-muted fw-light fs-5">(<?php echo $templateParams["totalResults"]; ?> trovati)</span></h3>
            </div>

            <?php if(empty($templateParams["risultati"])): ?>
                <div class="alert alert-light text-center py-5 shadow-sm rounded-4" role="alert">
                    <i class="bi bi-search display-1 text-muted mb-3 d-block"></i>
                    <h4 class="fw-bold text-muted">Nessun appunto trovato</h4>
                    <p>Prova a cambiare i filtri o cerca qualcos'altro.</p>
                </div>
            <?php else: ?>
                <div class="row gx-4">
                    <div class="col-md-6">
                        <div class="list-group">
                            <?php foreach(array_slice($templateParams["risultati"], 0, ceil(count($templateParams["risultati"])/2)) as $appunto): ?>
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
                                    <span class="small text-muted"><i class="bi bi-star"></i> <?php echo round($appunto["media_recensioni"], 1); ?>/5</span>
                                </div>
                                <p class="small text-secondary mb-1">Prof. <?php echo htmlspecialchars($appunto["Professore"]); ?> - <?php echo htmlspecialchars($appunto["Corso_Laurea"]); ?></p>
                                <p class="small text-muted mb-0"><i class="bi bi-download"></i> <?php echo $appunto["Download"]; ?> download</p>
                            </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="list-group">
                            <?php foreach(array_slice($templateParams["risultati"], ceil(count($templateParams["risultati"])/2)) as $appunto): ?>
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
                                    <span class="small text-muted"><i class="bi bi-star"></i> <?php echo round($appunto["media_recensioni"], 1); ?>/5</span>
                                </div>
                                <p class="small text-secondary mb-1">Prof. <?php echo htmlspecialchars($appunto["Professore"]); ?> - <?php echo htmlspecialchars($appunto["Corso_Laurea"]); ?></p>
                                <p class="small text-muted mb-0"><i class="bi bi-download"></i> <?php echo $appunto["Download"]; ?> download</p>
                            </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>

                <!-- Paginazione -->
                <?php if($templateParams["totalPages"] > 1): ?>
                <nav aria-label="Paginazione" class="d-flex justify-content-center mt-5">
                    <ul class="pagination">
                        <?php if($templateParams["currentPage"] > 1): ?>
                        <li class="page-item">
                            <a class="page-link text-danger" href="cerca.php?q=<?php echo urlencode($templateParams["search_text"]); ?>&prof=<?php echo urlencode($templateParams["selected_prof"]); ?>&subject=<?php echo urlencode($templateParams["selected_subject"]); ?>&course=<?php echo urlencode($templateParams["selected_course"]); ?>&user=<?php echo urlencode($templateParams["selected_user"]); ?>&page=<?php echo $templateParams["currentPage"] - 1; ?>" aria-label="Precedente">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <?php endif; ?>

                        <?php for($i = 1; $i <= $templateParams["totalPages"]; $i++): ?>
                            <?php if($i >= $templateParams["currentPage"] - 2 && $i <= $templateParams["currentPage"] + 2): ?>
                            <li class="page-item <?php echo ($i == $templateParams["currentPage"]) ? 'active' : ''; ?>">
                                <a class="page-link text-danger" href="cerca.php?q=<?php echo urlencode($templateParams["search_text"]); ?>&prof=<?php echo urlencode($templateParams["selected_prof"]); ?>&subject=<?php echo urlencode($templateParams["selected_subject"]); ?>&course=<?php echo urlencode($templateParams["selected_course"]); ?>&user=<?php echo urlencode($templateParams["selected_user"]); ?>&page=<?php echo $i; ?>"><?php echo $i; ?></a>
                            </li>
                            <?php endif; ?>
                        <?php endfor; ?>

                        <?php if($templateParams["currentPage"] < $templateParams["totalPages"]): ?>
                        <li class="page-item">
                            <a class="page-link text-danger" href="cerca.php?q=<?php echo urlencode($templateParams["search_text"]); ?>&prof=<?php echo urlencode($templateParams["selected_prof"]); ?>&subject=<?php echo urlencode($templateParams["selected_subject"]); ?>&course=<?php echo urlencode($templateParams["selected_course"]); ?>&user=<?php echo urlencode($templateParams["selected_user"]); ?>&page=<?php echo $templateParams["currentPage"] + 1; ?>" aria-label="Successiva">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                        <?php endif; ?>
                    </ul>
                </nav>
                <?php endif; ?>
            <?php endif; ?>

        </div>
    </div>
</div>

<!-- Modal Filtri -->
<div class="modal fade" id="filtersModal" tabindex="-1" aria-labelledby="filtersModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 shadow border-0">
            <div class="modal-header border-bottom-0 pb-0">
                <h1 class="modal-title fs-5 fw-bold text-danger" id="filtersModalLabel"><i class="bi bi-funnel me-2"></i>Seleziona Filtri</h1>
                <button type="button" class="btn-close focus-ring focus-ring-danger" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="cerca.php" method="GET" id="filterForm">
                    <input type="hidden" name="q" value="<?php echo htmlspecialchars($templateParams["search_text"]); ?>">
                    
                    <div class="mb-4">
                        <label class="form-label fw-semibold small text-uppercase text-muted">Materia</label>
                        <select class="form-select focus-ring focus-ring-danger bg-light border-0" name="subject">
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
                        <select class="form-select focus-ring focus-ring-danger bg-light border-0" name="prof">
                            <option value="">Tutti i professori</option>
                            <?php foreach($templateParams["filtri_prof"] as $prof): ?>
                                <option value="<?php echo $prof['Codice']; ?>" <?php echo ($templateParams["selected_prof"] == $prof['Codice']) ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($prof['Nome']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold small text-uppercase text-muted">Corso di Laurea</label>
                        <select class="form-select focus-ring focus-ring-danger bg-light border-0" name="course">
                            <option value="">Tutti i corsi</option>
                            <?php foreach($templateParams["filtri_corsi"] as $corso): ?>
                                <option value="<?php echo htmlspecialchars($corso['Nome']); ?>" <?php echo ($templateParams["selected_course"] == $corso['Nome']) ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($corso['Nome']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold small text-uppercase text-muted">Utente</label>
                        <select class="form-select focus-ring focus-ring-danger bg-light border-0" name="user">
                            <option value="">Tutti gli utenti</option>
                            <?php foreach($templateParams["filtri_utenti"] as $utente): ?>
                                <option value="<?php echo htmlspecialchars($utente['Utente']); ?>" <?php echo ($templateParams["selected_user"] == $utente['Utente']) ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($utente['Utente']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer border-top-0 d-flex justify-content-between gap-2 pb-4 px-4">
                <a href="cerca.php?q=<?php echo urlencode($templateParams["search_text"]); ?>" class="btn btn-light rounded-pill px-4">Resetta</a>
                <div>
                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Annulla</button>
                    <button type="submit" form="filterForm" class="btn btn-danger rounded-pill px-4 fw-bold">Applica</button>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
/* Piccola animazione per le card */
.transition-up { transition: transform 0.2s; }
.transition-up:hover { transform: translateY(-5px); }
</style>