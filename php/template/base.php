<!DOCTYPE html>
<html lang="it">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $templateParams["titolo"]; ?></title>
    <link rel="icon" type="image/png" href="img/logo.png"/>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather+Sans:wght@300;400;700&family=Merriweather:wght@300;400;700&family=Source+Sans+3:wght@300;400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="css/style.css" />
</head>
<body class="bg-light overflow-x-hidden">
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm py-3">
            <div class="container-fluid">
                
                <button class="navbar-toggler border-0 d-lg-none order-0 d-inline-flex focus-ring focus-ring-danger py-1 px-2 text-decoration-none border rounded-2 user-select-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>
    
                <a class="navbar-brand fw-bold fs-3 mx-auto order-1 d-flex align-items-center gap-2 user-select-none" href="index.php">
                    <img src="img/logo.png" alt="Logo" width="55" height="55"/><h1>AlmaNotes</h1>
                </a>
    
                <div class="d-flex align-items-center order-2 order-lg-3 user-select-none">
                    <a href="profilo.php" >
                        <i class="bi bi-person fs-3"></i>
                    </a>
                </div>
    
                <div class="offcanvas offcanvas-start order-lg-2" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                    
                    <div class="offcanvas-header">
                        <h4 class="offcanvas-title fw-bold" id="offcanvasNavbarLabel">Menu</h4>
                        <button type="button" class="btn-close focus-ring focus-ring-danger" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
    
                    <div class="offcanvas-body">
                        <ul class="navbar-nav justify-content-left flex-grow-1 pe-3 gap-lg-4">
                            
                            <li class="nav-item">
                                <a class="nav-link text-danger link-offset-2 px-3 <?php isActive("index.php");?>" 
                                href="index.php">
                                <i class="bi bi-house-door me-2"></i>Home
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link text-danger link-offset-2 px-3 <?php isActive("cerca.php");?>" 
                                href="cerca.php">
                                <i class="bi bi-search me-2"></i>Cerca
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link text-danger link-offset-2 px-3 <?php isActive("carica.php");?>" 
                                href="carica.php">
                                <i class="bi bi-cloud-upload me-2"></i>Carica
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link text-danger link-offset-2 px-3 <?php isActive("recensioni.php");?>" 
                                href="recensioni.php">
                                <i class="bi bi-star me-2"></i>Recensisci
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link text-danger link-offset-2 px-3 <?php isActive("about.php");?>" 
                                href="about.php">
                                <i class="bi bi-info-circle me-2"></i>About
                                </a>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <main>
        <?php
        if(isset($templateParams["nome"])){
            require($templateParams["nome"]);
        }

        
        ?>

    </main>
    <?php 
    // Controlla se il file nella barra degli indirizzi richiede anche il carica qui
    if(basename($_SERVER['PHP_SELF']) !== 'downloads.php' && basename($_SERVER['PHP_SELF']) !== 'carica.php'): 
    ?>
        <section class="text-white py-5 text-center">
            <div class="container z-1 py-4">
                <h2 class="fw-bold mb-4">Hai appunti da condividere?</h2>
                <a href="carica.php" class="btn btn-light btn-upload fw-bold px-4 py-2 rounded-3 shadow">
                    <i class="bi bi-upload me-2"></i>Carica qui
                </a>
            </div>
        </section>
    <?php endif; ?>
    
<footer class="bg-light pt-5 pb-3 border-top mt-auto">
        <div class="container">
            <div class="row">
                
                <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                    <a href="index.php" class="d-flex align-items-center text-dark text-decoration-none mb-3">
                        <img src="img/logo.png" alt="Logo" width="40" height="40" class="me-2"/>
                        <span class="fs-4 fw-bold">AlmaNotes</span>
                    </a>
                </div>

                <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="index.php" class="text-decoration-none text-secondary hover-danger">Home</a></li>
                        <li class="mb-2"><a href="carica.php" class="text-decoration-none text-secondary hover-danger">Carica Appunti</a></li>
                        <li class="mb-2"><a href="cerca.php" class="text-decoration-none text-secondary hover-danger">Cerca</a></li>
                        <li class="mb-2"><a href="recensioni.php" class="text-decoration-none text-secondary hover-danger">Recensioni</a></li>
                        <li class="mb-2"><a href="about.php" class="text-decoration-none text-secondary hover-danger">About</a></li>
                    </ul>
                </div>

                <div class="col-lg-4 col-md-12">
                    <ul class="list-unstyled text-secondary">
                        <li class="mb-3 d-flex align-items-start">
                            &copy; 2025 Almanotes | Tutti i diritti riservati.
                        </li>
                        <li class="mb-3 d-flex align-items-center">
                            <i class="bi bi-github text-danger me-2"></i>
                            <a href="https://github.com/Rolla04" class="text-decoration-none text-secondary">Luca Varale Rolla </a>
                        </li>
                        <li class="mb-3 d-flex align-items-center">
                            <i class="bi bi-github text-danger me-2"></i>
                            <a href="https://github.com/lolloantonioli" class="text-decoration-none text-secondary">Lorenzo Antonioli</a>
                        </li>
                    </ul>
                </div>
        </div>
    </footer>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="/AlmaNotes/js/reviews.js"></script>
<script src="/AlmaNotes/js/modal.js"></script>
</html>