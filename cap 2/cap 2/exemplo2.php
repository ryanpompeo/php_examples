<?php
    //$nome = "Maria";
    $nome = $_GET["nome"];
    $curso = $_GET["curso"];
    $sexo = $_GET["sexo"];

    if ($sexo == "F") {
        $saudacao = "bem-vinda";
    } else {
        $saudacao = "bem-vindo";
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>PHP Dinâmico</title>
    </head>
    <body>
        <h1>Olá, <?= $nome ?></h1>
        Seja <?= $saudacao ?> ao curso de <b><?= $curso ?></b>!
    </body>
</html>