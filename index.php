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

        <div class="containerTUDO">


            <div class="container">
                <div class="row col 12">
                    <a class="btn btn-custom-color" href="objeto.php"><img width="29" height="29"
                            src="img/icons8-add-100.png" alt="filled-trash" /></a>
                </div>
            </div>

            <form action="index.php" method="GET">
                <div id="filtro" class="container">

                    <div class="d-flex mb-2 justify-content-center">
                        <div class="px-1 col-lg-3">
                            <div class="input-group">
                                <input type="text" name="pesquisar" class="form-control" placeholder="Pesquisar objeto"
                                    autocomplete="off">
                            </div>
                        </div>
                        <div class="px-1 col-lg-3">
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
                        </div>

                        <div class="px-1 col-lg-3">

                            <select name="tipo" class="form-select">
                                <option value="" <?= $tipo === '' ? 'selected' : ''; ?>>Situação</option>
                                <option value="Encontrado" <?= $tipo === 'Encontrado' ? 'selected' : ''; ?>>Encontrado
                                </option>
                                <option value="Perdido" <?= $tipo === 'Perdido' ? 'selected' : ''; ?>>Perdido</option>


                            </select>

                        </div>
                        <button id="customButton" class="btn" type="submit" name="filtrarCategoria"><img width="25"
                                height="25" src="https://img.icons8.com/color/48/search--v1.png" alt="search--v1" />

                        </button>
                        <!-- <div class="row col-lg-12">

                    </div> -->

            </form>


        </div>
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
                                        <div class="card" style="max-width: 600px; height: auto;   ;">
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

        <br><br><br><br><br><br><br><br><br><br>


        <!-- FIM DO CONTEUDO -->





        </div>
        <!-- INICIO DO CONTEUDO -->





    </main>

    <!-- ---------------------------------------------------------------------- -->

    <!-- RODAPE -->
    <footer id="footer">

        <div class="container">
            <div class="h1" id="achados_perdidos">
                <h1>Achados&Perdidos</h1>

            </div>
            <div style="display: flex; align-items: center;">
                <img class="icon" src="img/icons8-phone-48.png"
                    style="width: 25px; height: 25px;  margin-bottom:17px; padding-right: 5px;" alt="icon">
                <p>+55 5398405-5364</p>
            </div>
            <div style="display: flex; align-items: center;">
                <img class="icon" src="img/icons8-gmail-50.png"
                    style="width: 25px; height: 25px; margin-bottom:19px; padding-right: 5px;" alt="icon">
                <p>luishenriquefonsecaphp@gmail.com</p>
            </div>
            <div style="display: flex; align-items: center;">
                <img class="icon" src="img/icons8-location-60.png"
                    style="width: 25px; height: 25px; margin-bottom:19px; padding-right: 5px;" alt="icon">
                <p>Pelotas, Rio Grande Do Sul</p>
            </div>
        </div>
    </footer>

    <!-- FIM DO RODAPÉ -->

    <!-- ---------------------------------------------------------------------- -->

</body>

</html>