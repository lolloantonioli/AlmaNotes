<?php
require_once 'bootstrap.php'; // Assicurati che carichi il db ($dbh)

header('Content-Type: application/json');

$query = $_GET['q'] ?? '';

if (strlen($query) < 2) {
    // Se la ricerca è troppo corta, restituisci array vuoto o messaggi minimi
    echo json_encode([]); 
    exit;
}

// Esegui la ricerca usando la funzione creata prima
$risultati = $dbh->searchCorsiProfessori($query);

// Restituisci i dati in formato JSON
echo json_encode($risultati);
?>