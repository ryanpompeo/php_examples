<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Funçoes aritmeticas</title>
</head>

<body>
    <h1>Funçoes aritmeticas</h1>
    <?php 
    $num1 = 10;
    $num2 = 3;

    echo "<p>Soma: " . ($num1 + $num2) . "</p>";
    echo "<p>Subtração: " . ($num1 - $num2) . "</p>";
    echo "<p>Multiplicação: " . ($num1 * $num2) . "</p>";
    echo "<p>Divisão: " . ($num1 / $num2) . "</p>";
    echo "<p>Módulo: " . ($num1 % $num2) . "</p>";

    echo "<p>Valor absoluto de -5: " . abs(-5) . "</p>";
    echo "<p>Raiz quadrada de 16: " . sqrt(16) . "</p>";
    echo "<p>Potência de 2 elevado a 3: " . pow(2, 3) . "</p>";
    echo "<p>Valor arredondado de 3.7: " . round(3.7) . "</p>";
    echo "<p>Valor arredondado para baixo de 3.7: " . floor(3.7) . "</p>";
    echo "<p>Valor arredondado para cima de 3.3: " . ceil(3.3) . "</p>";
    echo "<p>Valor máximo entre 5 e 10: " . max(5, 10) . "</p>";
    echo "<p>Valor mínimo entre 5 e 10: " . min(5, 10) . "</p>";    
    echo "<p>Número aleatório entre 0 e 1: " . rand() . "</p>";
    echo "<p>Número aleatório entre 1 e 100: " . rand(1, 100) . "</p>";
    
    ?>
</body>

</html>