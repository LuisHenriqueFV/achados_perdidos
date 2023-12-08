<?php
$msg = "";
$aviso = "";

require_once("./includes/components/autenticacao.php");
require_once("./includes/components/conecta.php");
require_once("./includes/components/funcao.php");


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $local = $_POST['local'];
    $data = $_POST['data'];
    $categoria = $_POST['categoria'];
    $tipo = $_POST['tipo'];

    $imagem_padrao = "img/objeto/imagem_padrao.png";

    if (!empty($_FILES['imagem']['name'])) {
        $uploadDir = "img/objeto/";

        $extensao = strtolower(pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION));

        $extensoesPermitidas = array("png", "jpg", "jpeg");
        if (!in_array($extensao, $extensoesPermitidas)) {
            $aviso = "Apenas arquivos PNG, JPG e JPEG são permitidos.";
        } else {
            $nomeArquivo = uniqid('imagem_') . '.' . $extensao;
            $uploadFile = $uploadDir . $nomeArquivo;

            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            if (move_uploaded_file($_FILES['imagem']['tmp_name'], $uploadFile)) {
                $imagem = $uploadDir . $nomeArquivo;

                cadastra_objeto($nome, $descricao, $local, $data, $categoria, $tipo, $imagem, $codpessoa, $pdo);

                $msg = "Objeto cadastrado com sucesso!";
            } else {
                $msg = "Erro no upload da imagem. Verifique o log de erros para mais informações.";
                error_log("Erro no upload da imagem: " . $_FILES['imagem']['error']);
            }
        }
    } else {
        $imagem = $imagem_padrao;

        cadastra_objeto($nome, $descricao, $local, $data, $categoria, $tipo, $imagem, $codpessoa, $pdo);

        $msg = "Objeto cadastrado com sucesso!";
    }
}
$categorias = obter_categorias($pdo);
$tipos = array("Encontrado", "Perdido");

require_once("./includes/components/js.php");
require_once("./includes/components/cabecalho.php");
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
            <h1 class="h2 text-center">Relate informações do que você perdeu ou encontrou.</h1>
            <div class="col-lg-12 col-md-3">

                <div class="forms">
                    <?php
                    if (!empty($msg)) {
                        echo '<div class="alert alert-success">' . $msg . '</div>';
                    }

                    if (!empty($aviso)) {
                        echo '<div class="alert alert-danger">' . $aviso . '</div>';
                    }

                    ?>
                    <form action="objeto.php" method="POST" enctype="multipart/form-data">
                        <div class="inputs-forms">

                            <select id="categoria" name="categoria" class="form-select" required>
                                <option value="" disabled selected>Categoria</option>
                                <?php
                                foreach ($categorias as $cat) {
                                    echo '<option value="' . $cat['nome'] . '">' . $cat['nome'] . '</option>';
                                }
                                ?>
                            </select>
                            <hr>
                            <select id="tipo" name="tipo" class="form-select" required>
                                <option value="" disabled selected>Situação</option>
                                <?php
                                foreach ($tipos as $tipo_option) {
                                    echo '<option value="' . $tipo_option . '">' . $tipo_option . '</option>';
                                }
                                ?>
                            </select>
                            <hr>
                            <input type="text" id="nome" name="nome" class="form-control" placeholder="Nome"
                                autocomplete="off" required>
                            <hr>
                            <input type="text" id="descricao" name="descricao" class="form-control"
                                placeholder="Descrição" autocomplete="off" required>
                            <hr>
                            <input type="text" id="local" name="local" class="form-control"
                                placeholder="Local encontrado ou perdido" autocomplete="off" required>
                            <hr>
                            <input type="date" id="data" name="data" class="form-control" required>
                            <hr>
                            <label for="imagem">Imagem:</label>
                            <input type="file" id="imagem" name="imagem" class="form-control">


                            <hr>
                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-custom-color">Enviar Informações</button>
                            </div>
                            <hr>
                            <div class="d-flex justify-content-center">
                                <a class="btn btn-secondary" href="index.php" role="button">Voltar</a>

                            </div>

                        </div>


                    </form>

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