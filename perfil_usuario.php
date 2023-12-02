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

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["imagem"])) {
    $uploadDir = "./uploads/";
    $uploadFile = $uploadDir . basename($_FILES["imagem"]["name"]);

    if (move_uploaded_file($_FILES["imagem"]["tmp_name"], $uploadFile)) {
        $atualizaImagem = $pdo->prepare('UPDATE pessoa SET imagem = ? WHERE codpessoa = ?');
        $atualizaImagem->execute([$_FILES["imagem"]["name"], $_SESSION["codpessoa"]]);

        echo "Imagem enviada com sucesso!";
    } else {
        echo "Erro ao enviar a imagem.";
    }
}
?>

<body>
    <main>


        <div id="conteudoPerfil" class="container mt-5%">
            <div class="text-center">
                <h1>Olá,
                    <?php echo $usuario["nome"]; ?>
                </h1>
            </div>

            <div class="row justify-content-center mt-4">
                <div class="col-md-4 text-center">
                    <div id="imagemPerfil" class="mb-3">
                        <img src="./uploads/<?php echo $usuario["imagem"]; ?>" alt="Imagem do perfil"
                            class="img-thumbnail" style="max-width: 150px;">
                    </div>
                    <form id="formImagem" method="POST" enctype="multipart/form-data">
                        <label for="imagem" class="form-label">Trocar Foto:</label>
                        <input type="file" name="imagem" accept="image/*" class="form-control-file">
                        <button type="submit" id="btnEnviarImagem" class="btn btn-primary mt-2">Enviar Imagem</button>
                    </form>
                </div>
            </div>

            <div class="mt-4">
                <div class="row justify-content-center">
                    <div class="col-md-6 text-center">
                        <a class="btn btn-primary mx-2" href="endereco.php" role="button">Cadastrar Endereço</a>
                        <a class="btn btn-primary mx-2" href="minhas_informacoes.php" role="button">Minhas
                            Informações</a>
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