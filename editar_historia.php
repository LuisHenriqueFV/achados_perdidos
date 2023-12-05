<?php
require_once("./includes/components/autenticacao.php");
require_once("./includes/components/conecta.php");
require_once("./includes/components/funcao.php");
require_once("./includes/components/cabecalho.php");

$userId = $_SESSION["codpessoa"];
$consulta = $pdo->prepare('SELECT * FROM pessoa WHERE codpessoa = ?');
$consulta->execute([$userId]);
$usuario = $consulta->fetch();

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $relato_id = $_GET['id'];
    $historias = obter_historias($pdo);

    $relato = array_filter($historias, function ($historia) use ($relato_id) {
        return $historia['id'] == $relato_id;
    });

    if (!empty($relato)) {
        $relato = reset($relato);
        $conteudo = isset($relato['relato']) ? $relato['relato'] : '';
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <link href="css/style2.css" rel="stylesheet">
</head>

<body>

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


</body>

</html>