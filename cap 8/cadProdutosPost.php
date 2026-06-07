<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cadastro de Produtos</title>
</head>
<body>
  <h1>📦Cadastro de Produtos</h1>
  <hr>

  <form method="post">
    Produto:<br>
    <input type="text" name="produto">
    <br><br>
    Quantidade:<br><input type="number" name="quantidade"><br>
    <br>
    <button>➕ Enviar</button>
  </form>
  <hr>

</body>
</html>

<?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {         
            $produto = $_POST['produto'];
            $quantidade = $_POST['quantidade'];
            $preco = $_POST['preco'];

            if (empty($produto) || empty($quantidade) || empty($preco)) {
                echo "Preencha todos os campos";
            } else {
                echo "<b>Produto:</b> $produto";
                echo "<br>";
                echo "<b>Quantidade:</b> $quantidade";
                echo "<b>Preço:</b> R$ " . number_format($preco, 2, ',', '.');
                $total = $preco * $quantidade;
                echo "<b>Total:</b> R$ " . number_format($total, 2, ',', '.');
            }
        }       
?>