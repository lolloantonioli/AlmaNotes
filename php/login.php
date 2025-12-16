<?php
require_once 'bootstrap.php';

if(isset($_POST["username"]) && isset ($_POST["password"])){
    $login_result = $dbh->checkLogin($_POST["username"], $_POST["password"]);
    if(count($login_result)==0){
        //login fallito
        $templateParams["errorelogin"] = "Errore! Controllare username e password";
    }else{
        registerLoggedUser($login_result[0]);
    }
}

if(isUserLoggedIn()){
    $templateParams["nome"] = "index.php";
}else{
    $templateParams["titolo"] = "Blog TW - Login";
    $templateParams["nome"] = "login-form.php";
}

require 'template/base.php';
?>