<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require("./includes/components/autenticacao.php");
require("./includes/components/conecta.php");
require "./includes/components/PHPMailer/src/PHPMailer.php";
require "./includes/components/PHPMailer/src/Exception.php";
require "./includes/components/PHPMailer/src/SMTP.php";
require("./includes/components/cabecalho.php");
require("./includes/components/js.php");


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $mensagem = $_POST["mensagem"];


    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'luishenriquefonsecaphp@gmail.com';
        $mail->Password = 'hdtm huzb bjsy haif';
        $mail->Port = 587;


        $mail->setFrom($email, $nome);
        $mail->addAddress('luishenriquefonsecaphp@gmail.com');


        $mail->isHTML(false);
        $mail->Subject = 'Nova Mensagem de Contato';
        $mail->Body = "Nome: $nome\nE-mail: $email\nMensagem:\n$mensagem";


        $mail->send();

        echo '<p class="alert alert-success">Mensagem enviada com sucesso!</p>';
    } catch (Exception $e) {
        echo '<p class="alert alert-danger">Erro ao enviar a mensagem: ' . $mail->ErrorInfo . '</p>';
    }
}
?>

<body>
    <main class="container mt-5">
        <div class="content">
            <h1 class="text-center">Entre em Contato</h1>
            <p>Se você tiver alguma dúvida, sugestão ou precisar de suporte, fique à vontade para entrar em contato
                conosco preenchendo o formulário abaixo.</p>

            <form action="#" method="post" class="form-container">
                <div class="mb-3">
                    <label for="nome" class="form-label">Nome:</label>
                    <input type="text" class="form-control" id="nome" name="nome" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">E-mail:</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="mensagem" class="form-label">Mensagem:</label>
                    <textarea class="form-control" id="mensagem" name="mensagem" rows="4" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Enviar Mensagem</button>
                <a class="btn btn-secondary" href="sobre_nos.php" role="button">Voltar</a>

            </form>
        </div>
    </main>
</body>

</html>