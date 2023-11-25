<?php
$msg = "";

require("./includes/components/cabecalho.php");
require("./includes/components/funcao.php");
require("./includes/components/conecta.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $local = $_POST['local'];
    $data = $_POST['data'];
    $categoria = $_POST['categoria'];

    // Verificar se uma imagem foi enviada
    if (!empty($_FILES['imagem']['name'])) {
        // Configurar o diretório de upload
        $uploadDir = "img/objetos_encontrados/";

        // Criar o caminho completo do arquivo de destino
        $uploadFile = $uploadDir . basename($_FILES['imagem']['name']);

        // Verificar se a pasta de destino existe, senão a cria
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        // Mover o arquivo enviado para o destino
        if (move_uploaded_file($_FILES['imagem']['tmp_name'], $uploadFile)) {
            // Se o upload for bem-sucedido, atribuir o caminho da imagem à variável $imagem
            $imagem = $uploadFile;
        } else {
            // Se houver um erro no upload, exibir uma mensagem de erro
            $msg = "Erro no upload da imagem. Verifique o log de erros para mais informações.";
            error_log("Erro no upload da imagem: " . $_FILES['imagem']['error']);
        }
    } else {
        // Se nenhum arquivo de imagem foi enviado, defina $imagem como NULL ou vazio, dependendo de como você a trata no banco de dados
        $imagem = NULL; // ou $imagem = "";
    }

    // Chame a função para cadastrar o objeto com a imagem
    cadastra_objeto_encontrado($nome, $descricao, $local, $data, $categoria, $imagem, $pdo);
    $msg = "Objeto cadastrado com sucesso!";
}

// Obter categorias existentes
$categorias = obter_categorias($pdo);
?>

<body>
    <main class="container">
        <div class="forms">
            <form action="objetos_encontrados.php" method="POST">
                <div class="inputs-forms">
                    <input type="text" id="nome" name="nome" class="form-control"
                        placeholder="Nome do objeto encontrado" autocomplete="off" required>
                    <input type="text" id="descricao" name="descricao" class="form-control"
                        placeholder="Descrição do objeto encontrado" autocomplete="off" required>
                    <input type="text" id="local" name="local" class="form-control"
                        placeholder="Local onde foi encontrado" autocomplete="off" required>
                    <input type="date" id="data" name="data" class="form-control" required>

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

        <div class="conteudo">
            <p>
                <?php
                echo ($msg);
                ?>
            </p>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-eEJrOIVZdXl1rIb1TPOOwpv6+X1/QAqLwdDD1lp56Pv0B/Dm5fAKUKtk8WYquENe"
        crossorigin="anonymous"></script>
</body>

</html>