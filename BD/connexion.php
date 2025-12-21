<?php
try {
    $dsn = "mysql:host=localhost;dbname=restaurant";
    $username = "root";
    $password = "";
    $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION; //array permettent la gestion des erreurs
    $pdo = new PDO($dsn, $username, $password, $pdo_options);
} catch (Exception $e) {
    die("Error" . $e->getMessage());
}
