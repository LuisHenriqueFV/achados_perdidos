<?php

require("./includes/components/autenticacao.php");
require("./includes/components/conecta.php");
require("./includes/components/funcao.php");
require("./includes/components/cabecalho.php");


$userId = $_SESSION["codpessoa"];

$consulta = $pdo->prepare('SELECT * FROM pessoa WHERE codpessoa = ?');
$consulta->execute([$userId]);
$usuario = $consulta->fetch();

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
    <main class="container mt-5">
        <div class="forms">
            <h1 class="text-center">Olá, <?php echo $usuario["nome"]; ?></h1>
            <div class="row justify-content-center">
              
                <div class="col-md-12">
                    <div id="imagemPerfil" class="mb-3">
                        <img src="./uploads/<?php echo $usuario["imagem"]; ?>" alt="Imagem do perfil" class="img-thumbnail" style="max-width: 150px;">
                    </div>
                    <form id="formImagem" method="POST" enctype="multipart/form-data">
                        <label for="imagem">Trocar Foto:</label>
                        <input type="file" name="imagem" accept="image/*" class="form-control-file">
                        <button type="submit" id="btnEnviarImagem" class="btn btn-primary mt-2">Enviar Imagem</button>
                    </form>
                </div>
            </div>
            <div class="mt-3">
                <a class="btn btn-primary" href="endereco.php" role="button">Cadastrar Endereço</a>
                <a class="btn btn-primary" href="minhas_informacoes.php" role="button">Minhas Informações</a>

                <a class="btn btn-secondary" href="index.php" role="button">Voltar</a>
            </div>
        </div>
    </main>
  
</body>
</html>