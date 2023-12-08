<?php
require_once("./includes/components/autenticacao.php");
require_once("./includes/components/conecta.php");
require_once("./includes/components/funcao.php");

$msg = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['nome_categoria']) && $_POST['nome_categoria'] !== '') {
        $nomeCategoria = $_POST['nome_categoria'];

        $cadastra_categoria = cadastra_categoria($nomeCategoria, $pdo);

        if ($cadastra_categoria) {
            $msg = "Categoria cadastrada com sucesso!";
        } else {
            $msg = "Erro ao cadastrar a categoria. Verifique o log de erros para mais informações.";
            error_log("Erro ao cadastrar categoria no banco de dados.");
        }
    }
    if (isset($_POST['relato']) && $_POST['relato'] !== '') {
        $relato = $_POST['relato'];

        $cadastra_historia = cadastra_historia($relato, $pdo);

        if ($cadastra_historia) {
            $msg = "Relato cadastrado com sucesso!";

            header("Location: historias.php?msg=" . urlencode($msg));
            exit();
        } else {
            $msg = "Erro ao cadastrar o relato. Verifique o log de erros para mais informações.";
            error_log("Erro ao cadastrar relato no banco de dados.");
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

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <?php
    require_once("./includes/components/cabecalho.php");
    ?>
</head>



<body>
    <header>
        <?php
        require_once("./includes/components/header2.php");
        ?>

    </header>

    <main>




        <div class="containerTUDO">



        <div id="conteudoPerfil" class="container">
            <div class="forms">
                <h1 class="h2 d-flex justify-content-center">Cadastrar Categoria</h1>
                <?php
                if (!empty($msg)) {
                    echo '<div class="alert alert-success">' . $msg . '</div>';
                }
                ?>
                <hr>

                <form action="adm.php" method="POST">
                    <div class="mb-3 input-group">
                        <input type="text" id="nome_categoria" name="nome_categoria" class="form-control"
                            placeholder="Digite o nome da categoria" autocomplete="off" required>
                    </div>

                    <div class="col-12 d-flex justify-content-center">

                        <button type="submit" class="btn btn-custom-color">Adicionar Categoria</button>
                    </div>
                    <hr>


                    <div class="col-12 d-flex justify-content-center">
                        <button type="button" id="btnMostrarCategorias" class="btn btn-custom-color"
                            onclick="toggleCategorias()">Mostrar Categorias</button>
                        <button type="button" id="btnOcultarCategorias" class="btn btn-custom-color"
                            style="display: none;" onclick="toggleCategorias()">Ocultar Categorias</button>

                    </div>

                    <hr>
                

                </form>
                <div class="forms">
                    <h1 class="h2 d-flex justify-content-center">Cadastrar História</h1>
                    <?php
                    if (!empty($msg)) {
                        echo '<div class="alert alert-success">' . $msg . '</div>';
                    }
                    ?>
                    <hr>

                    <form action="adm.php" method="POST">
                        <div class="mb-3 input-group">
                            <textarea id="relato" name="relato" class="form-control" placeholder="Digite a história"
                                autocomplete="off" required></textarea>
                        </div>

                        <div class="col-12 d-flex justify-content-center">
                            <button type="submit" class="btn btn-custom-color">Adicionar História</button>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-center">
                            <a class="btn btn-secondary" href="index.php" role="button">Voltar</a>
                        </div>
                        <hr>
                    </form>
                </div>
            </div>

            <div id="listaCategorias" class="forms" style="display: none;">
                <div class="d-flex justify-content-center">
                    <h3>Lista de Categorias</h3>

                </div>
                <ul class="list-group">
                    <?php foreach ($categorias as $categoria): ?>
                        <li class='list-group-item d-flex justify-content-between align-items-center'>
                            <?= $categoria['nome'] ?>
                            <a href="excluir_categoria.php?id=<?= $categoria['id']; ?>&excluir=true"
                                class="btn btn-custom-color"><img width="30" height="30"
                                    src="https://img.icons8.com/plasticine/30/000000/filled-trash.png"
                                    alt="filled-trash" /></a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>


        </div>
        </div>
        
    </main>


    <?php
    require_once("./includes/components/footer.php");
    require_once("./includes/components/js.php");
    require_once("./includes/components/js2.php");

    ?>
</body>

</html>