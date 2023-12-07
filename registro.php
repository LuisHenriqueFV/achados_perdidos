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
    $email = filter_var($_POST["email"], FILTER_VALIDATE_EMAIL);
    $senha = $_POST["senha"];

    if ($email === false) {
        echo "E-mail inválido. Por favor, insira um e-mail válido. <hr>";

    }

    if (strlen($senha) < 8) {
        echo "A senha deve ter pelo menos 8 caracteres.";
    } else {
        try {
            $verificaEmail = $pdo->prepare("SELECT COUNT(*) FROM pessoa WHERE email = ?");
            $verificaEmail->execute([$email]);
            $emailExistente = (int) $verificaEmail->fetchColumn();

            if ($emailExistente > 0) {
                echo "O e-mail já está registrado. Por favor, use outro e-mail.";
            } else {
                $codigoVerificacao = bin2hex(random_bytes(16));
                $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

                $sql = "INSERT INTO pessoa (nome, email, senha, codigo_verificacao) VALUES (?, ?, ?, ?)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$nome, $email, $senhaHash, $codigoVerificacao]);

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

                    echo "Registro bem-sucedido! Um e-mail de verificação foi enviado para o seu endereço.";
                } catch (Exception $e) {
                    echo "Erro ao enviar o e-mail";
                }
            }
        } catch (PDOException $e) {
            echo "Erro no registro: " . $e->getMessage();
        }
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
                    <label for="email" class="form-label">E-mail (somente @gmail.com):</label>
                    <input type="email" class="form-control" id="email" name="email"
                        pattern="[a-zA-Z0-9._%+-]+@gmail\.com$" required>
                    <small class="form-text text-muted">Digite um e-mail válido que termine com @gmail.com.</small>
                    <hr>
                </div>

                <div class="mb-3">
                    <label for="senha" class="form-label">Senha (8 caracteres ou mais):</label>
                    <input type="password" class="form-control" id="senha" name="senha" required minlength="8">
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