<?php
require_once 'bootstrap.php';

if (empty($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$utente = $_SESSION['username'];
$uploadedFiles = $dbh->getAllUploadedFiles($utente);

$templateParams["titolo"] = "Almanotes - I tuoi upload";
$templateParams["nome"] = "lista-upload-utente.php";
$templateParams["uploadedFiles"] = $uploadedFiles;

require 'template/base.php';
?>
