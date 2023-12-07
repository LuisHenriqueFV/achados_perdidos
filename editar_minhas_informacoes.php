<?php
require_once("./includes/components/autenticacao.php");
require_once("./includes/components/conecta.php");
require_once("./includes/components/funcao.php");

$userId = $_SESSION["codpessoa"];
$consulta = $pdo->prepare('SELECT * FROM pessoa WHERE codpessoa = ?');
$consulta->execute([$userId]);
$usuario = $consulta->fetch();

$msg = "";
$mensagem = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $novaSenha = $_POST["nova_senha"];
    $cep = $_POST["cep"];
    $bairro = $_POST["bairro"];
    $logradouro = $_POST["logradouro"];
    $cidade = $_POST["cidade"];

    if (!empty($novaSenha)) {
        if (strlen($novaSenha) >= 8) {
            $senhaHash = password_hash($novaSenha, PASSWORD_DEFAULT);
        } else {
            $mensagem = "A nova senha deve ter pelo menos 8 caracteres. A senha não foi alterada.";
            $senhaHash = $usuario["senha"]; 
        }
    } else {
        $senhaHash = $usuario["senha"];
        $msg = "Informações Atualizadas!";
    }

    atualizaInfo($nome, $email, $senhaHash, $cep, $bairro, $logradouro, $cidade, $userId, $pdo);
}

require_once("./includes/components/cabecalho.php");
require_once("./includes/components/header.php");
require_once("./includes/components/js.php");
?>

<body>
    <main>
        <!-- conteudo -->
        <div id="conteudoCadastro" class="container">
            <div class="forms">
                <h1 class="text-center">Editar Minhas Informações</h1>
                <hr>
                <?php
                if (!empty($msg)) {
                    echo '<div class="alert alert-success">' . $msg . '</div>';
                }
                if (!empty($mensagem)) {
                    echo '<div class="alert alert-warning">' . $mensagem . '</div>'; 
                }
                ?>
                
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