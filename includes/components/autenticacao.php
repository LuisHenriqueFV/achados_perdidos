<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (headers_sent()) {
    die("Erro: Cabeçalhos já foram enviados. Por favor, verifique se há algum espaço em branco ou saída antes do session_start().");
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
