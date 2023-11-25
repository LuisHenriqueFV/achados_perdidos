<?php
require("./includes/components/conecta.php");
require("./includes/components/cabecalho.php");

$email = $_GET['email'];
$codigo = $_GET['codigo'];

$verificacaoCorreta = verificaCodigo($email, $codigo, $pdo);

if ($verificacaoCorreta) {
    $pdo->prepare("UPDATE pessoa SET verificado = 1 WHERE email = :email")->execute(['email' => $email]);

    echo "Seu e-mail foi verificado com sucesso. Agora você pode fazer login!";
}else{
    echo "Código de verificação incorreto. Tente novamente.";
}

function verificaCodigo($email, $codigo, $pdo) {
    $stmt = $pdo->prepare("SELECT * FROM pessoa WHERE email = :email AND codigo_verificacao = :codigo");
    $stmt->execute(['email' => $email, 'codigo' => $codigo]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    return ($usuario !== false);
}
?>

<body>
    <button onclick="window.location.href='login.php'">Ir para a página de login</button>
</body>

</html>
