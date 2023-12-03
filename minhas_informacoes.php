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

<html>

<body>
    <main>



        <div id="conteudoMinhasInformacoes" class="container d-flex justify-content-center">

            <div class="forms">
                <h1 class="text-center">Minhas Informações</h1>
                <div class="row justify-content-center py-5">
                    <div class="col-md-12">
                        <p><strong>Nome de Usuário:</strong>
                            <?php echo $usuario["nome"]; ?>
                        </p>
                        <hr>
                        <p><strong>Email:</strong>
                            <?php echo $usuario["email"]; ?>
                        </p>
                        <hr>
                        <p><strong>CEP:</strong>
                            <?php echo $usuario["cep"]; ?>
                        </p>
                        <hr>
                        <p><strong>Bairro:</strong>
                            <?php echo $usuario["bairro"]; ?>
                        </p>
                        <hr>
                        <p><strong>Rua:</strong>
                            <?php echo $usuario["logradouro"]; ?>
                        </p>
                        <hr>
                        <p><strong>Cidade:</strong>
                            <?php echo $usuario["cidade"]; ?>
                        </p>
                        <hr>
                    </div>

                    <div class="d-flex justify-content-center pb-2">
                        <a class="btn btn-custom-color" href="editar_minhas_informacoes.php" role="button">Editar
                            Informações</a>

                    </div>
                    <hr>
                    <div class="container d-flex justify-content-center">
                        <div class="row col-2">
                        <a class="btn btn-secondary" href="perfil_usuario.php" role="button">Voltar</a>

                        </div>
                    </div>
                </div>
            </div>
        </div>

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

</html>