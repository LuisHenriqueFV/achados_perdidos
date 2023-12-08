<?php
require_once("./includes/components/autenticacao.php");
require_once("./includes/components/conecta.php");
require_once("./includes/components/funcao.php");

$msg = "";

if (empty($_FILES['imagem']['name'])) {
    $uploadDir = "img/perfil-padrao.png";
}



if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["imagem"])) {
    $uploadDir = "./uploads/";
    $uploadFile = $uploadDir . basename($_FILES["imagem"]["name"]);

    if (move_uploaded_file($_FILES["imagem"]["tmp_name"], $uploadFile)) {
        $atualizaImagem = $pdo->prepare('UPDATE pessoa SET imagem = ? WHERE codpessoa = ?');
        $atualizaImagem->execute([$_FILES["imagem"]["name"], $_SESSION["codpessoa"]]);

        $msg = "Imagem enviada com sucesso!";
    }
}
require_once("./includes/components/cabecalho.php");
require_once("./includes/components/js.php");
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






        <div id="conteudoUsuario" class="container mt-5% col-6">
            <?php
            if (!empty($msg)) {
                echo '<div class="alert alert-success">' . $msg . '</div>';
            }
            ?>

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



    <?php
    require_once("./includes/components/footer.php");
    require_once("./includes/components/js.php");
    require_once("./includes/components/js2.php");

    ?>

</body>

</html>