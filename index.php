<?php
require("./includes/components/autenticacao.php");
require("./includes/components/conecta.php");
require("./includes/components/funcao.php");
require("./includes/components/cabecalho.php");
// require("./includes/components/js.php");

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
                                <a class="nav-link" href="visualizar_encontrados.php">Sobre Nós</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="visualizar_perdidos.php">Contato</a>
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
        </header>
        <!-- FIM DO HEADER -->

        <!-- INICIO DO CARROSEL -->
        <div id="carouselExample" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner custom-carousel">
                <div class="carousel-item active">
                    <img class="d-block custom-img" src="./img/banner11.png" alt="First slide">
                </div>
            </div>
        </div>

        <!-- INICIO DOS FEATURES    -->
        <section class="features mt-5">
            <div class="container">
                <div class="row justify-content-lg-center">
                    <div class="col-lg-2 col-md-12">

                        <div class="features-post">
                            <div class="features-content d-flex align-items-center justify-content-center">
                                <div class="content-show">
                                    <a class="nav-link" href="objetos_perdidos.php">Perdi</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-12">
                        <div class="features-post second-features">
                            <div class="features-content d-flex align-items-center justify-content-center">
                                <div class="content-show">
                                    <a class="nav-link" href="objetos_encontrados.php">Achei</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-12">
                        <div class="features-post third-features">
                            <div class="features-content d-flex align-items-center justify-content-center">
                                <div class="content-show">
                                    <a class="nav-link" href="visualizar_encontrados.php">Achados</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-12">
                        <div class="features-post third-features">
                            <div class="features-content d-flex align-items-center justify-content-center">
                                <div class="content-show">
                                    <a class="nav-link" href="visualizar_perdidos.php">Perdidos</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            </div>
        </section>
        <!-- FIM DOS FEATURES    -->





    </main>
</body>