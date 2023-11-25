<?php
require("./includes/components/cabecalho.php");
require("./includes/components/funcao.php");
require("./includes/components/conecta.php");

if (isset($_GET['pesquisar'])) {
    $nome = $_GET['pesquisar'];
    $categoria = $_GET['categoria'];  // Certifique-se de ter a categoria se ela for obrigatória
    $objetosEncontrados = pesquisa_objeto_encontrado($nome, $categoria, $pdo);
} else {
    $objetosEncontrados = obter_objetos_encontrados($pdo);
}
// Buscar todas as categorias
$categorias = obter_categorias($pdo);
?>
<!DOCTYPE html>
<html lang="pt-br">

<body>
    <main class="container">
        <div class="forms">
            <form action="visualizar_encontrados.php" method="GET">
                <div class="mb-3 input-group">
                    <input type="text" name="pesquisar" class="form-control" placeholder="Pesquisar objeto encontrado"
                        autocomplete="off" required>

                    <select name="categoria" class="form-select">
                        <option value="">Todas as Categorias</option>
                        <?php
                        foreach ($categorias as $cat) {
                            echo "<option value='" . $cat['nome'] . "'>" . $cat['nome'] . "</option>";
                        }
                        ?>
                    </select>

                    <button id="search" class="btn btn-primary" type="submit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-search" viewBox="0 0 16 16">
                            <path
                                d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                        </svg>
                    </button>
                </div>
            </form>
        </div>

        <div class="conteudo">
            <?php
            if (isset($objetosEncontrados)) {
                if ($objetosEncontrados === null) {
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
                                        <?php echo ($objeto['nome']) ?>
                                    </td>
                                    <td>
                                        <?php echo ($objeto['descricao']) ?>
                                    </td>
                                    <td>
                                        <?php echo ($objeto['local']) ?>
                                    </td>
                                    <td>
                                        <?php echo ($objeto['data']) ?>
                                    </td>
                                    <td>
                                        <?php
                                        // Verifica se a categoria está definida antes de acessar a chave 'id_categoria'
                                        $categoriaId = isset($objeto['categoria']) ? $objeto['categoria'] : null;

                                        echo $categoriaId !== null ? $objeto['categoria'] : '';


                                        ?>
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
            }
            ?>
        </div>

        <a href="index.php" class="btn btn-secondary">Voltar</a>
    </main>

</body>

</html>