<?php
$msg = "";

require_once("./includes/components/autenticacao.php");
require_once("./includes/components/conecta.php");
require_once("./includes/components/funcao.php");
require_once("./includes/components/cabecalho.php");
require_once("./includes/components/header.php");
require_once("./includes/components/js.php");



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $local = $_POST['local'];
    $data = $_POST['data'];
    $categoria = $_POST['categoria'];

    // Verifica se uma imagem foi enviada
    if (!empty($_FILES['imagem']['name'])) {
        $uploadDir = "img/objetos_encontrados/";

        // Obtém a extensão do arquivo
        $extensao = strtolower(pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION));

        // Gera um nome único para o arquivo
        $nomeArquivo = uniqid('imagem_') . '.' . $extensao;

        $uploadFile = $uploadDir . $nomeArquivo;

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        // Move o arquivo para o diretório de upload
        if (move_uploaded_file($_FILES['imagem']['tmp_name'], $uploadFile)) {
            $imagem = $uploadDir . $nomeArquivo;

            // Insere o caminho da imagem no banco de dados
            cadastra_objeto_encontrado($nome, $descricao, $local, $data, $categoria, $imagem, $codpessoa, $pdo);

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
    <main>
        <div id="conteudo" class="container">
            <div class="forms">
                <?php
                // Exibe a mensagem de sucesso se houver
                if (!empty($msg)) {
                    echo '<div class="alert alert-success">' . $msg . '</div>';
                }
                ?>
                <form action="objetos_encontrados.php" method="POST" enctype="multipart/form-data">
                    <div class="inputs-forms">
                        <input type="text" id="nome" name="nome" class="form-control"
                            placeholder="Nome do objeto encontrado" autocomplete="off" required>
                        <input type="text" id="descricao" name="descricao" class="form-control"
                            placeholder="Descrição do objeto encontrado" autocomplete="off" required>
                        <input type="text" id="local" name="local" class="form-control"
                            placeholder="Local onde foi encontrado" autocomplete="off" required>
                        <input type="date" id="data" name="data" class="form-control" required>
                        <label for="imagem">Imagem:</label>
                        <input type="file" id="imagem" name="imagem" class="form-control">

                        <!-- Menu suspenso para selecionar a categoria -->
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
                        <button type="submit" class="btn btn-primary">Cadastrar Objeto Encontrado</button>
                        <a href="index.php" class="btn btn-secondary">Voltar</a>
                    </div>
                </form>
            </div>

        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-eEJrOIVZdXl1rIb1TPOOwpv6+X1/QAqLwdDD1lp56Pv0B/Dm5fAKUKtk8WYquENe"
        crossorigin="anonymous"></script>
</body>

</html>