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

    if (isset($_FILES['imagem'])) {
        $imagem = $_FILES['imagem'];

        if ($imagem['error'] === UPLOAD_ERR_OK) {
            $uploadDir = "./uploads/";
            $uploadFile = $uploadDir . basename($imagem['name']);
            move_uploaded_file($imagem['tmp_name'], $uploadFile);
        }
    }

    $cadastra_objeto_perdido = cadastra_objeto_perdido($nome, $descricao, $local, $data, $pdo);

    if ($cadastra_objeto_perdido) {
        $msg = "Objeto perdido cadastrado!";
    } else {
        $msg = "Objeto perdido existente ou erro no cadastro.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<body>
    <main class="container">
        <div class="forms">
            <form action="objetos_perdidos.php" method="POST" enctype="multipart/form-data">
                <div class="inputs-forms">
                    <input type="text" id="nome" name="nome" class="form-control" placeholder="Nome do objeto perdido" autocomplete="off" required>
                    <input type="text" id="descricao" name="descricao" class="form-control" placeholder="Descrição do objeto perdido" autocomplete="off" required>
                    <input type="text" id="local" name="local" class="form-control" placeholder="Local onde foi perdido" autocomplete="off" required>
                    <input type="date" id="data" name="data" class="form-control" required>

                    <!-- Adiciona o campo de upload de imagem -->
                    <label for="imagem">Escolha uma imagem:</label>
                    <input type="file" id="imagem" name="imagem" accept="image/*" class="form-control" required>

                    <div class="nav">
                        <button type="submit" class="btn btn-primary">Cadastrar Objeto Perdido</button>
                        <a href="index.php" class="btn btn-secondary">Voltar</a>
                    </div>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-eEJrOIVZdXl1rIb1TPOOwpv6+X1/QAqLwdDD1lp56Pv0B/Dm5fAKUKtk8WYquENe" crossorigin="anonymous"></script>
</body>

</html>
