<?php
require("./includes/components/conecta.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    try {
        $stmt = $pdo->prepare("DELETE FROM objetos_perdidos WHERE id = ?");
        $stmt->execute([$id]);

        // Redirecionar de volta à página de visualização após excluir
        header("Location: visualizar_perdidos.php");
        exit();
    } catch (PDOException $e) {
        echo "Erro ao excluir objeto: " . $e->getMessage();
        exit();
    }
} else {
    // Se o ID não estiver presente na URL, redirecione para a página de visualização
    header("Location: visualizar_perdidos.php");
    exit();
}
?>