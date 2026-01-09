<!DOCTYPE html>
<html lang="it">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title><?php echo $templateParams["titolo"]; ?></title>
    <link rel="icon" type="image/png" href="../img/logo.png"/>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather+Sans:wght@300;400;700&family=Merriweather:wght@300;400;700&family=Source+Sans+3:wght@300;400;700&display=swap" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css"/>
    <link rel="stylesheet" type="text/css" href="/AlmaNotes/css/style.css"/>
</head>
<body class="bg-light overflow-x-hidden">
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm py-3">
            <div class="container-fluid">
                
                <button class="navbar-toggler border-0 d-lg-none order-0 d-inline-flex focus-ring focus-ring-danger py-1 px-2 text-decoration-none border rounded-2 user-select-none" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Menu di navigazione">
                    <span class="navbar-toggler-icon"></span>
                </button>
    
                <a class="navbar-brand fw-bold fs-3 mx-auto order-1 d-flex align-items-center gap-2 user-select-none" href="index.php">
                    <img src="../img/logo.png" alt="Logo di AlmaNotes" width="55" height="55"/><h1>AlmaNotes</h1>
                </a>
    
                <div class="d-flex align-items-center order-2 order-lg-3 user-select-none">
                    <a href="profilo.php" aria-label="Vai al profilo utente">
                        <i class="bi bi-person fs-3" aria-hidden="true"></i>
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
                                <a class="nav-link link-offset-2 px-3 <?php isActive("index.php");?>" 
                                href="index.php">
                                <i class="bi bi-house-door me-2"></i>Home
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link link-offset-2 px-3 <?php isActive("cerca.php");?>" 
                                href="cerca.php">
                                <i class="bi bi-search me-2"></i>Cerca
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link link-offset-2 px-3 <?php isActive("carica.php");?>" 
                                href="carica.php">
                                <i class="bi bi-cloud-upload me-2"></i>Carica
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link link-offset-2 px-3 <?php isActive("recensioni.php");?>" 
                                href="recensioni.php">
                                <i class="bi bi-star me-2"></i>Recensisci
                                </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link link-offset-2 px-3 <?php isActive("about.php");?>" 
                                href="about.php">
                                <i class="bi bi-info-circle me-2"></i>About
                                </a>
                            </li>

                            <?php if(isset($_SESSION['username']) && strtolower($_SESSION['username']) === 'admin'): ?>
                                <li class="nav-item">
                                    <a class="nav-link link-offset-2 px-3 <?php isActive("admin.php");?>" 
                                    href="admin.php">
                                    <i class="bi bi-shield-lock me-2"></i>Pannello Admin
                                    </a>
                                </li>
                            <?php endif; ?>

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
    <?php if(basename($_SERVER['PHP_SELF']) !== 'downloads.php' && basename($_SERVER['PHP_SELF']) !== 'carica.php' && basename($_SERVER['PHP_SELF']) !== 'admin.php'): ?>
        <section class="text-white py-5 text-center position-relative overflow-hidden">
            <img src="../img/sfondo.jpg" alt="" class="position-absolute top-0 start-0 w-100 h-100 object-fit-cover" aria-hidden="true"/>
            <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark opacity-50 user-select-none"></div>
            <div class="container position-relative z-1 py-4">
                <h2 class="fw-bold mb-4">Hai appunti da condividere?</h2>
                <a href="carica.php" class="btn btn-upload fw-bold px-4 py-2 rounded-3 shadow">
                    <i class="bi bi-upload me-2 white-icon" aria-hidden="true"></i>Carica qui
                </a>
            </div>
        </section>
    <?php endif; ?>
    
<footer class="bg-light pt-5 pb-3 border-top mt-auto">
        <div class="container">
            <div class="row">
                
                <div class="col-lg-2 col-md-2 mb-4 mb-lg-0 user-select-none">
                    <img src="../img/logo.png" alt="Logo di AlmaNotes" width="40" height="40" class="me-2"/>
                </div>

                <div class="col-lg-5 col-md-5 mb-4 mb-lg-0">
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="index.php" class="text-decoration-none text-body">Home</a></li>
                        <li class="mb-2"><a href="carica.php" class="text-decoration-none text-body">Carica Appunti</a></li>
                        <li class="mb-2"><a href="cerca.php" class="text-decoration-none text-body">Cerca</a></li>
                        <li class="mb-2"><a href="recensioni.php" class="text-decoration-none text-body">Recensioni</a></li>
                        <li class="mb-2"><a href="about.php" class="text-decoration-none text-body">About</a></li>
                        <?php if(isset($_SESSION['username']) && strtolower($_SESSION['username']) === 'admin'): ?>
                            <li class="mb-2"><a href="admin.php" class="text-decoration-none text-body">Pannello Admin</a></li>
                        <?php endif; ?>
                    </ul>
                </div>

                <div class="col-lg-5 col-md-5">
                    <ul class="list-unstyled text-body">
                        <li class="mb-3 d-flex align-items-start">
                            &copy; 2025 Almanotes | Tutti i diritti riservati.
                        </li>
                        <li class="mb-3 d-flex align-items-center">
                            <i class="bi bi-github me-2 user-select-none"></i>
                            <a href="https://github.com/Rolla04" class="text-decoration-none text-body">Luca Varale Rolla </a>
                        </li>
                        <li class="mb-3 d-flex align-items-center">
                            <i class="bi bi-github me-2 user-select-none"></i>
                            <a href="https://github.com/lolloantonioli" class="text-decoration-none text-body">Lorenzo Antonioli</a>
                        </li>
                    </ul>
                </div>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/AlmaNotes/js/reviews.js"></script>
    <script src="/AlmaNotes/js/modal.js"></script>
</body>
</html>