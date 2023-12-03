<?php
$msg = "";

require_once("./includes/components/autenticacao.php");
require_once("./includes/components/conecta.php");
require_once("./includes/components/funcao.php");
require_once("./includes/components/header.php");
require_once("./includes/components/js.php");
require_once("./includes/components/cabecalho.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $local = $_POST['local'];
    $data = $_POST['data'];
    $categoria = $_POST['categoria'];
    $tipo = $_POST['tipo'];

    // Defina a imagem padrão 
    $imagem_padrao = "img/objeto/imagem_padrao.png";

    if (!empty($_FILES['imagem']['name'])) {
        $uploadDir = "img/objeto/";

        $extensao = strtolower(pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION));

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
    } else {
        // Caso não seja fornecida uma imagem, utiliza a imagem padrão
        $imagem = $imagem_padrao;

        // Adicione uma mensagem de teste
        echo "Nenhuma imagem fornecida, utilizando imagem padrão: $imagem_padrao";

        // Remova ou ajuste esta linha conforme necessário para o seu caso
        cadastra_objeto($nome, $descricao, $local, $data, $categoria, $tipo, $imagem, $codpessoa, $pdo);

        $msg = "Objeto cadastrado com sucesso!";
    }
}
$categorias = obter_categorias($pdo);
$tipos = array("Encontrado", "Perdido");
?>


<body>
    <main>

    <div class="container">
            <div class="row col 12">
            <a class="btn btn-custom-color" href="index.php"><img width="29" height="29"
                            src="img/icons8-back-100.png " alt="filled-trash" /></a>
            </div>
        </div>


        <!-- FORMULARIO DE objeto -->
        <div id="conteudoCadastro" class="container">
            <h1 class="h2">Deixe aqui as informações do objeto que você perdeu ou encontrou.</h1>
            <div class="col-lg-12 col-md-3">

                <div class="forms">
                    <?php
                    if (!empty($msg)) {
                        echo '<div class="alert alert-success">' . $msg . '</div>';
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
                            <select id="tipo" name="tipo" class="form-select" required>
                                <option value="" disabled selected>Situação</option>
                                <?php
                                foreach ($tipos as $tipo_option) {
                                    echo '<option value="' . $tipo_option . '">' . $tipo_option . '</option>';
                                }
                                ?>
                            </select>

                            <input type="text" id="nome" name="nome" class="form-control" placeholder="Nome do objeto"
                                autocomplete="off" required>
                            <input type="text" id="descricao" name="descricao" class="form-control"
                                placeholder="Descrição do objeto" autocomplete="off" required>
                            <input type="text" id="local" name="local" class="form-control" placeholder="Local"
                                autocomplete="off" required>
                            <input type="date" id="data" name="data" class="form-control" required>

                            <label for="imagem">Imagem:</label>
                            <input type="file" id="imagem" name="imagem" class="form-control">




                        </div>


                        <button type="submit" class="btn btn-primary">Cadastrar Objeto</button>

                    </form>
                </div>
            </div>


        </div>







    </main>


    <!-- RODAPE -->
    <footer class="py-5" id="footer">
        <div class="row justify-content-center">
            <div class="col-6 col-md-2 mb-2">
                <h5>Sobre Nós</h5>
                <ul class="nav flex-column">
                    <li class="nav-item mb-2"><a href="sobre_nos.php" class="nav-link p-0 text-body-secondary">Sobre
                            Nós</a></li>
                    <li class="nav-item mb-2"><a href="como_funciona.php" class="nav-link p-0 text-body-secondary">Como
                            Funciona?</a></li>
                    <li class="nav-item mb-2"><a href="comunidade.php"
                            class="nav-link p-0 text-body-secondary">Comunidade</a></li>
                </ul>
            </div>

            <div class="col-6 col-md-2 mb-2">
                <h5>Informações</h5>
                <ul class="nav flex-column">
                    <li class="nav-item mb-2"><a href="contato.php" class="nav-link p-0 text-body-secondary">Contato</a>
                    </li>
                </ul>
            </div>
        </div>
    </footer>

    <!-- FIM DO RODAPÉ -->


</body>

</html>