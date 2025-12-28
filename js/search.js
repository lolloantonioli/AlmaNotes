document.addEventListener('DOMContentLoaded', function() {
    
    // 1. GESTIONE SELEZIONE (Usando Data Attributes)
    // Invece di onclick inline, usiamo un listener globale sulla lista
    const resultsList = document.getElementById('resultsList');
    
    if (resultsList) {
        resultsList.addEventListener('click', function(e) {
            // Cerchiamo il bottone cliccato (anche se clicchi sul testo dentro il bottone)
            const button = e.target.closest('.btn-selezione');
            
            if (button) {
                // Leggiamo i dati sicuri dagli attributi data-...
                const idProf = button.dataset.idProf;
                const idCorso = button.dataset.idCorso;
                const label = button.dataset.label;

                console.log("Selezionato:", label, idProf, idCorso); // Debug

                // Riempiamo i campi
                document.getElementById('hiddenProfessore').value = idProf;
                document.getElementById('hiddenInsegnamento').value = idCorso;
                document.getElementById('displayScelta').value = label;

                // Chiudiamo il modale
                const modalElement = document.getElementById('modalRicerca');
                const modalInstance = bootstrap.Modal.getOrCreateInstance(modalElement);
                modalInstance.hide();
            }
        });

        // 2. GESTIONE FILTRO RICERCA
        const searchInput = document.getElementById('searchInput');
        if (searchInput) {
            searchInput.addEventListener('keyup', function() {
                const filter = this.value.toLowerCase();
                const buttons = resultsList.getElementsByTagName('button');

                for (let i = 0; i < buttons.length; i++) {
                    const text = buttons[i].textContent || buttons[i].innerText;
                    if (text.toLowerCase().indexOf(filter) > -1) {
                        buttons[i].style.display = ""; 
                    } else {
                        buttons[i].style.display = "none";
                    }
                }
            });
        }
    }
});