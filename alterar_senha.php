<?php

session_start();

if (!isset($_SESSION["logged"]) || $_SESSION["logged"] !== true) {
    header("Location: login.php");
    exit;
}
require("./includes/components/cabecalho.php");
require("./includes/components/conecta.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $novaSenha = $_POST["novaSenha"];
    $userId = $_SESSION["codpessoa"];

    $senhaCriptografada = password_hash($novaSenha, PASSWORD_DEFAULT);

    $atualizarSenha = $pdo->prepare('UPDATE pessoa SET senha = ? WHERE codpessoa = ?');
    $atualizarSenha->execute([$senhaCriptografada, $userId]);

    echo "Senha alterada com sucesso!";
}
?>


<body>
  <main class="container">
    <div class="forms">
        <h1>Alterar Senha</h1>
        <form action="alterar_senha.php" method="POST">
            <div class="mb-3">
                <label for="novaSenha" class="form-label">Nova Senha:</label>
                <input type="password" id="novaSenha" name="novaSenha" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary" id="alterarSenha" name="alterarSenha" value="alterarSenha">Alterar Senha</button>
        </form>

        <a href="perfil_usuario.php" class="btn btn-secondary">Voltar</a>
        
    </div>
</main>
<?php
    require_once("./includes/components/footer.php");
    ?>

</body>
</html>
