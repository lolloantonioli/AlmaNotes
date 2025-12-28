<?php
require_once 'bootstrap.php';
if (isset($_POST["username"]) && isset($_POST["email"]) && isset($_POST["password"])) {
    $signup_result = $dbh->insertUser($_POST["username"], $_POST["email"], $_POST["password"]);
    if ($signup_result == true) {
        //registrazione avvenuta con successo
        $login_result = $dbh->checkLogin($_POST["username"], $_POST["password"]);
        registerLoggedUser($login_result[0]);
    } else {
        //registrazione fallita
        $templateParams["erroresignup"] = "Errore! Controllare i dati inseriti";
    }
}
if (isUserLoggedIn()) {
    $templateParams["nome"] = "index.php";
}
?>