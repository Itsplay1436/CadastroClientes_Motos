<?php

require_once('config.php');

try {

    $database = new mysqli(DB_HOST, DB_USER, DB_PASSWORD);

    if ($database->connect_error) {
        throw new Exception($database->connect_error);
    }

    $database->set_charset("utf8mb4");

    $sql = "CREATE DATABASE IF NOT EXISTS " . DB_NAME .
           " CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci";

    $database->query($sql);

    $database->select_db(DB_NAME);

    $sqlCustomers = "
        CREATE TABLE IF NOT EXISTS customers (
            id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            cpf_cnpj VARCHAR(15) NOT NULL,
            birthdate DATETIME NOT NULL,
            address VARCHAR(255) NOT NULL,
            hood VARCHAR(100) NOT NULL,
            zip_code VARCHAR(8) NOT NULL,
            city VARCHAR(100) NOT NULL,
            state VARCHAR(2) NOT NULL,
            phone VARCHAR(11) NOT NULL,
            mobile VARCHAR(11) NOT NULL,
            ie VARCHAR(15) NOT NULL,
            created DATETIME NOT NULL,
            modified DATETIME NOT NULL
        )
    ";

    $sqlMotos = "
        CREATE TABLE IF NOT EXISTS motos (
            id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
            modelo VARCHAR(50) NOT NULL,
            marca VARCHAR(30) NOT NULL,
            motor VARCHAR(20) NOT NULL,
            datacad DATETIME NOT NULL,
            placa VARCHAR(7) NOT NULL,
            foto VARCHAR(255) NULL
        )
    ";

    $sqlUsuarios = "
        CREATE TABLE IF NOT EXISTS usuarios (
            id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
            nome VARCHAR(100) NOT NULL,
            user VARCHAR(50) NOT NULL UNIQUE,
            password VARCHAR(255) NOT NULL,
            foto VARCHAR(255) NULL
        )
    ";

    $database->query($sqlCustomers);
    $database->query($sqlMotos);
    $database->query($sqlUsuarios);

    echo "<h2>Banco de dados verificado com sucesso!</h2>";
    echo "<p>Tabelas disponíveis: customers, motos e usuarios.</p>";

    $database->close();

} catch (Exception $e) {

    echo "<h2>Erro ao preparar o banco de dados.</h2>";
    echo "<p>" . $e->getMessage() . "</p>";

}
?>