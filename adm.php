<?php
require_once("./includes/components/autenticacao.php");
require_once("./includes/components/conecta.php");
require_once("./includes/components/funcao.php");
require_once("./includes/components/cabecalho.php");
require_once("./includes/components/header.php");
require_once("./includes/components/js.php");

$msg = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['nome_categoria']) && $_POST['nome_categoria'] !== '') {
        $nomeCategoria = $_POST['nome_categoria'];

        // Tenta cadastrar a categoria
        $cadastra_categoria = cadastra_categoria($nomeCategoria, $pdo);

        // Verifica se a categoria foi cadastrada com sucesso
        if ($cadastra_categoria) {
            $msg = "Categoria cadastrada com sucesso!";
        } else {
            $msg = "Erro ao cadastrar a categoria. Verifique o log de erros para mais informações.";
            error_log("Erro ao cadastrar categoria no banco de dados.");
        }
    }
}

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

$categorias = obter_categorias($pdo);

?>

<body>
    <main>
        <div id="conteudo" class="container">
            <div class="forms">
                <h3>Cadastrar Categoria</h3>
                <?php
                // Exibe a mensagem de sucesso se houver
                if (!empty($msg)) {
                    echo '<div class="alert alert-success">' . $msg . '</div>';
                }
                ?>
               

                <form action="adm.php" method="POST">
                    <div class="mb-3 input-group">
                        <label for="nome_categoria" class="form-label">Nome da Categoria:</label>
                        <input type="text" id="nome_categoria" name="nome_categoria" class="form-control"
                            placeholder="Digite o nome da categoria" autocomplete="off" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Adicionar Categoria</button>
                    <button type="button" id="btnMostrarCategorias" class="btn btn-primary"
                        onclick="toggleCategorias()">Mostrar Categorias Cadastradas</button>
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

        </div>
    </main>
</body>

</html>