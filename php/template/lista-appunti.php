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