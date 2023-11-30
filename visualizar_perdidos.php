<?php

require_once("./includes/components/autenticacao.php");
require_once("./includes/components/conecta.php");
require_once("./includes/components/funcao.php");
require_once("./includes/components/cabecalho.php");
require_once("./includes/components/header.php");
require_once("./includes/components/js.php");

$msg = "";
$objetosPerdidos = null;

$categorias = obter_categorias($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $categoria = isset($_GET['categoria']) ? $_GET['categoria'] : "";
    $nome = isset($_GET['pesquisar']) ? $_GET['pesquisar'] : "";

    if ($categoria === "MostrarTodos") {
        $objetosPerdidos = pesquisa_objeto_perdido($nome, null, $pdo);
    } else {
        $objetosPerdidos = pesquisa_objeto_perdido($nome, $categoria, $pdo);
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
                <form action="visualizar_perdidos.php" method="GET">
                    <div class="mb-3 input-group">
                        <input type="text" name="pesquisar" class="form-control" placeholder="Pesquisar objeto perdido"
                            autocomplete="off">
                        <button class="btn btn-primary" type="submit" name="filtrarCategoria">Pesquisar</button>
                    </div>
                </form>

                <form action="visualizar_perdidos.php" method="GET">
                    <div class="mb-3 input-group">
                        <select name="categoria" class="form-select">
                            <option value="MostrarTodos" <?= $categoria === 'MostrarTodos' ? 'selected' : ''; ?>>Mostrar
                                Todos
                                os Objetos</option>
                            <?php foreach ($categorias as $cat): ?>
                                <option value="<?= htmlspecialchars($cat['nome'], ENT_QUOTES) ?>"
                                    <?= $categoria === $cat['nome'] ? 'selected' : ''; ?>>
                                    <?= htmlspecialchars($cat['nome'], ENT_QUOTES) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <button class="btn btn-secondary" type="submit" name="filtrarCategoria">Filtrar por
                            Categoria</button>
                    </div>
                </form>
            </div>

            <div class="conteudo">
                <?php if ($objetosPerdidos): ?>
                    <?php if (empty($objetosPerdidos)): ?>
                        <p>Nenhum resultado encontrado.</p>
                    <?php else: ?>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Descrição</th>
                                    <th>Local</th>
                                    <th>Data</th>
                                    <th>Categoria</th>
                                    <th>Imagem</th>
                                    <th>Ação</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($objetosPerdidos as $objeto): ?>
                                    <tr class='linha'>
                                        <td>
                                            <?= htmlspecialchars($objeto['nome'], ENT_QUOTES) ?>
                                        </td>
                                        <td>
                                            <?= htmlspecialchars($objeto['descricao'], ENT_QUOTES) ?>
                                        </td>
                                        <td>
                                            <?= htmlspecialchars($objeto['local'], ENT_QUOTES) ?>
                                        </td>
                                        <td>
                                            <?= htmlspecialchars($objeto['data'], ENT_QUOTES) ?>
                                        </td>
                                        <td>
                                            <?= htmlspecialchars($objeto['categoria'], ENT_QUOTES) ?>
                                        </td>
                                        <td>
                                            <?php if (!empty($objeto['imagem'])): ?>
                                                <img src="<?= htmlspecialchars($objeto['imagem'], ENT_QUOTES) ?>" alt="Imagem do Objeto"
                                                    style="max-width: 100px;">
                                            <?php else: ?>
                                                <img src="img/objetos_perdidos/sem_imagem.png" alt="Sem Imagem"
                                                    style="max-width: 100px;">
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if (isset($_SESSION["codpessoa"]) && ($_SESSION["adm"] == 1 || $objeto['codpessoa'] == $_SESSION["codpessoa"])): ?>
                                                <a href="editar_objeto_perdido.php?id=<?= $objeto['id'] ?>"
                                                    class="btn btn-primary">Editar</a>
                                                <a href="excluir_objeto_perdido.php?id=<?= $objeto['id'] ?>"
                                                    class="btn btn-danger">Excluir</a>
                                            <?php endif; ?>

                                        </td>

                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php endif; ?>
                <?php else: ?>
                    <p>
                        <?= htmlspecialchars($msg, ENT_QUOTES) ?>
                    </p>
                <?php endif; ?>
            </div>

            <a href="index.php" class="btn btn-secondary">Voltar</a>
        </div>


    </main>
</body>

</html>