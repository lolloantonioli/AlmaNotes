<?php
require_once 'bootstrap.php';

$templateParams["titolo"] = "AlmaNotes - Home";
$templateParams["nome"] = "lista-appunti.php";
$templateParams["topappunti"] = $dbh->getTopNotes(9);
$templateParams["lastappunti"] = $dbh->getMostRecentsNotes(9);

require 'template/base.php';
require 'template/modal-download.php';
?>