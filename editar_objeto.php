<?php
require_once("./includes/components/autenticacao.php");
require_once("./includes/components/conecta.php");
require_once("./includes/components/funcao.php");
require_once("./includes/components/header.php");
// require_once("./includes/components/js.php");

//se esta pagina parar de funcionar, exclua o header (até o require)

$objetoId = isset($_GET['id']) ? $_GET['id'] : "";

if (!$objetoId) {
    echo "ID do objeto não fornecido.";
    exit();
}

$objeto = obter_objeto_por_id($objetoId, $pdo);

if (!$objeto) {
    echo "Objeto não encontrado.";
    exit();
}

if ($objeto['codpessoa'] != $_SESSION["codpessoa"] && !$_SESSION["adm"]) {
    echo "Você não tem permissão para editar este objeto.";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $novoNome = $_POST['nome'];
    $novaDescricao = $_POST['descricao'];
    $novoLocal = $_POST['local'];
    $novaData = $_POST['data'];
    $novaCategoria = $_POST['categoria'];
    $novoTipo = $_POST['tipo'];

    if ($_FILES['imagem']['error'] === 0) {
        $nomeArquivo = $_FILES['imagem']['name'];
        $caminhoArquivo = 'uploads/' . $nomeArquivo;
        move_uploaded_file($_FILES['imagem']['tmp_name'], $caminhoArquivo);
    } else {
        $caminhoArquivo = $objeto['imagem'];
    }

    atualizar_objeto($objetoId, $novoNome, $novaDescricao, $novoLocal, $novaData, $caminhoArquivo, $novaCategoria, $pdo);

    header("Location: index.php");
    exit();
}

$categorias = obter_categorias($pdo);
$tipos = array("Encontrado", "Perdido");


require_once("./includes/components/cabecalho.php");

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

        <div id="conteudoCadastro" class="container">


            <h1>Editar Objeto</h1>
            <form action="editar_objeto.php?id=<?= $objetoId ?>" method="POST" enctype="multipart/form-data">
                <select id="tipo" name="tipo" class="form-select" required>
                    <option value="" disabled selected>Tipo</option>
                    <?php
                    foreach ($tipos as $tipo_option) {
                        echo '<option value="' . $tipo_option . '">' . $tipo_option . '</option>';
                    }
                    ?>
                </select>
                <div class="mb-3">
                    <label for="nome" class="form-label">Nome:</label>
                    <input type="text" class="form-control" id="nome" name="nome"
                        value="<?= htmlspecialchars($objeto['nome'], ENT_QUOTES) ?>" required>
                </div>
                <div class="mb-3">
                    <label for="descricao" class="form-label">Descrição:</label>
                    <textarea class="form-control" id="descricao" name="descricao"
                        required><?= htmlspecialchars($objeto['descricao'], ENT_QUOTES) ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="local" class="form-label">Local:</label>
                    <input type="text" class="form-control" id="local" name="local"
                        value="<?= htmlspecialchars($objeto['local'], ENT_QUOTES) ?>" required>
                </div>
                <div class="mb-3">
                    <label for="data" class="form-label">Data:</label>
                    <input type="date" class="form-control" id="data" name="data"
                        value="<?= htmlspecialchars($objeto['data'], ENT_QUOTES) ?>" required>
                </div>
                <div class="mb-3">
                    <label for="imagem" class="form-label">Imagem:</label>
                    <input type="file" class="form-control" id="imagem" name="imagem">
                </div>
                <select id="categoria" name="categoria" class="form-select" required>
                    <option value="" disabled selected>Categoria</option>
                    <?php
                    foreach ($categorias as $cat) {
                        echo '<option value="' . htmlspecialchars($cat['nome'], ENT_QUOTES) . '">' . htmlspecialchars($cat['nome'], ENT_QUOTES) . '</option>';
                    }
                    ?>
                </select>
                <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                <a href="index.php" class="btn btn-secondary">Voltar</a>
            </form>
        </div>
    </main>
       <!-- RODAPE -->
       <footer class="py-5 bg-footer-custom">
        <div class="row justify-content-center">
            <div class="col-6 col-md-2 mb-2">
                <h5>Sobre Nós</h5>
                <ul class="nav flex-column">
                    <li class="nav-item mb-2"><a href="sobre_nos.php" class="nav-link p-0 text-body-secondary">Sobre Nós</a></li>
                    <li class="nav-item mb-2"><a href="como_funciona.php" class="nav-link p-0 text-body-secondary">Como Funciona?</a></li>
                    <li class="nav-item mb-2"><a href="comunidade.php" class="nav-link p-0 text-body-secondary">Comunidade</a></li>
                </ul>
            </div>

            <div class="col-6 col-md-2 mb-2">
                <h5>Contato</h5>
                <ul class="nav flex-column">
                    <li class="nav-item mb-2"><a href="contato.php" class="nav-link p-0 text-body-secondary">Informações</a></li>
                </ul>
            </div>

        


        </div>

    </footer>
    <!-- FIM DO RODAPÉ -->

</body>

</html>