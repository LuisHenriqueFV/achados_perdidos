<?php
$msg = "";

require("./includes/components/autenticacao.php");
require("./includes/components/cabecalho.php");
require("./includes/components/funcao.php");
require("./includes/components/conecta.php");


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $local = $_POST['local'];
    $data = $_POST['data'];
    $categoria = $_POST['categoria'];

    // Verifica se uma imagem foi enviada
    if (!empty($_FILES['imagem']['name'])) {
        $uploadDir = "img/objetos_perdidos/";

        $extensao = strtolower(pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION));

        $nomeArquivo = uniqid('imagem_') . '.' . $extensao;

        $uploadFile = $uploadDir . $nomeArquivo;

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        if (move_uploaded_file($_FILES['imagem']['tmp_name'], $uploadFile)) {
            $imagem = $uploadDir . $nomeArquivo;

            cadastra_objeto_perdido($nome, $descricao, $local, $data, $categoria, $imagem, $codpessoa, $pdo);

            $msg = "Objeto cadastrado com sucesso!";
        } else {
            $msg = "Erro no upload da imagem. Verifique o log de erros para mais informações.";
            error_log("Erro no upload da imagem: " . $_FILES['imagem']['error']);
        }
    } else {
        $msg = "Por favor, selecione uma imagem.";
    }
}

$categorias = obter_categorias($pdo);
?>

<body>
    <main class="container">
        <div class="forms">
            <form action="objetos_perdidos.php" method="POST" enctype="multipart/form-data">
                <div class="inputs-forms">
                    <input type="text" id="nome" name="nome" class="form-control"
                        placeholder="Nome do objeto perdido" autocomplete="off" required>
                    <input type="text" id="descricao" name="descricao" class="form-control"
                        placeholder="Descrição do objeto perdido" autocomplete="off" required>
                    <input type="text" id="local" name="local" class="form-control"
                        placeholder="Local onde foi perdido" autocomplete="off" required>
                    <input type="date" id="data" name="data" class="form-control" required>
                    <label for="imagem">Imagem:</label>
                    <input type="file" id="imagem" name="imagem" class="form-control">

                    <label for="categoria">Categoria:</label>
                    <select id="categoria" name="categoria" class="form-select" required>
                        <option value="" disabled selected>Selecione uma categoria</option>
                        <?php
                        foreach ($categorias as $cat) {
                            echo '<option value="' . $cat['nome'] . '">' . $cat['nome'] . '</option>';
                        }
                        ?>
                    </select>
                </div>

                <div class="nav">
                    <button type="submit" class="btn btn-primary">Cadastrar Objeto Perdido</button>
                    <a href="index.php" class="btn btn-secondary">Voltar</a>
                </div>
            </form>
        </div>

        <div class="conteudo">
            <p>
                <?php
                echo $msg;
                ?>
            </p>
        </div>
    </main>

</body>

</html>
