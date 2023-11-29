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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $novaSenha = $_POST["nova_senha"];
    $cep = $_POST["cep"];
    $bairro = $_POST["bairro"];
    $logradouro = $_POST["logradouro"];
    $cidade = $_POST["cidade"];

    if (!empty($novaSenha)) {
        $senhaHash = password_hash($novaSenha, PASSWORD_DEFAULT);
    } else {
        $senhaHash = $usuario["senha"];
    }

    $atualizaInfo = $pdo->prepare('UPDATE pessoa SET nome = ?, email = ?, senha = ?, cep = ?, bairro = ?, logradouro = ?, cidade = ? WHERE codpessoa = ?');
    $atualizaInfo->execute([$nome, $email, $senhaHash, $cep, $bairro, $logradouro, $cidade, $userId]);

    $consulta->execute([$userId]);
    $usuario = $consulta->fetch();

    echo "Informações atualizadas com sucesso!";
}
?>

<body>
    <main class="container mt-5">
        <div class="forms">
            <h1 class="text-center">Editar Minhas Informações</h1>
            <form method="POST">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <label for="nome">Nome de Usuário:</label>
                        <input type="text" name="nome" class="form-control" value="<?php echo $usuario["nome"]; ?>"
                            required>
                    </div>
                    <div class="col-md-12">
                        <label for="email">Email:</label>
                        <input type="email" name="email" class="form-control" value="<?php echo $usuario["email"]; ?>"
                            required>
                    </div>
                    <div class="col-md-12">
                        <label for="nova_senha">Nova Senha:</label>
                        <input type="password" name="nova_senha" class="form-control"
                            placeholder="Deixar em branco para não alterar sua senha atual">
                    </div>
                    <div class="col-md-12">
                        <label for="cep">CEP:</label>
                        <input class="form-control" type="text" name="cep" id="cep"
                            placeholder="Digite seu cep para obter informações sobre seu endereço"
                            value="<?php echo $usuario["cep"]; ?>">
                    </div>
                    <div class="col-md-12">
                        <label for="bairro">Bairro:</label>
                        <input class="form-control" type="text" name="bairro" id="bairro"
                            value="<?php echo $usuario["bairro"]; ?>">
                    </div>
                    <div class="col-md-12">
                        <label for="logradouro">Rua:</label>
                        <input class="form-control" type="text" id="logradouro" name="logradouro"
                            value="<?php echo $usuario["logradouro"]; ?>">
                    </div>
                    <div class="col-md-12">
                        <label for="cidade">Cidade:</label>

                        <input class="form-control" type="text" name="cidade" id="cidade"
                            value="<?php echo $usuario["cidade"]; ?>">
                    </div>
                </div>
                <div class="mt-3">
                    <button type="submit" class="btn btn-primary">Atualizar Informações</button>
                    <a class="btn btn-secondary" href="minhas_informacoes.php" role="button">Cancelar</a>
                </div>
            </form>
        </div>
    </main>
</body>

</html>