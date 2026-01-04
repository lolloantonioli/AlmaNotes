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

    public function getTopNotes($n = 9) {
        $stmt = $this->db->prepare("SELECT a.Codice, a.Nome, a.NomeFile, a.Download, a.Utente, a.Data, p.Nome AS Professore, c.Nome AS Corso_Laurea, i.Nome AS Insegnamento, COALESCE(AVG(r.Stelle), 0) AS media_recensioni, COUNT(r.Stelle) AS numero_recensioni FROM appunti a LEFT JOIN recensione r ON a.Codice = r.Appunti JOIN professore p ON a.Professore = p.Codice JOIN insegnamento i ON a.Insegnamento = i.Codice JOIN corso_di_laurea c ON i.Corso_di_laurea = c.Codice GROUP BY a.Codice, a.Nome, a.NomeFile, a.Download, a.Utente, a.Data, p.Nome, c.Nome, i.Nome ORDER BY a.Download DESC LIMIT ?");
        $stmt->bind_param('i', $n);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getMostRecentsNotes($n = 9) {
        $stmt = $this->db->prepare("SELECT a.Codice, a.Nome, a.NomeFile, a.Download, a.Data, a.Utente, p.Nome AS Professore, c.Nome AS Corso_Laurea, i.Nome AS Insegnamento, COALESCE(AVG(r.Stelle), 0) AS media_recensioni, COUNT(r.Stelle) AS numero_recensioni FROM appunti a JOIN professore p ON a.Professore = p.Codice JOIN insegnamento i ON a.Insegnamento = i.Codice JOIN corso_di_laurea c ON i.Corso_di_laurea = c.Codice LEFT JOIN recensione r ON a.Codice = r.Appunti GROUP BY a.Codice, a.Nome, a.NomeFile, a.Download, a.Data, a.Utente, p.Nome, c.Nome, i.Nome ORDER BY a.Data DESC LIMIT ?");
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
        $stmt = $this->db->prepare("INSERT INTO appunti (Nome, Professore, Insegnamento, NomeFile, Data, Utente, Download) VALUES (?, ?, ?, ?, CURDATE(), ?, 0)");
        $stmt->bind_param("sssss", $nome, $professore, $insegnamento, $file, $utente);
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
        $stmt = $this->db->prepare("INSERT INTO scarica (Utente, Appunti, Data) VALUES (?, ?, CURDATE())");
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

    public function getPreviewDownloadedFiles($username, $n = 3) {
        // Left join per le recensioni (così prende anche appunti senza voti)
        $stmt = $this->db->prepare("SELECT A.Codice, A.Nome, A.NomeFile, A.Utente, A.Data, I.Nome AS Insegnamento, P.Nome AS Professore, C.Nome AS Corso_Laurea, S.Data AS Data_Download, COALESCE(AVG(r.Stelle), 0) AS media_recensioni, COUNT(DISTINCT r.Utente) AS numero_recensioni, A.Download FROM appunti A JOIN scarica S ON A.Codice = S.Appunti JOIN professore P ON A.Professore = P.Codice JOIN insegnamento I ON A.Insegnamento = I.Codice JOIN corso_di_laurea C ON I.Corso_di_laurea = C.Codice LEFT JOIN recensione R ON A.Codice = R.Appunti WHERE S.Utente = ? GROUP BY A.Codice, A.Nome, A.NomeFile, A.Utente, A.Data, I.Nome, P.Nome, C.Nome, S.Data, A.Download ORDER BY S.Data DESC LIMIT ?;");
        $stmt->bind_param('si', $username, $n);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getPreviewUploadedFiles($username, $n = 3) {
        // Left join per le recensioni (così prende anche appunti senza voti)
        $stmt = $this->db->prepare("SELECT 
            A.Codice, 
            A.Nome, 
            A.Data, 
            P.Nome AS Professore, 
            C.Nome AS Corso_Laurea, 
            I.Nome AS Insegnamento, 
            COALESCE(AVG(R.Stelle), 0) AS media_recensioni, 
            COUNT(R.Stelle) AS numero_recensioni, 
            A.Download 
        FROM appunti A 
        JOIN professore P ON A.Professore = P.Codice 
        JOIN insegnamento I ON A.Insegnamento = I.Codice 
        JOIN corso_di_laurea C ON I.Corso_di_laurea = C.Codice 
        LEFT JOIN recensione R ON A.Codice = R.Appunti 
        WHERE A.Utente = ? 
        GROUP BY A.Codice, A.Nome, A.Data, P.Nome, C.Nome, I.Nome, A.Download 
        ORDER BY A.Nome DESC 
        LIMIT ?;");
        $stmt->bind_param('si', $username, $n);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getTopNotesByUser($username, $n = 3) {
        $stmt = $this->db->prepare("SELECT 
            A.Codice, 
            A.Nome, 
            A.Data, 
            A.Download, 
            P.Nome AS Professore, 
            C.Nome AS CorsoDiLaurea, 
            I.Nome AS Insegnamento, 
            COALESCE(AVG(R.Stelle), 0) AS media_recensioni, 
            COUNT(R.Stelle) AS numero_recensioni 
        FROM appunti A 
        JOIN professore P ON A.Professore = P.Codice 
        JOIN insegnamento I ON A.Insegnamento = I.Codice 
        JOIN corso_di_laurea C ON I.Corso_di_laurea = C.Codice 
        LEFT JOIN recensione R ON A.Codice = R.Appunti 
        WHERE A.Utente = ? 
        GROUP BY A.Codice, A.Nome, A.Data, A.Download, P.Nome, C.Nome, I.Nome 
        ORDER BY A.Download DESC 
        LIMIT ?;");
        $stmt->bind_param('si', $username, $n);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getMostFavoritesNotesByUser($username, $n = 3) {
        $stmt = $this->db->prepare("SELECT 
            A.Codice, 
            A.Nome, 
            A.Data, 
            P.Nome AS Professore, 
            C.Nome AS CorsoDiLaurea, 
            I.Nome AS Insegnamento, 
            COALESCE(AVG(R.Stelle), 0) AS MediaRecensioni, 
            COUNT(R.Stelle) AS numero_recensioni, 
            A.Download 
        FROM appunti A 
        JOIN professore P ON A.Professore = P.Codice 
        JOIN insegnamento I ON A.Insegnamento = I.Codice 
        JOIN corso_di_laurea C ON I.Corso_di_laurea = C.Codice 
        LEFT JOIN recensione R ON A.Codice = R.Appunti 
        WHERE A.Utente = ? 
        GROUP BY A.Codice, A.Nome, A.Data, P.Nome, C.Nome, I.Nome, A.Download 
        ORDER BY MediaRecensioni DESC 
        LIMIT ?;");
        $stmt->bind_param('si', $username, $n);
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

    // --- NUOVE FUNZIONI PER LA RICERCA ---

    /**
     * Cerca appunti in base al testo e ai filtri opzionali
     */
    public function searchNotes($text, $prof = null, $subject = null) {
        // Query di base
        $sql = "SELECT a.Codice, a.Nome, a.NomeFile, a.Download, a.Data, a.Utente, 
                       p.Nome AS Professore, c.Nome AS Corso_Laurea, i.Nome AS Insegnamento, 
                       COALESCE(AVG(r.Stelle), 0) AS media_recensioni, COUNT(r.Stelle) AS numero_recensioni
                FROM appunti a
                JOIN professore p ON a.Professore = p.Codice
                JOIN insegnamento i ON a.Insegnamento = i.Codice
                JOIN corso_di_laurea c ON i.Corso_di_laurea = c.Codice
                LEFT JOIN recensione r ON a.Codice = r.Appunti
                WHERE 1=1";
        
        $params = [];
        $types = "";

        // Filtro Testo (cerca in Nome Appunto, Nome Prof o Nome Insegnamento)
        if (!empty($text)) {
            $sql .= " AND (a.Nome LIKE ? OR p.Nome LIKE ? OR i.Nome LIKE ?)";
            $searchTerm = "%" . $text . "%";
            array_push($params, $searchTerm, $searchTerm, $searchTerm);
            $types .= "sss";
        }

        // Filtro Professore
        if (!empty($prof)) {
            $sql .= " AND a.Professore = ?";
            $params[] = $prof;
            $types .= "s";
        }

        // Filtro Materia
        if (!empty($subject)) {
            $sql .= " AND a.Insegnamento = ?";
            $params[] = $subject;
            $types .= "s";
        }

        $sql .= " GROUP BY a.Codice, a.Nome, a.NomeFile, a.Download, a.Data, a.Utente, p.Nome, c.Nome, i.Nome ORDER BY a.Data DESC";

        $stmt = $this->db->prepare($sql);
        if (!empty($params)) {
            $stmt->bind_param($types, ...$params);
        }
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Ottiene tutti i professori per il filtro
     */
    public function getAllProfessors() {
        $result = $this->db->query("SELECT Codice, Nome FROM professore ORDER BY Nome");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Ottiene tutte le materie per il filtro
     */
    public function getAllSubjects() {
        $result = $this->db->query("SELECT Codice, Nome FROM insegnamento ORDER BY Nome");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getAllDownloadedFiles($username) {
        $stmt = $this->db->prepare("SELECT 
                A.Codice, 
                A.Nome, 
                A.NomeFile, 
                A.Utente, 
                A.Data, -- Data di caricamento
                MAX(S.Data) AS Data_Download, -- Data ultimo download
                P.Nome AS Professore, 
                C.Nome AS Corso_Laurea, 
                I.Nome AS Insegnamento, 
                COALESCE(AVG(R.Stelle), 0) AS media_recensioni, 
                COUNT(R.Stelle) AS numero_recensioni, 
                A.Download 
            FROM appunti A 
            JOIN scarica S ON A.Codice = S.Appunti 
            JOIN professore P ON A.Professore = P.Codice 
            JOIN insegnamento I ON A.Insegnamento = I.Codice 
            JOIN corso_di_laurea C ON I.Corso_di_laurea = C.Codice 
            LEFT JOIN recensione R ON A.Codice = R.Appunti 
            WHERE S.Utente = ? 
            GROUP BY A.Codice, A.Nome, A.NomeFile, A.Utente, A.Data, P.Nome, C.Nome, I.Nome, A.Download
            ORDER BY Data_Download DESC;");
        $stmt->bind_param('s', $username);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function getAllUploadedFiles($username) {
        $stmt = $this->db->prepare("SELECT 
                A.Codice, 
                A.Nome, 
                A.NomeFile, 
                A.Data, 
                A.Utente, 
                P.Nome AS Professore, 
                C.Nome AS Corso_Laurea, 
                I.Nome AS Insegnamento, 
                COALESCE(AVG(R.Stelle), 0) AS media_recensioni, 
                COUNT(R.Stelle) AS numero_recensioni, 
                A.Download 
            FROM appunti A 
            JOIN professore P ON A.Professore = P.Codice 
            JOIN insegnamento I ON A.Insegnamento = I.Codice 
            JOIN corso_di_laurea C ON I.Corso_di_laurea = C.Codice 
            LEFT JOIN recensione R ON A.Codice = R.Appunti 
            WHERE A.Utente = ? 
            GROUP BY A.Codice, A.Nome, A.NomeFile, A.Data, A.Utente, P.Nome, C.Nome, I.Nome, A.Download 
            ORDER BY A.Data DESC;");
        $stmt->bind_param('s', $username);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function getAllCourses() {
        $result = $this->db->query("SELECT DISTINCT Nome FROM corso_di_laurea ORDER BY Nome");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getAllUsers() {
        $result = $this->db->query("SELECT DISTINCT Utente FROM appunti ORDER BY Utente");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function insertRecensione($appunti, $utente, $stelle) {
        $stmt = $this->db->prepare("REPLACE INTO recensione (Appunti, Utente, Stelle) VALUES (?, ?, ?)");
        $stmt->bind_param("isi", $appunti, $utente, $stelle);
        return $stmt->execute();
    }
}