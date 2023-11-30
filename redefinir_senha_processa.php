<?php
ob_start();
session_start();
require("./includes/components/conecta.php");
require("./includes/components/funcao.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST["utilizador"];
    $hash = $_POST["confirmacao"];
    $novaSenha = $_POST["novaSenha"];

    $senhaHash = password_hash($novaSenha, PASSWORD_DEFAULT);
    $atualizaSenha = $pdo->prepare("UPDATE pessoa SET senha = :senha WHERE email = :email");
    $atualizaSenha->bindParam(':senha', $senhaHash);
    $atualizaSenha->bindParam(':email', $user);
    $atualizaSenha->execute();

    $removeRecuperacao = $pdo->prepare("DELETE FROM recuperacao WHERE utilizador = :user AND chave = :hash");
    $removeRecuperacao->bindParam(':user', $user);
    $removeRecuperacao->bindParam(':hash', $hash);
    $removeRecuperacao->execute();

    $_SESSION['senha_alterada'] = true;

    header("Location: login.php");
    exit();
} else {
    echo '<p style="color: red;">Método de requisição inválido</p>';
    exit();
}
?>
