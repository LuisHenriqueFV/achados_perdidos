<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (headers_sent()) {
    die("Error: Headers already sent. Please check for any whitespace or output before session_start().");
}


if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$codpessoa = $_SESSION['codpessoa'] ?? null;



   

$adm = $_SESSION['adm'] ?? 0; 

if (!isset($_SESSION['codpessoa'])) {
    header("Location: login.php");
    exit;
}
