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
    <main>
  

        <!-- conteudo -->
        <div id="conteudoCadastro" class="container">
            <div class="forms">
                <h1 class="text-center">Editar Minhas Informações</h1>
                <form method="POST">
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <label for="nome">Nome de Usuário:</label>
                            <input type="text" name="nome" class="form-control" value="<?php echo $usuario["nome"]; ?>"
                                required>
                                <hr>
                        </div>
                        <div class="col-md-12">
                            <label for="email">Email:</label>
                            <input type="email" name="email" class="form-control"
                                value="<?php echo $usuario["email"]; ?>" required>
                                <hr>
                        </div>
                        <div class="col-md-12">
                            <label for="nova_senha">Nova Senha:</label>
                            <input type="password" name="nova_senha" class="form-control"
                                placeholder="Deixar em branco para não alterar sua senha atual">
                                <hr>
                        </div>
                        <div class="col-md-12">
                            <label for="cep">CEP:</label>
                            <input class="form-control" type="text" name="cep" id="cep"
                                placeholder="Digite seu cep para obter informações sobre seu endereço"
                                value="<?php echo $usuario["cep"]; ?>">
                                <hr>
                        </div>
                        <div class="col-md-12">
                            <label for="bairro">Bairro:</label>
                            <input class="form-control" type="text" name="bairro" id="bairro"
                                value="<?php echo $usuario["bairro"]; ?>">
                                <hr>
                        </div>
                        <div class="col-md-12">
                            <label for="logradouro">Rua:</label>
                            <input class="form-control" type="text" id="logradouro" name="logradouro"
                                value="<?php echo $usuario["logradouro"]; ?>">
                                <hr>
                        </div>
                        <div class="col-md-12">
                            <label for="cidade">Cidade:</label>

                            <input class="form-control" type="text" name="cidade" id="cidade"
                                value="<?php echo $usuario["cidade"]; ?>">
                                <hr>
                        </div>
                    </div>
                    <div class="mt-3">
                        <button type="submit" class="btn btn-custom-color">Atualizar Informações</button>
                        <a class="btn btn-secondary" href="minhas_informacoes.php" role="button">Voltar</a>
                    </div>
                </form>
            </div>
        </div>
        <!-- fim do conteudo -->
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