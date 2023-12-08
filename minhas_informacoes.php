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

    <?php
    require_once("./includes/components/footer.php");
    require_once("./includes/components/js.php");
    require_once("./includes/components/js2.php");

    ?>

</body>


</html>