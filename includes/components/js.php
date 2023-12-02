<body>
    <!-- JavaScript Bootstrap -->



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery.sticky.js"></script>
    <script src="js/click-scroll.js"></script>
    <script src="js/custom.js"></script>


    <script>
    function toggleCategorias() {
        var listaCategorias = document.getElementById('listaCategorias');
        var btnMostrarCategorias = document.getElementById('btnMostrarCategorias');
        var btnOcultarCategorias = document.getElementById('btnOcultarCategorias');

        if (listaCategorias.style.display === 'none' || listaCategorias.style.display === '') {
            listaCategorias.style.display = 'block';
            btnMostrarCategorias.style.display = 'none';
            btnOcultarCategorias.style.display = 'block';
        } else {
            listaCategorias.style.display = 'none';
            btnMostrarCategorias.style.display = 'block';
            btnOcultarCategorias.style.display = 'none';
        }
    }
</script>





    <!-- FUNÇÕES -->
    <script>

        window.onload = function () {
            let cep = document.getElementById("cep")

            cep.addEventListener("blur", buscaDados)
        }

        function buscaDados(event) {

            const options = {
                method: 'GET',
                mode: 'cors',
                cache: 'default'
            }

            fetch('https://viacep.com.br/ws/' + this.value + '/json', options)

                .then(function (response) {
                    if (response.ok)
                        return response.json()
                    else
                        console.log("erro");

                })
                .then(function (dados) {

                    document.getElementById("logradouro").value = dados.logradouro
                    document.getElementById("bairro").value = dados.bairro
                    document.getElementById("cidade").value = dados.localidade


                })
                .catch(function (e) {
                    console.log("Erro: " + e)
                })
        }
    </script>
    <script>
        // Quando a página é carregada, inicia o temporizador para ocultar alertas
        document.addEventListener("DOMContentLoaded", function () {
            // Seleciona todos os alertas na página
            var alertas = document.querySelectorAll('.alert');

            // Para cada alerta encontrado
            alertas.forEach(function (alerta) {
                // Oculta o alerta após 1 segundo
                setTimeout(function () {
                    alerta.style.display = 'none';
                }, 1000);
            });
        });
    </script>

            <!-- DARK MODE -->

            <script>
                function saveThemeToLocalStorage(theme){
                    
                }
            </script>



</body>