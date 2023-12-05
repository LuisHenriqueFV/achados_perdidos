<?php
require("./includes/components/conecta.php");
require("./includes/components/cabecalho.php");
require("./includes/components/funcao.php");

$email = $_GET['email'];
$codigo = $_GET['codigo'];

$verificacaoCorreta = verificaCodigo($email, $codigo, $pdo);

if ($verificacaoCorreta) {
    $pdo->prepare("UPDATE pessoa SET verificado = 1 WHERE email = :email")->execute(['email' => $email]);

    echo "Seu e-mail foi verificado com sucesso. Agora você pode fazer login!";
}else{  
    echo "Código de verificação incorreto. Tente novamente.";
}


?>

<body>
    <button onclick="window.location.href='login.php'">Ir para a página de login</button>
</body>

</html>
