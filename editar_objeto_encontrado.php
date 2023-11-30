<?php
// Inclua os arquivos necessários, como autenticação, conexão com o banco de dados, etc.
require_once("./includes/components/autenticacao.php");
require_once("./includes/components/conecta.php");
require_once("./includes/components/funcao.php");
require_once("./includes/components/cabecalho.php");
require_once("./includes/components/header.php");
require_once("./includes/components/js.php");

// Verifica se o ID do objeto Encontrado foi fornecido na URL
if (isset($_GET['id'])) {
    $objetoId = $_GET['id'];

    // Recupera as informações do objeto Encontrado a ser editado
    $objetoEncontrado = obter_objeto_encontrado_por_id($objetoId, $pdo);

    if (!$objetoEncontrado) {
        echo "Objeto não encontrado.";
        exit();
    }

    // Verifica se o usuário tem permissão para editar este objeto
    if ($objetoEncontrado['codpessoa'] != $_SESSION["codpessoa"] && !$_SESSION["adm"]) {
        echo "Você não tem permissão para editar este objeto.";
        exit();
    }
} else {
    echo "ID do objeto Encontrado não fornecido.";
    exit();
}

// Processa os dados do formulário quando enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $novoNome = $_POST['nome'];
    $novaDescricao = $_POST['descricao'];
    $novoLocal = $_POST['local'];
    $novaData = $_POST['data'];
    $novaCategoria = $_POST['categoria'];

    // Processa o upload da nova imagem, se fornecida
    if ($_FILES['imagem']['error'] === 0) {
        $nomeArquivo = $_FILES['imagem']['name'];
        $caminhoArquivo = 'uploads/' . $nomeArquivo;
        move_uploaded_file($_FILES['imagem']['tmp_name'], $caminhoArquivo);
    } else {
        // Mantém a imagem existente se não houver nova imagem fornecida
        $caminhoArquivo = $objetoEncontrado['imagem'];
    }

    // Atualiza os dados do objeto Encontrado no banco de dados
    atualizar_objeto_encontrado($objetoId, $novoNome, $novaDescricao, $novoLocal, $novaData, $caminhoArquivo, $novaCategoria, $pdo);

    // Redireciona para a página de visualização de objetos Encontrados
    header("Location: visualizar_encontrados.php");
    exit();
}
?>

<body>
    <main class="container">
        <h1>Editar Objeto Encontrado</h1>
        <form action="editar_objeto_encontrado.php?id=<?= $objetoId ?>" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="nome" class="form-label">Nome:</label>
                <input type="text" class="form-control" id="nome" name="nome" value="<?= $objetoEncontrado['nome'] ?>"
                    required>
            </div>
            <div class="mb-3">
                <label for="descricao" class="form-label">Descrição:</label>
                <textarea class="form-control" id="descricao" name="descricao"
                    required><?= $objetoEncontrado['descricao'] ?></textarea>
            </div>
            <div class="mb-3">
                <label for="local" class="form-label">Local:</label>
                <input type="text" class="form-control" id="local" name="local"
                    value="<?= $objetoEncontrado['local'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="data" class="form-label">Data:</label>
                <input type="date" class="form-control" id="data" name="data" value="<?= $objetoEncontrado['data'] ?>"
                    required>
            </div>
            <div class="mb-3">
                <label for="imagem" class="form-label">Imagem:</label>
                <input type="file" class="form-control" id="imagem" name="imagem">
            </div>
            <div class="mb-3">
                <label for="categoria" class="form-label">Categoria:</label>
                <input type="text" class="form-control" id="categoria" name="categoria"
                    value="<?= $objetoEncontrado['categoria'] ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Salvar Alterações</button>
            <a href="visualizar_encontrados.php" class="btn btn-secondary">Voltar</a>

        </form>
    </main>
</body>

</html>