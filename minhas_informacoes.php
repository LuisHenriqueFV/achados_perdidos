<?php
require_once("./includes/components/autenticacao.php");
require_once("./includes/components/conecta.php");
require_once("./includes/components/funcao.php");
require_once("./includes/components/cabecalho.php");
require_once("./includes/components/header.php");
require_once("./includes/components/js.php");


?>

<html>

<body>
    <main>



        <div id="conteudoMinhasInformacoes" class="container d-flex justify-content-center">

            <div class="forms">
                <h1 class="text-center">Minhas Informações</h1>
                <div class="row justify-content-center py-5">
                    <div class="col-md-12">
                        <p><strong>Nome de Usuário:</strong>
                            <?php echo $usuario["nome"]; ?>
                        </p>
                        <hr>
                        <p><strong>Email:</strong>
                            <?php echo $usuario["email"]; ?>
                        </p>
                        <hr>
                        <p><strong>CEP:</strong>
                            <?php echo $usuario["cep"]; ?>
                        </p>
                        <hr>
                        <p><strong>Bairro:</strong>
                            <?php echo $usuario["bairro"]; ?>
                        </p>
                        <hr>
                        <p><strong>Rua:</strong>
                            <?php echo $usuario["logradouro"]; ?>
                        </p>
                        <hr>
                        <p><strong>Cidade:</strong>
                            <?php echo $usuario["cidade"]; ?>
                        </p>
                        <hr>
                    </div>

                    <div class="d-flex justify-content-center pb-2">
                        <a class="btn btn-custom-color" href="editar_minhas_informacoes.php" role="button">Editar
                            Informações</a>

                    </div>
                    <hr>
                    <div class="container d-flex justify-content-center">
                        <div class="row col-2">
                        <a class="btn btn-secondary" href="perfil_usuario.php" role="button">Voltar</a>

                        </div>
                    </div>
                </div>
            </div>
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

</html>