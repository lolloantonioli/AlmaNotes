<?php
require_once 'bootstrap.php';

// 1. Recupera i parametri di ricerca dalla URL
$searchText = isset($_GET['q']) ? trim($_GET['q']) : '';
$filterProf = isset($_GET['prof']) ? $_GET['prof'] : '';
$filterSubject = isset($_GET['subject']) ? $_GET['subject'] : '';
$filterCourse = isset($_GET['course']) ? $_GET['course'] : '';
$filterUser = isset($_GET['user']) ? $_GET['user'] : '';

// Paginazione
$pageSize = 12; // Risultati per pagina
$currentPage = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$offset = ($currentPage - 1) * $pageSize;

// 2. Esegui la ricerca
$allResults = $dbh->searchNotes($searchText, $filterProf, $filterSubject);

// 3. Filtra ulteriormente per corso e utente (se i nuovi filtri non sono supportati da searchNotes)
$filteredResults = array_filter($allResults, function($appunto) use ($filterCourse, $filterUser) {
    if (!empty($filterCourse) && $appunto['Corso_Laurea'] !== $filterCourse) {
        return false;
    }
    if (!empty($filterUser) && $appunto['Utente'] !== $filterUser) {
        return false;
    }
    return true;
});

// Pagina i risultati
$totalResults = count($filteredResults);
$totalPages = ceil($totalResults / $pageSize);
$risultati = array_slice($filteredResults, $offset, $pageSize);

// 4. Recupera dati per i filtri (popola le select)
$listaProfessori = $dbh->getAllProfessors();
$listaMaterie = $dbh->getAllSubjects();
$listaCorsi = $dbh->getAllCourses();
$listaUtenti = $dbh->getAllUsers();

// 5. Setup Template
$templateParams["titolo"] = "AlmaNotes - Cerca";
$templateParams["nome"] = "ricerca.php";
$templateParams["risultati"] = $risultati;
$templateParams["filtri_prof"] = $listaProfessori;
$templateParams["filtri_materie"] = $listaMaterie;
$templateParams["filtri_corsi"] = $listaCorsi;
$templateParams["filtri_utenti"] = $listaUtenti;
$templateParams["currentPage"] = $currentPage;
$templateParams["totalPages"] = $totalPages;
$templateParams["totalResults"] = $totalResults;

// Valori attuali per mantenere i campi compilati
$templateParams["search_text"] = $searchText;
$templateParams["selected_prof"] = $filterProf;
$templateParams["selected_subject"] = $filterSubject;
$templateParams["selected_course"] = $filterCourse;
$templateParams["selected_user"] = $filterUser;

require 'template/base.php';
?>