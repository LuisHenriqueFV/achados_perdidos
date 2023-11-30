<?php
require_once("./includes/components/autenticacao.php");
require_once("./includes/components/conecta.php");
require_once("./includes/components/funcao.php");
require_once("./includes/components/cabecalho.php");
require_once("./includes/components/header.php");
require_once("./includes/components/js.php");

$userId = $_SESSION["codpessoa"];
$consulta = $pdo->prepare('SELECT * FROM pessoa WHERE codpessoa = ?');
$consulta->execute([$userId]);
$usuario = $consulta->fetch();
?>

<body>
    <main class="container mt-5">
        <div class="forms">
            <h1 class="text-center">Minhas Informações</h1>
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <p><strong>Nome de Usuário:</strong> <?php echo $usuario["nome"]; ?></p>
                    <p><strong>Email:</strong> <?php echo $usuario["email"]; ?></p>
                    <p><strong>CEP:</strong> <?php echo $usuario["cep"]; ?></p>
                    <p><strong>Bairro:</strong> <?php echo $usuario["bairro"]; ?></p>
                    <p><strong>Rua:</strong> <?php echo $usuario["logradouro"]; ?></p>
                    <p><strong>Cidade:</strong> <?php echo $usuario["cidade"]; ?></p>
                </div>
                <div class="col-md-12">
                    <a class="btn btn-primary" href="editar_minhas_informacoes.php" role="button">Editar Informações</a>
                    <a class="btn btn-secondary" href="perfil_usuario.php" role="button">Voltar</a>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
