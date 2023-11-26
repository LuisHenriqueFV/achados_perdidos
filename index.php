<?php
require("./includes/components/autenticacao.php");
require("./includes/components/conecta.php");
require("./includes/components/funcao.php");
require("./includes/components/cabecalho.php");

$userEmail = $_SESSION["email"];

$consulta = $pdo->prepare('SELECT * FROM pessoa WHERE email = ?');
$consulta->execute([$userEmail]);
$usuario = $consulta->fetch();
?>
?>

<body>
    <main>
        <header class="bg-primary-color">
            <nav class="navbar navbar-expand-lg fixed-top bg-primary-color" id="navbar">
                <div class="container py-3">
                    <a class="navbar-logo" href="index.php">
                        <img id="navbar-logo" src="img/achados&perdidos-logo4.png" alt="achados&perdidos" />
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbar-items" aria-controls="navbar-items" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbar-items">
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link" href="index.php">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="objetos_encontrados.php">Achei</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="objetos_perdidos.php">Perdi</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="visualizar_encontrados.php">Achados</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="visualizar_perdidos.php">Perdidos</a>
                            </li>
                            <?php
                            $email = $_SESSION["email"];
                            $adm = verifica_administrador($email, $pdo);
                            if ($adm) {
                                ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="adm.php">Adm</a>
                                </li>
                                <?php
                            }
                            ?>
                        </ul>
                        <div class="dropdown text-end">
                        <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <?php
                                // Obtenha o caminho da imagem do perfil do usuário
                                $imagemPerfil = empty($usuario["imagem"]) ? "img/perfil-padrao.png" : "uploads/" . $usuario["imagem"];
                                ?>
                                <img src="<?php echo $imagemPerfil; ?>" alt="Perfil do usuário" width="32" height="32"
                                    class="rounded-circle">
                            </a>
                            <ul class="dropdown-menu text-small">
                                <li><a class="dropdown-item custom-bg-color text-black"
                                        href="perfil_usuario.php">Perfil</a></li>
                                <li>
                                </li>
                                <li><a class="dropdown-item custom-bg-color text-black" href="logout.php">Sair</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>
        </header>
    </main>

    <script>
        var profileIcon = document.getElementById('profileIcon');
        var optionsMenu = document.getElementById('optionsMenu');

        profileIcon.addEventListener('click', function () {
            optionsMenu.classList.toggle('visible');
        });
    </script>
</body>

</html>