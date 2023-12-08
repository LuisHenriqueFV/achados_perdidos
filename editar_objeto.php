<?php
require_once("./includes/components/autenticacao.php");
require_once("./includes/components/conecta.php");
require_once("./includes/components/funcao.php");




$objetoId = isset($_GET['id']) ? $_GET['id'] : "";

if (!$objetoId) {
    echo "ID do objeto não fornecido.";
    exit();
}

$objeto = obter_objeto_por_id($objetoId, $pdo);

if (!$objeto) {
    echo "Objeto não encontrado.";
    exit();
}

if ($objeto['codpessoa'] != $_SESSION["codpessoa"] && !$_SESSION["adm"]) {
    echo "Você não tem permissão para editar este objeto.";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $novoNome = $_POST['nome'];
    $novaDescricao = $_POST['descricao'];
    $novoLocal = $_POST['local'];
    $novaData = $_POST['data'];
    $novaCategoria = $_POST['categoria'];
    $novoTipo = $_POST['tipo'];

    if ($_FILES['imagem']['error'] === 0) {
        $nomeArquivo = $_FILES['imagem']['name'];
        $caminhoArquivo = 'uploads/' . $nomeArquivo;
        move_uploaded_file($_FILES['imagem']['tmp_name'], $caminhoArquivo);
    } else {
        $caminhoArquivo = $objeto['imagem'];
    }

    atualizar_objeto($objetoId, $novoNome, $novaDescricao, $novoLocal, $novaData, $caminhoArquivo, $novaCategoria, $pdo);

    header("Location: index.php");
    exit();
}

$categorias = obter_categorias($pdo);
$tipos = array("Encontrado", "Perdido");


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


        <div id="conteudoCadastro" class="container">


            <h1>Editar Publicação</h1>
            <form action="editar_objeto.php?id=<?= $objetoId ?>" method="POST" enctype="multipart/form-data">
                <select id="tipo" name="tipo" class="form-select" required>
                    <option value="" disabled selected>Tipo</option>
                    <?php
                    foreach ($tipos as $tipo_option) {
                        echo '<option value="' . $tipo_option . '">' . $tipo_option . '</option>';
                    }
                    ?>
                </select>
                <div class="mb-3">
                    <label for="nome" class="form-label">Nome:</label>
                    <input type="text" class="form-control" id="nome" name="nome"
                        value="<?= htmlspecialchars($objeto['nome'], ENT_QUOTES) ?>" required>
                </div>
                <div class="mb-3">
                    <label for="descricao" class="form-label">Descrição:</label>
                    <textarea class="form-control" id="descricao" name="descricao"
                        required><?= htmlspecialchars($objeto['descricao'], ENT_QUOTES) ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="local" class="form-label">Local:</label>
                    <input type="text" class="form-control" id="local" name="local"
                        value="<?= htmlspecialchars($objeto['local'], ENT_QUOTES) ?>" required>
                </div>
                <div class="mb-3">
                    <label for="data" class="form-label">Data:</label>
                    <input type="date" class="form-control" id="data" name="data"
                        value="<?= htmlspecialchars($objeto['data'], ENT_QUOTES) ?>" required>
                </div>
                <div class="mb-3">
                    <label for="imagem" class="form-label">Imagem:</label>
                    <input type="file" class="form-control" id="imagem" name="imagem">
                </div>
                <select id="categoria" name="categoria" class="form-select" required>
                    <option value="" disabled selected>Categoria</option>
                    <?php
                    foreach ($categorias as $cat) {
                        echo '<option value="' . htmlspecialchars($cat['nome'], ENT_QUOTES) . '">' . htmlspecialchars($cat['nome'], ENT_QUOTES) . '</option>';
                    }
                    ?>
                </select>
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-custom-color mt-4">Salvar Alterações</button>
                </div>
                      <hr>
                <div class="d-flex justify-content-center">
                    <a href="index.php" class="btn btn-secondary">Voltar</a>
                </div>

          

            </form>
        </div>
    </main>

   
    <?php
    require_once("./includes/components/footer.php");
    require_once("./includes/components/js.php");
    require_once("./includes/components/js2.php");

    ?>
</body>

</html>