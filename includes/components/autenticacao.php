<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Verifica se as headers foram enviadas
if (headers_sent()) {
    die("Error: Headers already sent. Please check for any whitespace or output before session_start().");
}

// Inicia a sessão se não estiver iniciada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Obtém o código da pessoa logada, ou define como null se não estiver logada
$codpessoa = $_SESSION['codpessoa'] ?? null;

// Obtém a informação de administrador (se disponível)
$adm = $_SESSION['adm'] ?? 0; // Padrão para 0 se não estiver definido

// Verifica se o usuário está logado
if (!isset($_SESSION['codpessoa'])) {
    header("Location: login.php");
    exit;
}
