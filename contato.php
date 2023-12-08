<?php
require_once("./includes/components/autenticacao.php");
require_once("./includes/components/conecta.php");
require_once("./includes/components/funcao.php");
require "./includes/components/PHPMailer/src/PHPMailer.php";
require "./includes/components/PHPMailer/src/Exception.php";
require "./includes/components/PHPMailer/src/SMTP.php";



use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


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
        echo 'Código de erro: ' . $e->getCode() . '<br>';
        echo 'Mensagem de erro: ' . $e->getMessage();
    }

}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <?php
    require_once("./includes/components/cabecalho.php");
    ?>
</head>



<body>

    <header>
        <?php
        require_once("./includes/components/header2.php");
        ?>

    </header>

    <main>

        <div class="containerTUDO">

            <div id="conteudoContato" class="container">


                <form action="#" method="post" class="form-container">
                    <h1 class="text-center">Entre em Contato</h1>
                    <hr>
                    <p>Dúvidas, sugestões, suporte, ou relatar um caso ocorrido com a utilização da plataforma, fique à
                        vontade para entrar em contato
                        conosco preenchendo o formulário abaixo.</p>
                    <hr>

                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome:</label>
                        <input type="text" class="form-control" id="nome" name="nome" required>
                        <hr>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">E-mail:</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                        <hr>
                    </div>
                    <div class="mb-3">
                        <label for="mensagem" class="form-label">Mensagem:</label>
                        <textarea class="form-control" id="mensagem" name="mensagem" rows="4" required></textarea>
                        <hr>
                    </div>
                    <button type="submit" class="btn btn-custom-color">Enviar Mensagem</button>
                    <hr>
                    <a class="btn btn-secondary" href="index.php" role="button">Voltar</a>

                </form>

            </div>
    </main>



    <?php
    require_once("./includes/components/footer.php");
    require_once("./includes/components/js.php");
    require_once("./includes/components/js2.php");

    ?>


</body>

</html>