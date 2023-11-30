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
    <main>

        <!-- FORMULARIO DE OBJETOS PERDIDOS -->
        <div id="conteudo" class="container">
            <div class="col-lg-6 col-md-3">
                <div class="forms">
                    <?php
                    // Exibe a mensagem de sucesso se houver
                    if (!empty($msg)) {
                        echo '<div class="alert alert-success">' . $msg . '</div>';
                    }
                    ?>
                    <form action="objetos_perdidos.php" method="POST" enctype="multipart/form-data">
                        <div class="inputs-forms">

                            <select id="categoria" name="categoria" class="form-select" required>
                                <option value="" disabled selected>Categoria</option>
                                <?php
                                foreach ($categorias as $cat) {
                                    echo '<option value="' . $cat['nome'] . '">' . $cat['nome'] . '</option>';
                                }
                                ?>
                            </select>

                            <input type="text" id="nome" name="nome" class="form-control"
                                placeholder="Nome do objeto perdido" autocomplete="off" required>
                            <input type="text" id="descricao" name="descricao" class="form-control"
                                placeholder="Descrição do objeto perdido" autocomplete="off" required>
                            <input type="text" id="local" name="local" class="form-control"
                                placeholder="Local onde foi perdido" autocomplete="off" required>
                            <input type="date" id="data" name="data" class="form-control" required>
                            <label for="imagem">Imagem:</label>
                            <input type="file" id="imagem" name="imagem" class="form-control">


                        </div>


                        <button type="submit" class="btn btn-primary">Cadastrar Objeto Perdido</button>
                        <a href="index.php" class="btn btn-secondary">Voltar</a>

                    </form>
                </div>
            </div>


        </div>


    </main>

</body>

</html>