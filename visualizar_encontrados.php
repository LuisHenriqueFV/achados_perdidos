<?php
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

<!DOCTYPE html>
<html lang="pt-br">

<body>
    <main class="container">
        <div class="forms">
            <form action="visualizar_encontrados.php" method="GET">
                <div class="mb-3 input-group">
                    <input type="text" name="pesquisar" class="form-control" placeholder="Pesquisar objeto encontrado"
                        autocomplete="off">

                    <button class="btn btn-primary" type="submit" name="filtrarCategoria">
                        Pesquisar
                    </button>
                </div>
            </form>

            <form action="visualizar_encontrados.php" method="GET">
                <div class="mb-3 input-group">
                    <select name="categoria" class="form-select">
                        <option value="MostrarTodos" <?php echo $categoria === 'MostrarTodos' ? 'selected' : ''; ?>>
                            Mostrar Todos os Objetos
                        </option>

                        <?php
                        foreach ($categorias as $cat) {
                            $selected = ($categoria === $cat['nome']) ? 'selected' : '';
                            echo "<option value='" . htmlspecialchars($cat['nome'], ENT_QUOTES) . "' $selected>" . htmlspecialchars($cat['nome'], ENT_QUOTES) . "</option>";
                        }
                        ?>
                    </select>

                    <button class="btn btn-secondary" type="submit" name="filtrarCategoria">
                        Filtrar por Categoria
                    </button>
                </div>
            </form>
        </div>

        <div class="conteudo">
            <?php
            if ($objetosEncontrados) {
                if (empty($objetosEncontrados)) {
                    echo "Nenhum resultado encontrado.";
                } else {
                    ?>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Descrição</th>
                                <th>Local</th>
                                <th>Data</th>
                                <th>Categoria</th>
                                <th>Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($objetosEncontrados as $objeto) { ?>
                                <tr class='linha'>
                                    <td>
                                        <?php echo htmlspecialchars($objeto['nome'], ENT_QUOTES) ?>
                                    </td>
                                    <td>
                                        <?php echo htmlspecialchars($objeto['descricao'], ENT_QUOTES) ?>
                                    </td>
                                    <td>
                                        <?php echo htmlspecialchars($objeto['local'], ENT_QUOTES) ?>
                                    </td>
                                    <td>
                                        <?php echo htmlspecialchars($objeto['data'], ENT_QUOTES) ?>
                                    </td>
                                    <td>
                                        <?php echo htmlspecialchars($objeto['categoria'], ENT_QUOTES) ?>
                                    </td>
                                    <td>
                                        <a href="excluir_objeto_encontrado.php?id=<?php echo $objeto['id']; ?>"
                                            class="btn btn-danger">Excluir</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <?php
                }
            } else {
                echo htmlspecialchars($msg, ENT_QUOTES);
            }
            ?>
        </div>

        <a href="index.php" class="btn btn-secondary">Voltar</a>
    </main>
</body>

</html>
