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

        <!-- INICIO DO CARROSEL -->
        <div id="carousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner custom-carousel">
                <div class="carousel-item active">
                    <img class="d-block custom-img" src="./img/banner11.png" alt="First slide">
                </div>
            </div>
        </div>

        <!-- INICIO DOS FEATURES    -->
        <section class="features mt-5">
            <div class="container-fluid">
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
        </section>
        <!-- FIM DOS FEATURES    -->

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