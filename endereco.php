<?php
require("./includes/components/autenticacao.php");
require("./includes/components/conecta.php"); // Certifique-se de incluir o arquivo que faz a conexão com o banco de dados
require("./includes/components/cabecalho.php");
require("./includes/components/funcao.php");
require("./includes/components/js.php");

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
<main>
    <section>
    <form action="#" method="post" class="form-container">
      <div class="fields">
      <fieldset>
      <p><label for="cep">CEP: </label> <input class="input" type="text" name="cep" id="cep"></p>
      <p><label for="logradouro">Logradouro: </label> <input class="input" type="text" name="logradouro" id="logradouro"></p>
      <p><label for="bairro">Bairro: </label> <input class="input" type="text" name="bairro" id="bairro"></p>
       <p><label for="cidade">Cidade: </label> <input class="input" type="text" name="cidade" id="cidade"></p>
      <p><button type="submit" id='cadastrar' name='cadastrar' value="Cadastrar"> Cadastrar </button>  </p> 
      <a class="btn btn-secondary" href="perfil_usuario.php" role="button">Voltar</a>

      </fieldset>
      </div>     
    </form>
    </section>
</main>
</body>
</html>