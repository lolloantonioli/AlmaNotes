<?php
require_once 'bootstrap.php';

if (empty($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

if (isset($_GET['id'])) {
    $idAppunto = $_GET['id'];
    $username = $_SESSION['username'];

    $appunto = $dbh->getNoteById($idAppunto);

    if ($appunto) {
        $file = 'uploads/' . $appunto['NomeFile'];

        if (file_exists($file)) {
            $dbh->insertDownload($username, $idAppunto);

            header('Content-Description: File Transfer');
            header('Content-Type: application/pdf');
            header('Content-Disposition: attachment; filename="' . basename($file) . '"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file));
            
            readfile($file);
            exit;
        } else {
            die("Errore: Il file fisico non esiste sul server.");
        }
    } else {
        die("Errore: Appunto non trovato.");
    }
}
header("Location: index.php");
?>