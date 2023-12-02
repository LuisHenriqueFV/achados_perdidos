<?php
require_once("./includes/components/autenticacao.php");
require_once("./includes/components/conecta.php");
require_once("./includes/components/funcao.php");
require_once("./includes/components/cabecalho.php");
require_once("./includes/components/header.php");
require_once("./includes/components/js.php");



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
 

    <div id="conteudoCadastro" class="container">
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
    </div>

  </main>

    <!-- RODAPE -->
    <footer class="py-5" id="footer">
        <div class="row justify-content-center">
            <div class="col-6 col-md-2 mb-2">
                <h5>Sobre Nós</h5>
                <ul class="nav flex-column">
                    <li class="nav-item mb-2"><a href="sobre_nos.php" class="nav-link p-0 text-body-secondary">Sobre
                            Nós</a></li>
                    <li class="nav-item mb-2"><a href="como_funciona.php" class="nav-link p-0 text-body-secondary">Como
                            Funciona?</a></li>
                    <li class="nav-item mb-2"><a href="comunidade.php"
                            class="nav-link p-0 text-body-secondary">Comunidade</a></li>
                </ul>
            </div>

            <div class="col-6 col-md-2 mb-2">
                <h5>Informações</h5>
                <ul class="nav flex-column">
                    <li class="nav-item mb-2"><a href="contato.php" class="nav-link p-0 text-body-secondary">Contato</a>
                    </li>
                </ul>
            </div>
        </div>
    </footer>

    <!-- FIM DO RODAPÉ -->

</body>

</html>