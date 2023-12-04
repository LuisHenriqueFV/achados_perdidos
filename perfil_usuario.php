<?php
require_once("./includes/components/autenticacao.php");
require_once("./includes/components/conecta.php");
require_once("./includes/components/funcao.php");
require_once("./includes/components/cabecalho.php");
require_once("./includes/components/header.php");
require_once("./includes/components/js.php");

if (empty($usuario["imagem"])) {
    $usuario["imagem"] = "perfil-padrao.png";
}

$msg = ""; // Adiciona esta linha para inicializar a variável $msg

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["imagem"])) {
    $uploadDir = "./uploads/";
    $uploadFile = $uploadDir . basename($_FILES["imagem"]["name"]);

    if (move_uploaded_file($_FILES["imagem"]["tmp_name"], $uploadFile)) {
        $atualizaImagem = $pdo->prepare('UPDATE pessoa SET imagem = ? WHERE codpessoa = ?');
        $atualizaImagem->execute([$_FILES["imagem"]["name"], $_SESSION["codpessoa"]]);

        $msg = "Imagem enviada com sucesso!"; // Define a mensagem de sucesso
    } else {
        $msg = "Erro ao enviar a imagem.";
    }
}
?>

<body class="dark">
    <main>


        <?php
        if (!empty($msg)) {
            echo '<div class="alert alert-success">' . $msg . '</div>';
        }
        ?>



        <div id="conteudoPerfil" class="container mt-5% col-6">
            <div class="text-center">
                <h1>Olá,
                    <?php echo $usuario["nome"]; ?>.
                </h1>
            </div>

            <div class="row justify-content-center mt-4">
                <div class="col-md-4 text-center">
                    <div id="imagemPerfil" class="mb-3">
                        <img src="./uploads/<?php echo $usuario["imagem"]; ?>" alt="Imagem do perfil"
                            class="img-thumbnail" style="max-width: 150px;">
                    </div>
                    <form id="formImagem" method="POST" enctype="multipart/form-data">
                        <div class="d-flex justify-content-center py-3">
                        
                            <label for="imagem" class="custom-file-upload">
                                <span><img width="48" height="48"
                                        src="https://img.icons8.com/color/48/000000/edit-user-male--v1.png"
                                        alt="edit-user-male--v1" /></span>
                            </label>
                            <input type="file" name="imagem" accept="image/*" id="imagem" class="form-control-file custom-file-input">
                            <hr>


                        </div>
                        <button type="submit" id="btnEnviarImagem" class="btn btn-custom-color mt-2">
                            Enviar Imagem <img width="24" height="24"
                                src="https://img.icons8.com/material/48/000000/send.png" alt="send" />
                        </button>
                        <hr>
                    </form>
                </div>
            </div>


            <div class="mt-4">
                <div class="row justify-content-center">
                    <div class="col-md-6 text-center">
                        <a class="btn btn-custom-color mx-2" href="minhas_informacoes.php" role="button">Minhas
                            Informações</a>
                        <hr>
                    </div>
                </div>

                <div class="row justify-content-center mt-3">
                    <div class="col-md-6 text-center">
                        <a class="btn btn-secondary" href="index.php" role="button">Voltar</a>
                    </div>
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