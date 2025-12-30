<?php
require_once 'bootstrap.php';

//Base template
$templateParams["titolo"] = "AlmaNotes - Profilo";
$templateParams["nome"] = "dati-profilo.php";

$templateParams["utente"] = $dbh->getUserData($_SESSION["username"]);
$templateParams["previewdownloadedfiles"] = $dbh->getPreviewDownloadedFiles($_SESSION["username"], 3);
$templateParams["previewuploadedfiles"] = $dbh->getPreviewUploadedFiles($_SESSION["username"], 3);
$templateParams["topnotes"] = $dbh->getTopNotesByUser($_SESSION["username"], 3);
$templateParams["favoritesnotes"] = $dbh->getMostFavoritesNotesByUser($_SESSION["username"], 3);

require 'template/base.php';
?>