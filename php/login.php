<?php
require_once 'bootstrap.php';
if (isUserLoggedIn()) {
    header("Location: index.php");
    exit;
}
if (isset($_POST["username"]) && isset($_POST["password"])) {
    $login_result = $dbh->checkLogin($_POST["username"], $_POST["password"]);
    if (count($login_result) == 0) {
        $templateParams["errorelogin"] = "Errore! Controllare username e password";
        require 'login-form.php';
        exit;
    } else {
        registerLoggedUser($login_result[0]);
        header("Location: index.php");
        exit;
    }
}
?>