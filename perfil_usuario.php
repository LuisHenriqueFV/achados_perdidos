<?php

require("./includes/components/autenticacao.php");
require("./includes/components/conecta.php");
require("./includes/components/funcao.php");
require("./includes/components/cabecalho.php");
require("./includes/components/js.php");


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
    <main class="container">
        <div class="forms">
            <h1>Perfil do Usuário</h1>
            <p>Nome de Usuário: <?php echo $usuario["nome"]; ?></p>
            <p>Email: <?php echo $usuario["email"]; ?></p>

            <div id="imagemPerfil" class="mb-3 text-center">
                <img src="./uploads/<?php echo $usuario["imagem"]; ?>" alt="Imagem do perfil" class="img-thumbnail" style="max-width: 150px;">
            </div>

            <form id="formImagem" method="POST" enctype="multipart/form-data">
                <label for="imagem">Escolha uma imagem para perfil:</label>
                <input type="file" name="imagem" accept="image/*" class="form-control-file">
                <button type="submit" id="btnEnviarImagem" class="btn btn-primary">Enviar Imagem</button>
            </form>
            <a class="btn btn-primary" href="alterar_Senha.php" role="button">Alterar S</a>

            <a class="btn btn-secondary" href="index.php" role="button">Voltar</a>
        </div>
    </main>

</body>
</html>
