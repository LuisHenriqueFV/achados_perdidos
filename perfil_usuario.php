<?php
require_once("./includes/components/autenticacao.php");
require_once("./includes/components/conecta.php");
require_once("./includes/components/funcao.php");


if(empty($usuario["imagem"])) {
    $usuario["imagem"] = "perfil-padrao.png";
}

$msg = "";

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["imagem"])) {
    $uploadDir = "./uploads/";
    $uploadFile = $uploadDir.basename($_FILES["imagem"]["name"]);

    if(move_uploaded_file($_FILES["imagem"]["tmp_name"], $uploadFile)) {
        $atualizaImagem = $pdo->prepare('UPDATE pessoa SET imagem = ? WHERE codpessoa = ?');
        $atualizaImagem->execute([$_FILES["imagem"]["name"], $_SESSION["codpessoa"]]);

        $msg = "Imagem enviada com sucesso!";
    } else {
        $msg = "Erro ao enviar a imagem.";
    }
}
require_once("./includes/components/cabecalho.php");
require_once("./includes/components/header.php");
require_once("./includes/components/js.php");
?>

<body>
    <main>


        <?php
        if(!empty($msg)) {
            echo '<div class="alert alert-success">'.$msg.'</div>';
        }
        ?>



        <div id="conteudoPerfil" class="container mt-5% col-6">


            <div class="row justify-content-center mt-4">
                <div class="col-md-4 text-center">
                    <div id="imagemPerfil" class="mb-3">
                        <img src="./uploads/<?php echo $usuario["imagem"]; ?>" alt="Imagem do perfil"
                            class="img-thumbnail" style="max-width: 150px;">
                    </div>
                    <div class="text-center">
                        <h1>
                            <?php echo $usuario["nome"]; ?>
                        </h1>
                    </div>
                    <form id="formImagem" method="POST" enctype="multipart/form-data">
                        <div class="d-flex justify-content-center py-3">

                            <label for="imagem" class="custom-file-upload">
                                <span>Trocar Foto<img width="35" height="35"
                                        src="https://img.icons8.com/color/48/000000/edit-user-male--v1.png"
                                        alt="edit-user-male--v1" /></span>
                            </label>
                            <input type="file" name="imagem" accept="image/*" id="imagem"
                                class="form-control-file custom-file-input">
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
    <footer id="footer">

        <div class="container">
            <div class="h1" id="achados_perdidos">
            <h1>Achei!</h1>

            </div>
            <div style="display: flex; align-items: center;">
                <img class="icon" src="img/icons8-phone-48.png"
                    style="width: 25px; height: 25px;  margin-bottom:17px; padding-right: 5px;" alt="icon">
                <p>+55 5398405-5364</p>
            </div>
            <div style="display: flex; align-items: center;">
                <img class="icon" src="img/icons8-gmail-50.png"
                    style="width: 25px; height: 25px; margin-bottom:19px; padding-right: 5px;" alt="icon">
                <p>luishenriquefonsecaphp@gmail.com</p>
            </div>
            <div style="display: flex; align-items: center;">
                <img class="icon" src="img/icons8-location-60.png"
                    style="width: 25px; height: 25px; margin-bottom:19px; padding-right: 5px;" alt="icon">
                <p>Pelotas, Rio Grande Do Sul</p>
            </div>
        </div>
    </footer>

    <!-- FIM DO RODAPÉ -->
</body>

</html>