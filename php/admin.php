<?php
require_once 'bootstrap.php';

// Sicurezza: Se non è admin, via!
if (empty($_SESSION['username']) || strtolower($_SESSION['username']) !== 'admin') {
    header("Location: index.php");
    exit;
}
// Gestione Eliminazioni (POST)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['delete_user'])) {
        $dbh->deleteUser($_POST['delete_user']);
    }
    elseif (isset($_POST['delete_note'])) {
        $dbh->deleteNote($_POST['delete_note']);
    }
    elseif (isset($_POST['delete_review'])) {
        $dbh->deleteReview($_POST['delete_review']);
    }
    // Refresh per evitare reinvio form
    header("Location: admin.php");
    exit;
}

// Recupero Dati
$templateParams["titolo"] = "AlmaNotes - Pannello Admin";
$templateParams["nome"] = "admin-panel.php";
$templateParams["users"] = $dbh->getUsersForAdmin();
$templateParams["notes"] = $dbh->getAllNotes();

require 'template/base.php';
?>