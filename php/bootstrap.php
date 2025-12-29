<?php
session_start();
define("UPLOAD_DIR", "./uploads/");
require_once("utils/functions.php");
require_once("../db/database.php");
$dbh = new Database("127.0.0.1", "root", "", "almanotes", "3306");
$paginaCorrente = basename($_SERVER['PHP_SELF']);
$paginePubbliche = ['login.php', 'signup.php', 'login-form.php', 'signup-form.php'];
if (!isUserLoggedIn() && !in_array($paginaCorrente, $paginePubbliche)) {
    header("Location: login-form.php");
    exit;
}
?>