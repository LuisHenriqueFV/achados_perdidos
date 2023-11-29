<?php
require("./includes/components/autenticacao.php");
require("./includes/components/conecta.php");
require("./includes/components/funcao.php");
require("./includes/components/cabecalho.php");

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

    // Verifica se a nova senha foi fornecida
    if (!empty($novaSenha)) {
        // Criptografa a nova senha
        $senhaHash = password_hash($novaSenha, PASSWORD_DEFAULT);
    } else {
        // Se a senha não foi fornecida, mantém a senha existente
        $senhaHash = $usuario["senha"];
    }

    // Atualiza as informações na tabela pessoa
    $atualizaInfo = $pdo->prepare('UPDATE pessoa SET nome = ?, email = ?, senha = ?, cep = ?, bairro = ?, logradouro = ?, cidade = ? WHERE codpessoa = ?');
    $atualizaInfo->execute([$nome, $email, $senhaHash, $cep, $bairro, $logradouro, $cidade, $userId]);
    
    echo "Informações atualizadas com sucesso!";
}

?>

<body>
    <main class="container mt-5">
        <div class="forms">
            <h1 class="text-center">Minhas Informações</h1>
            <form method="POST">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <label for="nome">Nome de Usuário:</label>
                        <input type="text" name="nome" class="form-control" value="<?php echo $usuario["nome"]; ?>" required>
                    </div>
                    <div class="col-md-12">
                        <label for="email">Email:</label>
                        <input type="email" name="email" class="form-control" value="<?php echo $usuario["email"]; ?>" required>
                    </div>
                    <div class="col-md-12">
                        <label for="nova_senha">Nova Senha:</label>
                        <input type="password" name="nova_senha" class="form-control">
                        <small>Deixe em branco para manter a senha atual.</small>
                    </div>
                    <div class="col-md-12">
                        <label for="cep">CEP:</label>
                        <input type="text" name="cep" class="form-control" value="<?php echo $usuario["cep"]; ?>">
                    </div>
                    <div class="col-md-12">
                        <label for="bairro">Bairro:</label>
                        <input type="text" name="bairro" class="form-control" value="<?php echo $usuario["bairro"]; ?>">
                    </div>
                    <div class="col-md-12">
                        <label for="logradouro">Logradouro:</label>
                        <input type="text" name="logradouro" class="form-control" value="<?php echo $usuario["logradouro"]; ?>">
                    </div>
                    <div class="col-md-12">
                        <label for="cidade">Cidade:</label>
                        <input type="text" name="cidade" class="form-control" value="<?php echo $usuario["cidade"]; ?>">
                    </div>
                </div>
                <div class="mt-3">
                    <button type="submit" class="btn btn-primary">Atualizar Informações</button>
                    <a class="btn btn-secondary" href="perfil_usuario.php" role="button">Voltar</a>
                </div>
            </form>
        </div>
    </main>
</body>
</html>
