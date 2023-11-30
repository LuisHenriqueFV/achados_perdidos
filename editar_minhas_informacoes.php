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
        
        <!-- INICIO DO HEADER -->
        <header class="bg-primary-color">
            <nav class="navbar navbar-expand-lg fixed-top bg-primary-color" id="navbar">
                <div class="container py-3">
                    <a class="navbar-logo" href="index.php">
                        <img id="navbar-logo" src="img/achados&perdidos-logo4.png" alt="achados&perdidos" />
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbar-items" aria-controls="navbar-items" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbar-items">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link" href="index.php">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="sobre_nos.php">Sobre Nós</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="comunidade.php">Comunidade</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="contato.php">Contato</a>
                            </li>
                            <?php
                            $userId = $_SESSION["codpessoa"];
                            $adm = verifica_administrador($userId, $pdo);




                            if ($adm) {
                                ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="adm.php">Adm</a>
                                </li>
                                <?php
                            }
                            ?>
                        </ul>
                        <div class="dropdown text-end">
                            <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <?php
                                $imagemPerfil = empty($usuario["imagem"]) ? "img/perfil-padrao.png" : "uploads/" . $usuario["imagem"];
                                ?>
                                <img src="<?php echo $imagemPerfil; ?>" alt="Perfil do usuário" width="32" height="32"
                                    class="rounded-circle">
                            </a>
                            <ul class="dropdown-menu text-small">
                                <li><a class="dropdown-item custom-bg-color text-black"
                                        href="perfil_usuario.php">Perfil</a></li>
                                <li>
                                </li>
                                <li><a class="dropdown-item custom-bg-color text-black" href="logout.php">Sair</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>
        </header>
        <!-- FIM DO HEADER -->

        <!-- conteudo -->
        <div id="conteudo" class="container">
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
                            <input type="email" name="email" class="form-control"
                                value="<?php echo $usuario["email"]; ?>" required>
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
        </div>
        <!-- fim do conteudo -->
    </main>
        <!-- RODAPE -->
        <footer class="py-5 bg-primary-color">
        <div class="row justify-content-center">
            <div class="col-6 col-md-2 mb-2">
                <h5>Comunidade</h5>
                <ul class="nav flex-column">
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Home</a></li>
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Features</a></li>
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Pricing</a></li>
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">FAQs</a></li>
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">About</a></li>
                </ul>
            </div>

            <div class="col-6 col-md-2 mb-2">
                <h5>Serviços</h5>
                <ul class="nav flex-column">
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Home</a></li>
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Features</a></li>
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Pricing</a></li>
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">FAQs</a></li>
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">About</a></li>
                </ul>
            </div>

            <div class="col-6 col-md-2 mb-2">
                <h5>Informação</h5>
                <ul class="nav flex-column">
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Home</a></li>
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Features</a></li>
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Pricing</a></li>
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">FAQs</a></li>
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">About</a></li>
                </ul>
            </div>

           
        </div>

    </footer>
    <!-- FINAL DO RODAPÉ -->
</body>

</html>