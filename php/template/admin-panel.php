<section class="container py-5">
    <h2 class="text-danger fw-bold mb-4"><i class="bi bi-shield-lock"></i> Amministrazione</h2>

    <ul class="nav nav-tabs mb-4" id="adminTab" role="tablist">
        <li class="nav-item">
            <button class="nav-link active text-danger" data-bs-toggle="tab" data-bs-target="#users" type="button">Utenti</button>
        </li>
        <li class="nav-item">
            <button class="nav-link text-danger" data-bs-toggle="tab" data-bs-target="#notes" type="button">Appunti</button>
        </li>

    </ul>
    
    <div class="tab-content" id="adminTabContent">
        <div class="tab-pane fade show active" id="users">
            <div class="table-responsive bg-white rounded shadow p-3">
                <table class="table table-hover align-middle">
                    <th><tr><th>Username</th><th>Email</th><th>Elimina</th></tr></th>
                    <tbody>
                    <?php foreach($templateParams["users"] as $u): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($u['Username']); ?></td>
                            <td><?php echo htmlspecialchars($u['Email']); ?></td>
                            <td>
                            <form method="POST">
                                <input type="hidden" name="delete_user" value="<?php echo $u['Username']; ?>">
                                <button type="button" class="btn btn-sm btn-outline-danger" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#modalConfermaEliminazione"
                                        onclick="preparaEliminazione(this)">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="tab-pane fade" id="notes">
            <div class="table-responsive bg-white rounded shadow p-3">
                <table class="table table-hover align-middle">
                    <thead><tr><th>Codice</th><th>Titolo</th><th>File</th><th>Autore</th><th>Azioni</th></tr></thead>
                    <tbody>
                    <?php foreach($templateParams["notes"] as $n): ?>
                        <tr>
                            <td><?php echo $n['Codice']; ?></td>
                            <td><?php echo htmlspecialchars($n['Nome']); ?></td>
                            <td><a href="uploads/<?php echo $n['NomeFile']; ?>" target="_blank" class="text-decoration-none">PDF</a></td>
                            <td><?php echo htmlspecialchars($n['Utente']); ?></td>
                            <td>
                            <form method="POST">
                                <input type="hidden" name="delete_note" value="<?php echo $n['Codice']; ?>">
                                <button type="button" class="btn btn-sm btn-outline-danger" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#modalConfermaEliminazione"
                                        onclick="preparaEliminazione(this)">
                                    <i class="bi bi-trash"></i>
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
            <div class="modal-header bg-danger text-white">
                <h2 class="modal-title fw-bold">
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
                <button type="button" class="btn btn-danger fw-bold" id="confirmDeleteBtn">Sì, Elimina</button>
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