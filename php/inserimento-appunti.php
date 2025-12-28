<?php
require_once 'bootstrap.php'; 

if (empty($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // 1. Recupero input con TRIM (Sicurezza contro gli spazi invisibili)
    $nomeAppunto = trim($_POST['nome']);
    $idProfessore = trim($_POST['professore']); 
    $idInsegnamento = trim($_POST['insegnamento']); // Usato solo per controllo
    $utente = $_SESSION['username'];

    // 2. Controllo File
    if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
        
        $fileTmpPath = $_FILES['file']['tmp_name'];
        $fileName = $_FILES['file']['name'];
        
        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $mimeType = $finfo->file($fileTmpPath);

        if ($mimeType === 'application/pdf') {
            
            // Genera nome unico pulito
            $cleanFileName = preg_replace('/[^A-Za-z0-9_\-]/', '_', pathinfo($fileName, PATHINFO_FILENAME));
            $newFileName = uniqid() . "_" . $cleanFileName . ".pdf";

            // Cartella uploads
            $uploadDir = './uploads/'; 
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }
            
            $destPath = $uploadDir . $newFileName;

            if (move_uploaded_file($fileTmpPath, $destPath)) {
                
                // 3. CHIAMATA AL DB: Passiamo 5 parametri
                // Nota: $newFileName è una stringa (il percorso), non il file binario
                $result = $dbh->insertNote($nomeAppunto, $idProfessore, $idInsegnamento, $newFileName, $utente);

                if ($result) {
                    echo "<script>alert('File caricato con successo!'); window.location.href = 'index.php';</script>";
                } else {
                    // Se fallisce il DB, cancelliamo il file caricato per non occupare spazio inutile
                    if (file_exists($destPath)) unlink($destPath);
                    echo "<script>alert('Errore nel database. Riprova.'); window.history.back();</script>";
                }

            } else {
                echo "<script>alert('Errore nello spostamento del file.'); window.history.back();</script>";
            }

        } else {
            echo "<script>alert('Formato non valido. Solo PDF.'); window.history.back();</script>";
        }

    } else {
        echo "<script>alert('Errore: Seleziona un file PDF.'); window.history.back();</script>";
    }
} else {
    header("Location: index.php");
}
?>