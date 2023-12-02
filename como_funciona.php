<?php
require_once("./includes/components/autenticacao.php");
require_once("./includes/components/conecta.php");
require_once("./includes/components/funcao.php");
require_once("./includes/components/header.php");
require_once("./includes/components/js.php");
require_once("./includes/components/cabecalho.php");

$msg = "";
$objeto = null;

$categorias = obter_categorias($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $categoria = isset($_GET['categoria']) ? $_GET['categoria'] : "";
    $tipo = isset($_GET['tipo']) ? $_GET['tipo'] : "";
    $nome = isset($_GET['pesquisar']) ? $_GET['pesquisar'] : "";

    // Pesquisa objeto
    if ($categoria === "MostrarTodos") {
        $objeto = pesquisa_objeto($nome, null, $tipo, $pdo);
    } else {
        $objeto = pesquisa_objeto($nome, $categoria, $tipo, $pdo);
    }
}

?>

<body>
    <main>


   
<!-- ---------------------------------------------------------------------- -->

        <!-- INICIO DO CARROSEL -->
        <div id="carousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner custom-carousel">
                <div class="carousel-item active">
                    <img class="d-block custom-img" src="./img/banner11.png" alt="First slide">
                </div>
            </div>
        </div>
        <!-- FIM DO CARROSEL -->
<!-- ---------------------------------------------------------------------- -->

        <!-- INICIO DOS FEATURES    -->
        <section class="features mt-5">
            <div class="container">
                <div class="row justify-content-lg-center">
                    <div class="col-lg-2 col-md-12">

                        <div class="features-post">
                            <div class="features-content d-flex align-items-center justify-content-center">
                                <div class="content-show">
                                    <a class="nav-link" href="objeto.php">Achei / Perdi</a>
                                </div>
                            </div>
                        </div>
                    </div>

                

                </div>
            </div>
        </section>
        <!-- FIM DOS FEATURES    -->

        </main>

<!-- ---------------------------------------------------------------------- -->

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

 <!-- ---------------------------------------------------------------------- -->

</body>

</html>