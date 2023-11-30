<?php
session_start();

$_SESSION["msg"] = "";

require("./includes/components/funcao.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $senha = $_POST["password"];

    if (!(empty($email) || empty($senha))) {

        require('./includes/components/conecta.php');

        $consulta = $pdo->prepare("SELECT * FROM pessoa WHERE email = :email");
        $consulta->bindParam(':email', $email);
        $consulta->execute();

        $usuario = $consulta->fetch(PDO::FETCH_ASSOC);

        if ($usuario) {
            $verificado = $usuario['verificado'];

            if ($verificado) {
                $senhaBanco = $usuario['senha'];
                if (password_verify($senha, $senhaBanco)) {
                    $_SESSION["logged"] = true;

                    // Correção aqui: você precisa armazenar o codpessoa na sessão
                    $_SESSION["codpessoa"] = $usuario['codpessoa'];

                    // Verifica se o usuário é um administrador
                    $_SESSION["adm"] = ($usuario['adm'] == 1);

                    envia_email($email);
                    header("Location: index.php");
                    exit();
                } else {
                    $_SESSION["msg"] = "Senha incorreta. Tente novamente.";
                }
            } else {
                $_SESSION["msg"] = "Seu e-mail ainda não foi verificado. Por favor, verifique seu e-mail.";
            }
        } else {
            $_SESSION["msg"] = "Usuário não encontrado. Verifique suas credenciais.";
        }
    }
}

require("./includes/components/cabecalho.php");



?>

<body>

    <main>
        <div id="loginContainer" >
                <div class=" m-auto form-container rounded-4 p-5">
                    <form action="login.php" method="POST" class="needs-validation">

                        <div class="text-center mb-4">
                            <h1 class="mb-2 fw-regular">Login</h1>
                            <hr class="w-100 mx-auto my-2">
                        </div>

                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" id="email" name="email"
                                placeholder="exemplo@gmail.com" required>
                            <label for="email">E-mail</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="Digite sua senha" required>
                            <label for="password">Senha</label>
                        </div>

                        <button type="submit" class="btn-custom-color w-100 py-2 rounded-2">Entrar</button>
                        <hr class="w-100 mx-auto my-2">
                        <div class="row">
                            <div class="col-md-6 text-center">
                                <p><a href="registro.php"
                                        class="link-secondary link-offset-2 link-opacity-25 link-opacity-100-hover">Registre-se</a>
                                </p>
                            </div>
                            <div class="col-md-6 text-center">
                                <p><a href="recuperar_senha.php"
                                        class="link-secondary link-offset-2 link-opacity-25 link-opacity-100-hover">Esqueci
                                        a Senha</a></p>
                            </div>
                        </div>

                        <?php echo $_SESSION["msg"]; ?>
                    </form>

                    <?php
                    if (isset($_SESSION['senha_alterada'])) {
                        echo '<p style="color: green;">Senha alterada com sucesso!</p>';
                        unset($_SESSION['senha_alterada']);
                    }
                    ?>
                </div>
            </div>
        </div>

    </main>

</body>

</html>