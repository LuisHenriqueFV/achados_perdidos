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
$cards = obter_cards_do_banco($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    $categoria = isset($_GET['categoria']) ? $_GET['categoria'] : "";
    $tipo = isset($_GET['tipo']) ? $_GET['tipo'] : "";
    $nome = isset($_GET['pesquisar']) ? $_GET['pesquisar'] : "";

    if ($categoria === "MostrarTodos") {
        $objeto = pesquisa_objeto($nome, null, $tipo, $pdo);
    } else {
        $objeto = pesquisa_objeto($nome, $categoria, $tipo, $pdo);
    }
}



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

        <!-- ---------------------------------------------------------------------- -->



        <!-- INICIO DO CONTEUDO -->
        <div id="filtro" class="container">

            <div class="row mb-2 justify-content-center">
                <div class="row col-lg-3  mb-2 col-md-12 col-ms-12">
                    <a class="btn btn-custom-color" href="objeto.php"><img width="30" height="30"
                            src="img/icons8-add-40.png " alt="filled-trash" /></a>
                </div>




                <div class="forms">
                    <form action="index.php" method="GET">

                        <div class="row col-lg-12">

                            <div class="mb-1 input-group">
                                <input type="text" name="pesquisar" class="form-control" placeholder="Pesquisar objeto"
                                    autocomplete="off">


                                <select name="categoria" class="form-select">
                                    <option value="MostrarTodos" <?= $categoria === 'MostrarTodos' ? 'selected' : ''; ?>>
                                        Todas
                                        Categorias</option>
                                    <?php foreach ($categorias as $cat): ?>
                                        <option value="<?= htmlspecialchars($cat['nome'], ENT_QUOTES) ?>"
                                            <?= $categoria === $cat['nome'] ? 'selected' : ''; ?>>
                                            <?= htmlspecialchars($cat['nome'], ENT_QUOTES) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>

                                <select name="tipo" class="form-select">
                                    <option value="" <?= $tipo === '' ? 'selected' : ''; ?>>Situação</option>
                                    <option value="Encontrado" <?= $tipo === 'Encontrado' ? 'selected' : ''; ?>>Encontrado
                                    </option>
                                    <option value="Perdido" <?= $tipo === 'Perdido' ? 'selected' : ''; ?>>Perdido</option>
                                </select>


                                <button id="customButton" class="btn" type="submit"
                                    name="filtrarCategoria"><img width="25" height="25" src="https://img.icons8.com/color/48/search--v1.png" alt="search--v1"/>

</button>
                            </div>



                        </div>
                    </form>
                </div>

                <div class="conteudo">
                    <?php if ($objeto): ?>
                        <?php if (empty($objeto)): ?>
                            <p>Nenhum resultado encontrado.</p>
                        <?php else: ?>
                            <div id="conteudo" class="container">
                                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3">
                                    <?php foreach ($objeto as $obj): ?>
                                        <?php if (
                                            ($tipo === 'Encontrado' && $obj['tipo'] === 'Encontrado') ||
                                            ($tipo === 'Perdido' && $obj['tipo'] === 'Perdido') ||
                                            ($tipo === '')
                                        ): ?>
                                            <div class="col mb-4">
                                                <div class="card" style="max-width: 600px; height: 350px   ;">
                                                    <div class="row g-0">
                                                        <div class="col-lg-4">
                                                            <img src="<?= $obj['imagem']; ?>" class="img-fluid rounded-start"
                                                                alt="Imagem do Card" style="width: 100%; height: 150px ;">
                                                        </div>
                                                        <div class="col-lg-8">
                                                            <div class="card-body">
                                                                <h5 class="card-title">
                                                                    <?= $obj['tipo']; ?>
                                                                </h5>
                                                                <p class="card-text">
                                                                    <?= $obj['categoria']; ?>
                                                                </p>
                                                                <p class="card-text">
                                                                    <?= $obj['nome']; ?>
                                                                </p>
                                                                <p class="card-text">
                                                                    <?= $obj['descricao']; ?>
                                                                </p>
                                                                <p class="card-text">
                                                                    <?= $obj['local']; ?>
                                                                </p>

                                                                <?php $pessoa = pesquisa_pessoa_por_id($obj['codpessoa'], $pdo) ?>
                                                                <p class="card-text"><small class="text-body-secondary">
                                                                        <?php echo $pessoa['email']; ?>
                                                                    </small></p>

                                                                <p class="card-text"><small class="text-body-secondary">
                                                                        <?= date(' d / m / Y ', strtotime($obj['data'])); ?>
                                                                    </small></p>

                                                                <?php if (isset($_SESSION["codpessoa"]) && ($_SESSION["adm"] == 1 || $obj['codpessoa'] == $_SESSION["codpessoa"])): ?>
                                                                    <div class="justfy-content-between ">
                                                                        <a href="editar_objeto.php?id=<?= $obj['id']; ?>" class="btn"><img
                                                                                width="24" height="24"
                                                                                src="https://img.icons8.com/dusk/64/000000/edit--v1.png"
                                                                                alt="edit--v1" /></a>
                                                                        <a href="excluir_objeto.php?id=<?= $obj['id']; ?>" class="btn"><img
                                                                                width="30" height="30"
                                                                                src="https://img.icons8.com/plasticine/30/000000/filled-trash.png"
                                                                                alt="filled-trash" /></a>
                                                                    </div>
                                                                <?php endif; ?>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php else: ?>
                        <p>
                            <?= htmlspecialchars($msg, ENT_QUOTES) ?>
                        </p>
                    <?php endif; ?>
                </div>



                <!-- FIM DO CONTEUDO -->



    </main>

    <!-- ---------------------------------------------------------------------- -->

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