<?php
require("./includes/components/cabecalho.php");
require("./includes/components/funcao.php");
require("./includes/components/conecta.php");
require("./includes/components/js.php");

$msg = "";

// Verificar se o formulário de cadastro de categoria foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['nome_categoria']) && $_POST['nome_categoria'] !== '') {
        $nomeCategoria = $_POST['nome_categoria'];

        $cadastra_categoria = cadastra_categoria($nomeCategoria, $pdo);

  
    }
}

// Excluir categoria
if (isset($_GET['excluir']) && $_GET['excluir'] === 'true') {
    $categoria_id = $_GET['id'];

    if (exclui_categoria($categoria_id, $pdo)) {
        $msg = "Categoria excluída!";
        header("Location: adm.php?excluir=true&msg=" . urlencode($msg));
        exit();
    } else {
        $msg = "Erro ao excluir a categoria. Verifique o log de erros para mais informações.";
        error_log("Erro ao excluir categoria no banco de dados.");
    }
}

// Obter categorias
$categorias = obter_categorias($pdo);

?>

<body>
    <main class="container">
        <div class="forms">
            <h3>Cadastrar Categoria</h3>
            <!-- Exibir mensagem de sucesso ou erro -->
            <?php if (!empty($msg)): ?>
                <div class="alert <?php echo $cadastra_categoria ? 'alert-success' : 'alert-danger'; ?>" role="alert">
                    <?php echo $msg; ?>
                </div>
            <?php endif; ?>

            <!-- Formulário para adicionar categoria -->
            <form action="adm.php" method="POST">
                <div class="mb-3 input-group">
                    <label for="nome_categoria" class="form-label">Nome da Categoria:</label>
                    <input type="text" id="nome_categoria" name="nome_categoria" class="form-control"
                        placeholder="Digite o nome da categoria" autocomplete="off" required>
                </div>
                <button type="submit" class="btn btn-primary">Adicionar Categoria</button>
                <button type="button" id="btnMostrarCategorias" class="btn btn-primary" onclick="toggleCategorias()">Mostrar Categorias Cadastradas</button>
            </form>
        </div>

        <div id="listaCategorias" class="forms" style="display: none;">
            <h3>Lista de Categorias</h3>
            <ul class="list-group">
                <?php foreach ($categorias as $categoria): ?>
                    <li class='list-group-item d-flex justify-content-between align-items-center'>
                        <?= $categoria['nome'] ?>
                        <a href="excluir_categoria.php?id=<?= $categoria['id']; ?>" class="btn btn-danger">Excluir</a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>

        <a href="index.php" class="btn btn-secondary">Voltar</a>
    </main>

    <script>
        function toggleCategorias() {
            var listaCategorias = document.getElementById("listaCategorias");
            var buttonMostrarCategorias = document.getElementById("btnMostrarCategorias");

            if (listaCategorias.style.display === "none") {
                listaCategorias.style.display = "block";
                buttonMostrarCategorias.textContent = "Ocultar Categorias Cadastradas";
            } else {
                listaCategorias.style.display = "none";
                buttonMostrarCategorias.textContent = "Mostrar Categorias Cadastradas";
            }
        }
    </script>
</body>
</html>