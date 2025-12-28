<?php
require_once 'bootstrap.php'; // Assicura che $dbh e $_SESSION siano disponibili

// 1. Controllo Login
if (empty($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    

    // 2. Recupero input utente
    $nomeAppunto = $_POST['nome'];
    $idProfessore = $_POST['professore']; 
    $idInsegnamento = $_POST['insegnamento'];
    $utente = $_SESSION['username'];

    // 3. Controllo e Upload del File
    if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
        
        $fileTmpPath = $_FILES['file']['tmp_name'];
        $fileName = $_FILES['file']['name'];
        $fileSize = $_FILES['file']['size'];
        
        // Verifica Sicurezza: MIME Type reale
        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $mimeType = $finfo->file($fileTmpPath);

        // Estensioni permesse
        $allowedMimeTypes = ['application/pdf'];
        
        if (in_array($mimeType, $allowedMimeTypes)) {
            
            // Genera nome unico: es. "65a4b2_appunti-analisi.pdf"
            // Pulisce il nome originale da caratteri strani
            $cleanFileName = preg_replace('/[^A-Za-z0-9_\-]/', '_', pathinfo($fileName, PATHINFO_FILENAME));
            $newFileName = uniqid() . "_" . $cleanFileName . ".pdf";

            // Cartella di destinazione (Assicurati che esista e abbia i permessi!)
            $uploadDir = './uploads/'; 
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }
            
            $destPath = $uploadDir . $newFileName;

            // Sposta il file
            if (move_uploaded_file($fileTmpPath, $destPath)) {
                
                // 4. Inserimento nel DB (Passiamo il PERCORSO, non il file)
                // $newFileName è la stringa che salveremo nel DB
                $result = $dbh->insertNote($nomeAppunto, $idProfessore, $idInsegnamento, $newFileName, $utente);

                if ($result) {
                    // Successo
                    echo "<script>alert('File caricato con successo!'); window.location.href = 'index.php';</script>";
                } else {
                    // Errore DB (magari eliminiamo il file orfano)
                    unlink($destPath);
                    echo "<script>alert('Errore nel database. Riprova.'); window.history.back();</script>";
                }

            } else {
                echo "<script>alert('Errore nello spostamento del file.'); window.history.back();</script>";
            }

        } else {
            echo "<script>alert('Formato non valido. Solo PDF.'); window.history.back();</script>";
        }

    } else {
        echo "<script>alert('Errore nell\'upload o nessun file selezionato.'); window.history.back();</script>";
    }
} else {
    header("Location: index.php"); // Se provano ad aprire la pagina direttamente
}
?>