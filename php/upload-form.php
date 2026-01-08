<?php 
    $listaDati = $dbh->getCorsiProfessori();
    $jsonDati = json_encode($listaDati);
?>

<section class="bg-light d-flex flex-column justify-content-center align-items-center vh-100" style="background-image: url(img/sfondo.jpg); background-size: cover; background-position: center; background-repeat: no-repeat;">
    <div class="bg-light bg-opacity-95 rounded-4 shadow-lg p-4 p-sm-5 mx-3" style="max-width: 450px; width: 100%;">
        <div class="w-100 px-3" style="max-width: 400px;">
            
            <div class="text-center mb-0">
                <h1 class="fw-bold mb-4 d-flex align-items-center justify-content-center gap-2" style="color: #BB2E29">
                    <i class="bi bi-upload fs-2"></i>
                    Carica
                </h1>
            </div>

            <?php if (isset($_SESSION['flash_message'])):
                $msg = htmlspecialchars($_SESSION['flash_message']);
                $type = $_SESSION['flash_type'] ?? 'info';
                unset($_SESSION['flash_message'], $_SESSION['flash_type']);
                $smallClass = ($type === 'success') ? 'text-success' : (($type === 'error') ? 'text-danger' : 'text-muted');
            ?>
            <div class="text-center mb-2"><small class="<?php echo $smallClass; ?>"><?php echo $msg; ?></small></div>
            <?php endif; ?>
            
            <form action="inserimento-appunti.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="professore" id="hiddenProfessore" required>
                <input type="hidden" name="insegnamento" id="hiddenInsegnamento" required>

                <div class="mb-3">
                    <label for="displayScelta" class="form-label">Corso e Professore</label>
                    <div class="input-group">
                        <input type="text" class="form-control focus-ring focus-ring-danger border border-danger-subtle" id="displayScelta" placeholder="Clicca per selezionare..." readonly style="background-color: white; cursor: pointer;" data-bs-toggle="modal" data-bs-target="#modalRicerca" required>
                    </div>

                </div>

                <div class="form-floating mb-3">
                    <input type="text" class="form-control focus-ring focus-ring-danger border border-danger-subtle" name="nome" id="nomeFileInput" placeholder="Nome File" autocomplete="off" required>
                    <label for="nomeFileInput">Nome File</label>
                </div>

                <div class="mb-4">
                    <input class="form-control focus-ring focus-ring-danger border border-danger-subtle" type="file" name="file" id="formFile" accept=".pdf" required>
                    <label for="formFile" class="form-label visually-hidden">Seleziona File PDF</label>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn fw-bold py-2 rounded-3 shadow m-0 fs-4" style="background-color: #BB2E29; color: white;">Carica</button>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="modalRicerca" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Seleziona Insegnamento e Docente</h5>
                    <button type="button" class="btn-close focus-ring focus-ring-danger" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <label for="searchInput" class="visually-hidden">Cerca corso o professore</label>
                    <input type="text" id="searchInput" class="form-control mb-3 focus-ring focus-ring-danger border border-danger-subtle" placeholder="Scrivi nome corso o prof..." autocomplete="off">
                    <div class="list-group" id="resultsList">
                        <div class="text-center text-muted small mt-2">Inizia a scrivere per cercare...</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        const tuttiICorsi = <?php echo $jsonDati; ?>;
    </script>
    <script src="/AlmaNotes/js/search.js"></script>
</section>