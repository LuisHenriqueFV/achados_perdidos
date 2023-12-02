<?php
require("./includes/components/autenticacao.php");
require("./includes/components/conecta.php");
require("./includes/components/funcao.php");
require("./includes/components/cabecalho.php");
require("./includes/components/js.php");
require("./includes/components/header.php");


?>

<body>
    <main>
   

        <!-- INFORMAÇÃO -->
        <div id="conteudoCadastro" class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Sobre Nós</h2>
                    <p>Bem-vindo ao Achados & Perdidos, o lugar onde a comunidade se une para ajudar a encontrar objetos
                        perdidos e reunir pessoas com seus pertences perdidos. Nosso objetivo é facilitar a conexão
                        entre
                        aqueles que perderam algo e aqueles que encontraram algo.</p>

                    <h2>Nossa Missão</h2>
                    <p>Nossa missão é criar uma plataforma fácil de usar, onde as pessoas podem relatar objetos
                        perdidos,
                        compartilhar informações sobre itens encontrados e se reunir para devolver pertences perdidos
                        aos
                        seus donos. Acreditamos que, ao conectar a comunidade, podemos fazer a diferença na vida das
                        pessoas.</p>

                    <h2>Como Funciona</h2>
                    <p>Para começar, explore as seções "Perdi" e "Achei" para ver os objetos que foram relatados como
                        perdidos ou encontrados. Se você perdeu algo, você pode relatar seu item perdido, e se encontrou
                        algo, pode compartilhar as informações para ajudar na devolução. A comunidade é o coração do
                        Achados
                        & Perdidos, e sua participação faz toda a diferença.</p>

                    <h2>Contato</h2>
                    <p>Se você tiver alguma dúvida, sugestão ou precisar de suporte, sinta-se à vontade para entrar em
                        contato conosco através do nosso formulário de <a href="contato.php">Contato</a>. Estamos aqui
                        para
                        ajudar!</p>
                    <a href="index.php" class="btn btn-secondary">Voltar</a>
                </div>


            </div>
        </div>
        <!-- FIM DA INFORMAÇÃO -->



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