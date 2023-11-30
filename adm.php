<?php
require_once("./includes/components/autenticacao.php");
require_once("./includes/components/conecta.php");
require_once("./includes/components/funcao.php");
require_once("./includes/components/cabecalho.php");
require_once("./includes/components/header.php");
require_once("./includes/components/js.php");

$msg = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['nome_categoria']) && $_POST['nome_categoria'] !== '') {
        $nomeCategoria = $_POST['nome_categoria'];

        // Tenta cadastrar a categoria
        $cadastra_categoria = cadastra_categoria($nomeCategoria, $pdo);

        // Verifica se a categoria foi cadastrada com sucesso
        if ($cadastra_categoria) {
            $msg = "Categoria cadastrada com sucesso!";
        } else {
            $msg = "Erro ao cadastrar a categoria. Verifique o log de erros para mais informações.";
            error_log("Erro ao cadastrar categoria no banco de dados.");
        }
    }
}

if (isset($_GET['excluir']) && $_GET['excluir'] === 'true') {
    $categoria_id = $_GET['id'];

    if (exclui_categoria($categoria_id, $pdo)) {
        $msg = "Categoria excluída!";
        header("Location: adm.php?excluir=true&msg=" . urlencode($msg));
        exit();
    } else {
        $msg = "Erro ao excluir a categoria. Verifique o log de erros para mais informações.";
        error_log("Erro ao excluir categoria no banco de dados.");
    }
}

$categorias = obter_categorias($pdo);

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
        <div id="conteudo" class="container">
            <div class="forms">
                <h3>Cadastrar Categoria</h3>
                <?php
                // Exibe a mensagem de sucesso se houver
                if (!empty($msg)) {
                    echo '<div class="alert alert-success">' . $msg . '</div>';
                }
                ?>


                <form action="adm.php" method="POST">
                    <div class="mb-3 input-group">
                        <label for="nome_categoria" class="form-label">Nome da Categoria:</label>
                        <input type="text" id="nome_categoria" name="nome_categoria" class="form-control"
                            placeholder="Digite o nome da categoria" autocomplete="off" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Adicionar Categoria</button>
                    <button type="button" id="btnMostrarCategorias" class="btn btn-primary"
                        onclick="toggleCategorias()">Mostrar Categorias Cadastradas</button>
                </form>
            </div>

            <div id="listaCategorias" class="forms" style="display: none;">
                <h3>Lista de Categorias</h3>
                <ul class="list-group">
                    <?php foreach ($categorias as $categoria): ?>
                        <li class='list-group-item d-flex justify-content-between align-items-center'>
                            <?= $categoria['nome'] ?>
                            <a href="excluir_categoria.php?id=<?= $categoria['id']; ?>" class="btn btn-danger">Excluir</a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <a href="index.php" class="btn btn-secondary">Voltar</a>

        </div>

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