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
<html lang="pt-BR">

<head>
    <link href="css/style2.css" rel="stylesheet">
</head>

<body>

    <header>
        <button id="openMenu">&#9776;</button>
        <a href="index.php" id="logo">
            <img src="img/logo3.png" alt="achados&perdidos" />
        </a>



        <nav id="menu">

            <button id="closeMenu">X</button>

            <a href="index.php">Home</a>
            <a href="objeto.php">Formulário</a>
            <a href="informacao.php">Informacao</a>
            <a href="historias.php">Historias</a>
            <a href="contato.php">Contato</a>

            <?php
            $userId = $_SESSION["codpessoa"];
            $adm = verifica_administrador($userId, $pdo);




            if ($adm) {
                ?>

                <a href="adm.php">Adm</a>

                <?php
            }
            ?>
        </nav>

        <button id="themeToggle" class="btn btn-text-light"><img width="25" height="25"
                src="img/icons8-day-and-night-50.png" alt="day-and-night" /></button>
        <div class="perfil">

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
                    <li><a class="dropdown-item custom-color text-black" href="perfil_usuario.php">Perfil</a></li>
                    <li>
                    </li>
                    <li><a class="dropdown-item custom-color text-black" href="logout.php">Sair</a></li>
                </ul>
            </div>
        </div>


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
    ?>

    <?php
    require_once("./includes/components/js2.php");
    require_once("./includes/components/js.php");
    ?>
</body>

</html>