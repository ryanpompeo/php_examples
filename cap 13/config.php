<?php
    $host = "localhost";
    $banco = "loja";
    $usuario = "root";
    $senha = "";
    $conn = new PDO("mysql:host=$host;dbname=$banco;charset=utf8", $usuario, $senha); //dsn
    $conn->setAttribute(
    PDO::ATTR_ERRMODE,
    PDO::ERRMODE_EXCEPTION
);