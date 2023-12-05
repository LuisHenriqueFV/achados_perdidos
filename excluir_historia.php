<?php
require_once("./includes/components/conecta.php");
require_once("./includes/components/funcao.php");

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $relato = $_GET['id'];

    if (exclui_historia($relato, $pdo)) {
        header("Location: historias.php");
        exit();
    } else {
        echo "Erro ao excluir o relato.";
    }
} else {
    echo "ID do relato não fornecido.";
}
?>