<?php
require_once("./includes/components/autenticacao.php");
require_once("./includes/components/conecta.php");
require_once("./includes/components/funcao.php");

$userId = $_SESSION["codpessoa"];
$consulta = $pdo->prepare('SELECT * FROM pessoa WHERE codpessoa = ?');
$consulta->execute([$userId]);
$usuario = $consulta->fetch();

$historias = obter_historias($pdo);

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <?php
    require_once("./includes/components/cabecalho.php");
    ?>
</head>



<body>
    <header>
        <?php
        require_once("./includes/components/header2.php");
        ?>

    </header>
    <main>


        <div class="container">
            <section class="cards">
                <?php foreach ($historias as $historia): ?>
                    <article class="card">
                        <?php if (isset($_SESSION["adm"]) && $_SESSION["adm"] == 1): ?>
                            <div class="text-center">
                                <a href="editar_historia.php?id=<?= $historia['id']; ?>" class="btn"><img width="24" height="24"
                                        src="https://img.icons8.com/dusk/64/000000/edit--v1.png" alt="edit--v1" /></a>
                                <a href="excluir_historia.php?id=<?= $historia['id']; ?>" class="btn"><img width="30"
                                        height="30" src="https://img.icons8.com/plasticine/30/000000/filled-trash.png"
                                        alt="filled-trash" /></a>
                            </div>
                        <?php endif; ?>
                        <?php if (isset($historia['relato'])): ?>
                            <p>
                                <?= $historia['relato']; ?>
                            </p>

                        <?php else: ?>
                            <p>Conteúdo não disponível</p>
                        <?php endif; ?>
                    </article>
                <?php endforeach; ?>
            </section>
        </div>


    </main>
    <?php
    require_once("./includes/components/footer.php");
    ?>


</body>
<?php
require_once("./includes/components/js2.php");
require_once("./includes/components/js.php");

?>

</html>