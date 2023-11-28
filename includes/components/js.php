


<body>
    <!-- JavaScript Bootstrap -->



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery.sticky.js"></script>
    <script src="js/click-scroll.js"></script>
    <script src="js/custom.js"></script>





    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>

</script> 

   -->

<script>
        function toggleCategorias() {
            var listaCategorias = document.getElementById("listaCategorias");
            var buttonMostrarCategorias = document.getElementById("btnMostrarCategorias");

            if (listaCategorias.style.display === "none") {
                listaCategorias.style.display = "block";
                buttonMostrarCategorias.textContent = "Ocultar Categorias Cadastradas";
            } else {
                listaCategorias.style.display = "none";
                buttonMostrarCategorias.textContent = "Mostrar Categorias Cadastradas";
            }
        }
    </script>


  <!-- <script>
    //estava no index?????
        var profileIcon = document.getElementById('profileIcon');
        var optionsMenu = document.getElementById('optionsMenu');

        profileIcon.addEventListener('click', function () {
            optionsMenu.classList.toggle('visible');
        });
    </script>

</body>