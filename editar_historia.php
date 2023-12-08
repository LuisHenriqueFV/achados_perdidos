<?php
require_once("./includes/components/autenticacao.php");
require_once("./includes/components/conecta.php");
require_once("./includes/components/funcao.php");

$userId = $_SESSION["codpessoa"];
$consulta = $pdo->prepare('SELECT * FROM pessoa WHERE codpessoa = ?');
$consulta->execute([$userId]);
$usuario = $consulta->fetch();

$relato = null;
$conteudo = '';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $relato_id = $_GET['id'];
    $historias = obter_historias($pdo);

    $relato = array_filter($historias, function ($historia) use ($relato_id) {
        return $historia['id'] == $relato_id;
    });

    if (!empty($relato)) {
        $relato = reset($relato);
        $conteudo = $relato['relato'];
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['relato_id'])) {
    $relato_id = $_POST['relato_id'];
    $novo_relato = $_POST['novo_relato'];

    $atualizacaoSucesso = atualiza_historia($relato_id, $novo_relato, $pdo);

    if ($atualizacaoSucesso) {
        header("Location: historias.php");
        exit;
    } else {
        echo "Falha ao atualizar a história.";
    }
}
require_once("./includes/components/cabecalho.php");

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
        <?php if (!empty($relato)) { ?>
            <div class="form-container">
                <form action="editar_historia.php" method="POST">
                    <input type="hidden" name="relato_id" value="<?= $relato['id'] ?>">
                    <textarea name="novo_relato"><?= $conteudo ?></textarea>
                    <button class="btn custom-color" type="submit">Salvar</button>
                    <hr>
                    <a class="btn btn-secondary" href="historias.php" role="button">Voltar</a>
                </form>
            </div>
        <?php } else {
            echo "Relato não encontrado.";
        } ?>
    </main>
    <?php
    require_once("./includes/components/footer.php");
    require_once("./includes/components/js2.php");
    require_once("./includes/components/js.php");
    ?>
</body>

</html>