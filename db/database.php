<?php

class Database {
    private $db;

    public function __construct($servername, $username, $password, $dbname, $port) {
        $this->db = new mysqli($servername, $username, $password, $dbname, $port);
        if ($this->db->connect_error) {
            die("Connection failed: " . $db->connect_error);
        }
    }

    public function checkLogin($username, $password){        
        $stmt = $this->db->prepare("SELECT Username, Email FROM utente WHERE Username = ? AND Password = ?");
        $stmt->bind_param('ss', $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getTopNotes($n) {
        $stmt = $this->db->prepare("SELECT a.Codice, a.Nome, a.NomeFile, a.Download, p.Nome AS Professore, c.Nome AS Corso_Laurea, AVG(r.Stelle) AS media_recensioni, COUNT(r.Stelle) AS numero_recensioni FROM appunti a JOIN recensione r ON a.Codice = r.Appunti JOIN professore p ON a.Professore = p.Codice JOIN tenere t ON p.codice = t.professore JOIN insegnamento i ON t.insegnamento = i.codice JOIN corso_di_laurea c ON i.corso_di_laurea = c.codice GROUP BY a.Codice, a.Nome, p.Nome, c.Nome HAVING numero_recensioni >= 3 ORDER BY media_recensioni DESC LIMIT ?");
        $stmt->bind_param('i', $n);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getMostRecentsNotes($n) {
        $stmt = $this->db->prepare("SELECT a.Codice, a.Nome, a.NomeFile, p.Nome AS Professore, c.Nome AS Corso_Laurea, a.Data, a.Utente FROM appunti a JOIN professore p ON a.Professore = p.Codice JOIN tenere t ON p.Codice = t.Professore JOIN insegnamento i ON t.Insegnamento = i.Codice JOIN corso_di_laurea c ON i.Corso_di_laurea = c.Codice GROUP BY a.Codice ORDER BY a.Data DESC LIMIT ?");
        $stmt->bind_param('i', $n);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getNoteById($id) {
        $stmt = $this->db->prepare("SELECT NomeFile FROM appunti WHERE Codice = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function insertNote($nome, $professore, $insegnamento, $file, $utente) {
        $stmt = $this->db->prepare("INSERT INTO appunti (Nome, Professore, NomeFile, Data, Utente, Download) VALUES (?, ?, ?, CURDATE(), ?, 0)");
        $stmt->bind_param("ssss", $nome, $professore, $file, $utente);
        $executed = $stmt->execute();
        if (!$executed) {
            return false;
        }
        return ($stmt->affected_rows > 0);
    }

    public function insertUser($username, $email, $password) {
        try {
            $stmt = $this->db->prepare("INSERT INTO utente (Username, Email, Password) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $username, $email, $password);
            $stmt->execute();
            return true;
        } catch (mysqli_sql_exception $e) {
            return false;
        }
    }

    private function updateDownloadCount($codiceAppunti) {
        $stmt = $this->db->prepare("UPDATE appunti SET Download = Download + 1 WHERE Codice = ?");
        $stmt->bind_param('i', $codiceAppunti);
        $stmt->execute();
    }

    public function insertDownload($username, $codiceAppunti) {
        $stmt = $this->db->prepare("INSERT INTO scarica (Utente, Appunti) VALUES (?, ?)");
        $stmt->bind_param('si', $username, $codiceAppunti);
        $result = $stmt->execute();
        return $result ? $this->updateDownloadCount($codiceAppunti) : $result;
    }

    public function getUserData($username) {
        $stmt = $this->db->prepare("SELECT Username, Email, Password FROM utente WHERE Username = ?");
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_assoc();
    }

    public function getPreviewDownloadedFiles($username) {
        $stmt = $this->db->prepare("SELECT 
            A.Nome,
            P.Nome AS Professore,
            C.Nome AS Corso_Laurea,
            COALESCE(AVG(R.Stelle), 0) AS media_recensioni,
            A.Download
        FROM 
            appunti A
            JOIN professore P ON A.Professore = P.Codice
            JOIN tenere T ON P.Codice = T.Professore
            JOIN insegnamento I ON T.Insegnamento = I.Codice
            JOIN corso_di_laurea C ON I.Corso_di_laurea = C.Codice
            -- Left join per le recensioni (così prende anche appunti senza voti)
            LEFT JOIN recensione R ON A.Codice = R.Appunti
        WHERE 
            A.Utente = ?
        GROUP BY 
            A.Codice, A.Nome, P.Nome, C.Nome, A.Download
        ORDER BY 
            A.Nome DESC
        LIMIT 3;");
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Recupera la lista combinata di Insegnamenti e Professori.
     * Serve per la ricerca nel modale.
     */
    public function getCorsiProfessori() {
        $stmt = $this->db->prepare("SELECT p.Codice AS CodiceProf, p.Nome AS NomeProf, i.Codice AS CodiceCorso, i.Nome AS NomeCorso, c.Nome AS NomeCdl FROM tenere t JOIN professore p ON t.Professore = p.Codice JOIN insegnamento i ON t.Insegnamento = i.Codice JOIN corso_di_laurea c ON i.Corso_di_laurea = c.Codice");
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
}

?>