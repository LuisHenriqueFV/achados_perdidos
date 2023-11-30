<?php
require_once("./includes/components/autenticacao.php");
require_once("./includes/components/conecta.php");
require_once("./includes/components/funcao.php");
require_once("./includes/components/cabecalho.php");
require_once("./includes/components/header.php");
require_once("./includes/components/js.php");

$userId = $_SESSION["codpessoa"];

$consulta = $pdo->prepare('SELECT * FROM pessoa WHERE codpessoa = ?');
$consulta->execute([$userId]);
$usuario = $consulta->fetch();
?>


<body>
    <main>

        <!-- CONTEÚDO INFORMAÇÃO -->
        <div class="container">
            <div id="conteudo" class="content">
                <h1 class="text-center">Achado Não É Roubado, Mas a História É Mais Complexa...</h1>

                <p>Bem-vindo à nossa comunidade no Achados & Perdidos, onde exploramos a fascinante dinâmica dos achados
                    e
                    perdidos. A expressão "Achado não é roubado" é comumente ouvida, mas há mais para descobrir nessa
                    história...</p>

                <p>É inspirador ver histórias de honestidade, especialmente quando pessoas encontram objetos perdidos e
                    se
                    dedicam a devolvê-los aos seus donos. Taxistas e catadores de reciclados frequentemente são heróis
                    nesses momentos. Mas, poucos sabem que procurar o dono de itens perdidos é um dever legal, conforme
                    o
                    Código Civil.</p>

                <p>O artigo 1.233 do Código Civil estabelece que quem encontrar algo perdido deve devolvê-lo ao
                    proprietário. Se não conhecer o dono, deve empenhar-se em encontrá-lo. Caso não tenha sucesso, deve
                    entregá-lo à autoridade competente, que divulgará a descoberta. Após sessenta dias, se o dono não
                    for
                    encontrado, o objeto será leiloado, e o valor será revertido para o Município. Em casos de objetos
                    de
                    pequeno valor, o Município pode abrir mão em favor de quem encontrou.</p>

                <p>Se o dono for localizado, quem devolve o item tem direito a uma recompensa, não inferior a 5% do
                    valor do
                    objeto, além do ressarcimento de despesas com conservação e transporte. O descobridor responderá por
                    danos causados intencionalmente.</p>

                <p>Na nossa comunidade, celebramos essas histórias e discutimos como podemos contribuir para um mundo
                    mais
                    honesto e conectado. Participe, compartilhe suas experiências e inspire-se conosco!</p>
            </div>
        </div>
        <!-- FIM DO CONTEUDO INFORMAÇÃO -->
    </main>

    <!-- RODAPE -->
    <footer class="py-5 bg-primary-color">
        <div class="row justify-content-center">
            <div class="col-6 col-md-2 mb-2">
                <h5>Comunidade</h5>
                <ul class="nav flex-column">
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Home</a></li>
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Features</a></li>
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Pricing</a></li>
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">FAQs</a></li>
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">About</a></li>
                </ul>
            </div>

            <div class="col-6 col-md-2 mb-2">
                <h5>Serviços</h5>
                <ul class="nav flex-column">
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Home</a></li>
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Features</a></li>
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Pricing</a></li>
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">FAQs</a></li>
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">About</a></li>
                </ul>
            </div>

            <div class="col-6 col-md-2 mb-2">
                <h5>Informação</h5>
                <ul class="nav flex-column">
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Home</a></li>
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Features</a></li>
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Pricing</a></li>
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">FAQs</a></li>
                    <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">About</a></li>
                </ul>
            </div>


        </div>

    </footer>
    <!-- FINAL DO RODAPÉ -->
</body>

</html>