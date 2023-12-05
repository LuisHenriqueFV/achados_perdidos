<?php
require_once("./includes/components/autenticacao.php");
require_once("./includes/components/conecta.php");
require_once("./includes/components/funcao.php");
?>
<?php
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
            <a href="objeto.php">Achei/Perdi</a>
            <a href="sobre_nos.php">Sobre</a>
            <a href="historias.php">Historias</a>
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



        <div class="container">

            <section class="cards">

                <article class="card">
                    <p>
                        "O Reencontro das Cartas"

                        Carolina, uma jovem escritora, perdeu seu caderno de anotações favorito enquanto trabalhava em
                        um parque. Desesperada, ela acessou o site "Achados e Perdidos" e deixou um anúncio detalhando a
                        perda. Do outro lado da cidade, João, um estudante universitário, encontrou o caderno debaixo de
                        uma árvore.

                        Ao acessar o mesmo site para relatar seu achado, João leu o anúncio de Carolina. Ambos se
                        encontraram em um café próximo para a devolução. A amizade floresceu entre eles, e a história de
                        como o caderno viajou de mãos perdidas para mãos encontradas tornou-se a inspiração para o
                        próximo romance de Carolina.</p>
                </article>

                <article class="card">
                    <p> "A Conexão dos Relógios"

                        Luís, um apaixonado por antiguidades, achou um relógio antigo no metrô. Curioso para descobrir
                        sua história, ele procurou o site "Achados e Perdidos" para encontrar o dono. Maria, uma senhora
                        idosa, tinha perdido o relógio durante uma viagem.

                        Ao se reunirem para a devolução, Maria compartilhou histórias emocionantes sobre o relógio, que
                        pertencera a seu avô. A conexão entre Luís e Maria transcendeu a simples devolução de um objeto;
                        uma amizade entre gerações começou a se formar, e Luís continuou visitando Maria para ouvir mais
                        histórias fascinantes.</p>
                </article>

                <article class="card">
                    <p>"O Retorno da Fotografia"

                        Rafael, um fotógrafo amador, deixou sua câmera em um ônibus. Desesperado pela perda das fotos
                        preciosas de um evento especial, ele publicou um anúncio no site "Achados e Perdidos". Isabel,
                        uma estudante de fotografia, encontrou a câmera no banco traseiro do ônibus.

                        Ao devolver a câmera, Isabel não apenas trouxe de volta as memórias de Rafael, mas também
                        ofereceu-se para compartilhar técnicas de fotografia. Os dois começaram a sair juntos para
                        explorar a cidade através das lentes de suas câmeras, transformando uma perda momentânea em uma
                        jornada fotográfica compartilhada.

                        Essas histórias fictícias destacam como o site "Achados e Perdidos" não apenas ajuda na
                        recuperação de objetos, mas também pode ser o catalisador para conexões significativas entre as
                        pessoas.</p>
                </article>

                <article class="card">
                    <p> "O Encontro dos Colecionadores"

                        Ana, uma entusiasta de selos raros, percebeu que sua coleção havia desaparecido depois de uma
                        mudança de casa. Ela decidiu postar um anúncio no site "Achados e Perdidos" na esperança de
                        recuperar seus tesouros filatélicos. Do outro lado da cidade, Pedro, um colecionador ocasional,
                        encontrou a coleção esquecida em uma caixa no sótão de sua nova casa.

                        Ao se encontrarem para a devolução, Ana e Pedro descobriram que compartilhavam uma paixão comum
                        por selos raros. Isso levou não apenas à recuperação da coleção de Ana, mas também ao início de
                        uma amizade baseada em sua paixão compartilhada por filatelia. Juntos, eles começaram a
                        frequentar feiras de colecionadores e a expandir suas coleções.</p>
                </article>

                <article class="card">
                    <p>"O Livro Perdido e a Troca Cultural"

                        Miguel, um estudante estrangeiro, perdeu seu livro de gramática em uma biblioteca movimentada.
                        Desanimado pela dificuldade de encontrar um substituto em seu idioma nativo, ele recorreu ao
                        site "Achados e Perdidos". Sofia, uma estudante local, encontrou o livro e percebeu que Miguel
                        era um estrangeiro.

                        Ao devolver o livro, Sofia e Miguel começaram a conversar sobre suas respectivas culturas e
                        línguas. Isso levou a uma amizade intercultural, onde eles começaram a trocar experiências
                        linguísticas e culinárias. O livro perdido não só retornou ao seu dono, mas também abriu as
                        portas para uma troca cultural enriquecedora.</p>
                </article>

                <article class="card">
                    <p> "O Retorno do Brinquedo Favorito"

                        Lucas, um menino de sete anos, perdeu seu brinquedo favorito, um pequeno robô, enquanto brincava
                        no parque. Sua mãe, Carla, publicou um pedido de ajuda no site "Achados e Perdidos". Sofia, uma
                        adolescente que passava pelo parque, encontrou o robô e ficou comovida com a tristeza de Lucas.

                        Ao devolver o brinquedo, Sofia não apenas trouxe alegria de volta à vida de Lucas, mas também
                        decidiu passar algum tempo brincando com ele no parque. Essa simples devolução transformou-se em
                        um momento especial, mostrando como a generosidade e empatia podem criar laços inesperados entre
                        diferentes gerações.

                        Essas histórias fictícias destacam a diversidade de situações que podem ocorrer ao redor do tema
                        "Achados e Perdidos", mostrando como a plataforma não apenas facilita a recuperação de objetos,
                        mas também pode ser o ponto de partida para experiências significativas e conexões humanas.</p>
                </article>

            </section>


        </div>


    </main>


    <footer>

  
    
         <img class="logo" src="img/logo3.png" alt="logo">
    
        <!-- <div class="listas">
            <h2>Informação</h2>
            <ul class="lista">
            <li><a href="como_funciona.php">Como Funciona?</a></li>
            <li><a href="sobre_nos.php">Sobre</a></li>
            <li><a href="comunidade.php">Comunidade</a></li>
            <li><a href="contato.php">Contato</a></li>


            </ul> -->
        <!-- </div> -->

    </footer>

</body>
<?php
require_once("./includes/components/js2.php");
require_once("./includes/components/js.php");

?>

</html>