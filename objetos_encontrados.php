<?php
$msg = "";

require("./includes/components/autenticacao.php");
require("./includes/components/cabecalho.php");
require("./includes/components/funcao.php");
require("./includes/components/conecta.php");

$userId = $_SESSION["codpessoa"];

$consulta = $pdo->prepare('SELECT * FROM pessoa WHERE codpessoa = ?');
$consulta->execute([$userId]);
$usuario = $consulta->fetch();



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $local = $_POST['local'];
    $data = $_POST['data'];
    $categoria = $_POST['categoria'];

    // Verifica se uma imagem foi enviada
    if (!empty($_FILES['imagem']['name'])) {
        $uploadDir = "img/objetos_encontrados/";

        // Obtém a extensão do arquivo
        $extensao = strtolower(pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION));

        // Gera um nome único para o arquivo
        $nomeArquivo = uniqid('imagem_') . '.' . $extensao;

        $uploadFile = $uploadDir . $nomeArquivo;

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        // Move o arquivo para o diretório de upload
        if (move_uploaded_file($_FILES['imagem']['tmp_name'], $uploadFile)) {
            $imagem = $uploadDir . $nomeArquivo;

            // Insere o caminho da imagem no banco de dados
            cadastra_objeto_encontrado($nome, $descricao, $local, $data, $categoria, $imagem, $codpessoa, $pdo);

            $msg = "Objeto cadastrado com sucesso!";
        } else {
            $msg = "Erro no upload da imagem. Verifique o log de erros para mais informações.";
            error_log("Erro no upload da imagem: " . $_FILES['imagem']['error']);
        }
    } else {
        $msg = "Por favor, selecione uma imagem.";
    }
}

$categorias = obter_categorias($pdo);
?>

<body>
    <main class="container">

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
                                <a class="nav-link" href="visualizar_perdidos.php">Comunidade</a>
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

        <div class="forms">
            <form action="objetos_encontrados.php" method="POST" enctype="multipart/form-data">
                <div class="inputs-forms">
                    <input type="text" id="nome" name="nome" class="form-control"
                        placeholder="Nome do objeto encontrado" autocomplete="off" required>
                    <input type="text" id="descricao" name="descricao" class="form-control"
                        placeholder="Descrição do objeto encontrado" autocomplete="off" required>
                    <input type="text" id="local" name="local" class="form-control"
                        placeholder="Local onde foi encontrado" autocomplete="off" required>
                    <input type="date" id="data" name="data" class="form-control" required>
                    <label for="imagem">Imagem:</label>
                    <input type="file" id="imagem" name="imagem" class="form-control">

                    <!-- Menu suspenso para selecionar a categoria -->
                    <label for="categoria">Categoria:</label>
                    <select id="categoria" name="categoria" class="form-select" required>
                        <option value="" disabled selected>Selecione uma categoria</option>
                        <?php
                        foreach ($categorias as $cat) {
                            echo '<option value="' . $cat['nome'] . '">' . $cat['nome'] . '</option>';
                        }
                        ?>
                    </select>
                </div>

                <div class="nav">
                    <button type="submit" class="btn btn-primary">Cadastrar Objeto Encontrado</button>
                    <a href="index.php" class="btn btn-secondary">Voltar</a>
                </div>
            </form>
        </div>

        <div class="conteudo">
            <p>
                <?php
                echo $msg;
                ?>
            </p>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-eEJrOIVZdXl1rIb1TPOOwpv6+X1/QAqLwdDD1lp56Pv0B/Dm5fAKUKtk8WYquENe"
        crossorigin="anonymous"></script>
</body>

</html>
