<?php
require("./includes/components/conecta.php");
require "./includes/components/PHPMailer/src/PHPMailer.php";
require "./includes/components/PHPMailer/src/Exception.php";
require "./includes/components/PHPMailer/src/SMTP.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$msg = "";
$aviso ="";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $email = filter_var($_POST["email"], FILTER_VALIDATE_EMAIL);
    $senha = $_POST["senha"];

    if ($email === false) {
        $aviso = "E-mail inválido. Por favor, insira um e-mail válido. <hr>";

    }

    if (strlen($senha) < 8) {
        $aviso = "A senha deve ter pelo menos 8 caracteres.";
    } else {
        try {
            $verificaEmail = $pdo->prepare("SELECT COUNT(*) FROM pessoa WHERE email = ?");
            $verificaEmail->execute([$email]);
            $emailExistente = (int) $verificaEmail->fetchColumn();

            if ($emailExistente > 0) {
                $aviso = "O e-mail já está registrado. Por favor, use outro e-mail.";
            } else {
                $codigoVerificacao = bin2hex(random_bytes(16));
                $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
                $imagemPadrao = "../img/perfil_padrao.png";

                $sql = "INSERT INTO pessoa (nome, email, senha, codigo_verificacao, imagem) VALUES (?, ?, ?, ?, ?)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$nome, $email, $senhaHash, $codigoVerificacao, $imagemPadrao]);

                $mail = new PHPMailer(true);

                try {
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'luishenriquefonsecaphp@gmail.com';
                    $mail->Password = 'hdtm huzb bjsy haif';
                    $mail->Port = 587;

                    $mail->setFrom('seu_email@gmail.com', 'Seu Nome');
                    $mail->addAddress($email);
                    $mail->Subject = 'Verificar E-mail Registrado na plataforma Achados & Perdidos';

                    $linkVerificacao = "https://henriquefonsecaachadoseperdidos.000webhostapp.com/achados_perdidos/login.php?email=$email&codigo=$codigoVerificacao";
                    $mail->Body = "Clique no link para verificar seu e-mail: $linkVerificacao";

                    $mail->send();

                    $msg = "Cadastrado! Verifique seu e-mail para continuar.";

                } catch (Exception $e) {
                    $aviso = "Erro ao enviar o e-mail";
                }
            }
        } catch (PDOException $e) {
            $aviso = "Erro no registro: " . $e->getMessage();
        }
    }


}
require("./includes/components/cabecalho.php");

?>

<body>
    <main>
        <div id="conteudoRegistro" class="container justfy-content-center">
            <h2>Registro</h2>
            <form action="registro.php" method="POST">

                <?php
                if (!empty($msg)) {
                    echo '<div class="alert alert-success">' . $msg . '</div>';
                }
                if (!empty($aviso)) {
                    echo '<div class="alert alert-warning">' . $aviso . '</div>';
                }

                ?>

                <div class="mb-3">
                    <label for="nome" class="form-label">Nome de Usuário:</label>
                    <input type="text" class="form-control" id="nome" name="nome" required>
                    <hr>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">E-mail:</label>
                    <input type="email" class="form-control" id="email" name="email"placeholder="exemplo@gmail.com"
                        pattern="[a-zA-Z0-9._%+-]+@gmail\.com$" required>
                    <hr>
                </div>

                <div class="mb-3">
                    <label for="senha" class="form-label">Senha:</label>
                    <input type="password" class="form-control" id="senha" name="senha" placeholder="Senha de 8 caracteres ou mais" required minlength="8">
                    <hr>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-custom-color">Registrar</button>
                    <a class="btn btn-secondary" href="login.php" role="button">Voltar</a>
                </div>
            </form>



        </div>


    </main>
</body>

</html>