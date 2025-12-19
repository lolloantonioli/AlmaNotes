<section class="bg-light d-flex flex-column justify-content-center align-items-center vh-100" style="background-image: url(../img/sfondo.jpg); background-size: cover; background-position: center; background-repeat: no-repeat;">
    <div class="bg-light bg-opacity-95 rounded-4 shadow-lg p-4 p-sm-5 mx-3" style="max-width: 450px; width: 100%;">
    <div class="w-100 px-3" style="max-width: 400px;">
        
        <div class="text-center mb-0">
              <i class="bi bi-upload me-2"></i><h1 class="text-danger fw-bold">Carica</h1>
        </div>

        <div class="form-floating mb-0">
            <input type="text" class="form-control" id="floatingInput" placeholder="appunti">
            <label for="floatingInput">Nome File</label>
        </div>

        <div class="form-floating mb-0">
            <select class="form-select" id="floatingSelectProf" aria-label="Seleziona Professore">
                <option selected>Seleziona un professore</option>
                <option value="1">Prof. Cinti</option>
                <option value="2">Prof. Bononi</option>
                <option value="3">Prof. Ghini</option>
                <option value="4">Prof. Salvioli</option>
                <option value="5">Altro...</option>
                </select>
            <label for="floatingSelectProf">Professore</label>
        </div>

        <div class="form-floating mb-0">
            <select class="form-select" id="floatingSelectCourse" aria-label="Seleziona Corso di Laurea">
                <option selected>Seleziona un Corso di Laurea</option>
                <option value="1">Analisi</option>
                <option value="2">Ricerca</option>
                <option value="3">Basi di Dati</option>
                <option value="4">Musica</option>
                <option value="5">Altro...</option>
                </select>
            <label for="floatingSelectCourse">Corso di Laurea</label>
        </div>

        <div class="mb-3">
            <input class="form-control" type="file" id="formFile">
        </div>
        <div class="d-grid">
            <button class="btn btn-danger fw-bold py-2 rounded-3 shadow">
                <p class="m-0 fs-4">Carica</p> </button>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</section>