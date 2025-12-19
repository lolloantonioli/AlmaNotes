<div class="text-white container-fluid py-5 text-center position-relative z-1">
        <h1 class="display-5 fw-bold mt-5 mb-3">Gli appunti giusti per ogni esame</h1>
        <p class="lead mb-4 fw-light">
            Trova e condividi appunti specifici per ogni insegnamento e professore dell'UniBo
        </p>
        
        <div class="row justify-content-center">
            <div class="col-11 col-md-8 col-lg-8">
                <div class="input-group input-group-lg bg-white rounded-pill p-1 mb-5 mt-3 shadow">
                    <span class="input-group-text border-0 bg-transparent ps-3 text-muted">
                        <i class="bi bi-search"></i>
                    </span>
                    <input type="text" class="form-control border-0 bg-transparent" placeholder="Cerca per esame, professore o argomento">
                </div>
            </div>
        </div>
    </div>
<!--METTERE PIù RISULTATI PERCHè SE NO SEMBRA AUSTRIA-->
    <main class="container py-5">
        <div class="row g-5">
            
            <div class="col-12 col-lg-6">
                <h3 class="fw-bold mb-4 d-flex align-items-center gap-2">
                    <i class="bi bi-graph-up-arrow"></i> Più scaricati
                </h3>
                <div class="list-group shadow">
                    
                    <?php foreach ($templateparams["topappunti"] as $appunto): ?>
                    <a href="#" class="list-group-item list-group-item-action border border-danger">
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
                    <i class="bi bi-clock"></i> Ultimi caricati
                </h3>
                <div class="list-group shadow">
                    
                    <?php foreach ($templateparams["lastappunti"] as $appunto): ?>
                    <a href="#" class="list-group-item list-group-item-action border border-danger">
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