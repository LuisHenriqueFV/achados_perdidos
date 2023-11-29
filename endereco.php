<?php
require("./includes/components/autenticacao.php");
require("./includes/components/conecta.php"); // Certifique-se de incluir o arquivo que faz a conexão com o banco de dados
require("./includes/components/cabecalho.php");
require("./includes/components/funcao.php");
require("./includes/components/js.php");

$userId = $_SESSION["codpessoa"];
$consulta = $pdo->prepare('SELECT * FROM pessoa WHERE codpessoa = ?');
$consulta->execute([$userId]);
$usuario = $consulta->fetch();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recebendo os dados do formulário
    $cep = $_POST["cep"];
    $logradouro = $_POST["logradouro"];
    $bairro = $_POST["bairro"];
    $cidade = $_POST["cidade"];

    // Usando prepared statements para evitar SQL injection
    $stmt = $pdo->prepare("UPDATE pessoa SET cep = ?, logradouro = ?, bairro = ?, cidade = ? WHERE codpessoa = ?");
    $stmt->execute([$cep, $logradouro, $bairro, $cidade, $_SESSION["codpessoa"]]);

    // Verificando se a atualização foi bem-sucedida
    if ($stmt->rowCount() > 0) {
        echo '<p>Dados cadastrados com sucesso!</p>';
    } else {
        echo '<p>Ocorreu um erro ao cadastrar os dados.</p>';
    }
}
?>


<body>
    <main class="container mt-5">
        <div class="forms">
            <h1 class="text-center">Cadastrar Meu Endereço</h1>
            <form method="POST">
                <div class="row justify-content-center">
                  
                    <div class="col-md-12">
                        <label for="cep">CEP:</label>
                        <input class="form-control" type="text" name="cep" id="cep"
                            placeholder="Digite seu cep para obter informações sobre seu endereço"
                            value="<?php echo $usuario["cep"]; ?>">
                    </div>
                    <div class="col-md-12">
                        <label for="bairro">Bairro:</label>
                        <input class="form-control" type="text" name="bairro" id="bairro"
                            value="<?php echo $usuario["bairro"]; ?>">
                    </div>
                    <div class="col-md-12">
                        <label for="logradouro">Rua:</label>
                        <input class="form-control" type="text" id="logradouro" name="logradouro"
                            value="<?php echo $usuario["logradouro"]; ?>">
                    </div>
                    <div class="col-md-12">
                        <label for="cidade">Cidade:</label>

                        <input class="form-control" type="text" name="cidade" id="cidade"
                            value="<?php echo $usuario["cidade"]; ?>">
                    </div>
                </div>
                <div class="mt-3">
                    <button type="submit" class="btn btn-primary">Atualizar Informações</button>
                    <a class="btn btn-secondary" href="perfil_usuario.php" role="button">Cancelar</a>
                </div>
            </form>
        </div>
    </main>
</body>

</html>