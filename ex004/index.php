<?php 
echo "Tipos Primitivos em PHP: <br>";
$inteiro = (double) 42; // coerção de tipo para double
$flutuante = 3.14;
$booleano = true;
$string = "Olá, Mundo!";
$caractere = 'A';
$nulo = null;
echo "Inteiro: $inteiro <br>";
var_dump($inteiro) ; // Exibe o tipo e valor da variável
echo "Flutuante: $flutuante <br>";  
echo "Booleano: " . ($booleano ? 'true' : 'false') . "<br>";
echo "String: $string <br>";    
echo "Caractere: $caractere <br>";
echo "Nulo: $nulo <br>";
echo "<hr>";

$_VETOR = [1, 2, 3, 4, 5];
var_dump($_VETOR); // Exibe o tipo e valor do vetor
echo "Vetor: ";

?>



?>