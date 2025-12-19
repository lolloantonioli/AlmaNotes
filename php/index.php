<?php
require_once 'bootstrap.php';

//Base template
$templateParams["titolo"] = "AlmaNotes - Home";
$templateParams["nome"] = "lista-appunti.php";
//Home template
$templateParams["topappunti"] = $dbh->getTopNotes(9);
$templateParams["lastappunti"] = $dbh->getMostRecentsNotes(9);

require 'template/base.php'
?>