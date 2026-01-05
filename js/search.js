document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const resultsList = document.getElementById('resultsList');
    const modalRicerca = document.getElementById('modalRicerca');

    // Funzione per mostrare i risultati
    function renderResults(data) {
        resultsList.innerHTML = ''; // Pulisce la lista

        if (data.length === 0) {
            resultsList.innerHTML = '<div class="p-3 text-muted text-center">Nessun risultato trovato</div>';
            return;
        }

        data.forEach(item => {
            const label = `${item.NomeCorso} - ${item.NomeProf} (${item.NomeCdl})`;
            
            const btn = document.createElement('button');
            btn.type = 'button';
            btn.className = 'list-group-item list-group-item-action btn-selezione';
            // Salviamo i dati nel bottone
            btn.dataset.idProf = item.CodiceProf;
            btn.dataset.idCorso = item.CodiceCorso;
            btn.dataset.label = label;

            btn.innerHTML = `
                <div class="d-flex w-100 justify-content-between">
                    <h6 class="mb-1 text-danger fw-bold">${item.NomeCorso}</h6>
                    <small class="text-muted">${item.NomeCdl}</small>
                </div>
                <p class="mb-1 small">Prof. ${item.NomeProf}</p>
            `;

            resultsList.appendChild(btn);
        });
    }

    // LISTENER SULL'INPUT (AJAX)
    let timeout = null;
    searchInput.addEventListener('keyup', function() {
        const query = this.value.trim();

        // Evitiamo chiamate inutili se è vuoto
        if (query.length < 2) {
            resultsList.innerHTML = '<div class="text-center text-muted mt-3"><small>Scrivi almeno 2 caratteri...</small></div>';
            return;
        }

        // Debounce: aspetta 300ms che l'utente finisca di scrivere prima di chiamare il server
        clearTimeout(timeout);
        timeout = setTimeout(() => {
            fetch(`api-ricerca.php?q=${encodeURIComponent(query)}`)
                .then(response => response.json())
                .then(data => {
                    renderResults(data);
                })
                .catch(error => {
                    console.error('Errore:', error);
                    resultsList.innerHTML = '<div class="text-danger p-3">Errore nella ricerca</div>';
                });
        }, 300);
    });

    // LISTENER SUL CLICK DEI RISULTATI (Event Delegation)
    resultsList.addEventListener('click', function(e) {
        const btn = e.target.closest('.btn-selezione');
        if (btn) {
            // Preleva dati
            const idProf = btn.dataset.idProf;
            const idCorso = btn.dataset.idCorso;
            const label = btn.dataset.label;

            // Riempi form principale
            document.getElementById('hiddenProfessore').value = idProf;
            document.getElementById('hiddenInsegnamento').value = idCorso;
            document.getElementById('displayScelta').value = label;

            // Chiudi modale
            const modalInstance = bootstrap.Modal.getOrCreateInstance(modalRicerca);
            modalInstance.hide();
        }
    });

    // RESET ALL'APERTURA MODALE
    modalRicerca.addEventListener('shown.bs.modal', function () {
        searchInput.focus(); // Focus automatico
        searchInput.value = '';
        resultsList.innerHTML = '<div class="text-center text-muted mt-3"><small>Inizia a scrivere per cercare...</small></div>';
    });
});