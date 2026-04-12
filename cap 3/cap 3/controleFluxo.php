<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>PHP - Controle de Fluxo, Ternário e Coalescing</title>
</head>
<body>

<?php
echo "<h2>Controle de Fluxo no PHP</h2>";

// 1) if / else
echo "<h3>if / else</h3>";

$idade = 15;

if ($idade >= 18) {
  echo "Maior de idade<br>";
} else {
  echo "Menor de idade<br>";
}

echo "<hr>";

// 2) if / elseif / else
echo "<h3>if / elseif / else</h3>";

$nota = 7;

if ($nota >= 7) {
  echo "Aprovado<br>";
} elseif ( ($nota >= 5) && ($nota < 7) ) {
  echo "Recuperação<br>";
} else {
  echo "Reprovado<br>";
}
echo "<hr>";

// 3) Operadores lógicos
echo "<h3>Operadores lógicos</h3>";

$frequencia = 80;

if ($nota >= 7 && $frequencia >= 75) {
  echo "Aluno aprovado por nota e frequência<br>";
} else {
  echo "Aluno reprovado<br>";
}
echo "<hr>";

// 4) Operador ternário
echo "<h3>Operador ternário</h3>";
$nota = 4.9;
$resultado = ($nota >= 7) ? "Aprovado" : "Reprovado";

echo "Resultado: $resultado<br>";
echo "<hr>";

// 5) Null Coalescing (??)
echo "<h3>Operador Null Coalescing (??)</h3>";

// Simulando dados vindos da URL 
// http://localhost:8000/controleFluxo.php?nome=Simone&idade=25&curso=DS

$nome = $_GET["nome"] ?? "Visitante";
$idadeUsuario = $_GET["idade"] ?? "Idade não informada";

echo "Nome: $nome<br>";
echo "Idade: $idadeUsuario<br>";

// 6) switch
echo "<h3>switch</h3>";
$dia = 2;

switch ($dia) {
  case 1:
    echo "Domingo<br>";
    break;
  case 2:
    echo "Segunda-feira<br>";
    break;
  case 3:
    echo "Terça-feira<br>";
    break;
  case 4:
    echo "Quarta-feira<br>";
    break;
  case 5:
    echo "Quinta-feira<br>";
    break;
  case 6:
    echo "Sexta-feira<br>";
    break;
  case 7:
    echo "Sábado<br>";
    break;
  default:
    echo "Dia inválido<br>";
}
echo "<hr>";
?>

</body>
</html>