<?php
require_once("./includes/components/autenticacao.php");
require_once("./includes/components/conecta.php");
require_once("./includes/components/funcao.php");

$userId = $_SESSION["codpessoa"];
$consulta = $pdo->prepare('SELECT * FROM pessoa WHERE codpessoa = ?');
$consulta->execute([$userId]);
$usuario = $consulta->fetch();

$historias = obter_historias($pdo);

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


        <div class="instructions-container">
            <div class="instruction-section">
                <h1 class="h2">Visão Geral:</h1>
                Bem-vindo à plataforma Achados e Perdidos, um serviço dedicado a ajudar a comunidade a recuperar
                objetos ou animais perdidos e a devolver itens encontrados.
            </div>

            <div class="instruction-section">
                <h1 class="h2">Como Funciona:</h1>
                Se você encontrou um objeto: Registre-o em nosso sistema para que a pessoa que o perdeu possa
                localizá-lo.<br>
                Se você perdeu um objeto: Relate-o imediatamente, fornecendo informações detalhadas para aumentar as
                chances de recuperação.
            </div>

            <div class="instruction-section">
                <h1 class="h2">Registro de Encontrados:</h1>
                Preencha nosso formulário de registro com informações precisas sobre o objeto ou animal encontrado,
                incluindo
                data, local e uma descrição detalhada.
            </div>

            <div class="instruction-section">
                <h1 class="h2">Relato de Perdidos:</h1>

                Use nosso formulário de relato para fornecer detalhes sobre o objeto perdido, incluindo
                características
                distintivas, local onde foi visto pela última vez e data aproximada do ocorrido.
            </div>
            <div class="instruction-section">
                <h1 class="h2">Recuperação de Objetos Perdidos:</h1>

                Caso você encontre um objeto listado como perdido, entre em contato com a pessoa (através do seu
                email registrado) que o perdeu para
                organizar a devolução.
                Lembre-se de seguir as políticas e regras estabelecidas para garantir uma experiência positiva para
                todos os envolvidos.
            </div>
            <div class="instruction-section">
                <h1 class="h2"> Contato e Suporte:</h1>

                Se precisar de assistência ou tiver dúvidas, entre em contato conosco através do e-mail
                luishenriquefonsecaphp ou utilize nosso formulário de contato disponível em: <a
                    href="contato.php">contato</a>

            </div>


        </div>



    </main>





    <?php
    require_once("./includes/components/footer.php");
    ?>


</body>
<?php
    require_once("./includes/components/footer.php");
    require_once("./includes/components/js.php");
    require_once("./includes/components/js2.php");

    ?>
</html>