<?php

class Database {
    private $db;

    public function __construct($servername, $username, $password, $dbname, $port) {
        $this->db = new mysqli($servername, $username, $password, $dbname, $port);
        if ($this->db->connect_error) {
            die("Connection failed: " . $db->connect_error);
        }
    }

    public function getTopNotes($n) {
        $stmt = $this->db->prepare("SELECT a.Nome, a.Download, p.Nome AS Professore, c.Nome AS Corso_Laurea, AVG(r.Stelle) AS media_recensioni, COUNT(r.Stelle) AS numero_recensioni FROM appunti a JOIN recensione r ON a.Codice = r.Appunti JOIN professore p ON a.Professore = p.Codice JOIN tenere t ON p.codice = t.professore JOIN insegnamento i ON t.insegnamento = i.codice JOIN corso_di_laurea c ON i.corso_di_laurea = c.codice GROUP BY a.Codice, a.Nome, p.Nome, c.Nome HAVING numero_recensioni >= 3 ORDER BY media_recensioni DESC LIMIT ?");
        $stmt->bind_param('i', $n);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getMostRecentsNotes($n) {
        $stmt = $this->db->prepare("SELECT a.Nome, p.Nome AS Professore, a.Data, a.Utente FROM appunti a JOIN professore p ON a.Professore = p.Codice ORDER BY a.Data DESC LIMIT ?");
        $stmt->bind_param('i', $n);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function insertNote($nome, $professore, $insegnamento, $file) {
        $utente = $_SESSION['username'];
        $stmt = $this->db->prepare("INSERT INTO appunti (Nome, Professore, File, Data, Utente, Download) VALUES (?, ?, ?, CURDATE(), ?, 0)");
        $stmt->bind_param("ssss", $nome, $professore, $file, $utente);
        $stmt->execute();
    }

    /**
     * Recupera la lista combinata di Insegnamenti e Professori.
     * Serve per la ricerca unificata nel modale.
     */
    public function getCorsiProfessori() {
        // Selezioniamo ID e Nomi di entrambi unendo le tabelle
        // t.ID non esiste, usiamo la coppia (Professore, Insegnamento)
        $query = "SELECT 
                    p.Codice AS CodiceProf, 
                    p.Nome AS NomeProf, 
                    i.Codice AS CodiceCorso, 
                    i.Nome AS NomeCorso 
                  FROM tenere t
                  JOIN professore p ON t.Professore = p.Codice
                  JOIN insegnamento i ON t.Insegnamento = i.Codice";

        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    }
}

?>