<?php
require "./includes/components/conecta.php";
require "./includes/components/funcao.php";
require("./includes/components/cabecalho.php");


if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['utilizador']) && isset($_GET['confirmacao'])) {
    $user = $_GET['utilizador'];
    $hash = $_GET['confirmacao'];

    $recuperacao = buscaUtilizador($user, $hash, $pdo);

    if ($recuperacao) {
        ?>

        <?php
    }
} else {
    echo '<p>Não é possível alterar a senha: dados em falta</p>';
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redefinir Senha</title>
</head>

<body>
    <main>
        <div id="conteudoPerfil" class="container">
            <h1>Redefinir Senha</h1>
            <form method="post" action="redefinir_senha_processa.php">
                <input type="hidden" name="utilizador" value="<?= htmlspecialchars($user) ?>">
                <input type="hidden" name="confirmacao" value="<?= htmlspecialchars($hash) ?>">
                <label for="novaSenha">Nova Senha:</label>
                <input type="password" name="novaSenha" required minlength="8" />
                <hr>
                <button type="submit" class="btn btn-custom-color">Alterar senha</button>
                <hr>
                <a class="btn btn-secondary" href="login.php" role="button">Voltar</a>


            </form>
        </div>
    </main>




    <footer id="footer">
        <div class="container">
            <div class="h1" id="achados_perdidos">
                <h1>Achei!</h1>

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



</body>

</html>