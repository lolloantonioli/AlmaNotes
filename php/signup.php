<?php
require_once 'bootstrap.php';
if (isset($_POST["username"]) && isset($_POST["email"]) && isset($_POST["password"])) {
    $signup_result = $dbh->insertUser($_POST["username"], $_POST["email"], $_POST["password"]);
    if ($signup_result == true) {
        //registrazione avvenuta con successo
        $login_result = $dbh->checkLogin($_POST["username"], $_POST["password"]);
        if (count($login_result) > 0) {
            registerLoggedUser($login_result[0]);
            header("Location: index.php");
            exit;
        } else {
            $templateParams["erroresignup"] = "Registrazione riuscita ma errore nel login automatico.";
        }
    } else {
        //registrazione fallita
        $templateParams["erroresignup"] = "Errore! Controllare i dati inseriti";
    }
}
?>