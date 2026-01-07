<main class="container py-5">
    <div class="row g-5">
        
        <div class="col-12 col-lg-8 mx-auto"> 
            
            <div class="d-flex justify-content-center align-items-center gap-3 mb-4">
                <h3><i class="bi bi-person display-6"></i> Il tuo profilo</h3>
            </div>

            
                <div class="list-group list-group-flush card shadow border border-danger-subtle rounded">
    
    <div class="list-group-item p-4 border-bottom border-danger-subtle">
        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex justify-content-start user-select-none" style="width: 50px;">
                <i class="bi bi-at display-6"></i>
            </div>
            
            <div class="flex-grow-1 text-center px-2">
                <h5 class="font-serif fw-bold mb-1">Username</h5>
                <p class="font-sans text-secondary mb-0 text-break"><?php echo $templateParams["utente"]["Username"]; ?></p>
            </div>
            
            <div style="width: 50px;"></div>
        </div>
    </div>

    <div class="list-group-item p-4 border-bottom border-danger-subtle">
        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex justify-content-start user-select-none" style="width: 50px;">
                <i class="bi bi-envelope display-6"></i>
            </div>
            
            <div class="flex-grow-1 text-center px-2">
                <h5 class="font-serif fw-bold mb-1">E-mail</h5>
                <p class="font-sans text-secondary mb-0 text-break"><?php echo $templateParams["utente"]["Email"]; ?></p>
            </div>

            <div style="width: 50px;"></div>
        </div>
    </div>

    <div class="list-group-item p-4">
        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex justify-content-start user-select-none" style="width: 50px;">
                <i class="bi bi-key display-6"></i>
            </div>
            
            <div class="flex-grow-1 text-center px-2"> 
                <h5 class="font-serif fw-bold mb-1">Password</h5>
                <p id="password-text" class="font-sans text-secondary mb-0" data-password="<?php echo htmlspecialchars($templateParams["utente"]["Password"]); ?>">••••••••</p>
            </div>
            
            <div class="d-flex justify-content-end user-select-none" style="width: 50px;">
                <i id="toggle-password-icon" class="bi bi-eye fs-4" style="cursor: pointer;" onclick="togglePassword()"></i>
            </div>
        </div>
    </div>

