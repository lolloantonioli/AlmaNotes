<?php
require_once('bootstrap.php');

if (!isset($_SESSION['username'])) {
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'Non autorizzato']);
    exit;
}

$appunti_codice = isset($_POST['appunti_codice']) ? intval($_POST['appunti_codice']) : 0;
$stelle = isset($_POST['stelle']) ? intval($_POST['stelle']) : 0;

if ($appunti_codice <= 0 || $stelle < 1 || $stelle > 5) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Dati non validi']);
    exit;
}

$utente = $_SESSION['username'];
$result = $dbh->insertRecensione($appunti_codice, $utente, $stelle);

if ($result) {
    $_SESSION['flash_message'] = 'Recensione salvata con successo!';
    $_SESSION['flash_type'] = 'success';
    echo json_encode(['success' => true, 'message' => 'Recensione salvata']);
} else {
    $_SESSION['flash_message'] = 'Errore nel salvataggio della recensione';
    $_SESSION['flash_type'] = 'danger';
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Errore nel salvataggio']);
}
?>
