<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


require_once("./includes/components/autenticacao.php");
require_once("./includes/components/conecta.php");
require_once("./includes/components/funcao.php");





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
require_once("./includes/components/cabecalho.php");
require_once("./includes/components/header.php");
require_once("./includes/components/js.php");
?>

<body>
    <main>


        <div id="conteudo" class="container">


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


    <!-- RODAPE -->
    <footer id="footer">

        <div class="container">
            <div class="h1" id="achados_perdidos">
                <h1>Achados&Perdidos</h1>

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

    <!-- FIM DO RODAPÉ -->

</body>

</html>