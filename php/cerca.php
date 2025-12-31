<?php
require_once 'bootstrap.php';

// 1. Recupera i parametri di ricerca dalla URL
$searchText = isset($_GET['q']) ? trim($_GET['q']) : '';
$filterProf = isset($_GET['prof']) ? $_GET['prof'] : '';
$filterSubject = isset($_GET['subject']) ? $_GET['subject'] : '';

// 2. Esegui la ricerca
$risultati = $dbh->searchNotes($searchText, $filterProf, $filterSubject);

// 3. Recupera dati per i filtri (popola le select)
$listaProfessori = $dbh->getAllProfessors();
$listaMaterie = $dbh->getAllSubjects();

// 4. Recupera i "Top Notes" per il carosello in basso
$topNotes = $dbh->getTopNotes(9); 

// 5. Setup Template
$templateParams["titolo"] = "AlmaNotes - Cerca";
$templateParams["nome"] = "ricerca.php";
$templateParams["risultati"] = $risultati;
$templateParams["filtri_prof"] = $listaProfessori;
$templateParams["filtri_materie"] = $listaMaterie;
$templateParams["carosello"] = $topNotes;

// Valori attuali per mantenere i campi compilati
$templateParams["search_text"] = $searchText;
$templateParams["selected_prof"] = $filterProf;
$templateParams["selected_subject"] = $filterSubject;

require 'template/base.php';
?>