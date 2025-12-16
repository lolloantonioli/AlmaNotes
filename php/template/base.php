<!DOCTYPE html>
<html lang="it">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $templateParams["titolo"]; ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather+Sans:wght@300;400;700&family=Merriweather:wght@300;400;700&family=Source+Sans+3:wght@300;400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="css/style.css" />
</head>
<body class="bg-light overflow-x-hidden">
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm py-3">
            <div class="container-fluid">
                
                <button class="navbar-toggler border-0 d-lg-none order-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>
    
                <a class="navbar-brand fw-bold fs-3 mx-auto order-1 d-flex align-items-center gap-2" href="index.html">
                    <img src="img/logo.png" alt="Logo" width="55" height="55"/><h1>AlmaNotes</h1>
                </a>
    
                <div class="d-flex align-items-center order-2 order-lg-3">
                    <a href="profilo.php" >
                        <i class="bi bi-person"></i>
                    </a>
                </div>
    
                <div class="offcanvas offcanvas-start order-lg-2" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                    
                    <div class="offcanvas-header">
                        <h4 class="offcanvas-title fw-bold" id="offcanvasNavbarLabel">Menu</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
    
                    <div class="offcanvas-body">
                        <ul class="navbar-nav justify-content-left flex-grow-1 pe-3 gap-lg-4">
                            <li class="nav-item"><a <?php isActive("index.php");?> class="nav-link text-danger fw-semibold" href="index.php">Home</a></li><li class="nav-item"><a <?php !isActive("index.php");?> class="nav-link text-secondary" href="index.php">Home</a></li>
                            <li class="nav-item"><a <?php !isActive("cerca.php");?> class="nav-link text-danger text-secondary" href="cerca.php">Cerca</a></li><li class="nav-item"><a <?php isActive("cerca.php");?> class="nav-link text-danger fw-bold" href="cerca.php">Cerca</a></li>
                            <li class="nav-item"><a <?php isActive("carica.php");?> class="nav-link text-danger fw-bold" href="carica.php">Carica</a></li><li class="nav-item"><a <?php !isActive("carica.php");?> class="nav-link text-danger text-secondary" href="carica.php">Carica</a></li>
                            <li class="nav-item"><a <?php !isActive("carica.php");?>  class="nav-link text-danger text-secondary" href="contatti.php">Contatti</a></li><li class="nav-item"><a <?php isActive("carica.php");?>  class="nav-link text-danger fw-bold" href="contatti.php">Contatti</a></li>
                            <li class="nav-item"><a <?php !isActive("about.php");?> class="nav-link text-danger text-secondary" href="about.php">About</a></li><li class="nav-item"><a <?php isActive("about.php");?> class="nav-link text-danger fw-bold" href="about.php">About</a></li>
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
    if(basename($_SERVER['PHP_SELF']) !== 'downloads.php' || basename($_SERVER['PHP_SELF']) !== 'carica.php'): 
    ?>
        <section class="text-white py-5 text-center">
            <div class="container z-1 py-4">
                <h2 class="fw-bold mb-4">Hai appunti da condividere?</h2>
                <button class="btn btn-light btn-upload fw-bold px-4 py-2 rounded-3 shadow">
                    <i class="bi bi-upload me-2"></i>Carica qui
                </button>
            </div>
        </section>
    <?php endif; ?>
    
    <footer class="bg-light py-5 border-top">
        <div class="container">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
                
                <div class="text-secondary small d-flex align-items-center gap-2">
                    <i class="bi bi-c-circle"></i> 2025 - AlmaNotes - Lorenzo Antonioli, Luca Varale Rolla
                </div>

                <div class="fs-3">
                     <img src="img/logo.png" alt="Logo" width="55" height="55"></img>
                </div>

                <div class="d-flex gap-4 small opacity-50">
                    <a href="index.php" class="text-decoration-none text-reset">Home</a>
                    <a href="carica.php" class="text-decoration-none text-reset">Carica</a>
                    <a href="cerca.php" class="text-decoration-none text-reset">Cerca</a>
                    <a href="contatti.php" class="text-decoration-none text-reset">Contatti</a>
                    <a href="about.php" class="text-decoration-none text-reset">About</a>
                </div>

            </div>
        </div>
    </footer>
</body>
</html>