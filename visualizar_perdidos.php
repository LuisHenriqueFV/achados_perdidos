<?php
require("./includes/components/cabecalho.php");
require("./includes/components/funcao.php");
require("./includes/components/conecta.php");

if (isset($_GET['pesquisar'])) {
    $nome = $_GET['pesquisar'];
    $objetosPerdidos = pesquisa_objeto_perdido($nome, $pdo);
} else {
    $objetosPerdidos = obter_objetos_perdidos($pdo);
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<body>
    <main class="container">
        <div class="forms">
            <form action="visualizar_perdidos.php" method="GET">
                <div class="mb-3 input-group">
                    <input type="text" name="pesquisar" class="form-control" placeholder="Pesquisar objeto perdido" autocomplete="off" required>
                    <button id="search" class="btn btn-primary" type="submit">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                        </svg>
                    </button>
                </div>
            </form>
        </div>

        <div class="conteudo">
            <?php
            if (isset($objetosPerdidos)) {
                if ($objetosPerdidos === null) {
                    echo "Nenhum resultado encontrado.";
                } else {
            ?>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Imagem</th>
                                <th>Nome</th>
                                <th>Descrição</th>
                                <th>Local</th>
                                <th>Data</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($objetosPerdidos as $objeto) { ?>
                                <tr class='linha'>
                                    <td>
                                        <?php if (!empty($objeto['imagem'])): ?>
                                            <img src="./uploads/<?php echo $objeto['imagem']; ?>" alt="Imagem do objeto" style="max-width: 40px;">
                                        <?php else: ?>
                                            <img src="caminho/para/imagem-padrao.jpg" alt="Imagem padrão" style="max-width: 40px;">
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo ($objeto['nome']) ?></td>
                                    <td><?php echo ($objeto['descricao']) ?></td>
                                    <td><?php echo ($objeto['local']) ?></td>
                                    <td><?php echo ($objeto['data']) ?></td>
                                    <td>
                <!-- Adicione o botão/link de exclusão -->
                <a href="excluir_objeto_perdido.php?id=<?php echo $objeto['id']; ?>" class="btn btn-danger">Excluir</a>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-eEJrOIVZdXl1rIb1TPOOwpv6+X1/QAqLwdDD1lp56Pv0B/Dm5fAKUKtk8WYquENe" crossorigin="anonymous"></script>
</body>

</html>
