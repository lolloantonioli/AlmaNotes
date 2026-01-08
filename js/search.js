document.addEventListener('DOMContentLoaded', function() {
    
    const searchInput = document.getElementById('searchInput');
    const resultsList = document.getElementById('resultsList');
    
    if (searchInput && resultsList && typeof tuttiICorsi !== 'undefined') {
        
        searchInput.addEventListener('keyup', function() {
            const filter = this.value.toLowerCase().trim();
            
            if (filter.length < 2) {
                resultsList.innerHTML = '<div class="text-center text-muted small mt-2">Scrivi almeno 2 caratteri...</div>';
                return;
            }

            const risultati = tuttiICorsi.filter(item => {
                const testoCompleto = (item.NomeCorso + ' ' + item.NomeProf + ' ' + item.NomeCdl).toLowerCase();
                return testoCompleto.includes(filter);
            });

            const topRisultati = risultati.slice(0, 20);

            if (topRisultati.length > 0) {
                const htmlString = topRisultati.map(riga => {
                    const label = `${riga.NomeCorso} - ${riga.NomeProf} (${riga.NomeCdl})`;
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

    if (resultsList) {
        resultsList.addEventListener('click', function(e) {
            const button = e.target.closest('.btn-selezione');
            
            if (button) {
                const idProf = button.getAttribute('data-id-prof');
                const idCorso = button.getAttribute('data-id-corso');
                const label = button.getAttribute('data-label');

                document.getElementById('hiddenProfessore').value = idProf;
                document.getElementById('hiddenInsegnamento').value = idCorso;
                document.getElementById('displayScelta').value = label;

                const modalElement = document.getElementById('modalRicerca');
                const modalInstance = bootstrap.Modal.getOrCreateInstance(modalElement);
                modalInstance.hide();
            }
        });
    }
});