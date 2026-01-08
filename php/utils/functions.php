<?php
function isActive($pageName){
    if(basename($_SERVER['PHP_SELF'])==$pageName){
        echo ' active fw-bold'; 
    }
}

function isUserLoggedIn(){
    return !empty($_SESSION['username']);
}

function registerLoggedUser($user){
    $_SESSION["username"] = $user["Username"];
}
?>