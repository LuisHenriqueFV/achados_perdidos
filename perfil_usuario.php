<?php
session_start();

if (!isset($_SESSION["logged"]) || $_SESSION["logged"] !== true) {
    header("Location: login.php");
    exit;
}

require("./includes/components/conecta.php");
require("./includes/components/cabecalho.php");

$userEmail = $_SESSION["email"];

$consulta = $pdo->prepare('SELECT * FROM pessoa WHERE email = ?');
$consulta->execute([$userEmail]);
$usuario = $consulta->fetch();

// Verifica se o usuário tem uma imagem
if (empty($usuario["imagem"])) {
    // Se não tiver imagem, atribui o nome da imagem padrão
    $usuario["imagem"] = "perfil-padrao.png";
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["imagem"])) {
    $uploadDir = "./uploads/";
    $uploadFile = $uploadDir . basename($_FILES["imagem"]["name"]);

    if (move_uploaded_file($_FILES["imagem"]["tmp_name"], $uploadFile)) {
        $atualizaImagem = $pdo->prepare('UPDATE pessoa SET imagem = ? WHERE email = ?');
        $atualizaImagem->execute([$_FILES["imagem"]["name"], $userEmail]);
        echo "Imagem enviada com sucesso!";
    } else {
        echo "Erro ao enviar a imagem.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil do Usuário</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
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
                <button type="button" id="btnEnviarImagem" class="btn btn-primary">Enviar Imagem</button>
            </form>

            <a class="btn btn-secondary" href="index.php" role="button">Voltar</a>
        </div>
    </main>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function() {
            $("#btnEnviarImagem").click(function() {
                var formData = new FormData($("#formImagem")[0]);

                $.ajax({
                    url: "perfil_usuario.php", 
                    type: "POST",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        $("#imagemPerfil").html(response);
                    },
                    error: function() {
                        alert("Erro ao enviar a imagem.");
                    }
                });
            });
        });
    </script>
</body>
</html>
