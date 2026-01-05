<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AlmaNotes - Accedi</title>
    <link rel="icon" type="image/png" href="img/logo.png"/>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather+Sans:wght@300;400;700&family=Merriweather:wght@300;400;700&family=Source+Sans+3:wght@300;400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>

<body class="bg-light d-flex flex-column justify-content-center align-items-center vh-100 overflow-x-hidden" style="background-image: url(img/sfondo.jpg); background-size: cover; background-position: center; background-repeat: no-repeat;">
    <?php if(isset($templateParams["errorelogin"])): ?>
        <div class="alert alert-danger">
            <?php echo $templateParams["errorelogin"]; ?>
        </div>
    <?php endif; ?>
    <form action="login.php" method="POST">

        <div></div>
        <div class="bg-light bg-opacity-95 rounded-4 shadow-lg p-4 p-sm-5 mx-3" style="max-width: 450px; width: 100%;">
            <div class="w-100 px-3" style="max-width: 400px;">
                <div class="text-center mb-2">
                    <img src="img/logo.png" alt="Logo" width="70" height="70"/><h1 class="text-danger fw-bold mb-4">Accedi</h1>
                </div>
                
                <div class="form-floating mb-2">
                    <input type="text" class="form-control focus-ring focus-ring-danger border border-danger-subtle" id="username" name="username" placeholder="Username" autocomplete="off" required/>
                    <label for="username">Username</label>
                </div>
                
                <div class="form-floating mb-3">
                    <input type="password" class="form-control focus-ring focus-ring-danger border border-danger-subtle" id="password" name="password" placeholder="Password" autocomplete="off" required/>
                    <label for="password">Password</label>
                </div>

                <p class="mb-3">Non sei registrato? <a href="./signup-form.php">Registrati qui</a></p>
                
                <div class="d-grid">
                    <input type="submit" class="btn btn-danger fw-bold py-2 rounded-3 shadow m-0 fs-4" value="Accedi"/>
                </div>
                
            </div>
        </form>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>