</div>
        </div>
        
        <div class="col-12 col-lg-6">
            <div class="d-flex align-items-center mb-4 gap-3">
                <h3 class="fw-bold mb-0 d-flex align-items-center gap-2">
                    <i class="bi bi-download"></i> I file che hai scaricato
                </h3>
                <a href="downloads-utente.php" class="btn fw-bold px-3 shadow rounded-3" style="background-color: #BB2E29; color: white;">Vedi</a>
            </div>
            <div class="list-group shadow">
                <?php foreach ($templateParams["previewdownloadedfiles"] as $appunto): ?>
                <a href="#" class="list-group-item list-group-item-action border border-danger"
                   data-bs-toggle="modal"
                   data-bs-target="#downloadModal"
                   data-file-name="<?php echo htmlspecialchars($appunto["Nome"]); ?>"
                   data-file-prof="<?php echo htmlspecialchars($appunto["Professore"]); ?>"
                   data-file-course="<?php echo htmlspecialchars($appunto["Corso_Laurea"] ?? $appunto["CorsoDiLaurea"] ?? ''); ?>"
                   data-file-subject="<?php echo htmlspecialchars($appunto["Insegnamento"] ?? ''); ?>"
                   data-file-user="<?php echo htmlspecialchars($appunto["Utente"] ?? $templateParams["utente"]["Username"]); ?>"
                   data-file-date="<?php echo htmlspecialchars($appunto["Data_Download"] ?? $appunto["Data"] ?? ''); ?>"
                   data-file-downloads="<?php echo htmlspecialchars($appunto["Download"] ?? 0); ?>"
                   data-file-reviews-avg="<?php echo htmlspecialchars(round($appunto["media_recensioni"] ?? $appunto["MediaRecensioni"] ?? 0, 1)); ?>"
                   data-file-reviews-count="<?php echo htmlspecialchars($appunto["numero_recensioni"] ?? 0); ?>"
                   data-file-url="<?php echo isset($appunto["Codice"]) ? htmlspecialchars('download.php?id='.$appunto["Codice"]) : '#'; ?>"
                >
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1 fw-bold"><?php echo $appunto["Nome"]; ?></h5>
                        <span class="small text-muted">Data download: <?php echo $appunto["Data_Download"]; ?></span>
                    </div>
                    <p class="mb-1">Prof. <?php echo $appunto["Professore"]; ?> - <?php echo $appunto["Corso_Laurea"]; ?></p>
                    <p class="small text-muted mb-0"><i class="bi bi-download"></i> <?php echo $appunto["Download"]; ?> download</p>
                </a>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="col-12 col-lg-6">
            <div class="d-flex align-items-center mb-4 gap-3">
                <h3 class="fw-bold mb-0 d-flex align-items-center gap-2">
                    <i class="bi bi-upload"></i> I file che hai caricato
                </h3>
                <a href="uploads-utente.php" class="btn fw-bold px-3 shadow rounded-3" style="background-color: #BB2E29; color: white;">Modifica</a>
            </div>
            <div class="list-group shadow">
                <?php foreach ($templateParams["previewuploadedfiles"] as $appunto): ?>
                <a href="#" class="list-group-item list-group-item-action border border-danger"
                   data-bs-toggle="modal"
                   data-bs-target="#downloadModal"
                   data-file-name="<?php echo htmlspecialchars($appunto["Nome"]); ?>"
                   data-file-prof="<?php echo htmlspecialchars($appunto["Professore"]); ?>"
                   data-file-course="<?php echo htmlspecialchars($appunto["Corso_Laurea"] ?? $appunto["CorsoDiLaurea"] ?? ''); ?>"
                   data-file-subject="<?php echo htmlspecialchars($appunto["Insegnamento"] ?? ''); ?>"
                   data-file-user="<?php echo htmlspecialchars($appunto["Utente"] ?? $templateParams["utente"]["Username"]); ?>"
                   data-file-date="<?php echo htmlspecialchars($appunto["Data"] ?? ''); ?>"
                   data-file-downloads="<?php echo htmlspecialchars($appunto["Download"] ?? 0); ?>"
                   data-file-reviews-avg="<?php echo htmlspecialchars(round($appunto["media_recensioni"] ?? $appunto["MediaRecensioni"] ?? 0, 1)); ?>"
                   data-file-reviews-count="<?php echo htmlspecialchars($appunto["numero_recensioni"] ?? 0); ?>"
                   data-file-url="<?php echo isset($appunto["Codice"]) ? htmlspecialchars('download.php?id='.$appunto["Codice"]) : '#'; ?>"
                >
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1 fw-bold"><?php echo $appunto["Nome"]; ?></h5>
                        <span class="small text-muted"><i class="bi bi-star-fill text-warning"></i> <?php echo round($appunto["media_recensioni"], 1); ?></span>                    </div>
                    <p class="mb-1">Prof. <?php echo $appunto["Professore"]; ?> - <?php echo $appunto["Corso_Laurea"]; ?></p>
                    <p class="small text-muted mb-0"><i class="bi bi-download"></i> <?php echo $appunto["Download"]; ?> download</p>
                </a>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="col-12 col-lg-6">
            <h3 class="fw-bold mb-4 d-flex align-items-center gap-2">
                <i class="bi bi-graph-up-arrow"></i>I più popolari
            </h3>
            <div class="list-group shadow">
                <?php foreach ($templateParams["topnotes"] as $appunto): ?>
                <a href="#" class="list-group-item list-group-item-action border border-danger"
                   data-bs-toggle="modal"
                   data-bs-target="#downloadModal"
                   data-file-name="<?php echo htmlspecialchars($appunto["Nome"]); ?>"
                   data-file-prof="<?php echo htmlspecialchars($appunto["Professore"]); ?>"
                   data-file-course="<?php echo htmlspecialchars($appunto["CorsoDiLaurea"] ?? $appunto["Corso_Laurea"] ?? ''); ?>"
                   data-file-subject="<?php echo htmlspecialchars($appunto["Insegnamento"] ?? ''); ?>"
                   data-file-user="<?php echo htmlspecialchars($appunto["Utente"] ?? $templateParams["utente"]["Username"]); ?>"
                   data-file-date="<?php echo htmlspecialchars($appunto["Data"] ?? ''); ?>"
                   data-file-downloads="<?php echo htmlspecialchars($appunto["Download"] ?? 0); ?>"
                   data-file-reviews-avg="<?php echo htmlspecialchars(round($appunto["media_recensioni"] ?? $appunto["MediaRecensioni"] ?? 0, 1)); ?>"
                   data-file-reviews-count="<?php echo htmlspecialchars($appunto["numero_recensioni"] ?? 0); ?>"
                   data-file-url="<?php echo isset($appunto["Codice"]) ? htmlspecialchars('download.php?id='.$appunto["Codice"]) : '#'; ?>"
                >
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1 fw-bold"><?php echo $appunto["Nome"]; ?></h5>
                        <span class="small text-muted"><?php echo $appunto["Data"]; ?></span>
                    </div>
                    <p class="mb-1">Prof. <?php echo $appunto["Professore"]; ?> - <?php echo $appunto["CorsoDiLaurea"]; ?></p>
                    <p class="small text-muted mb-0"><i class="bi bi-download"></i> <?php echo $appunto["Download"]; ?> download</p>
                </a>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="col-12 col-lg-6">
            <h3 class="fw-bold mb-4 d-flex align-items-center gap-2">
                <i class="bi bi-star"></i> I fan Favourites
            </h3>
            <div class="list-group shadow">
                <?php foreach ($templateParams["favoritesnotes"] as $appunto): ?>
                <a href="#" class="list-group-item list-group-item-action border border-danger"
                   data-bs-toggle="modal"
                   data-bs-target="#downloadModal"
                   data-file-name="<?php echo htmlspecialchars($appunto["Nome"]); ?>"
                   data-file-prof="<?php echo htmlspecialchars($appunto["Professore"]); ?>"
                   data-file-course="<?php echo htmlspecialchars($appunto["CorsoDiLaurea"] ?? $appunto["Corso_Laurea"] ?? ''); ?>"
                   data-file-subject="<?php echo htmlspecialchars($appunto["Insegnamento"] ?? ''); ?>"
                   data-file-user="<?php echo htmlspecialchars($appunto["Utente"] ?? $templateParams["utente"]["Username"]); ?>"
                   data-file-date="<?php echo htmlspecialchars($appunto["Data"] ?? ''); ?>"
                   data-file-downloads="<?php echo htmlspecialchars($appunto["Download"] ?? 0); ?>"
                   data-file-reviews-avg="<?php echo htmlspecialchars(round($appunto["MediaRecensioni"] ?? $appunto["media_recensioni"] ?? 0, 1)); ?>"
                   data-file-reviews-count="<?php echo htmlspecialchars($appunto["numero_recensioni"] ?? 0); ?>"
                   data-file-url="<?php echo isset($appunto["Codice"]) ? htmlspecialchars('download.php?id='.$appunto["Codice"]) : '#'; ?>"
                >
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1 fw-bold"><?php echo $appunto["Nome"]; ?></h5>
                        <span class="small text-muted"><i class="bi bi-star-fill text-warning"></i> <?php echo round($appunto["MediaRecensioni"], 1); ?></span>
                    </div>
                    <p class="mb-1">Prof. <?php echo $appunto["Professore"]; ?> - <?php echo $appunto["CorsoDiLaurea"]; ?></p>
                    <p class="small text-muted mb-0"><i class="bi bi-download"></i> <?php echo $appunto["Download"]; ?> download</p>
                </a>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="col-12 text-center mt-5 mb-3">
            <button type="button" class="btn btn-outline-danger btn-lg px-5 rounded-pill fw-bold shadow" data-bs-toggle="modal" data-bs-target="#logoutModal">
                <i class="bi bi-box-arrow-right me-2"></i>Esci dal Profilo
            </button>
        </div>
    </div>
