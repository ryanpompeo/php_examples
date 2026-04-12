<?php
//1) Função simples (sem parâmetro e sem retorno)
function mensagem() {
    $valor1 = 20;
    $valor2 = 5;
    $soma = $valor1 + $valor2;
    echo "Valor calculado pela função: $soma <br>";
}

// 2) Função com parâmetros
function saudacao($nome) {
    echo "Olá, $nome!<br>";
}

// 3) Função com retorno
function soma($a, $b) {
  return $a + $b;
}

// 4) Parâmetro com valor padrão
function calcularDesconto($valor, $percentual = 10) {
  return $valor - ($valor * $percentual / 100);
}

// 5) Tipagem opcional (introdução)
function multiplicar(int $a, int $b): int {
  return $a * $b;
}

// 6) Função usando array
function media(array $notas) {
  $total = array_sum($notas);
  return $total / count($notas);
}

// 7) Escopo de variáveis
$valor = 10; //escopo global

function mostrarValor() {  
  $valor = 5; // escopo local
  return $valor;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>PHP - Funções Essenciais</title>
</head>
<body>

<h1>Funções em PHP</h1>
<hr>

<h2>1) Função simples (sem parâmetro e sem retorno)</h2>
<?= mensagem() ?>

<h2>2) Função com parâmetros</h2>
<?= saudacao("Maria") ?>
<?= saudacao("João") ?>

<h2>3) Função com retorno</h2>
Soma = <?= soma(10, 5) ?>

<h2>4) Parâmetro com valor padrão</h2>
Com desconto padrão = <?= calcularDesconto(100) ?>
<br>
Com outro desconto = <?= calcularDesconto(100, 20) ?>

<h2>5) Tipagem opcional (introdução)</h2>
Passando inteiro = <?= multiplicar(4,5) ?>
<br>
Passando float = <?= multiplicar(4.5,5.5) ?>

<h2>6) Função usando array</h2>
Média = <?= media([7, 8, 9]) ?>

<h2>7) Escopo de variáveis</h2>
Valor Global = <?= $valor ?>
<br>
Valor Local = <?= mostrarValor() ?>

</body>
</html>