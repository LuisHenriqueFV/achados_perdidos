<?php
require("./includes/components/autenticacao.php");
require("./includes/components/cabecalho.php");
require("./includes/components/funcao.php");
require("./includes/components/conecta.php");

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
    <main class="container">
        <div class="forms">
            <form action="visualizar_perdidos.php" method="GET">
                <div class="mb-3 input-group">
                    <input type="text" name="pesquisar" class="form-control" placeholder="Pesquisar objeto Perdido" autocomplete="off">
                    <button class="btn btn-primary" type="submit" name="filtrarCategoria">Pesquisar</button>
                </div>
            </form>

            <form action="visualizar_perdidos.php" method="GET">
                <div class="mb-3 input-group">
                    <select name="categoria" class="form-select">
                        <option value="MostrarTodos" <?= $categoria === 'MostrarTodos' ? 'selected' : ''; ?>>Mostrar Todos os Objetos</option>
                        <?php foreach ($categorias as $cat) : ?>
                            <option value="<?= htmlspecialchars($cat['nome'], ENT_QUOTES) ?>" <?= $categoria === $cat['nome'] ? 'selected' : ''; ?>>
                                <?= htmlspecialchars($cat['nome'], ENT_QUOTES) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <button class="btn btn-secondary" type="submit" name="filtrarCategoria">Filtrar por Categoria</button>
                </div>
            </form>
        </div>

        <div class="conteudo">
            <?php if ($objetosPerdidos) : ?>
                <?php if (empty($objetosPerdidos)) : ?>
                    <p>Nenhum resultado Perdido.</p>
                <?php else : ?>
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
                            <?php foreach ($objetosPerdidos as $objeto) : ?>
                                <tr class='linha'>
                                    <td><?= htmlspecialchars($objeto['nome'], ENT_QUOTES) ?></td>
                                    <td><?= htmlspecialchars($objeto['descricao'], ENT_QUOTES) ?></td>
                                    <td><?= htmlspecialchars($objeto['local'], ENT_QUOTES) ?></td>
                                    <td><?= htmlspecialchars($objeto['data'], ENT_QUOTES) ?></td>
                                    <td><?= htmlspecialchars($objeto['categoria'], ENT_QUOTES) ?></td>
                                    <td>
                                        <?php if (!empty($objeto['imagem'])) : ?>
                                            <img src="<?= htmlspecialchars($objeto['imagem'], ENT_QUOTES) ?>" alt="Imagem do Objeto" style="max-width: 100px;">
                                        <?php else : ?>
                                            <img src="img/objetos_perdidos/sem_imagem.png" alt="Sem Imagem" style="max-width: 100px;">
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if (isset($_SESSION["codpessoa"]) && $objeto['codpessoa'] == $_SESSION["codpessoa"]) : ?>
                                            <a href="editar_objeto_Perdido.php?id=<?= $objeto['id'] ?>" class="btn btn-primary">Editar</a>
                                            <a href="excluir_objeto_Perdido.php?id=<?= $objeto['id'] ?>" class="btn btn-danger">Excluir</a>
                                        <?php else : ?>
                                            <p>Usuário logado não é o criador do objeto.</p>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            <?php else : ?>
                <p><?= htmlspecialchars($msg, ENT_QUOTES) ?></p>
            <?php endif; ?>
        </div>

        <a href="index.php" class="btn btn-secondary">Voltar</a>
    </main>
</body>

</html>
