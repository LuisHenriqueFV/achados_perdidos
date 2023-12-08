
<?php
$userId = $_SESSION["codpessoa"];
$consulta = $pdo->prepare('SELECT * FROM pessoa WHERE codpessoa = ?');
$consulta->execute([$userId]);
$usuario = $consulta->fetch();
?>
<header>
        
        <button id="openMenu">&#9776;</button>
        <a href="index.php" id="logo">
            <img src="img/logo3.png" alt="achados&perdidos" />
        </a>



        <nav id="menu">

            <button id="closeMenu">X</button>

            <a href="index.php">Home</a>
            <a href="objeto.php">Publicar</a>
            <a href="informacao.php">Informações</a>
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
