<?php
require("./includes/components/conecta.php");
require "./includes/components/PHPMailer/src/PHPMailer.php";
require "./includes/components/PHPMailer/src/Exception.php";
require "./includes/components/PHPMailer/src/SMTP.php";
require("./includes/components/cabecalho.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $senha = password_hash($_POST["senha"], PASSWORD_DEFAULT);

    try {
        $verificaEmail = $pdo->prepare("SELECT COUNT(*) FROM pessoa WHERE email = ?");
        $verificaEmail->execute([$email]);
        $emailExistente = (int) $verificaEmail->fetchColumn();

        if ($emailExistente > 0) {
            echo "O e-mail já está registrado. Por favor, use outro e-mail.";
        } else {
            $codigoVerificacao = bin2hex(random_bytes(16));

            $sql = "INSERT INTO pessoa (nome, email, senha, codigo_verificacao) VALUES (?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$nome, $email, $senha, $codigoVerificacao]);

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

                $linkVerificacao = "https://henriquefonsecaachadoseperdidos.000webhostapp.com/achados_perdidos/verificar.php?email=$email&codigo=$codigoVerificacao";
                $mail->Body = "Clique no link para verificar seu e-mail: $linkVerificacao";

                $mail->send();

                echo "Registro bem-sucedido! Um e-mail de verificação foi enviado para o seu endereço.";
            } catch (Exception $e) {
                echo "Erro ao enviar o e-mail de verificação: " . $mail->ErrorInfo;
            }
        }
    } catch (PDOException $e) {
        echo "Erro no registro: " . $e->getMessage();
    }
}
?>

<body>
    <main>
        <div id="conteudoRegistro" class="container justfy-content-center">

            <h2>Registro</h2>
            <form action="registro.php" method="POST">
                <div class="mb-3">
                    <label for="nome" class="form-label">Nome de Usuário:</label>
                    <input type="text" class="form-control" id="nome" name="nome" required>
                    <hr>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">E-mail:</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                    <hr>
                </div>

                <div class="mb-3">
                    <label for="senha" class="form-label">Senha:</label>
                    <input type="password" class="form-control" id="senha" name="senha" required>
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