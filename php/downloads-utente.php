<?php
require_once 'bootstrap.php';

if (empty($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$utente = $_SESSION['username'];
$downloadedFiles = $dbh->getAllDownloadedFiles($utente);

$templateParams["titolo"] = "Almanotes - I tuoi download";
$templateParams["nome"] = "lista-download-utente.php";
$templateParams["downloadedFiles"] = $downloadedFiles;

require 'template/base.php';
?>
