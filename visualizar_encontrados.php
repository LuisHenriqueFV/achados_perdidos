<?php
require("./includes/components/autenticacao.php");
require("./includes/components/cabecalho.php");
require("./includes/components/funcao.php");
require("./includes/components/conecta.php");

$msg = "";
$objetosEncontrados = null;

$categorias = obter_categorias($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $categoria = isset($_GET['categoria']) ? $_GET['categoria'] : "";
    $nome = isset($_GET['pesquisar']) ? $_GET['pesquisar'] : "";

    if ($categoria === "MostrarTodos") {
        $objetosEncontrados = pesquisa_objeto_encontrado($nome, null, $pdo);
    } else {
        $objetosEncontrados = pesquisa_objeto_encontrado($nome, $categoria, $pdo);
    }
}
?>

<body>
    <main class="container">
        <div class="forms">
            <form action="visualizar_encontrados.php" method="GET">
                <div class="mb-3 input-group">
                    <input type="text" name="pesquisar" class="form-control" placeholder="Pesquisar objeto encontrado" autocomplete="off">
                    <button class="btn btn-primary" type="submit" name="filtrarCategoria">Pesquisar</button>
                </div>
            </form>

            <form action="visualizar_encontrados.php" method="GET">
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
            <?php if ($objetosEncontrados) : ?>
                <?php if (empty($objetosEncontrados)) : ?>
                    <p>Nenhum resultado encontrado.</p>
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
                             <?php foreach ($objetosEncontrados as $objeto) : ?>
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
                                            <img src="img/objetos_encontrados/sem_imagem.png" alt="Sem Imagem" style="max-width: 100px;">
                                        <?php endif; ?>
                                    </td>
                                       <?php
                // Verifica se o usuário logado é o criador da publicação
               if (isset($_SESSION["codpessoa"])) {
        if ($objeto['codpessoa'] == $_SESSION["codpessoa"]) {
                    // Exibe botões apenas se o usuário for o criador
                    echo '<a href="editar_objeto_encontrado.php?id=' . $objeto['id'] . '" class="btn btn-primary">Editar</a>';
            echo ' <a href="excluir_objeto_encontrado.php?id=' . $objeto['id'] . '" class="btn btn-danger">Excluir</a>';
                }
               }
                ?>
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
