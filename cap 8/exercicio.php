<?php
$erro = "";
$resultado = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $produto = $_POST['produto'];
    $quantidade = $_POST['quantidade'];
    $preco = $_POST['preco'];

    // VALIDAÇÃO
    if (empty($produto)) {
        $erro .= "Nome do produto é obrigatório<br>";
    }

    if (empty($preco) || $preco <= 0) {
        $erro .= "Preço deve ser maior que zero<br>";
    }

    if (empty($quantidade) || $quantidade <= 0) {
        $erro .= "Quantidade deve ser maior que zero<br>";
    }

    // PROCESSAMENTO
    if ($erro == "") {

        $total = $preco * $quantidade;

        // formatação
        $totalFormatado = number_format($total, 2, ',', '.');

        $resultado = "
            <h3>Cadastro realizado!</h3>
            <b>Produto:</b> $produto <br>
            <b>Preço:</b> R$ " . number_format($preco, 2, ',', '.') . " <br>
            <b>Quantidade:</b> $quantidade
            <hr>
            <b>Total: R$ $totalFormatado</b>
        ";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cadastro de Produto</title>
</head>
<body>

<h1>📦Cadastro de Produtos</h1>
<hr>
<form method="post">
    Produto:<br>
    <input type="text" name="produto"><br><br>

    Quantidade:<br>
    <input type="number" name="quantidade"><br><br>    

    Preço unitário:<br>
    <input type="number" step="0.01" name="preco"><br><br>

    <button>Cadastrar</button>
</form>
<br>

<span style='color:red'><?= $erro ?></span>
<span><?= $resultado ?></span>

</body>
</html>