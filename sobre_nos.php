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


        <!-- INFORMAÇÃO -->
        <div id="conteudo" class="content">
            <div class="content">
                <h1 class="text-center">Sobre Nós</h1>
                <p>Bem-vindo ao Achados & Perdidos, o lugar onde a comunidade se une para ajudar a encontrar objetos
                    perdidos e reunir pessoas com seus pertences perdidos. Nosso objetivo é facilitar a conexão entre
                    aqueles que perderam algo e aqueles que encontraram algo.</p>

                <h2>Nossa Missão</h2>
                <p>Nossa missão é criar uma plataforma fácil de usar, onde as pessoas podem relatar objetos perdidos,
                    compartilhar informações sobre itens encontrados e se reunir para devolver pertences perdidos aos
                    seus donos. Acreditamos que, ao conectar a comunidade, podemos fazer a diferença na vida das
                    pessoas.</p>

                <h2>Como Funciona</h2>
                <p>Para começar, explore as seções "Perdi" e "Achei" para ver os objetos que foram relatados como
                    perdidos ou encontrados. Se você perdeu algo, você pode relatar seu item perdido, e se encontrou
                    algo, pode compartilhar as informações para ajudar na devolução. A comunidade é o coração do Achados
                    & Perdidos, e sua participação faz toda a diferença.</p>

                <h2>Contato</h2>
                <p>Se você tiver alguma dúvida, sugestão ou precisar de suporte, sinta-se à vontade para entrar em
                    contato conosco através do nosso formulário de <a href="contato.php">Contato</a>. Estamos aqui para
                    ajudar!</p>
            </div>
            <a href="index.php" class="btn btn-secondary">Voltar</a>
        </div>
        <!-- FIM DA INFORMAÇÃO -->





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