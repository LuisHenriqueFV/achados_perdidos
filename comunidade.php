<?php
require_once("./includes/components/autenticacao.php");
require_once("./includes/components/conecta.php");
require_once("./includes/components/funcao.php");
require_once("./includes/components/cabecalho.php");
require_once("./includes/components/header.php");
require_once("./includes/components/js.php");


?>

<body>
    <main>


        <!-- INICIO DO HEADER -->
        <header class="bg-primary-color">
            <nav class="navbar navbar-expand-lg fixed-top bg-primary-color" id="navbar">
                <div class="container py-3">
                    <a class="navbar-logo" href="index.php">
                        <img id="navbar-logo" src="img/logo1.png" alt="achados&perdidos" />
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
                                <a class="nav-link" href="como_funciona.php">Sobre</a>
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


        <!-- CONTEÚDO INFORMAÇÃO -->
        <div id="conteudoCadastro" class="container">
            <div id="conteudo" class="content">
                <h1 class="text-center">Achado Não É Roubado, Mas a História É Mais Complexa...</h1>

                <p>Bem-vindo à nossa comunidade no Achados & Perdidos, onde exploramos a fascinante dinâmica dos achados
                    e
                    perdidos. A expressão "Achado não é roubado" é comumente ouvida, mas há mais para descobrir nessa
                    história...</p>

                <p>É inspirador ver histórias de honestidade, especialmente quando pessoas encontram objetos perdidos e
                    se
                    dedicam a devolvê-los aos seus donos. Taxistas e catadores de reciclados frequentemente são heróis
                    nesses momentos. Mas, poucos sabem que procurar o dono de itens perdidos é um dever legal, conforme
                    o
                    Código Civil.</p>

                <p>O artigo 1.233 do Código Civil estabelece que quem encontrar algo perdido deve devolvê-lo ao
                    proprietário. Se não conhecer o dono, deve empenhar-se em encontrá-lo. Caso não tenha sucesso, deve
                    entregá-lo à autoridade competente, que divulgará a descoberta. Após sessenta dias, se o dono não
                    for
                    encontrado, o objeto será leiloado, e o valor será revertido para o Município. Em casos de objetos
                    de
                    pequeno valor, o Município pode abrir mão em favor de quem encontrou.</p>

                <p>Se o dono for localizado, quem devolve o item tem direito a uma recompensa, não inferior a 5% do
                    valor do
                    objeto, além do ressarcimento de despesas com conservação e transporte. O descobridor responderá por
                    danos causados intencionalmente.</p>

                <p>Na nossa comunidade, celebramos essas histórias e discutimos como podemos contribuir para um mundo
                    mais
                    honesto e conectado. Participe, compartilhe suas experiências e inspire-se conosco!</p>
            </div>
        </div>
        <!-- FIM DO CONTEUDO INFORMAÇÃO -->
    </main>
    <!-- RODAPE -->
    <footer class="py-5 bg-footer-custom">
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
                <h5>Contato</h5>
                <ul class="nav flex-column">
                    <li class="nav-item mb-2"><a href="contato.php"
                            class="nav-link p-0 text-body-secondary">Informações</a></li>
                </ul>
            </div>




        </div>

    </footer>
    <!-- FIM DO RODAPÉ -->

</body>

</html>