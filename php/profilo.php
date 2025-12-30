<?php
require_once 'bootstrap.php';

//Base template
$templateParams["titolo"] = "AlmaNotes - Profilo";
$templateParams["nome"] = "dati-profilo.php";

$templateParams["utente"] = $dbh->getUserData($_SESSION["username"]);
$templateParams["previewdownloadedfiles"] = $dbh->getPreviewDownloadedFiles($_SESSION["username"]);

require 'template/base.php';
?>