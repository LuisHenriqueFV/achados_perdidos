<?php
try {
<<<<<<< HEAD
    $pdo = new PDO("mysql:host=localhost; dbname=id21540160_achados_perdidos; charset=utf8", "id21540160_henrique","12345Qwertyuiop!");
=======
    $pdo = new PDO("mysql:host=localhost; dbname=perdidos_achados; charset=utf8", "root","");
>>>>>>> c015125519ffc3e02a3d2e8a7f0ae0287d5828b5
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e) {
    print $e->getMessage();
}
?>