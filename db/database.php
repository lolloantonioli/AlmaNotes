<?php

class Database {
    private $db

    public function __construct($servername, $username, $password, $dbname, $port) {
        $this->db = new mysqli($servername, $username, $password, $dbname, $port);
        if ($this->db->connect_error) {
            die("Connection failed: " . $db->connect_error);
        }
    }

    public function getTopNotes($n) {
        $stmt = $this->db->prepare("SELECT a.Nome, a.Download, p.Nome AS Professore, AVG(r.Stelle) AS media_recensioni, COUNT(r.Stelle) AS numero_recensioni FROM appunti a JOIN recensione r ON a.Codice = r.Appunti JOIN professori p ON a.Professore = p.Codice GROUP BY a.Codice, a.Nome, p.Nome HAVING numero_recensioni >= 3 ORDER BY media_recensioni DESC LIMIT ?");
        $stmt->bind_param('i', $n);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getMostRecentsNotes($n) {
        $stmt = $this->db->prepare("SELECT a.Nome, p.Nome AS Professore, a.Data, a.Utente FROM appunti a JOIN professori p ON a.Professore = p.Codice ORDER BY a.Data DESC LIMIT ?");
        $stmt->bind_param('i', $n);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->fetch_all(MYSQLI_ASSOC);
    }
}

?>