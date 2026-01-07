<?php
require_once 'bootstrap.php';

// Controllo se l'utente è loggato
if (empty($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$action = $_POST['action'] ?? '';
$id = $_POST['id'] ?? null;
$username = $_SESSION['username'];

if (!$id) {
    // Gestione errore
    header("Location: uploads-utente.php");
    exit;
}

if ($action === 'update') {
    $nuovoNome = trim($_POST['nome']);
    if (!empty($nuovoNome)) {
        $dbh->updateNoteName($id, $nuovoNome, $username);
    }
} elseif ($action === 'delete') {
    $dbh->deleteNote($id, $username);
}

// Ritorna alla pagina degli upload
header("Location: uploads-utente.php");
exit;
?>