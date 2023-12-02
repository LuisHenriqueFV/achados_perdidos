<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


require_once("./includes/components/autenticacao.php");
require_once("./includes/components/conecta.php");
require_once("./includes/components/funcao.php");
require_once("./includes/components/cabecalho.php");
require_once("./includes/components/header.php");
require_once("./includes/components/js.php");




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

<body>
    <main>

    
        <div id="conteudo" class="container">
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
                <a class="btn btn-secondary" href="index.php" role="button">Voltar</a>

            </form>

        </div>
    </main>

    <!-- RODAPE -->
    <footer class="py-5" id="footer">
        <div class="row justify-content-center">
            <div class="col-6 col-md-2 mb-2">
                <h5>Sobre Nós</h5>
                <ul class="nav flex-column">
                    <li class="nav-item mb-2"><a href="sobre_nos.php" class="nav-link p-0 text-body-secondary">Sobre
                            Nós</a></li>
                    <li class="nav-item mb-2"><a href="como_funciona.php" class="nav-link p-0 text-body-secondary">Como
                            Funciona?</a></li>
                    <li class="nav-item mb-2"><a href="comunidade.php"
                            class="nav-link p-0 text-body-secondary">Comunidade</a></li>
                </ul>
            </div>

            <div class="col-6 col-md-2 mb-2">
                <h5>Informações</h5>
                <ul class="nav flex-column">
                    <li class="nav-item mb-2"><a href="contato.php" class="nav-link p-0 text-body-secondary">Contato</a>
                    </li>
                </ul>
            </div>
        </div>
    </footer>

    <!-- FIM DO RODAPÉ -->

</body>

</html>