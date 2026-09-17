<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Testa conexão</title>
</head>

<body>
    <?php
    //include_once "config.php";
    include "config.php";
    //require_once "config.php";
    //require "config.php";
    //require_once 'config.php';
    include DBAPI;
    try {
        $db = open_database();
        echo "<h1>Banco de Dados Conectado!</h1>";
    } catch (Exception $e) {
        echo "<h2>{$e->getMessage()}</h2>";
    }
    ?>
</body>

</html>