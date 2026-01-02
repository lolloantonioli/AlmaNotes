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
                    $_SESSION['flash_message'] = 'File caricato con successo!';
                    $_SESSION['flash_type'] = 'success';
                    header('Location: carica.php');
                    exit;
                } else {
                    // Se fallisce il DB, cancelliamo il file caricato per non occupare spazio inutile
                    if (file_exists($destPath)) unlink($destPath);
                    $_SESSION['flash_message'] = 'Errore nel database. Riprova.';
                    $_SESSION['flash_type'] = 'error';
                    header('Location: carica.php');
                    exit;
                }

            } else {
                $_SESSION['flash_message'] = 'Errore nello spostamento del file.';
                $_SESSION['flash_type'] = 'error';
                header('Location: carica.php');
                exit;
            }

        } else {
            $_SESSION['flash_message'] = 'Formato non valido. Solo PDF.';
            $_SESSION['flash_type'] = 'error';
            header('Location: carica.php');
            exit;
        }

    } else {
        $_SESSION['flash_message'] = 'Errore: Seleziona un file PDF.';
        $_SESSION['flash_type'] = 'error';
        header('Location: carica.php');
        exit;
    }
} else {
    header("Location: index.php");
}
?>