<?php
require("./includes/components/conecta.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    try {
        $stmt = $pdo->prepare("DELETE FROM objetos_perdidos WHERE id = ?");
        $stmt->execute([$id]);

        header("Location: visualizar_perdidos.php");
        exit();
    } catch (PDOException $e) {
        echo "Erro ao excluir objeto: " . $e->getMessage();
        exit();
    }
} else {
    header("Location: visualizar_perdidos.php");
    exit();
}
?>