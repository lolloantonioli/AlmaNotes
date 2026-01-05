document.addEventListener('DOMContentLoaded', function() {
    
    const searchInput = document.getElementById('searchInput');
    const resultsList = document.getElementById('resultsList');
    
    // 1. FUNZIONE DI RICERCA VELOCE (Sui dati in memoria)
    if (searchInput && resultsList && typeof tuttiICorsi !== 'undefined') {
        
        searchInput.addEventListener('keyup', function() {
            const filter = this.value.toLowerCase().trim();
            
            // Se non hai scritto almeno 2 lettere, svuota tutto per velocità
            if (filter.length < 2) {
                resultsList.innerHTML = '<div class="text-center text-muted small mt-2">Scrivi almeno 2 caratteri...</div>';
                return;
            }

            // Filtra l'array JSON
            const risultati = tuttiICorsi.filter(item => {
                // Uniamo i campi per cercare ovunque
                const testoCompleto = (item.NomeCorso + ' ' + item.NomeProf + ' ' + item.NomeCdl).toLowerCase();
                return testoCompleto.includes(filter);
            });

            // Prendi solo i primi 20 risultati per non intasare il browser
            const topRisultati = risultati.slice(0, 20);

            // Genera l'HTML
            if (topRisultati.length > 0) {
                const htmlString = topRisultati.map(riga => {
                    const label = `${riga.NomeCorso} - ${riga.NomeProf} (${riga.NomeCdl})`;
                    // Attenzione agli apici nel HTML
                    const labelSafe = label.replace(/"/g, '&quot;'); 
                    
                    return `
                    <button type="button" class="list-group-item list-group-item-action btn-selezione" 
                            data-id-prof="${riga.CodiceProf}"
                            data-id-corso="${riga.CodiceCorso}"
                            data-label="${labelSafe}">
                        <div class="d-flex w-100 justify-content-between">
                            <h6 class="mb-1 text-danger fw-bold">${riga.NomeCorso}</h6>
                            <small class="text-muted">${riga.NomeCdl}</small>
                        </div>
                        <p class="mb-1 small">Prof. ${riga.NomeProf}</p>
                    </button>
                    `;
                }).join('');
                
                resultsList.innerHTML = htmlString;
            } else {
                resultsList.innerHTML = '<div class="text-center text-muted small">Nessun risultato trovato.</div>';
            }
        });
    }

    // 2. GESTIONE SELEZIONE (Delega evento)
    // Questo rimane quasi uguale a prima, usando la delega degli eventi
    if (resultsList) {
        resultsList.addEventListener('click', function(e) {
            const button = e.target.closest('.btn-selezione');
            
            if (button) {
                const idProf = button.getAttribute('data-id-prof');
                const idCorso = button.getAttribute('data-id-corso');
                const label = button.getAttribute('data-label');

                // Riempi input nascosti
                document.getElementById('hiddenProfessore').value = idProf;
                document.getElementById('hiddenInsegnamento').value = idCorso;
                document.getElementById('displayScelta').value = label;

                // Chiudi modale (Bootstrap 5)
                const modalElement = document.getElementById('modalRicerca');
                const modalInstance = bootstrap.Modal.getOrCreateInstance(modalElement);
                modalInstance.hide();
            }
        });
    }
});