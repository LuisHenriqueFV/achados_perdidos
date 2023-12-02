<?php
$userId = $_SESSION["codpessoa"];
$consulta = $pdo->prepare('SELECT * FROM pessoa WHERE codpessoa = ?');
$consulta->execute([$userId]);
$usuario = $consulta->fetch();
?>
   
   <body>
    <main>
                <!-- INICIO DO HEADER -->
                <header>

<nav class="navbar navbar-expand-lg fixed-top" id="navbar">

    <div class="container">
        <a class="navbar-logo" href="index.php">
            <img id="navbar-logo" src="img/logo1.png" alt="achados&perdidos" />
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
                    <a class="nav-link" href="como_funciona.php">Sobre</a>
                </li>


                <?php
                $userId = $_SESSION["codpessoa"];
                $adm = verifica_administrador($userId, $pdo);




                if ($adm) {
                    ?>
                    <li class="nav-item">
                        <a class="nav-link" href="adm.php">Adm</a>
                    </li>
                    <?php
                }
                ?>
            </ul>
    <button id="themeToggle" class="btn btn-text-light"><img width="25" height="25" src="https://img.icons8.com/ios/50/day-and-night.png"  alt="day-and-night"/></button>

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
<!-- FIM DO HEADER -->
    </main>
 
   