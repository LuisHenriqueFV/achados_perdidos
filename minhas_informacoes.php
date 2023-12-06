<?php
require_once("./includes/components/autenticacao.php");
require_once("./includes/components/conecta.php");
require_once("./includes/components/funcao.php");


$userId = $_SESSION["codpessoa"];
$consulta = $pdo->prepare('SELECT * FROM pessoa WHERE codpessoa = ?');
$consulta->execute([$userId]);
$usuario = $consulta->fetch();



?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historias</title>
    <!-- Google Montserrat Alternates -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat+Alternates:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <!-- styles -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <?php
    require_once("./includes/components/cabecalho.php");
    ?>
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



        <div id="conteudoMinhasInformacoes" style="display: flex; justify-content: center;" class="container">

            <div class="forms">
                <h1 class="text-center">Minhas Informações</h1>
                <div style="display: flex; justify-content: center; padding: 5%; flex-direction: column;">
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

                <div style="display: flex; justify-content: center; padding-bottom: 2%;">
                    <a style="margin: 1%;" class="btn btn-custom-color" href="editar_minhas_informacoes.php"
                        role="button">Editar Informações</a>
                </div>
                <hr>
                <div style="display: flex; justify-content: center;">
                    <div style="display: flex; flex-direction: column; padding: 1%;">
                        <a style="margin: 1%;" class="btn btn-secondary" href="perfil_usuario.php"
                            role="button">Voltar</a>
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
    <?php
    require_once("./includes/components/js2.php");
    ?>
</body>

</html>