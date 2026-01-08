<section class="container py-5">
    <h2 class="fw-bold mb-4 red-title"><i class="bi bi-shield-lock"></i> Amministrazione</h2>

    <ul class="nav nav-tabs mb-4" id="adminTab" role="tablist">
        <li class="nav-item">
            <button class="nav-link active" id="users-tab" style="color: #BB2E29;" data-bs-toggle="tab" data-bs-target="#users" type="button" role="tab" aria-controls="users" aria-selected="true">Utenti</button>
        </li>
        <li class="nav-item">
            <button class="nav-link" id="notes-tab" style="color: #BB2E29;" data-bs-toggle="tab" data-bs-target="#notes" type="button" role="tab" aria-controls="notes" aria-selected="false">Appunti</button>
        </li>
    </ul>
    
    <div class="tab-content" id="adminTabContent">
        <div class="tab-pane fade show active" id="users" role="tabpanel" aria-labelledby="users-tab">
            <div class="table-responsive bg-white rounded shadow p-3">
                <table class="table table-hover align-middle">
                    <caption class="visually-hidden">Lista degli utenti registrati</caption>
                    <thead>
                        <tr>
                            <th scope="col">Username</th>
                            <th scope="col">Email</th>
                            <th scope="col">Elimina</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($templateParams["users"] as $u): ?>
                        <tr>
                            <th scope="row"><?php echo htmlspecialchars($u['Username']); ?></th>
                            <td><?php echo htmlspecialchars($u['Email']); ?></td>
                            <td>
                                <form method="POST">
                                    <input type="hidden" name="delete_user" value="<?php echo $u['Username']; ?>">
                                    <button type="button" class="btn btn-sm" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#modalConfermaEliminazione"
                                            onclick="preparaEliminazione(this)"
                                            aria-label="Elimina utente <?php echo htmlspecialchars($u['Username']); ?>">
                                        <i class="bi bi-trash" aria-hidden="true"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="tab-pane fade" id="notes" role="tabpanel" aria-labelledby="notes-tab">
            <div class="table-responsive bg-white rounded shadow p-3">
                <table class="table table-hover align-middle">
                    <caption class="visually-hidden">Lista degli appunti caricati dagli utenti</caption>
                    <thead>
                        <tr>
                            <th scope="col">Codice</th>
                            <th scope="col">Titolo</th>
                            <th scope="col">File</th>
                            <th scope="col">Autore</th>
                            <th scope="col">Elimina</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach($templateParams["notes"] as $n): ?>
                        <tr>
                            <th scope="row"><?php echo $n['Codice']; ?></th>
                            <td><?php echo htmlspecialchars($n['Nome']); ?></td>
                            <td>
                                <a href="uploads/<?php echo $n['NomeFile']; ?>" target="_blank" class="text-decoration-none" aria-label="Visualizza PDF di <?php echo htmlspecialchars($n['Nome']); ?>">
                                    <i class="bi bi-file-earmark-pdf" aria-hidden="true"></i> PDF
                                </a>
                            </td>
                            <td><?php echo htmlspecialchars($n['Utente']); ?></td>
                            <td>
                                <form method="POST">
                                    <input type="hidden" name="delete_note" value="<?php echo $n['Codice']; ?>">
                                    <button type="button" class="btn btn-sm" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#modalConfermaEliminazione"
                                            onclick="preparaEliminazione(this)"
                                            aria-label="Elimina appunto <?php echo htmlspecialchars($n['Nome']); ?>">
                                        <i class="bi bi-trash" aria-hidden="true"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<div class="modal fade" id="modalConfermaEliminazione" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title fw-bold red-title">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>Attenzione
                </h2>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Sei sicuro di voler procedere con l'eliminazione?<br>
                <span class="text-danger small">Questa azione è irreversibile.</span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                <button type="button" class="btn btn-danger fw-bold" id="confirmDeleteBtn">Elimina</button>
            </div>
        </div>
    </div>
</div>

<script>
    let formDaInviare = null; // Variabile per ricordare quale form dobbiamo inviare

    function preparaEliminazione(elementoBottone) {
        // Trova il form genitore del bottone che è stato cliccato
        formDaInviare = elementoBottone.closest('form');
    }

    // Quando clicchi "Sì, Elimina" nel modale
    document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
        if (formDaInviare) {
            formDaInviare.submit(); // Invia il form che avevamo memorizzato
        }
    });
</script>