</main>
<div class="modal fade" id="logoutModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 shadow border-0">
            
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title fw-bold">Conferma Logout</h5>
                <button type="button" class="btn-close focus-ring focus-ring-danger" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <div class="modal-body text-center py-4">
                <i class="bi bi-exclamation-circle text-warning display-4 d-block mb-3"></i>
                <p class="mb-0 fs-5">Sei sicuro di voler uscire dal tuo account?</p>
            </div>
            
            <div class="modal-footer border-top-0 d-flex justify-content-center gap-3 pb-4">
                <button type="button" class="btn btn-light rounded-pill px-4 fw-bold" data-bs-dismiss="modal">Annulla</button>
                <a href="logout.php" class="btn btn-danger rounded-pill px-4 fw-bold">Esci</a>
            </div>

        </div>
    </div>
</div>
<script>
function togglePassword() {
    // 1. Prendi i riferimenti agli elementi
    const passwordText = document.getElementById('password-text');
    const toggleIcon = document.getElementById('toggle-password-icon');
    
    // 2. Leggi la password reale salvata nell'attributo
    const realPassword = passwordText.getAttribute('data-password');
    const maskedPassword = "••••••••"; // O qualsiasi stringa di mascheramento vuoi

    // 3. Controlla lo stato attuale e scambia
    if (passwordText.innerText === maskedPassword) {
        // MOSTRA: Sostituisci i pallini con la password vera
        passwordText.innerText = realPassword;
        
        // Cambia l'icona in "occhio barrato" (opzionale, ma carino)
        toggleIcon.classList.remove('bi-eye');
        toggleIcon.classList.add('bi-eye-slash');
    } else {
        // NASCONDI: Rimetti i pallini
        passwordText.innerText = maskedPassword;
        
        // Ripristina l'icona "occhio aperto"
        toggleIcon.classList.remove('bi-eye-slash');
        toggleIcon.classList.add('bi-eye');
    }
}
</script>