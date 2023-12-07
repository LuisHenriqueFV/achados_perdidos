<?php

require "./includes/components/cabecalho.php";
require "./includes/components/conecta.php";
require "./includes/components/PHPMailer/src/PHPMailer.php";
require "./includes/components/PHPMailer/src/Exception.php";
require "./includes/components/PHPMailer/src/SMTP.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];

    $q = $pdo->prepare("SELECT * FROM pessoa WHERE email = :email");
    $q->bindParam(':email', $email);
    $q->execute();

    if ($q->rowCount() == 1) {
        $chave = bin2hex(random_bytes(16));
        $hashedChave = password_hash($chave, PASSWORD_DEFAULT);

        $conf = $pdo->prepare("INSERT INTO recuperacao (utilizador, chave) VALUES (:email, :chave)");
        $conf->bindParam(':email', $email);
        $conf->bindParam(':chave', $hashedChave);

        if ($conf->execute()) {
            $link = "https://henriquefonsecaachadoseperdidos.000webhostapp.com/achados_perdidos/redefinir_senha.php?utilizador=$email&confirmacao=$chave";

            $mail = new PHPMailer(true);

            try {
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'luishenriquefonsecaphp@gmail.com';
                $mail->Password = 'hdtm huzb bjsy haif';
                $mail->Port = 587;

                $mail->setFrom('luishenriquefonsecaphp@gmail.com', 'achados&perdidos');
                $mail->addAddress($email);
                $mail->Subject = 'Recuperar Senha';
                $mail->Body = 'Olá ' . $email . ', visite este link ' . $link;

                $mail->send();

                $msg = '<p>Um e-mail foi enviado para o seu endereço com um link único para alterar sua senha.</p>';
            } catch (Exception $e) {
                $msg = '<p>Ocorreu um erro ao enviar o e-mail: ' . $mail->ErrorInfo . '</p>';
            }
        } else {
            $msg = '<p>Não foi possível gerar o endereço único.</p>';
        }
    } else {
        $msg = '<p>Este usuário não existe.</p>';
    }
}

?>

<div id="conteudoCadastro" class="container">
       
    <form method="post" action="recuperar_senha.php" class="mt-3">
        <h4>Digite seu E-mail cadastrado para alterar sua senha.</h4>
        <div class="mb-3">
            <label for="email" class="form-label">E-mail:</label>
            <input type="text" name="email" id="email" class="form-control">
        </div>
        <button type="submit" class="btn btn-custom-color">Recuperar</button>
        <a class="btn btn-secondary" href="login.php" role="button">Voltar</a>
    </form>

    <?php echo $msg;  ?>

</div>
