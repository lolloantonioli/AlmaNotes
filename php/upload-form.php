<?php 
    // Assicurati che $dbh sia inizializzato
    $listaDati = $dbh->getCorsiProfessori();
?>

<section class="bg-light d-flex flex-column justify-content-center align-items-center vh-100" style="background-image: url(img/sfondo.jpg); background-size: cover; background-position: center; background-repeat: no-repeat;">
    <div class="bg-light bg-opacity-95 rounded-4 shadow-lg p-4 p-sm-5 mx-3" style="max-width: 450px; width: 100%;">
        <div class="w-100 px-3" style="max-width: 400px;">
            
            <div class="text-center mb-0">
                <i class="bi bi-upload me-2 user-select-none"></i><h1 class="text-danger fw-bold">Carica</h1>
            </div>
            
            <form action="inserimento-appunti.php" method="POST" enctype="multipart/form-data">

                <input type="hidden" name="professore" id="hiddenProfessore" required>
                <input type="hidden" name="insegnamento" id="hiddenInsegnamento" required>

                <div class="mb-3">
                    <label class="form-label">Corso e Professore</label>
                    <div class="input-group">
                        <input type="text" class="form-control focus-ring focus-ring-danger" id="displayScelta" placeholder="Clicca per selezionare..." readonly style="background-color: white; cursor: pointer;" data-bs-toggle="modal" data-bs-target="#modalRicerca" required>
                        <button class="btn btn-outline-danger" type="button" data-bs-toggle="modal" data-bs-target="#modalRicerca">
                            <i class="bi bi-search"></i> Cerca
                        </button>
                    </div>
                </div>

                <div class="form-floating mb-2">
                    <input type="text" class="form-control focus-ring focus-ring-danger" name="nome" id="floatingInput" placeholder="appunti" autocomplete="off" required/>
                    <label for="floatingInput">Nome File</label>
                </div>
        
                <div class="mb-3">
                    <input class="form-control focus-ring focus-ring-danger" type="file" name="file" id="formFile" accept=".pdf" required>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-danger fw-bold py-2 rounded-3 shadow m-0 fs-4">Carica</button>
                </div>
        
            </form>
        </div>
    </div>

    <div class="modal fade" id="modalRicerca" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Seleziona Insegnamento e Docente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                
                <input type="text" id="searchInput" class="form-control mb-3" placeholder="Scrivi nome corso o prof...">

                <div class="list-group" id="resultsList">
                    <?php foreach ($listaDati as $riga): ?>
                        <?php 
                            $idProf = trim($riga['CodiceProf']);
                            $idCorso = trim($riga['CodiceCorso']);
                            $nomeCorso = htmlspecialchars($riga['NomeCorso']);
                            $nomeProf = htmlspecialchars($riga['NomeProf']);
                            $nomeCdl = htmlspecialchars($riga['NomeCdl']);
                            $labelCompleta = $riga['NomeCorso'] . ' - ' . $riga['NomeProf'] . ' (' . $riga['NomeCdl'] . ')';
                        ?>
                        
                        <button type="button" class="list-group-item list-group-item-action btn-selezione" 
                                data-id-prof="<?php echo $idProf; ?>"
                                data-id-corso="<?php echo $idCorso; ?>"
                                data-label="<?php echo htmlspecialchars($labelCompleta); ?>">
                            
                            <div class="d-flex w-100 justify-content-between">
                                <h6 class="mb-1 text-danger fw-bold"><?php echo $nomeCorso; ?></h6>
                                <small class="text-muted"><?php echo $nomeCdl; ?></small>
                            </div>
                            <p class="mb-1 small">Prof. <?php echo $nomeProf; ?></p>
                            
                            <span class="d-none"><?php echo strtolower($labelCompleta); ?></span>
                        
                        </button>
                    <?php endforeach; ?>
                </div>

            </div>
            </div>
        </div>
    </div>
    <script src="../js/search.js"></script>
</section>