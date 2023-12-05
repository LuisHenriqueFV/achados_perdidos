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
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informações</title>
    <!-- Google Montserrat Alternates -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat+Alternates:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <!-- styles -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link href="css/style2.css" rel="stylesheet">

</head>

<body>

    <header>
        <button id="openMenu">&#9776;</button>
        <a href="index.php" id="logo">
            <img src="img/logo3.png" alt="achados&perdidos" />
        </a>



        <nav id="menu">

            <button id="closeMenu">X</button>

            <a href="index.php">Home</a>
            <a href="objeto.php">Formulário</a>
            <a href="informacao.php">Informacao</a>
            <a href="historias.php">Historias</a>
            <a href="contato.php">Contato</a>

            <?php
            $userId = $_SESSION["codpessoa"];
            $adm = verifica_administrador($userId, $pdo);




            if ($adm) {
                ?>

                <a href="adm.php">Adm</a>

                <?php
            }
            ?>
        </nav>

        <button id="themeToggle" class="btn btn-text-light"><img width="25" height="25"
                src="img/icons8-day-and-night-50.png" alt="day-and-night" /></button>
        <div class="perfil">

            <div class="dropdown text-end">
                <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <?php
                    $imagemPerfil = empty($usuario["imagem"]) ? "img/perfil-padrao.png" : "uploads/" . $usuario["imagem"];
                    ?>
                    <img src="<?php echo $imagemPerfil; ?>" alt="Perfil do usuário" width="32" height="32"
                        class="rounded-circle">
                </a>
                <ul class="dropdown-menu text-small">
                    <li><a class="dropdown-item custom-color text-black" href="perfil_usuario.php">Perfil</a></li>
                    <li>
                    </li>
                    <li><a class="dropdown-item custom-color text-black" href="logout.php">Sair</a></li>
                </ul>
            </div>
        </div>


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






    <footer id="footer">




        <div class="container">
            <div class="h1" id="achados_perdidos">
                <h1>Achados&Perdidos</h1>

            </div>
            <div style="display: flex; align-items: center;">
                <img class="icon" src="img/icons8-phone-48.png"
                    style="width: 25px; height: 25px;  margin-bottom:17px; padding-right: 5px;" alt="icon">
                +55 5398405-5364
            </div>
            <div style="display: flex; align-items: center;">
                <img class="icon" src="img/icons8-gmail-50.png"
                    style="width: 25px; height: 25px; margin-bottom:19px; padding-right: 5px;" alt="icon">
                luishenriquefonsecaphp@gmail.com
            </div>
            <div style="display: flex; align-items: center;">
                <img class="icon" src="img/icons8-location-60.png"
                    style="width: 25px; height: 25px; margin-bottom:19px; padding-right: 5px;" alt="icon">
                Pelotas, Rio Grande Do Sul
            </div>
        </div>


    </footer>

</body>
<?php
require_once("./includes/components/js2.php");
require_once("./includes/components/js.php");

?>

</html>