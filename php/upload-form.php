<section class="bg-light d-flex flex-column justify-content-center align-items-center vh-100" style="background-image: url(img/sfondo.jpg); background-size: cover; background-position: center; background-repeat: no-repeat;">
    <div class="bg-light bg-opacity-95 rounded-4 shadow-lg p-4 p-sm-5 mx-3" style="max-width: 450px; width: 100%;">
    <div class="w-100 px-3" style="max-width: 400px;">
        
        <div class="text-center mb-0">
              <i class="bi bi-upload me-2"></i><h1 class="text-danger fw-bold">Carica</h1>
        </div>
        <form action="inserimento-appunti.php" method="POST" enctype="multipart/form-data">

            <div class="form-floating mb-2">
                <input type="text" class="form-control" id="floatingInput" placeholder="appunti" required/>
                <label for="floatingInput">Nome File</label>
            </div>
    
            <div class="form-floating mb-2">
                <input type="text" class="form-control" id="floatingInputProf" placeholder="professore" required/>
                <label for="floatingInputProf">Professore</label>
            </div>
    
            <div class="form-floating mb-2">
                <input type="text" class="form-control" id="floatingInputInsegnamento" placeholder="insegnamento" required/>
                <label for="floatingInputInsegnamento">Insegnamento</label>
            </div>
    
            <div class="mb-3">
                <input class="form-control" type="file" id="formFile">
            </div>

            <div class="d-grid">
                <input type="submit" class="btn btn-danger fw-bold py-2 rounded-3 shadow m-0 fs-4" value="Carica"/>
            </div>
    
        </form>
    </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</section>