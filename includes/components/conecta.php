<?php
try {
    $pdo = new PDO("mysql:host=localhost; dbname=id21540160_achados_perdidos; charset=utf8", "id21540160_henrique","12345Qwertyuiop!");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e) {
    print $e->getMessage();
}
?>